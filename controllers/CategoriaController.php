<?php

class CategoriaController extends Controller {

    public function index() {
        return $this->listar();
    }

    public function listar() {
        $categoriaModel = $this->loadModel('Categoria');
        $categorias = $categoriaModel->getAll();

        // Agregar info extra: si tiene productos
        foreach ($categorias as &$cat) {
            $cat['has_products'] = $categoriaModel->hasProducts($cat['id_categoria']);
        }

        $this->render('categorias/listar', [
            'categorias' => $categorias
        ]);
    }


    public function crear() {
        if ($this->isPost()) {

            $nombre = $this->post('nombre');
            $descripcion = $this->post('descripcion');

            $categoriaModel = $this->loadModel('Categoria');
            $resultado = $categoriaModel->create($nombre, $descripcion);

            if ($resultado['ok']) {
                $this->addLog('categorias', 'INSERT', "Categoría creada: $nombre");
                $this->redirect('categoria/listar');
            }

            $categorias = $categoriaModel->getAll();
            $this->render('categorias/listar', [
                'categorias' => $categorias,
                'error' => "Error al crear la categoría"
            ]);

        } else {
            $this->redirect('categoria/listar');
        }
    }

    public function editar($id = null) {

        if ($id === null) {
            $id = $this->get('id');
        }

        if (!$id) {
            $this->redirect('categoria/listar');
            return;
        }

        $categoriaModel = $this->loadModel('Categoria');

        if ($this->isPost()) {

            $nombre = $this->post('nombre');
            $descripcion = $this->post('descripcion');

            $resultado = $categoriaModel->update($id, $nombre, $descripcion);

            if ($resultado['ok']) {
                $this->addLog('categorias', 'UPDATE', "Categoría actualizada: $nombre (ID: $id)");
                $this->redirect('categoria/listar');
            }

            $categorias = $categoriaModel->getAll();
            $categoria_editar = $categoriaModel->getById($id);

            $this->render('categorias/listar', [
                'categorias' => $categorias,
                'categoria_editar' => $categoria_editar,
                'error' => "Error al actualizar la categoría"
            ]);

        } else {

            $categorias = $categoriaModel->getAll();
            $categoria_editar = $categoriaModel->getById($id);

            if (!$categoria_editar) {
                $this->redirect('categoria/listar');
                return;
            }

            $this->render('categorias/listar', [
                'categorias' => $categorias,
                'categoria_editar' => $categoria_editar
            ]);
        }
    }

    public function eliminar($id = null) {

        if ($id === null) {
            $id = $this->get('id');
        }

        if ($id) {
            $categoriaModel = $this->loadModel('Categoria');
            $categoriaModel->delete($id);

            $this->addLog('categorias', 'DELETE', "Categoría eliminada (ID: $id)");
        }

        $this->redirect('categoria/listar');
    }
}
