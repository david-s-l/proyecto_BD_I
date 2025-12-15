<?php
class Producto extends Model {

    public function listar() {
        return $this->fetchAll("SELECT * FROM productos");
    }

    public function getAll() {
        $sql = "SELECT 
                    p.id_producto, 
                    p.nombre, 
                    p.precio, 
                    p.descripcion, 
                    c.nombre AS categoria
                FROM productos p
                LEFT JOIN categorias c ON p.id_categoria = c.id_categoria
                ORDER BY p.id_producto DESC";
        return $this->fetchAll($sql);
    }

    public function create($nombre, $descripcion, $precio, $id_categoria) {
        $sql = "INSERT INTO productos (nombre, descripcion, precio, id_categoria)
                VALUES (?, ?, ?, ?, ?)";
        return $this->execute($sql, [$nombre, $descripcion, $precio, $id_categoria], 'ssdii');
    }

    public function getById($id) {
        $sql = "SELECT 
                    p.id_producto,
                    p.nombre,
                    p.descripcion,
                    p.precio,
                    p.estado,
                    p.id_categoria,
                    c.nombre AS categoria_nombre
                FROM productos p
                LEFT JOIN categorias c ON p.id_categoria = c.id_categoria
                WHERE p.id_producto = ?
                LIMIT 1";
        
        return $this->fetchOne($sql, [$id], 'i');
    }

    public function update($id_producto, $nombre, $descripcion, $precio, $id_categoria, $estado) {
        $sql = "UPDATE productos 
                SET nombre = ?, 
                    descripcion = ?, 
                    precio = ?, 
                    id_categoria = ?, 
                    estado = ?
                WHERE id_producto = ?";
        return $this->execute($sql, [$nombre, $descripcion, $precio, $id_categoria, $estado, $id_producto], "ssdiisi");
    }

    // Categorías activas
    public function getActivas() {
        $sql = "SELECT * FROM categorias ORDER BY nombre ASC";
        return $this->fetchAll($sql);
    }

    /* ============================================================
   📌 LISTAR PRODUCTOS ACTIVOS (PARA COMPRAS / VENTAS)
    ============================================================ */
    public function listarActivos()
    {
        $sql = "SELECT 
                    p.id_producto,
                    p.nombre,
                    p.precio,
                    IFNULL(i.stock_actual, 0) AS stock
                FROM productos p
                LEFT JOIN inventario i ON i.id_producto = p.id_producto
                WHERE p.estado = 1
                ORDER BY p.nombre ASC";

        return $this->fetchAll($sql);
    }

}
