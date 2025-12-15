<?php

class ClienteController extends Controller
{
    /**
     * Mostrar listado de clientes
     */
    public function listar()
    {
        $clienteModel = $this->loadModel('Cliente');
        $clientes = $clienteModel->listar();

        $this->render('clientes/gestion', [
            'clientes' => $clientes
        ]);
    }

    /**
     * Mostrar formulario y procesar creación
     */
    public function crear()
    {
        $clienteModel = $this->loadModel('Cliente');

        if ($this->isPost()) {
            $documento = trim($this->post('documento'));
            $nombres = trim($this->post('nombres'));
            $apellidos = trim($this->post('apellidos'));
            $telefono = trim($this->post('telefono'));
            $email = trim($this->post('email'));
            $direccion = trim($this->post('direccion'));

            // Validación básica
            if ($nombres === '' || $apellidos === '') {
                return $this->render('clientes/gestion', [
                    'clientes' => $clienteModel->listar(),
                    'error' => 'Los nombres y apellidos son obligatorios'
                ]);
            }

            $res = $clienteModel->crear($documento, $nombres, $apellidos, $telefono, $email, $direccion);

            if ($res['ok']) {
                $this->addLog('clientes', 'INSERT', "Cliente creado: $nombres $apellidos (ID: {$res['insert_id']})");
                return $this->redirect('cliente/listar');
            }

            return $this->render('clientes/gestion', [
                'clientes' => $clienteModel->listar(),
                'error' => 'Error al crear el cliente'
            ]);
        }

        // GET -> mostrar formulario
        $this->render('clientes/gestion', [
            'clientes' => $clienteModel->listar()
        ]);
    }

    /**
     * Editar cliente: muestra formulario (GET) y procesa actualización (POST)
     * URL esperada: /cliente/editar/{id}
     */
    public function editar($id = null)
    {
        $clienteModel = $this->loadModel('Cliente');

        $id = $id ?? $this->get('id');

        if (!$id) return $this->redirect('cliente/listar');

        $cliente = $clienteModel->obtener($id);
        if (!$cliente) return $this->redirect('cliente/listar');

        if ($this->isPost()) {
            $documento = trim($this->post('documento'));
            $nombres = trim($this->post('nombres'));
            $apellidos = trim($this->post('apellidos'));
            $telefono = trim($this->post('telefono'));
            $email = trim($this->post('email'));
            $direccion = trim($this->post('direccion'));

            if ($nombres === '' || $apellidos === '') {
                return $this->render('clientes/gestion', [
                    'clientes' => $clienteModel->listar(),
                    'error' => 'Los nombres y apellidos son obligatorios',
                    'cliente_editar' => $cliente
                ]);
            }

            $res = $clienteModel->editar($id, $documento, $nombres, $apellidos, $telefono, $email, $direccion);

            if ($res['ok']) {
                $this->addLog('clientes', 'UPDATE', "Cliente actualizado: $nombres $apellidos (ID: $id)");
                return $this->redirect('cliente/listar');
            }

            return $this->render('clientes/gestion', [
                'clientes' => $clienteModel->listar(),
                'error' => 'Error al actualizar el cliente',
                'cliente_editar' => $cliente
            ]);
        }

        // GET -> mostrar
        $this->render('clientes/gestion', [
            'clientes' => $clienteModel->listar(),
            'cliente_editar' => $cliente
        ]);
    }

    /**
     * Eliminar cliente.
     * Si la petición es POST (AJAX) devuelve JSON.
     * Si es GET, redirige al listado.
     */
    public function eliminar($id = null)
    {
        $clienteModel = $this->loadModel('Cliente');

        // Si llega por POST (ajax)
        if ($this->isPost()) {
            $id = $_POST['id'] ?? null;

            header('Content-Type: application/json; charset=utf-8');

            if (!$id) {
                echo json_encode(['ok' => false, 'error' => 'ID no válido']);
                exit();
            }

            $res = $clienteModel->eliminar($id);

            // Si el modelo devolvió un array con error personalizado
            if (isset($res['ok']) && $res['ok'] === false && isset($res['error'])) {
                echo json_encode(['ok' => false, 'error' => $res['error']]);
                exit();
            }

            // Si execute devolvió el resultado típico
            if (isset($res['ok']) && $res['ok']) {
                $this->addLog('clientes', 'DELETE', "Cliente eliminado (ID: $id)");
                echo json_encode(['ok' => true]);
                exit();
            }

            // Fallback: error genérico
            echo json_encode(['ok' => false, 'error' => 'Error al eliminar el cliente']);
            exit();
        }

        // Si no es POST -> eliminación por link (GET)
        $id = $id ?? $this->get('id');
        if (!$id) return $this->redirect('cliente/listar');

        $res = $clienteModel->eliminar($id);

        if (isset($res['ok']) && $res['ok']) {
            $this->addLog('clientes', 'DELETE', "Cliente eliminado (ID: $id)");
            return $this->redirect('cliente/listar');
        }

        // Si hubo error por relaciones u otro, volver al listado con mensaje
        $error = (isset($res['error']) ? $res['error'] : 'Error al eliminar el cliente');
        $this->render('clientes/gestion', [
            'clientes' => $clienteModel->listar(),
            'error' => $error
        ]);
    }

    /**
     * Ver historial de un cliente
     */
    public function historial($id = null)
    {
        $clienteModel = $this->loadModel('Cliente');
        
        $id = $id ?? $this->get('id');
        
        if (!$id) return $this->redirect('cliente/listar');
        
        $cliente = $clienteModel->obtener($id);
        if (!$cliente) return $this->redirect('cliente/listar');
        
        // Cargar el historial de compras del cliente
        $historial = $clienteModel->historialCompras($id);
        
        $this->render('clientes/historial', [
            'cliente' => $cliente,
            'historial' => $historial
        ]);
    }
}