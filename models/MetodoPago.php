<?php

class MetodoPago extends Model {

    public function getAll() {
        $sql = "SELECT * FROM metodo_pago ORDER BY id_metodo_pago DESC";
        return $this->fetchAll($sql);
    }

    public function create($nombre, $descripcion) {
        $sql = "INSERT INTO metodo_pago (nombre, descripcion)
                VALUES (?, ?)";
        return $this->execute($sql, [$nombre, $descripcion], "ss");
    }

    public function getById($id_metodo_pago) {
        $sql = "SELECT * FROM metodo_pago WHERE id_metodo_pago = ? LIMIT 1";
        return $this->fetchOne($sql, [$id_metodo_pago], "i");
    }

    public function update($id_metodo_pago, $nombre, $descripcion) {
        $sql = "UPDATE metodo_pago 
                SET nombre = ?, descripcion = ?
                WHERE id_metodo_pago = ?";
        return $this->execute($sql, [$nombre, $descripcion, $id_metodo_pago], "ssi");
    }

    public function delete($id_metodo_pago) {
        $sql = "DELETE FROM metodo_pago WHERE id_metodo_pago = ?";
        return $this->execute($sql, [$id_metodo_pago], "i");
    }

    public function hasPayments($id_metodo_pago) {
        $sql = "SELECT COUNT(*) AS total FROM pago_venta WHERE id_metodo_pago = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id_metodo_pago);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        return $result['total'] > 0;
    }

}