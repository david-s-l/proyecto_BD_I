<?php

class Compras extends Model {


    /* ============================================================
       📌 REGISTRAR COMPRA (CABECERA) - USA SP (CORREGIDO)
       Ahora recibe y envía subtotal, igv y total (total_con_igv).
    ============================================================ */
    public function registrarCompra(
        $id_proveedor, 
        $id_usuario, 
        $subtotal, 
        $igv,      
        $total     
    ) {
        // SP: CALL sp_registrar_compra(p_id_proveedor, p_id_usuario, p_subtotal, p_igv, p_total_con_igv)
        $sql = "CALL sp_registrar_compra(?, ?, ?, ?, ?)";
        return $this->fetchOne($sql, [
            $id_proveedor, 
            $id_usuario, 
            $subtotal, 
            $igv, 
            $total
        ], "iiddd"); // <--- ¡AQUÍ ESTÁ EL PROBLEMA!
    }

    /* ============================================================
       📌 INSERTAR DETALLE COMPRA + INVENTARIO + MOVIMIENTO (CORREGIDO)
       SP: CALL sp_registrar_detalle_compra(p_id_compra, p_id_producto, p_cantidad, p_precio, p_id_usuario)
    ============================================================ */
    public function registrarDetalle(
        $id_compra, 
        $id_producto, 
        $cantidad, 
        $precio, // Precio unitario CON IGV
        $id_usuario
    ) {
        $sql = "CALL sp_registrar_detalle_compra(?, ?, ?, ?, ?)";
        return $this->execute($sql, [
            $id_compra,
            $id_producto,
            $cantidad,
            $precio,
            $id_usuario
        ], "iiidi"); // i=int, d=decimal
    }

    /* ============================================================
       📌 LISTAR TODAS LAS COMPRAS (Montos agregados)
    ============================================================ */
    public function listar() {
        $sql = "SELECT 
                    c.id_compra, 
                    c.fecha_compra, 
                    c.subtotal,      
                    c.igv,           
                    c.total,        
                    p.nombre AS proveedor,
                    CONCAT(u.nombres, ' ', u.apellidos) AS usuario
                FROM compras c
                INNER JOIN proveedores p ON p.id_proveedor = c.id_proveedor
                INNER JOIN usuarios u ON u.id_usuario = c.id_usuario
                ORDER BY c.fecha_compra DESC";
        return $this->fetchAll($sql);
    }

    /* ============================================================
       📌 OBTENER COMPRA POR ID (CABECERA) (Montos agregados)
    ============================================================ */
    public function obtener($id_compra) {
        $sql = "SELECT 
                    c.*,              /* Incluye subtotal, igv, total */
                    p.nombre AS proveedor,
                    p.ruc AS proveedor_ruc,
                    p.telefono AS proveedor_telefono,
                    CONCAT(u.nombres, ' ', u.apellidos) AS usuario
                FROM compras c
                INNER JOIN proveedores p ON p.id_proveedor = c.id_proveedor
                INNER JOIN usuarios u ON u.id_usuario = c.id_usuario
                WHERE c.id_compra = ?
                LIMIT 1";
        return $this->fetchOne($sql, [$id_compra], "i");
    }

    /* ============================================================
       📌 OBTENER DETALLE DE UNA COMPRA
       Nota: el subtotal en detalle_compra es cantidad * precio (C/IGV)
    ============================================================ */
    public function obtenerDetalle($id_compra) {
        $sql = "SELECT 
                    d.id_detalle_compra,
                    d.id_producto,
                    d.cantidad,
                    d.precio,
                    d.subtotal,
                    pr.nombre AS producto
                FROM detalle_compra d
                INNER JOIN productos pr ON pr.id_producto = d.id_producto
                WHERE d.id_compra = ?";
        return $this->fetchAll($sql, [$id_compra], "i");
    }

    /* ============================================================
       📌 ELIMINAR COMPRA (Nota: esto no revierte inventario)
    ============================================================ */
    public function eliminar($id_compra) {
        // En un sistema robusto, la eliminación de una compra debería
        // anular el movimiento de inventario. Aquí mantenemos la versión simple:
        
        // 1. Eliminar el detalle
        $sqlDetalle = "DELETE FROM detalle_compra WHERE id_compra = ?";
        $this->execute($sqlDetalle, [$id_compra], "i");
        
        // 2. Eliminar la compra
        $sql = "DELETE FROM compras WHERE id_compra = ?";
        return $this->execute($sql, [$id_compra], "i");
    }

    /* ============================================================
       📌 OBTENER COMPRAS POR PROVEEDOR (Montos agregados)
    ============================================================ */
    public function porProveedor($id_proveedor) {
        $sql = "SELECT 
                    c.id_compra, 
                    c.fecha_compra, 
                    c.subtotal,       
                    c.igv,            
                    c.total,         
                    CONCAT(u.nombres, ' ', u.apellidos) AS usuario
                FROM compras c
                INNER JOIN usuarios u ON u.id_usuario = c.id_usuario
                WHERE c.id_proveedor = ?
                ORDER BY c.fecha_compra DESC";
        return $this->fetchAll($sql, [$id_proveedor], "i");
    }

    /* ============================================================
       📌 OBTENER COMPRAS POR RANGO DE FECHAS (Montos agregados)
    ============================================================ */
    public function porFechas($fecha_inicio, $fecha_fin) {
        $sql = "SELECT 
                    c.id_compra, 
                    c.fecha_compra, 
                    c.subtotal,       
                    c.igv,            
                    c.total,         
                    p.nombre AS proveedor,
                    CONCAT(u.nombres, ' ', u.apellidos) AS usuario
                FROM compras c
                INNER JOIN proveedores p ON p.id_proveedor = c.id_proveedor
                INNER JOIN usuarios u ON u.id_usuario = c.id_usuario
                WHERE DATE(c.fecha_compra) BETWEEN ? AND ?
                ORDER BY c.fecha_compra DESC";
        return $this->fetchAll($sql, [$fecha_inicio, $fecha_fin], "ss");
    }
}