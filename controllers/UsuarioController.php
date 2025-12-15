<?php

class UsuarioController extends Controller {

    public function __construct() {
        $url = $_GET['url'] ?? '';

        // NO aplicar roles al login
        if (strpos($url, 'usuario/login') === 0 ||
            strpos($url, 'usuario/logout') === 0) {
            return;
        }

        RoleMiddleware::allow([1]); 
    }

    public function index() {
        return $this->listar();
    }

    public function listar() {
        $usuarioModel = $this->loadModel('Usuario');
        $usuarios = $usuarioModel->getAll();

        foreach ($usuarios as &$user) {
            $user['has_relations'] = $usuarioModel->hasRelations($user['id_usuario']);
        }

        $rolModel = $this->loadModel('Rol');
        $roles = $rolModel->listar();

        $this->render('usuarios/listar', [
            'usuarios' => $usuarios,
            'roles' => $roles
        ]);
    }

    /* ============================================================
       🔒 MÉTODO PRIVADO PARA REDIBUJAR LA VISTA CON ERRORES
    ============================================================ */
    private function loadDataAndRender($extra = []) {
        $usuarioModel = $this->loadModel('Usuario');
        $usuarios = $usuarioModel->getAll();

        foreach ($usuarios as &$u) {
            $u['has_relations'] = $usuarioModel->hasRelations($u['id_usuario']);
        }

        $rolModel = $this->loadModel('Rol');
        $roles = $rolModel->listar();


        $data = array_merge([
            'usuarios' => $usuarios,
            'roles' => $roles
        ], $extra);

        $this->render('usuarios/listar', $data);
    }

    /* ============================================================
       🔒 MÉTODO PRIVADO PARA VALIDAR FORMULARIO
    ============================================================ */
    private function validateUserForm($usuarioModel, $username, $password, $password_confirm, $id = null) {

        if ($usuarioModel->usernameExists($username, $id)) {
            return "El nombre de usuario '$username' ya existe";
        }

        if (!empty($password)) {
            if ($password !== $password_confirm) {
                return "Las contraseñas no coinciden";
            }

            if (strlen($password) < 6) {
                return "La contraseña debe tener al menos 6 caracteres";
            }
        } else if ($id === null) {
            return "La contraseña es obligatoria";
        }

        return null; // Todo correcto
    }

    /* ============================================================
       🟢 CREAR USUARIO
    ============================================================ */
    public function crear() {
        if (!$this->isPost()) {
            return $this->redirect('usuario/listar');
        }

        $username = trim($this->post('username'));
        $password = $this->post('password');
        $confirm = $this->post('password_confirm');
        $documento = trim($this->post('documento'));
        $nombres = trim($this->post('nombres'));
        $apellidos = trim($this->post('apellidos'));
        $email = trim($this->post('email'));
        $telefono = trim($this->post('telefono'));
        $roles_ids = $this->post('roles') ?? [];

        $usuarioModel = $this->loadModel('Usuario');

        // Validación
        $error = $this->validateUserForm($usuarioModel, $username, $password, $confirm);

        if ($error) {
            return $this->loadDataAndRender(['error' => $error]);
        }

        // Crear usuario
        $resultado = $usuarioModel->create($username, $password, $documento, $nombres, $apellidos, $email, $telefono);

        if ($resultado['ok']) {
            $usuarioModel->updateUserRoles($resultado['id'], $roles_ids);
            $this->addLog('usuarios', 'INSERT', "Usuario creado: $username (ID: {$resultado['id']})");
            return $this->redirect('usuario/listar');
        }

        return $this->loadDataAndRender(['error' => "Error al crear el usuario"]);
    }

    /* ============================================================
       🟡 EDITAR USUARIO
    ============================================================ */
    public function editar($id = null) {

        $id = $id ?? $this->get('id');

        if (!$id) return $this->redirect('usuario/listar');

        $usuarioModel = $this->loadModel('Usuario');
        $usuario = $usuarioModel->getById($id);

        if (!$usuario) return $this->redirect('usuario/listar');

        if ($this->isPost()) {

            $username = trim($this->post('username'));
            $password = $this->post('password');
            $confirm = $this->post('password_confirm');
            $documento = trim($this->post('documento'));
            $nombres = trim($this->post('nombres'));
            $apellidos = trim($this->post('apellidos'));
            $email = trim($this->post('email'));
            $telefono = trim($this->post('telefono'));
            $estado = $this->post('estado');
            $roles_ids = $this->post('roles') ?? [];

            // Validación
            $error = $this->validateUserForm($usuarioModel, $username, $password, $confirm, $id);

            if ($error) {
                return $this->loadDataAndRender([
                    'error' => $error,
                    'usuario_editar' => $usuario,
                    'roles_ids_usuario' => $usuarioModel->getUserRoles($id)
                ]);
            }

            // Actualizar usuario
            $resultado = $usuarioModel->update($id, $username, $documento, $nombres, $apellidos, $email, $telefono, $estado, $password);

            if ($resultado['ok']) {
                $usuarioModel->updateUserRoles($id, $roles_ids);
                $this->addLog('usuarios', 'UPDATE', "Usuario actualizado: $username (ID: $id)");
                return $this->redirect('usuario/listar');
            }

            return $this->loadDataAndRender([
                'error' => "Error al actualizar el usuario",
                'usuario_editar' => $usuario,
                'roles_ids_usuario' => $usuarioModel->getUserRoles($id)
            ]);

        }

        // GET → mostrar formulario
        return $this->loadDataAndRender([
            'usuario_editar' => $usuario,
            'roles_ids_usuario' => $usuarioModel->getUserRoles($id)
        ]);
    }

    /* ============================================================
       🔴 ELIMINAR USUARIO (AJAX)
    ============================================================ */
    public function eliminar($id = null) {

        header("Content-Type: application/json; charset=utf-8");

        // Si viene por POST (AJAX)
        if ($this->isPost()) {
            $id = $_POST['id'] ?? null;
        }

        if (!$id) {
            echo json_encode(["ok" => false, "error" => "ID no válido"]);
            exit();
        }

        $usuarioModel = $this->loadModel('Usuario');
        $usuario = $usuarioModel->getById($id);

        if (!$usuario) {
            echo json_encode(["ok" => false, "error" => "Usuario no encontrado"]);
            exit();
        }

        if ($usuarioModel->hasRelations($id)) {
            echo json_encode(["ok" => false, "error" => "No se puede eliminar porque tiene registros asociados"]);
            exit();
        }

        $usuarioModel->delete($id);

        echo json_encode(["ok" => true]);
        exit();
    }

    public function login(){
        // Mostrar formulario (GET)
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // NO usar $this->render porque agrega header, sidebar y footer
            require_once "views/usuarios/login.php";
            return;
        }

        // Procesar login (POST)
        $username = Request::post('username');
        $password = Request::post('password');

        $model = new Usuario();
        $usuario = $model->login($username, $password);

        if (!$usuario) {
            Session::set('error', "Usuario o contraseña incorrectos");
            Utils::redirect('usuario/login');
            return;
        }

        Auth::login($usuario);
        Utils::redirect('dashboard/index');
    }

    public function logout(){
        Auth::logout();
        Utils::redirect('usuario/login'); 
    }
}