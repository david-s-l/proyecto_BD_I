<?php

class CuentaController extends Controller
{
    /* ============================================================
       👤 PERFIL DEL USUARIO LOGUEADO
    ============================================================ */
    public function index()
    {
        $cuenta = $this->loadModel("Cuenta");
        $id = Auth::id();
        // Obtener los datos del user_account logueado
        $user_account = $cuenta->obtenerPorId($id);

        return $this->render("cuenta/index", [
            "user_account" => $user_account // Aquí enviamos los datos al view
        ]);
    }

    /* ============================================================
       ✏️ ACTUALIZAR DATOS PERSONALES
    ============================================================ */
    public function actualizar()
    {
        if (!$this->isPost()) {
            return $this->redirect("cuenta/index");
        }

        $data = [
            "documento" => $this->post("documento"),
            "nombres"   => $this->post("nombres"),
            "apellidos" => $this->post("apellidos"),
            "email"     => $this->post("email"),
            "telefono"  => $this->post("telefono")
        ];

        $cuenta = $this->loadModel("Cuenta");

        if (empty($data['nombres']) || empty($data['apellidos'])) {
            return $this->render("cuenta/index", [
                "error"   => "Nombres y apellidos son obligatorios",
                "user_account" => $cuenta->obtenerPorId(Auth::id())
            ]);
        }

        if ($cuenta->actualizarDatos(Auth::id(), $data)) {

            $this->addLog(
                "usuarios",
                "UPDATE",
                "Usuario actualizó su perfil"
            );

            return $this->render("cuenta/index", [
                "success" => "Datos actualizados correctamente",
                "user_account" => $cuenta->obtenerPorId(Auth::id())
            ]);
        }

        return $this->render("cuenta/index", [
            "error"   => "No se pudo actualizar la información",
            "user_account" => $cuenta->obtenerPorId(Auth::id())
        ]);
    }

    /* ============================================================
    🔐 CAMBIO DE CONTRASEÑA (DESDE MODAL)
    ============================================================ */
    public function password() {
        if (!$this->isPost()) {
            return $this->redirect("cuenta/index");
        }

        $actual = $this->post("password_actual");
        $nueva  = $this->post("password_nueva");
        $conf   = $this->post("password_confirmar");

        // Validación: campos vacíos
        if (empty($actual) || empty($nueva) || empty($conf)) {
            $_SESSION['error_password'] = "Todos los campos son obligatorios";
            return $this->redirect("cuenta/index");
        }

        // Validación: longitud mínima
        if (strlen($nueva) < 6) {
            $_SESSION['error_password'] = "La nueva contraseña debe tener al menos 6 caracteres";
            return $this->redirect("cuenta/index");
        }

        // Validación: confirmación coincide
        if ($nueva !== $conf) {
            $_SESSION['error_password'] = "Las contraseñas no coinciden";
            return $this->redirect("cuenta/index");
        }

        // Validación: nueva diferente a actual
        if ($actual === $nueva) {
            $_SESSION['error_password'] = "La nueva contraseña debe ser diferente a la actual";
            return $this->redirect("cuenta/index");
        }

        $cuenta = $this->loadModel("Cuenta");

        // 🔐 Intentar cambiar la contraseña (valida automáticamente la actual)
        $resultado = $cuenta->cambiarPassword(Auth::id(), $actual, $nueva);

        if (!$resultado) {
            $_SESSION['error_password'] = "La contraseña actual es incorrecta";
            return $this->redirect("cuenta/index");
        }

        // Log del sistema
        $this->addLog(
            "usuarios",
            "UPDATE",
            "Cambio de contraseña usuario ID " . Auth::id()
        );

        $_SESSION['success_password'] = "✅ Contraseña actualizada correctamente";
        return $this->redirect("cuenta/index");
    }
}

