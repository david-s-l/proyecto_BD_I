<?php

class Inventario extends Model {
    /* ============================================================
       📌 OBTENER LISTA DE PRODUCTOS + STOCK
    ============================================================ */
    public function listarInventario()
    {
        $sql = "SELECT 
                    p.id_producto,
                    p.nombre,
                    c.nombre AS categoria,
                    p.precio,
                    i.stock_actual
                FROM inventario i
                INNER JOIN productos p ON p.id_producto = i.id_producto
                LEFT JOIN categorias c ON c.id_categoria = p.id_categoria
                ORDER BY p.nombre ASC";

        return $this->fetchAll($sql);
    }

    /* ============================================================
       📌 OBTENER MOVIMIENTOS
    ============================================================ */
    public function listarMovimientos()
    {
        $sql = "SELECT 
                    m.id_movimiento,
                    m.fecha,
                    p.nombre AS producto,
                    m.tipo,
                    m.cantidad,
                    m.motivo,
                    u.username AS usuario
                FROM movimiento_inventario m
                INNER JOIN productos p ON p.id_producto = m.id_producto
                INNER JOIN usuarios u ON u.id_usuario = m.id_usuario
                ORDER BY m.fecha DESC";

        return $this->fetchAll($sql);
    }

    /* ============================================================
       📌 OBTENER TODOS LOS PRODUCTOS (para selects)
    ============================================================ */
    public function productos()
    {
        return $this->fetchAll("SELECT id_producto, nombre FROM productos ORDER BY nombre ASC");
    }

    /* ============================================================
       📌 OBTENER DATOS DE UN PRODUCTO
    ============================================================ */
    public function obtenerProducto($id_producto)
    {
        return $this->fetchOne(
            "SELECT 
                p.*,
                i.stock_actual
            FROM productos p
            LEFT JOIN inventario i ON i.id_producto = p.id_producto
            WHERE p.id_producto = ?
            LIMIT 1",
            [$id_producto],
            "i"
        );
    }

    /* ============================================================
       📌 REGISTRAR ENTRADA
       Usa SP si existe, sino SQL directo
    ============================================================ */
    public function registrarEntrada($id_producto, $cantidad, $motivo, $id_usuario)
    {
        // Intentar usar SP
        try {
            return $this->execute(
                "CALL sp_registrar_entrada(?,?,?,?)",
                [$id_producto, $cantidad, $id_usuario, $motivo],
                "iiis"
            );
        } catch (\Throwable $e) {
            // SQL fallback
            $this->execute(
                "INSERT INTO movimiento_inventario(id_producto, id_usuario, tipo, cantidad, motivo)
                 VALUES(?, ?, 'entrada', ?, ?)",
                [$id_producto, $id_usuario, $cantidad, $motivo],
                "iiis"
            );

            return $this->execute(
                "UPDATE inventario SET stock_actual = stock_actual + ? WHERE id_producto = ?",
                [$cantidad, $id_producto],
                "ii"
            );
        }
    }

    /* ============================================================
       📌 REGISTRAR SALIDA
    ============================================================ */
    public function registrarSalida($id_producto, $cantidad, $motivo, $id_usuario)
    {
        try {
            return $this->execute(
                "CALL sp_registrar_salida(?,?,?,?)",
                [$id_producto, $cantidad, $id_usuario, $motivo],
                "iiis"
            );
        } catch (\Throwable $e) {
            $this->execute(
                "INSERT INTO movimiento_inventario(id_producto, id_usuario, tipo, cantidad, motivo)
                 VALUES(?, ?, 'salida', ?, ?)",
                [$id_producto, $id_usuario, $cantidad, $motivo],
                "iiis"
            );

            return $this->execute(
                "UPDATE inventario SET stock_actual = stock_actual - ? WHERE id_producto = ?",
                [$cantidad, $id_producto],
                "ii"
            );
        }
    }

    /* ============================================================
       📌 REGISTRAR AJUSTE
    ============================================================ */
    public function registrarAjuste($id_producto, $cantidad, $motivo, $id_usuario)
    {
        try {
            return $this->execute(
                "CALL sp_ajuste_inventario(?,?,?,?)",
                [$id_producto, $cantidad, $id_usuario, $motivo],
                "iiis"
            );
        } catch (\Throwable $e) {
            $this->execute(
                "INSERT INTO movimiento_inventario(id_producto, id_usuario, tipo, cantidad, motivo)
                 VALUES(?, ?, 'ajuste', ?, ?)",
                [$id_producto, $id_usuario, $cantidad, $motivo],
                "iiis"
            );

            return $this->execute(
                "UPDATE inventario SET stock_actual = stock_actual + ? WHERE id_producto = ?",
                [$cantidad, $id_producto],
                "ii"
            );
        }
    }

    /* ============================================================
       📌 OBTENER STOCK ACTUAL POR PRODUCTO
    ============================================================ */
    public function obtenerStock($id_producto)
    {
        $sql = "SELECT stock_actual 
                FROM inventario 
                WHERE id_producto = ? 
                LIMIT 1";

        $res = $this->fetchOne($sql, [$id_producto], "i");
        
        // Si no existe, devuelve 0 (gracias al trigger, siempre debería existir)
        return $res['stock_actual'] ?? 0; 
    }
}
