<?php

class Auditoria extends Model
{
    /* ============================================================
       📋 LISTAR AUDITORÍA
    ============================================================ */
    public function listar()
    {
        $sql = "SELECT
                    tabla,
                    operacion,
                    descripcion,
                    fecha
                FROM log_sistema
                ORDER BY fecha DESC";

        return $this->fetchAll($sql);
    }

    /* ============================================================
       🔍 FILTRAR AUDITORÍA (OPCIONAL)
    ============================================================ */
    public function filtrar($tabla = null, $operacion = null)
    {
        $sql = "SELECT
                    tabla,
                    operacion,
                    descripcion,
                    fecha
                FROM log_sistema
                WHERE 1=1";

        $params = [];
        $types  = "";

        if (!empty($tabla)) {
            $sql .= " AND tabla = ?";
            $params[] = $tabla;
            $types .= "s";
        }

        if (!empty($operacion)) {
            $sql .= " AND operacion = ?";
            $params[] = $operacion;
            $types .= "s";
        }

        $sql .= " ORDER BY fecha DESC";

        return $this->fetchAll($sql, $params, $types);
    }
}
