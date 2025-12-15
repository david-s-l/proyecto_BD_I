<?php

class Usuario extends Model {

    /* ============================================================
       📌 LISTAR TODOS LOS USUARIOS
    ============================================================ */
    public function getAll() {
        $sql = "SELECT u.*, 
                GROUP_CONCAT(r.nombre SEPARATOR ', ') AS roles
                FROM usuarios u
                LEFT JOIN usuarios_roles ur ON u.id_usuario = ur.id_usuario
                LEFT JOIN roles r ON ur.id_rol = r.id_rol
                GROUP BY u.id_usuario
                ORDER BY u.id_usuario DESC";
        return $this->fetchAll($sql);
    }

    /* ============================================================
       📌 OBTENER UN USUARIO POR ID
    ============================================================ */
    public function getById($id_usuario) {
        $sql = "SELECT * FROM usuarios WHERE id_usuario = ? LIMIT 1";
        return $this->fetchOne($sql, [$id_usuario], "i");
    }

    /* ============================================================
       📌 CREAR USUARIO
    ============================================================ */
    public function create($username, $password, $documento, $nombres, $apellidos, $email, $telefono) {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO usuarios (username, password_hash, documento, nombres, apellidos, email, telefono, estado)
                VALUES (?, ?, ?, ?, ?, ?, ?, 1)";
        return $this->execute(
            $sql,
            [$username, $password_hash, $documento, $nombres, $apellidos, $email, $telefono],
            "sssssss"
        );
    }

    /* ============================================================
       📌 ACTUALIZAR USUARIO (CON O SIN CONTRASEÑA)
    ============================================================ */
    public function update($id_usuario, $username, $documento, $nombres, $apellidos, $email, $telefono, $estado, $password = null) {

        if (!empty($password)) {
            $password_hash = password_hash($password, PASSWORD_BCRYPT);

            $sql = "UPDATE usuarios 
                    SET username = ?, password_hash = ?, documento = ?, nombres = ?, apellidos = ?, 
                        email = ?, telefono = ?, estado = ?
                    WHERE id_usuario = ?";
            return $this->execute(
                $sql,
                [$username, $password_hash, $documento, $nombres, $apellidos, $email, $telefono, $estado, $id_usuario],
                "sssssssii"
            );
        }

        // Sin contraseña
        $sql = "UPDATE usuarios 
                SET username = ?, documento = ?, nombres = ?, apellidos = ?, email = ?, telefono = ?, estado = ?
                WHERE id_usuario = ?";
        return $this->execute(
            $sql,
            [$username, $documento, $nombres, $apellidos, $email, $telefono, $estado, $id_usuario],
            "ssssssii"
        );
    }

    /* ============================================================
       📌 ELIMINAR USUARIO (Y SUS ROLES ASOCIADOS)
    ============================================================ */
    public function delete($id_usuario) {
        // Eliminar roles
        $this->execute("DELETE FROM usuarios_roles WHERE id_usuario = ?", [$id_usuario], "i");

        // Eliminar usuario
        return $this->execute("DELETE FROM usuarios WHERE id_usuario = ?", [$id_usuario], "i");
    }

    /* ============================================================
       📌 VALIDAR USERNAME ÚNICO
    ============================================================ */
    public function usernameExists($username, $exclude_id = null) {

        if ($exclude_id) {
            $sql = "SELECT COUNT(*) AS total FROM usuarios WHERE username = ? AND id_usuario != ?";
            $result = $this->fetchOne($sql, [$username, $exclude_id], "si");
        } else {
            $sql = "SELECT COUNT(*) AS total FROM usuarios WHERE username = ?";
            $result = $this->fetchOne($sql, [$username], "s");
        }

        return $result['total'] > 0;
    }

    /* ============================================================
       🔥 OPTIMIZACIÓN: MÉTODO PRIVADO PARA CONTAR RELACIONES
    ============================================================ */
    private function countRelation($table, $id_usuario) {
        $sql = "SELECT COUNT(*) AS total FROM $table WHERE id_usuario = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc()['total'];
    }

    /* ============================================================
       📌 VALIDAR SI USUARIO TIENE RELACIONES
    ============================================================ */
    public function hasRelations($id_usuario) {
        return 
            $this->countRelation("ventas", $id_usuario) > 0 ||
            $this->countRelation("compras", $id_usuario) > 0 ||
            $this->countRelation("movimiento_inventario", $id_usuario) > 0;
    }

    /* ============================================================
       📌 OBTENER ROLES DE USUARIO
    ============================================================ */
    public function getUserRoles($id_usuario) {
        $sql = "SELECT id_rol FROM usuarios_roles WHERE id_usuario = ?";
        $result = $this->fetchAll($sql, [$id_usuario], "i");
        return array_column($result, 'id_rol');
    }

    /* ============================================================
       📌 ACTUALIZAR ROLES DEL USUARIO
    ============================================================ */
    public function updateUserRoles($id_usuario, $roles_ids) {

        $this->execute("DELETE FROM usuarios_roles WHERE id_usuario = ?", [$id_usuario], "i");

        if (!empty($roles_ids)) {
            foreach ($roles_ids as $id_rol) {
                $this->execute(
                    "INSERT INTO usuarios_roles (id_usuario, id_rol) VALUES (?, ?)",
                    [$id_usuario, $id_rol],
                    "ii"
                );
            }
        }

        return ['ok' => true];
    }

    public function login($username, $password){
        $db = Database::connect();

        // 1 SOLO buscar por username
        $sql = "SELECT 
                    u.id_usuario,
                    u.username,
                    u.password_hash,
                    r.id_rol
                FROM usuarios u
                INNER JOIN usuarios_roles ur ON ur.id_usuario = u.id_usuario
                INNER JOIN roles r ON r.id_rol = ur.id_rol
                WHERE u.username = ?
                LIMIT 1";

        $stmt = $db->prepare($sql);

        if (!$stmt) {
            die("Error SQL: " . $db->error);
        }

        $stmt->bind_param("s", $username);  // SOLO un parámetro
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if (!$user) {
            return false; // usuario no existe
        }

        // 2 Verificar contraseña correctamente
        if (!password_verify($password, $user['password_hash'])) {
            return false; // contraseña incorrecta
        }

        // 3 Quitar hash por seguridad
        unset($user['password_hash']);

        return $user;
    }


}
