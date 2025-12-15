<?php

class Rol extends Model {

    /* ============================================================
       📌 LISTAR TODOS LOS ROLES
    ============================================================ */
    public function listar() {
        $sql = "SELECT * FROM roles ORDER BY id_rol ASC";
        return $this->fetchAll($sql);
    }

    /* ============================================================
       📌 OBTENER UN ROL POR ID
    ============================================================ */
    public function obtener($id_rol) {
        $sql = "SELECT * FROM roles WHERE id_rol = ? LIMIT 1";
        return $this->fetchOne($sql, [$id_rol], "i");
    }

    /* ============================================================
       📌 CREAR ROL
    ============================================================ */
    public function crear($nombre, $descripcion) {
        $sql = "INSERT INTO roles (nombre, descripcion) VALUES (?, ?)";
        return $this->execute($sql, [$nombre, $descripcion], "ss");
    }

    /* ============================================================
       📌 EDITAR ROL
    ============================================================ */
    public function editar($id_rol, $nombre, $descripcion) {
        $sql = "UPDATE roles 
                SET nombre = ?, descripcion = ?
                WHERE id_rol = ?";
        return $this->execute($sql, [$nombre, $descripcion, $id_rol], "ssi");
    }

    /* ============================================================
       📌 VERIFICAR RELACIONES ANTES DE ELIMINAR
    ============================================================ */
    private function tieneUsuarios($id_rol) {
        $sql = "SELECT COUNT(*) AS total FROM usuarios_roles WHERE id_rol = ?";
        $res = $this->fetchOne($sql, [$id_rol], "i");
        return $res['total'] > 0;
    }

    /* ============================================================
       📌 ELIMINAR ROL
    ============================================================ */
    public function eliminar($id_rol) {

        if ($this->tieneUsuarios($id_rol)) {
            return [
                'ok' => false,
                'error' => "No se puede eliminar: el rol está asignado a uno o más usuarios."
            ];
        }

        return $this->execute(
            "DELETE FROM roles WHERE id_rol = ?",
            [$id_rol],
            "i"
        );
    }
}
