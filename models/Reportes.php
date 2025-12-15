<?php

class Reportes extends Model
{
    /* ============================================================
       📊 COMPRAS POR PROVEEDOR
    ============================================================ */
    public function comprasPorProveedor()
    {
        $sql = "SELECT 
                    pr.nombre AS proveedor,
                    COUNT(c.id_compra) AS compras,
                    SUM(c.total) AS total
                FROM compras c
                INNER JOIN proveedores pr ON pr.id_proveedor = c.id_proveedor
                GROUP BY c.id_proveedor";

        return $this->fetchAll($sql);
    }

    /* ============================================================
       📊 VENTAS POR FECHA
    ============================================================ */
    public function ventasPorFechas($inicio, $fin)
    {
        $sql = "SELECT 
                    DATE(fecha_venta) AS fecha,
                    COUNT(id_venta) AS cantidad,
                    SUM(total) AS total
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
       📊 VENTAS POR CLIENTE
    ============================================================ */
    public function ventasPorCliente()
    {
        $sql = "SELECT 
                    CONCAT(c.nombres,' ',c.apellidos) AS cliente,
                    COUNT(v.id_venta) AS ventas,
                    SUM(v.total) AS total
                FROM ventas v
                INNER JOIN clientes c ON c.id_cliente = v.id_cliente
                WHERE v.estado = 'ACTIVA'
                GROUP BY v.id_cliente
                ORDER BY total DESC";

        return $this->fetchAll($sql);
    }

    /* ============================================================
       📊 GANANCIAS DEL MES
    ============================================================ */
    public function gananciasDelMes($mes, $anio)
    {
        $sql = "SELECT
                    (
                        SELECT IFNULL(SUM(total),0)
                        FROM ventas
                        WHERE estado='ACTIVA'
                        AND MONTH(fecha_venta)=?
                        AND YEAR(fecha_venta)=?
                    ) -
                    (
                        SELECT IFNULL(SUM(total),0)
                        FROM compras
                        WHERE MONTH(fecha_compra)=?
                        AND YEAR(fecha_compra)=?
                    ) AS ganancia";

        return $this->fetchOne($sql, [$mes, $anio, $mes, $anio], "iiii");
    }

    /* ============================================================
       📊 VENTAS ANULADAS
    ============================================================ */
    public function ventasAnuladas()
    {
        $sql = "SELECT 
                    v.id_venta,
                    v.fecha_venta,
                    v.total,
                    CONCAT(c.nombres,' ',c.apellidos) AS cliente
                FROM ventas v
                LEFT JOIN clientes c ON c.id_cliente = v.id_cliente
                WHERE v.estado = 'ANULADA'
                ORDER BY v.fecha_venta DESC";

        return $this->fetchAll($sql);
    }
}
