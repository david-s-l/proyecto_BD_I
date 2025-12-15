<?php

class Categoria extends Model {

    public function getAll() {
        $sql = "SELECT * FROM categorias ORDER BY id_categoria DESC";
        return $this->fetchAll($sql);
    }

    public function create($nombre, $descripcion) {
        $sql = "INSERT INTO categorias (nombre, descripcion)
                VALUES (?, ?)";
        return $this->execute($sql, [$nombre, $descripcion], "ss");
    }

    public function getById($id_categoria) {
        $sql = "SELECT * FROM categorias WHERE id_categoria = ? LIMIT 1";
        return $this->fetchOne($sql, [$id_categoria], "i");
    }

    public function update($id_categoria, $nombre, $descripcion) {
        $sql = "UPDATE categorias 
                SET nombre = ?, descripcion = ?
                WHERE id_categoria = ?";
        return $this->execute($sql, [$nombre, $descripcion, $id_categoria], "ssi");
    }

    public function delete($id_categoria) {
        $sql = "DELETE FROM categorias WHERE id_categoria = ?";
        return $this->execute($sql, [$id_categoria], "i");
    }

    public function hasProducts($id_categoria) {
        $sql = "SELECT COUNT(*) AS total FROM productos WHERE id_categoria = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id_categoria);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        return $result['total'] > 0;
    }

}
    