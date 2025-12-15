<?php

class MetodoPagoController extends Controller {

    public function index() {
        return $this->listar();
    }

    public function listar() {
        $metodoPagoModel = $this->loadModel('MetodoPago');
        $metodos_pago = $metodoPagoModel->getAll();

        // Agregar info extra: si tiene pagos asociados
        foreach ($metodos_pago as &$metodo) {
            $metodo['has_payments'] = $metodoPagoModel->hasPayments($metodo['id_metodo_pago']);
        }

        $this->render('metodos_pago/listar', [
            'metodos_pago' => $metodos_pago
        ]);
    }


    public function crear() {
        if ($this->isPost()) {

            $nombre = $this->post('nombre');
            $descripcion = $this->post('descripcion');

            $metodoPagoModel = $this->loadModel('MetodoPago');
            $resultado = $metodoPagoModel->create($nombre, $descripcion);

            if ($resultado['ok']) {
                $this->addLog('metodo_pago', 'INSERT', "Método de pago creado: $nombre");
                $this->redirect('metodoPago/listar');
            }

            $metodos_pago = $metodoPagoModel->getAll();

            // Agregar info extra: si tiene pagos asociados
            foreach ($metodos_pago as &$metodo) {
                $metodo['has_payments'] = $metodoPagoModel->hasPayments($metodo['id_metodo_pago']);
            }

            $this->render('metodos_pago/listar', [
                'metodos_pago' => $metodos_pago,
                'error' => "Error al crear el método de pago"
            ]);

        } else {
            $this->redirect('metodoPago/listar');
        }
    }

    public function editar($id = null) {

        if ($id === null) {
            $id = $this->get('id');
        }

        if (!$id) {
            $this->redirect('metodoPago/listar');
            return;
        }

        $metodoPagoModel = $this->loadModel('MetodoPago');

        if ($this->isPost()) {

            $nombre = $this->post('nombre');
            $descripcion = $this->post('descripcion');

            $resultado = $metodoPagoModel->update($id, $nombre, $descripcion);

            if ($resultado['ok']) {
                $this->addLog('metodo_pago', 'UPDATE', "Método de pago actualizado: $nombre (ID: $id)");
                $this->redirect('metodoPago/listar');
            }

            $metodos_pago = $metodoPagoModel->getAll();
            $metodo_editar = $metodoPagoModel->getById($id);

            // Agregar info extra: si tiene pagos asociados
            foreach ($metodos_pago as &$metodo) {
                $metodo['has_payments'] = $metodoPagoModel->hasPayments($metodo['id_metodo_pago']);
            }

            $this->render('metodos_pago/listar', [
                'metodos_pago' => $metodos_pago,
                'metodo_editar' => $metodo_editar,
                'error' => "Error al actualizar el método de pago"
            ]);

        } else {

            $metodos_pago = $metodoPagoModel->getAll();
            $metodo_editar = $metodoPagoModel->getById($id);

            if (!$metodo_editar) {
                $this->redirect('metodoPago/listar');
                return;
            }

            // Agregar info extra: si tiene pagos asociados
            foreach ($metodos_pago as &$metodo) {
                $metodo['has_payments'] = $metodoPagoModel->hasPayments($metodo['id_metodo_pago']);
            }

            $this->render('metodos_pago/listar', [
                'metodos_pago' => $metodos_pago,
                'metodo_editar' => $metodo_editar
            ]);
        }
    }

    public function eliminar($id = null) {

        if ($id === null) {
            $id = $this->get('id');
        }

        if ($id) {
            $metodoPagoModel = $this->loadModel('MetodoPago');
            $metodoPagoModel->delete($id);

            $this->addLog('metodo_pago', 'DELETE', "Método de pago eliminado (ID: $id)");
        }

        $this->redirect('metodoPago/listar');
    }
}