<?php

class Proveedor extends Model {

    public function listar() {
        return $this->fetchAll("SELECT * FROM proveedores");
    }

    public function getAll() {
        return $this->fetchAll("
            SELECT p.*,
                (SELECT COUNT(*) FROM compras c WHERE c.id_proveedor = p.id_proveedor) AS relaciones
            FROM proveedores p
            ORDER BY p.id_proveedor DESC
        ");
    }

    public function getById($id) {
        return $this->fetchOne(
            "SELECT * FROM proveedores WHERE id_proveedor = ?",
            [$id],
            "i"
        );
    }

    public function create($nombre, $ruc, $telefono, $email, $direccion) {
        $sql = "INSERT INTO proveedores (nombre, ruc, telefono, email, direccion)
                VALUES (?, ?, ?, ?, ?)";

        return $this->execute(
            $sql,
            [$nombre, $ruc, $telefono, $email, $direccion],
            "sssss"
        );
    }


    public function update($id, $nombre, $ruc, $telefono, $email, $direccion){
        $sql = "UPDATE proveedores 
                SET nombre = ?, 
                    ruc = ?, 
                    telefono = ?, 
                    email = ?, 
                    direccion = ?
                WHERE id_proveedor = ?";

        return $this->execute(
            $sql,
            [$nombre, $ruc, $telefono, $email, $direccion, $id],
            "sssssi"   // 👉 SIN espacios, SIN errores
        );
    }


    public function obtener($id) {
        return $this->getById($id);
    }

    public function comprasProveedor($id_proveedor) {
        $sql = "SELECT 
                    c.id_compra,
                    c.fecha_compra AS fecha,
                    c.total,
                    CONCAT(u.nombres, ' ', u.apellidos) AS usuario
                FROM compras c
                LEFT JOIN usuarios u ON u.id_usuario = c.id_usuario
                WHERE c.id_proveedor = ?
                ORDER BY c.fecha_compra DESC";

        return $this->fetchAll($sql, [$id_proveedor], "i");
    }

    public function eliminar($id_proveedor) {

        if ($this->hasRelations($id_proveedor)) {
            return [
                "ok" => false,
                "error" => "No se puede eliminar: el proveedor tiene compras registradas."
            ];
        }

        return $this->execute(
            "DELETE FROM proveedores WHERE id_proveedor = ?",
            [$id_proveedor],
            "i"
        );
    }

    public function hasRelations($id) {
        $r = $this->fetchOne(
            "SELECT COUNT(*) AS total FROM compras WHERE id_proveedor = ?",
            [$id],
            "i"
        );
        return $r["total"] > 0;
    }
}
