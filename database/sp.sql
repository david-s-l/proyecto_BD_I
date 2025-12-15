DELIMITER //

-- ===================================================================
-- INVENTARIO: ENTIDADES BÁSICAS
-- ===================================================================
-- SP para registrar entrada del INVENTARIO (Uso: Ajustes manuales, Compras)
CREATE PROCEDURE sp_registrar_entrada(
    IN p_id_producto INT,
    IN p_cantidad INT,
    IN p_id_usuario INT,
    IN p_motivo VARCHAR(255)
)
BEGIN
    INSERT INTO movimiento_inventario (id_producto, id_usuario, tipo, cantidad, motivo)
    VALUES (p_id_producto, p_id_usuario, 'entrada', p_cantidad, p_motivo);

    UPDATE inventario
    SET stock_actual = stock_actual + p_cantidad
    WHERE id_producto = p_id_producto;
END //
 
-- SP para registrar salida del INVENTARIO (Uso: Ajustes manuales, Ventas)
CREATE PROCEDURE sp_registrar_salida(
    IN p_id_producto INT,
    IN p_cantidad INT,
    IN p_id_usuario INT,
    IN p_motivo VARCHAR(255)
)
BEGIN
    -- Verificar stock antes de la salida (si no se realiza en la aplicación cliente)
    DECLARE v_stock INT;
    SELECT stock_actual INTO v_stock FROM inventario WHERE id_producto = p_id_producto;
    
    IF v_stock < p_cantidad THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Stock insuficiente para registrar la salida manual';
    END IF;
    
    INSERT INTO movimiento_inventario (id_producto, id_usuario, tipo, cantidad, motivo)
    VALUES (p_id_producto, p_id_usuario, 'salida', p_cantidad, p_motivo);

    UPDATE inventario
    SET stock_actual = stock_actual - p_cantidad
    WHERE id_producto = p_id_producto;
END //

-- SP para ajuste (aumentar o disminuir, p_cantidad debe ser positiva o negativa)
CREATE PROCEDURE sp_ajuste_inventario(
    IN p_id_producto INT,
    IN p_cantidad INT, -- Puede ser positivo (aumento) o negativo (disminución)
    IN p_id_usuario INT,
    IN p_motivo VARCHAR(255)
)
BEGIN
    DECLARE v_stock_actual INT;
    DECLARE v_cantidad_movimiento INT;
    
    SET v_cantidad_movimiento = ABS(p_cantidad);
    
    IF p_cantidad < 0 THEN
        -- Obtener stock actual
        SELECT stock_actual INTO v_stock_actual FROM inventario WHERE id_producto = p_id_producto;
        
        -- Verificar si la resta resulta en un número negativo
        IF (v_stock_actual + p_cantidad) < 0 THEN
             SIGNAL SQLSTATE '45000'
             SET MESSAGE_TEXT = 'Error: El ajuste por disminución causa stock negativo';
        END IF;
    END IF;
    
    -- 3. Registrar el movimiento (usamos 'ajuste' y la cantidad absoluta)
    INSERT INTO movimiento_inventario (id_producto, id_usuario, tipo, cantidad, motivo)
    VALUES (p_id_producto, p_id_usuario, 'ajuste', v_cantidad_movimiento, p_motivo);
    
    -- 4. Actualizar el stock (la suma funciona correctamente si p_cantidad es positivo o negativo)
    UPDATE inventario
    SET stock_actual = stock_actual + p_cantidad
    WHERE id_producto = p_id_producto;
END //

-- Trigger: crear inventario al insertar producto
CREATE TRIGGER tg_product_creado
AFTER INSERT ON productos
FOR EACH ROW
BEGIN
    INSERT INTO inventario (id_producto, stock_actual)
    VALUES (NEW.id_producto, 0);
END //

-- Trigger: evitar stock negativo (funciona con los SPs que ya incluyen validación, pero es un resguardo)
CREATE TRIGGER tg_no_stock_negativo
BEFORE UPDATE ON inventario
FOR EACH ROW
BEGIN
    IF NEW.stock_actual < 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Stock no puede ser negativo';
    END IF;
END //

-- Función: validar stock disponible
CREATE FUNCTION fn_stock_disponible(
    p_id_producto INT
)
RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE v_stock INT;

    SELECT stock_actual
    INTO v_stock
    FROM inventario
    WHERE id_producto = p_id_producto;

    RETURN IFNULL(v_stock, 0);
END//

-- ===================================================================
-- COMPRAS
-- ===================================================================

-- SP para registrar una compra (cabecera) y devolver id_compra
CREATE PROCEDURE sp_registrar_compra (
    IN p_id_proveedor INT,
    IN p_id_usuario INT,
    IN p_subtotal DECIMAL(10,2),
    IN p_igv DECIMAL(10,2),
    IN p_total DECIMAL(10,2)
)
BEGIN
    -- CORRECCIÓN: Se insertan los 3 montos, eliminando la sintaxis errónea.
    INSERT INTO compras (id_proveedor, id_usuario, subtotal, igv, total)
    VALUES (p_id_proveedor, p_id_usuario, p_subtotal, p_igv, p_total);

    SELECT LAST_INSERT_ID() AS id_compra;
END //

-- SP para insertar detalle compra, actualizar inventario y registrar movimiento.
-- NOTA: Se asume que el p_precio recibido aquí es el precio NETO (sin IGV) por unidad de compra.
CREATE PROCEDURE sp_registrar_detalle_compra (
    IN p_id_compra INT,
    IN p_id_producto INT,
    IN p_cantidad INT,
    IN p_precio DECIMAL(10,2), -- Precio unitario NETO (sin IGV)
    IN p_id_usuario INT
)
BEGIN
    DECLARE v_subtotal_item DECIMAL(10,2);
    SET v_subtotal_item = p_cantidad * p_precio; -- Subtotal del item SIN IGV

    INSERT INTO detalle_compra (id_compra, id_producto, cantidad, precio, subtotal)
    VALUES (p_id_compra, p_id_producto, p_cantidad, p_precio, v_subtotal_item);

    -- actualizar inventario
    UPDATE inventario
    SET stock_actual = stock_actual + p_cantidad
    WHERE id_producto = p_id_producto;

    -- registrar movimiento en la tabla movimiento_inventario
    INSERT INTO movimiento_inventario (id_producto, id_usuario, tipo, cantidad, motivo)
    VALUES (p_id_producto, p_id_usuario, 'entrada', p_cantidad, CONCAT('Compra #', p_id_compra));
END //

-- ===================================================================
-- VENTAS
-- ===================================================================

-- SP para crear venta (cabecera) - MODIFICADO para estandarizar la firma
CREATE PROCEDURE sp_crear_venta(
    IN p_id_cliente INT,
    IN p_id_usuario INT,
    IN p_subtotal DECIMAL(10,2),
    IN p_igv DECIMAL(10,2),
    IN p_total DECIMAL(10,2)
)
BEGIN
    -- Se inicializa en 0.00. Los triggers calcularán el total real.
    INSERT INTO ventas (id_cliente, id_usuario, subtotal, igv, total)
    VALUES (p_id_cliente, p_id_usuario, p_subtotal, p_igv, p_total); 

    SELECT LAST_INSERT_ID() AS id_venta;
END //

-- SP para agregar detalle de venta
-- NOTA: Asumimos que el p_precio aquí es el precio de venta unitario CON IGV.
CREATE PROCEDURE sp_agregar_detalle_venta(
    IN p_id_venta INT,
    IN p_id_producto INT,
    IN p_cantidad INT,
    IN p_precio_con_igv DECIMAL(10,2) -- Precio unitario CON IGV
)
BEGIN
    DECLARE v_stock INT;
    DECLARE v_subtotal_item DECIMAL(10,2); -- Subtotal del item CON IGV

    SET v_stock = fn_stock_disponible(p_id_producto);

    IF v_stock < p_cantidad THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Stock insuficiente para realizar la venta';
    END IF;
    
    SET v_subtotal_item = p_cantidad * p_precio_con_igv;

    INSERT INTO detalle_venta (
        id_venta,
        id_producto,
        cantidad,
        precio, -- Precio CON IGV
        subtotal -- Subtotal del item CON IGV
    )
    VALUES (
        p_id_venta,
        p_id_producto,
        p_cantidad,
        p_precio_con_igv,
        v_subtotal_item
    );
END //

-- SP para obtener detalle completo de una venta
CREATE PROCEDURE sp_detalle_venta(
    IN p_id_venta INT
)
BEGIN
    SELECT 
        dv.id_detalle_venta,
        p.nombre AS nom_producto,
        dv.cantidad AS cantidad,
        dv.precio AS precio_con_igv, -- Clarificar que es con IGV
        dv.subtotal AS subtotal_item_con_igv
    FROM detalle_venta dv
    INNER JOIN productos p ON p.id_producto = dv.id_producto
    WHERE dv.id_venta = p_id_venta;
END //

-- SP para anular venta (sin tocar inventario)
CREATE PROCEDURE sp_anular_venta(
    IN p_id_venta INT
)
BEGIN
    -- Validar que exista y esté activa
    IF NOT EXISTS (
        SELECT 1 FROM ventas
        WHERE id_venta = p_id_venta
        AND estado = 'ACTIVA'
    ) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'La venta no existe o ya fue anulada';
    END IF;

    UPDATE ventas
    SET estado = 'ANULADA'
    WHERE id_venta = p_id_venta;
    -- El trigger 'trg_anular_venta_inventario' se encarga de devolver el stock.
END //

-- ===================================================================
-- TRIGGERS DE VENTA: Actualizan Inventario y Totales
-- ===================================================================

-- Trigger: Descontar inventario (SALIDA) y registrar movimiento al agregar detalle de venta
CREATE TRIGGER trg_salida_inventario_venta
AFTER INSERT ON detalle_venta
FOR EACH ROW
BEGIN
    DECLARE v_id_usuario INT;
    
    -- Obtener id_usuario del registro de venta
    SELECT id_usuario INTO v_id_usuario FROM ventas WHERE id_venta = NEW.id_venta;
    
    -- Actualizar inventario
    UPDATE inventario
    SET stock_actual = stock_actual - NEW.cantidad
    WHERE id_producto = NEW.id_producto;

    -- Registrar movimiento de salida
    INSERT INTO movimiento_inventario (
        id_producto,
        id_usuario,
        tipo,
        cantidad,
        motivo,
        referencia
    )
    VALUES (
        NEW.id_producto,
        v_id_usuario,
        'salida',
        NEW.cantidad,
        'Venta de producto',
        CONCAT('VENTA-', NEW.id_venta)
    );
END //

-- Trigger: Recalcular totales (subtotal, igv, total) de la venta - CORREGIDO
CREATE TRIGGER trg_actualizar_totales_venta
AFTER INSERT ON detalle_venta
FOR EACH ROW
BEGIN
    DECLARE v_igv_rate DECIMAL(5,2);
    DECLARE v_total_bruto DECIMAL(10,2); -- Suma de subtotales CON IGV

    -- 1. Obtener la tasa de IGV de la tabla configuracion
    SELECT igv INTO v_igv_rate FROM configuracion LIMIT 1;
    -- Convertir de porcentaje (ej: 18.00) a tasa (ej: 0.18)
    SET v_igv_rate = v_igv_rate / 100.00;
    
    -- 2. Calcular el total bruto (suma de subtotales de detalle_venta, que son CON IGV)
    SELECT SUM(subtotal) 
    INTO v_total_bruto
    FROM detalle_venta
    WHERE id_venta = NEW.id_venta;
    
    -- 3. Actualizar la cabecera de la venta (ventas)
    UPDATE ventas
    SET 
        total = v_total_bruto, -- 🏆 CORREGIDO: Usar 'total'
        -- Desagregación: Subtotal SIN IGV
        subtotal = v_total_bruto / (1 + v_igv_rate),
        -- Monto IGV
        igv = v_total_bruto - (v_total_bruto / (1 + v_igv_rate))
    WHERE id_venta = NEW.id_venta;
END //

-- Trigger: Auditoría de ventas (INSERT)
CREATE TRIGGER trg_log_venta
AFTER INSERT ON ventas
FOR EACH ROW
BEGIN
    INSERT INTO log_sistema (
        tabla,
        operacion,
        descripcion
    )
    VALUES (
        'ventas',
        'INSERT',
        CONCAT('Nueva venta registrada ID=', NEW.id_venta, ' por usuario=', NEW.id_usuario)
    );
END //

-- Trigger: Devolver stock al anular venta (UPDATE estado='ANULADA')
CREATE TRIGGER trg_anular_venta_inventario
AFTER UPDATE ON ventas
FOR EACH ROW
BEGIN
    -- Solo si cambia de ACTIVA a ANULADA
    IF OLD.estado = 'ACTIVA' AND NEW.estado = 'ANULADA' THEN

        -- Devolver stock por cada producto vendido
        UPDATE inventario i
        INNER JOIN detalle_venta d
            ON d.id_producto = i.id_producto
        SET i.stock_actual = i.stock_actual + d.cantidad
        WHERE d.id_venta = NEW.id_venta;

        -- Registrar movimientos de entrada por anulación
        INSERT INTO movimiento_inventario (
            id_producto,
            id_usuario,
            tipo,
            cantidad,
            motivo,
            referencia
        )
        SELECT
            d.id_producto,
            NEW.id_usuario,
            'entrada', -- El stock vuelve a entrar al inventario
            d.cantidad,
            'Anulación de venta (Devolución de stock)',
            CONCAT('VENTA-', NEW.id_venta)
        FROM detalle_venta d
        WHERE d.id_venta = NEW.id_venta;

    END IF;
END //

-- Trigger de auditoría para anulación (UPDATE)
CREATE TRIGGER trg_log_anular_venta
AFTER UPDATE ON ventas
FOR EACH ROW
BEGIN
    IF OLD.estado = 'ACTIVA' AND NEW.estado = 'ANULADA' THEN
        INSERT INTO log_sistema (
            tabla,
            operacion,
            descripcion
        )
        VALUES (
            'ventas',
            'ANULAR',
            CONCAT('Venta anulada ID=', NEW.id_venta, ' por usuario=', NEW.id_usuario)
        );
    END IF;
END //

DELIMITER ;

