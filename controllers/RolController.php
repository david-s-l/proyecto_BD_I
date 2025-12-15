<?php

class RolController extends Controller
{
    /**
     * Mostrar listado de roles
     */
    public function index()
    {
        $rolModel = $this->loadModel('Rol');
        $roles = $rolModel->listar();

        $this->render('usuarios/roles', [
            'roles' => $roles
        ]);
    }

    /**
     * Mostrar formulario y procesar creación
     */
    public function crear()
    {
        $rolModel = $this->loadModel('Rol');

        if ($this->isPost()) {
            $nombre = trim($this->post('nombre'));
            $descripcion = trim($this->post('descripcion'));

            // Validación sencilla
            if ($nombre === '') {
                return $this->render('usuarios/roles', [
                    'roles' => $rolModel->listar(),
                    'error' => 'El nombre del rol es obligatorio'
                ]);
            }

            $res = $rolModel->crear($nombre, $descripcion);

            if ($res['ok']) {
                $this->addLog('roles', 'INSERT', "Rol creado: $nombre (ID: {$res['insert_id']})");
                return $this->redirect('rol/index');
            }

            return $this->render('usuarios/roles', [
                'roles' => $rolModel->listar(),
                'error' => 'Error al crear el rol'
            ]);
        }

        // GET -> mostrar formulario (puede ser una vista dedicada si la tienes)
        $this->render('usuarios/roles', [
            'roles' => $rolModel->listar()
        ]);
    }

    /**
     * Editar rol: muestra formulario (GET) y procesa actualización (POST)
     * URL esperada: /rol/editar/{id}
     */
    public function editar($id = null)
    {
        $rolModel = $this->loadModel('Rol');

        $id = $id ?? $this->get('id');

        if (!$id) return $this->redirect('rol/index');

        $rol = $rolModel->obtener($id);
        if (!$rol) return $this->redirect('rol/index');

        if ($this->isPost()) {
            $nombre = trim($this->post('nombre'));
            $descripcion = trim($this->post('descripcion'));

            if ($nombre === '') {
                return $this->render('usuarios/roles', [
                    'roles' => $rolModel->listar(),
                    'error' => 'El nombre del rol es obligatorio',
                    'rol_editar' => $rol
                ]);
            }

            $res = $rolModel->editar($id, $nombre, $descripcion);

            if ($res['ok']) {
                $this->addLog('roles', 'UPDATE', "Rol actualizado: $nombre (ID: $id)");
                return $this->redirect('rol/index');
            }

            return $this->render('usuarios/roles', [
                'roles' => $rolModel->listar(),
                'error' => 'Error al actualizar el rol',
                'rol_editar' => $rol
            ]);
        }

        // GET -> mostrar (reutilizamos la vista de roles y pasamos el rol a editar)
        $this->render('usuarios/roles', [
            'roles' => $rolModel->listar(),
            'rol_editar' => $rol
        ]);
    }

    /**
     * Eliminar rol.
     * Si la petición es POST (AJAX) devuelve JSON.
     * Si es GET, redirige al listado.
     */
    public function eliminar($id = null)
    {
        $rolModel = $this->loadModel('Rol');

        // Si llega por POST (ajax)
        if ($this->isPost()) {
            $id = $_POST['id'] ?? null;

            header('Content-Type: application/json; charset=utf-8');

            if (!$id) {
                echo json_encode(['ok' => false, 'error' => 'ID no válido']);
                exit();
            }

            $res = $rolModel->eliminar($id);

            // Si el modelo devolvió un array con error personalizado
            if (isset($res['ok']) && $res['ok'] === false && isset($res['error'])) {
                echo json_encode(['ok' => false, 'error' => $res['error']]);
                exit();
            }

            // Si execute devolvió el resultado típico
            if (isset($res['ok']) && $res['ok']) {
                $this->addLog('roles', 'DELETE', "Rol eliminado (ID: $id)");
                echo json_encode(['ok' => true]);
                exit();
            }

            // Fallback: error genérico
            echo json_encode(['ok' => false, 'error' => 'Error al eliminar el rol']);
            exit();
        }

        // Si no es POST -> eliminación por link (GET)
        $id = $id ?? $this->get('id');
        if (!$id) return $this->redirect('rol/index');

        $res = $rolModel->eliminar($id);

        if (isset($res['ok']) && $res['ok']) {
            $this->addLog('roles', 'DELETE', "Rol eliminado (ID: $id)");
            return $this->redirect('rol/index');
        }

        // Si hubo error por relaciones u otro, volver al listado con mensaje
        $error = (isset($res['error']) ? $res['error'] : 'Error al eliminar el rol');
        $this->render('usuarios/roles', [
            'roles' => $rolModel->listar(),
            'error' => $error
        ]);
    }
}
