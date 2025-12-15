<?php

class Model {

    protected $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    /**
     * SELECT múltiples filas
     */
    protected function fetchAll($sql, $params = [], $types = '') {

        $stmt = $this->db->prepare($sql);
        if (!$stmt) throw new Exception("Error SQL: " . $this->db->error);

        if (!empty($params)) {
            if ($types === '') {
                $types = str_repeat('s', count($params));
            }
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $rows = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();
        return $rows;
    }

    /**
     * SELECT una fila
     */
    protected function fetchOne($sql, $params = [], $types = '') {
        $data = $this->fetchAll($sql, $params, $types);
        return count($data) > 0 ? $data[0] : null;
    }

    /**
     * INSERT / UPDATE / DELETE
     */
    protected function execute($sql, $params = [], $types = '') {

        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            throw new Exception("Error SQL: " . $this->db->error);
        }

        if (!empty($params)) {
            if ($types === '') {
                $types = str_repeat('s', count($params));
            }
            $stmt->bind_param($types, ...$params);
        }

        $ok = $stmt->execute();
        $insert_id = $stmt->insert_id ?: $this->db->insert_id;
        $affected = $stmt->affected_rows;

        $stmt->close();

        return [
            'ok' => $ok,
            'id' => $insert_id,       // <-- 💥 Corrección principal
            'affected' => $affected
        ];
    }

    protected function escape($string) {
        return $this->db->real_escape_string($string);
    }
}
