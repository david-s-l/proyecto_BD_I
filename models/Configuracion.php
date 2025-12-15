<?php
class Configuracion extends Model {
    public function obtenerIGV() {
        $sql = "SELECT igv FROM configuracion LIMIT 1";
        return $this->fetchOne($sql)['igv'];
    }
}
