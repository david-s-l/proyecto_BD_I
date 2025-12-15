<?php

class Cliente extends Model {

    /* ============================================================
       📌 LISTAR TODOS LOS CLIENTES
    ============================================================ */
    public function listar() {
        $sql = "SELECT * FROM clientes ORDER BY apellidos, nombres ASC";
        return $this->fetchAll($sql);
    }

    /* ============================================================
       📌 OBTENER UN CLIENTE POR ID
    ============================================================ */
    public function obtener($id_cliente) {
        $sql = "SELECT * FROM clientes WHERE id_cliente = ? LIMIT 1";
        return $this->fetchOne($sql, [$id_cliente], "i");
    }

    /* ============================================================
       📌 CREAR CLIENTE
    ============================================================ */
    public function crear($documento, $nombres, $apellidos, $telefono, $email, $direccion) {
        $sql = "INSERT INTO clientes (documento, nombres, apellidos, telefono, email, direccion) 
                VALUES (?, ?, ?, ?, ?, ?)";
        return $this->execute($sql, [$documento, $nombres, $apellidos, $telefono, $email, $direccion], "ssssss");
    }

    /* ============================================================
       📌 EDITAR CLIENTE
    ============================================================ */
    public function editar($id_cliente, $documento, $nombres, $apellidos, $telefono, $email, $direccion) {
        $sql = "UPDATE clientes 
                SET documento = ?, 
                    nombres = ?, 
                    apellidos = ?, 
                    telefono = ?, 
                    email = ?, 
                    direccion = ?
                WHERE id_cliente = ?";
        return $this->execute($sql, [$documento, $nombres, $apellidos, $telefono, $email, $direccion, $id_cliente], "ssssssi");
    }

    /* ============================================================
       📌 VERIFICAR RELACIONES ANTES DE ELIMINAR
    ============================================================ */
    private function tieneVentas($id_cliente) {
        $sql = "SELECT COUNT(*) AS total FROM ventas WHERE id_cliente = ?";
        $res = $this->fetchOne($sql, [$id_cliente], "i");
        return $res['total'] > 0;
    }

    /* ============================================================
       📌 ELIMINAR CLIENTE
    ============================================================ */
    public function eliminar($id_cliente) {

        if ($this->tieneVentas($id_cliente)) {
            return [
                'ok' => false,
                'error' => "No se puede eliminar: el cliente tiene ventas registradas."
            ];
        }

        return $this->execute(
            "DELETE FROM clientes WHERE id_cliente = ?",
            [$id_cliente],
            "i"
        );
    }

    /* ============================================================
       📌 BUSCAR CLIENTES (OPCIONAL)
    ============================================================ */
    public function buscar($termino) {
        $termino = "%$termino%";
        $sql = "SELECT * FROM clientes 
                WHERE nombres LIKE ? 
                   OR apellidos LIKE ? 
                   OR documento LIKE ?
                ORDER BY apellidos, nombres";
        return $this->fetchAll($sql, [$termino, $termino, $termino], "sss");
    }

    /* ============================================================
       📌 VERIFICAR SI DOCUMENTO YA EXISTE (OPCIONAL)
    ============================================================ */
    public function documentoExiste($documento, $excluir_id = null) {
        if ($excluir_id) {
            $sql = "SELECT COUNT(*) as total FROM clientes 
                    WHERE documento = ? AND id_cliente != ?";
            $res = $this->fetchOne($sql, [$documento, $excluir_id], "si");
        } else {
            $sql = "SELECT COUNT(*) as total FROM clientes WHERE documento = ?";
            $res = $this->fetchOne($sql, [$documento], "s");
        }
        
        return $res['total'] > 0;
    }

    /* ============================================================
       📌 OBTENER HISTORIAL DE COMPRAS/VENTAS DEL CLIENTE
    ============================================================ */
    public function historialCompras($id_cliente) {
        $sql = "SELECT 
                    v.id_venta, 
                    v.fecha_venta AS fecha, 
                    v.total,
                    CONCAT(u.nombres, ' ', u.apellidos) AS vendedor
                FROM ventas v
                LEFT JOIN usuarios u ON v.id_usuario = u.id_usuario
                WHERE v.id_cliente = ?
                ORDER BY v.fecha_venta DESC";
        return $this->fetchAll($sql, [$id_cliente], "i");
    }
}