<?php

class Ventas extends Model {

    /* ============================================================
    📌 REGISTRAR VENTA (CABECERA)
    Los totales se inicializan en 0.00
    El trigger trg_actualizar_totales_venta recalcula todo
    ============================================================ */
    public function registrarVenta(
        $id_cliente,
        $id_usuario,
        $subtotal = 0.00,
        $igv = 0.00,
        $total = 0.00
    ) {
        $sql = "CALL sp_crear_venta(?, ?, ?, ?, ?)";
        
        return $this->fetchOne(
            $sql,
            [
                $id_cliente,
                $id_usuario,
                $subtotal,
                $igv,
                $total
            ],
            "iiddd" // i=int, d=decimal
        );
    }

    /* ============================================================
       📌 REGISTRAR DETALLE DE VENTA + DESCUENTO INVENTARIO
       El Trigger trg_actualizar_totales_venta se encarga de recalcular
       subtotal, igv y total de la cabecera después de este SP.
    ============================================================ */
    public function registrarDetalle(
        $id_venta,
        $id_producto,
        $cantidad,
        $precio) {
        // SP: CALL sp_agregar_detalle_venta(p_id_venta, p_id_producto, p_cantidad, p_precio)
        $sql = "CALL sp_agregar_detalle_venta(?, ?, ?, ?)";
        return $this->execute($sql, [
            $id_venta,
            $id_producto,
            $cantidad,
            $precio,
        ], "iiid"); // i=int, d=decimal
    }

    /* ============================================================
       📌 LISTAR VENTAS (Campos Subtotal, IGV y Total incluidos)
    ============================================================ */
    public function listar()
    {
        $sql = "SELECT 
                    v.id_venta,
                    v.fecha_venta,
                    v.subtotal,     
                    v.igv,          
                    v.total,
                    v.estado,
                    CONCAT(c.nombres, ' ', c.apellidos) AS cliente,
                    CONCAT(u.nombres, ' ', u.apellidos) AS usuario
                FROM ventas v
                LEFT JOIN clientes c ON c.id_cliente = v.id_cliente
                INNER JOIN usuarios u ON u.id_usuario = v.id_usuario
                ORDER BY v.fecha_venta DESC";

        return $this->fetchAll($sql);
    }

    /* ============================================================
       📌 OBTENER VENTA (CABECERA) (Campos Subtotal, IGV y Total incluidos)
    ============================================================ */
    public function obtener($id_venta)
    {
        $sql = "SELECT 
                    v.*, /* Incluye subtotal, igv, total directamente */
                    CONCAT(c.nombres, ' ', c.apellidos) AS cliente,
                    CONCAT(u.nombres, ' ', u.apellidos) AS usuario
                FROM ventas v
                LEFT JOIN clientes c ON c.id_cliente = v.id_cliente
                INNER JOIN usuarios u ON u.id_usuario = v.id_usuario
                WHERE v.id_venta = ?
                LIMIT 1";

        return $this->fetchOne($sql, [$id_venta], "i");
    }

    /* ============================================================
       📌 OBTENER DETALLE DE VENTA
       Nota: el subtotal del detalle es el valor CON IGV.
    ============================================================ */
    public function obtenerDetalle($id_venta)
    {
        // Usamos el SP que definimos para obtener el detalle
        $sql = "CALL sp_detalle_venta(?)"; 

        return $this->fetchAll($sql, [$id_venta], "i");
    }

    /* ============================================================
       📌 ANULAR VENTA
    ============================================================ */
    public function anular($id_venta)
    {
        $sql = "CALL sp_anular_venta(?)";
        return $this->execute($sql, [$id_venta], "i");
    }

    /* ============================================================
   📊 VENTAS POR RANGO DE FECHAS (Total general)
    ============================================================ */
    public function ventasPorFechas($inicio, $fin)
    {
        $sql = "SELECT 
                    DATE(fecha_venta) AS fecha,
                    COUNT(id_venta) AS cantidad,
                    SUM(subtotal) AS subtotal_vendido, 
                    SUM(igv) AS igv_recaudado,         
                    SUM(total) AS total_vendido        
                FROM ventas
                WHERE estado = 'ACTIVA'
                AND DATE(fecha_venta) BETWEEN ? AND ?
                GROUP BY DATE(fecha_venta)
                ORDER BY fecha ASC";

        return $this->fetchAll($sql, [$inicio, $fin], "ss");
    }

    /* ============================================================
   📊 VENTAS POR PRODUCTO
    ============================================================ */
    public function ventasPorProducto()
    {
        $sql = "SELECT 
                    p.nombre AS producto,
                    SUM(dv.cantidad) AS total_vendido,
                    SUM(dv.subtotal) AS total_ingreso 
                FROM detalle_venta dv
                INNER JOIN productos p ON p.id_producto = dv.id_producto
                INNER JOIN ventas v ON v.id_venta = dv.id_venta
                WHERE v.estado = 'ACTIVA'
                GROUP BY dv.id_producto
                ORDER BY total_vendido DESC";

        return $this->fetchAll($sql);
    }

    /* ============================================================
   📊 VENTAS POR CLIENTE (Subtotal, IGV y Total incluidos)
    ============================================================ */
    public function ventasPorCliente()
    {
        $sql = "SELECT 
                    CONCAT(c.nombres,' ',c.apellidos) AS cliente,
                    COUNT(v.id_venta) AS ventas,
                    SUM(v.subtotal) AS subtotal_total, 
                    SUM(v.igv) AS igv_total,          
                    SUM(v.total) AS total              
                FROM ventas v
                INNER JOIN clientes c ON c.id_cliente = v.id_cliente
                WHERE v.estado = 'ACTIVA'
                GROUP BY v.id_cliente
                ORDER BY total DESC";

        return $this->fetchAll($sql);
    }

    /* ============================================================
   📊 VENTAS POR MÉTODO DE PAGO
    ============================================================ */
    public function ventasPorMetodoPago()
    {
        $sql = "SELECT 
                    mp.nombre AS metodo,
                    COUNT(pv.id_pago) AS operaciones,
                    SUM(pv.monto) AS total
                FROM pago_venta pv
                INNER JOIN metodo_pago mp ON mp.id_metodo_pago = pv.id_metodo_pago
                -- Se debe filtrar solo las ventas activas para un reporte correcto
                INNER JOIN ventas v ON v.id_venta = pv.id_venta
                WHERE v.estado = 'ACTIVA' 
                GROUP BY mp.id_metodo_pago
                ORDER BY total DESC";

        return $this->fetchAll($sql);
    }

    /* ============================================================
   📊 VENTAS ANULADAS (Campos Subtotal, IGV y Total incluidos)
    ============================================================ */
    public function ventasAnuladas()
    {
        $sql = "SELECT 
                    v.id_venta,
                    v.fecha_venta,
                    v.subtotal,       
                    v.igv,            
                    v.total,
                    CONCAT(c.nombres,' ',c.apellidos) AS cliente
                FROM ventas v
                LEFT JOIN clientes c ON c.id_cliente = v.id_cliente
                WHERE v.estado = 'ANULADA'
                ORDER BY v.fecha_venta DESC";

        return $this->fetchAll($sql);
    }
}