<?php

class ProveedorController extends Controller {

    public function __construct() {
        // Solo admin (1) y almacenero (3)
        RoleMiddleware::allow([1, 3]);
    }

    public function index() {
        return $this->listar();
    }

    public function listar() {
        $proveedorModel = $this->loadModel("Proveedor");
        $proveedores = $proveedorModel->getAll();

        // Render con posible formulario (crear)
        $this->render("proveedores/listar", [
            "proveedores" => $proveedores
        ]);
    }

    /* ============================================================
        🔒 REDIBUJAR LA VISTA (cuando hay errores)
    ============================================================ */
    private function reloadForm($extra = []) {
        $proveedorModel = $this->loadModel("Proveedor");
        $proveedores = $proveedorModel->getAll();

        $data = array_merge([
            "proveedores" => $proveedores
        ], $extra);

        $this->render("proveedores/listar", $data);
    }

    /* ============================================================
        🟢 CREAR PROVEEDOR
    ============================================================ */
    public function crear() {

        if (!$this->isPost()) return $this->redirect("proveedor/listar");

        $nombre = trim($this->post("nombre"));
        $ruc = trim($this->post("ruc"));
        $telefono = trim($this->post("telefono"));
        $email = trim($this->post("email"));
        $direccion = trim($this->post("direccion"));

        if (empty($nombre)) {
            return $this->reloadForm(["error" => "El nombre es obligatorio"]);
        }

        $model = $this->loadModel("Proveedor");

        $ok = $model->create($nombre, $ruc, $telefono, $email, $direccion);

        if ($ok) {
            $this->addLog("proveedores", "INSERT", "Proveedor creado: $nombre");
            return $this->redirect("proveedor/listar");
        }

        return $this->reloadForm(["error" => "Ocurrió un error al registrar"]);
    }

    /* ============================================================
        🟡 EDITAR PROVEEDOR
    ============================================================ */
    public function editar($id = null) {

        $id = $id ?? $this->get("id");
        if (!$id) return $this->redirect("proveedor/listar");

        $model = $this->loadModel("Proveedor");
        $proveedor = $model->getById($id);

        if (!$proveedor)
            return $this->redirect("proveedor/listar");

        if ($this->isPost()) {

            $nombre = trim($this->post("nombre"));
            $ruc = trim($this->post("ruc"));
            $telefono = trim($this->post("telefono"));
            $email = trim($this->post("email"));
            $direccion = trim($this->post("direccion"));

            if (empty($nombre)) {
                return $this->reloadForm([
                    "error" => "El nombre es obligatorio",
                    "proveedor_editar" => $proveedor
                ]);
            }

            $ok = $model->update($id, $nombre, $ruc, $telefono, $email, $direccion);

            if ($ok) {
                $this->addLog("proveedores", "UPDATE", "Proveedor actualizado ID: $id");
                return $this->redirect("proveedor/listar");
            }

            return $this->reloadForm([
                "error" => "Error al actualizar",
                "proveedor_editar" => $proveedor
            ]);
        }

        // GET → formulario
        return $this->reloadForm([
            "proveedor_editar" => $proveedor
        ]);
    }

    /* ============================================================
        🔴 ELIMINAR (AJAX)
        ============================================================*/
    public function eliminar($id = null) {
        $proveedorModel = $this->loadModel('Proveedor');

        // AJAX POST
        if ($this->isPost()) {

            $id = $_POST['id'] ?? null;

            header('Content-Type: application/json');

            if (!$id) {
                echo json_encode(['ok' => false, 'error' => 'ID inválido']);
                exit();
            }

            $res = $proveedorModel->eliminar($id);

            // Validación personalizada
            if (isset($res['ok']) && $res['ok'] === false) {
                echo json_encode($res);
                exit();
            }

            if (isset($res['ok']) && $res['ok']) {
                $this->addLog('proveedores', 'DELETE', "Proveedor eliminado (ID: $id)");
                echo json_encode(['ok' => true]);
                exit();
            }

            echo json_encode(['ok' => false, 'error' => 'Error al eliminar']);
            exit();
        }

        // GET (eliminar desde URL)
        $id = $id ?? $this->get('id');

        if (!$id) return $this->redirect('proveedor/listar');

        $res = $proveedorModel->eliminar($id);

        if (isset($res['ok']) && $res['ok']) {
            $this->addLog('proveedores', 'DELETE', "Proveedor eliminado (ID: $id)");
            return $this->redirect('proveedor/listar');
        }

        $error = $res['error'] ?? 'No se pudo eliminar';
        $this->render('proveedores/listar', [
            'proveedores' => $proveedorModel->getAll(),
            'error' => $error
        ]);
    }

    public function compras($id = null) {
        $proveedorModel = $this->loadModel("Proveedor");

        $id = $id ?? $this->get("id");

        if (!$id) return $this->redirect("proveedor/listar");

        $proveedor = $proveedorModel->obtener($id);
        if (!$proveedor) return $this->redirect("proveedor/listar");

        $compras = $proveedorModel->comprasProveedor($id);

        $this->render("proveedores/compras", [
            "proveedor" => $proveedor,
            "compras"   => $compras
        ]);
    }

}
