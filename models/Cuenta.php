<?php

class Cuenta extends Model
{
    /* ============================================================
       👤 OBTENER DATOS DEL USUARIO LOGUEADO
    ============================================================ */
    public function obtenerPorId($id_usuario)
    {
        $sql = "SELECT
                    id_usuario,
                    username,
                    documento,
                    nombres,
                    apellidos,
                    email,
                    telefono
                FROM usuarios
                WHERE id_usuario = ?
                LIMIT 1";

        return $this->fetchOne($sql, [$id_usuario], "i");
    }
    

    /* ============================================================
       ✏️ ACTUALIZAR DATOS PERSONALES
    ============================================================ */
    public function actualizarDatos($id_usuario, $data)
    {
        $sql = "UPDATE usuarios SET
                    documento = ?,
                    nombres   = ?,
                    apellidos = ?,
                    email     = ?,
                    telefono  = ?
                WHERE id_usuario = ?";

        return $this->execute($sql, [
            $data['documento'],
            $data['nombres'],
            $data['apellidos'],
            $data['email'],
            $data['telefono'],
            $id_usuario
        ], "sssssi");
    }

    /* ============================================================
       🔐 CAMBIAR CONTRASEÑA (VALIDANDO LA ACTUAL)
    ============================================================ */
    public function cambiarPassword($id_usuario, $password_actual, $password_nueva)
    {
        // 1️⃣ Obtener el hash actual de la BD
        $sql = "SELECT password_hash 
                FROM usuarios 
                WHERE id_usuario = ? 
                LIMIT 1";
        
        $usuario = $this->fetchOne($sql, [$id_usuario], "i");

        if (!$usuario) {
            return false; // Usuario no encontrado
        }

        // 2️⃣ Verificar que la contraseña actual sea correcta
        if (!password_verify($password_actual, $usuario['password_hash'])) {
            return false; // Contraseña actual incorrecta
        }

        // 3️⃣ Generar hash de la nueva contraseña
        $nuevo_hash = password_hash($password_nueva, PASSWORD_BCRYPT);

        // 4️⃣ Actualizar en la BD
        $sql_update = "UPDATE usuarios 
                       SET password_hash = ? 
                       WHERE id_usuario = ?";

        return $this->execute($sql_update, [$nuevo_hash, $id_usuario], "si");
    }

    /* ============================================================
       🔎 VERIFICAR CONTRASEÑA ACTUAL (MÉTODO AUXILIAR - OPCIONAL)
    ============================================================ */
    public function verificarPasswordActual($id_usuario, $password)
    {
        $sql = "SELECT password_hash
                FROM usuarios
                WHERE id_usuario = ?
                LIMIT 1";

        $usuario = $this->fetchOne($sql, [$id_usuario], "i");

        if (!$usuario) {
            return false;
        }

        return password_verify($password, $usuario['password_hash']);
    }
}