<?php

class ProductoController extends Controller {

    public function index() {
        return $this->listar();
    }

    // ========== PRODUCTOS ==========
    
    public function listar() {
        $productoModel = $this->loadModel('Producto');
        $productos = $productoModel->getAll();

        $this->render('productos/listar', [
            'productos' => $productos
        ]);
    }

    public function crear() {
        if ($this->isPost()) {
            $nombre = $this->post('nombre');
            $descripcion = $this->post('descripcion');
            $precio = $this->post('precio');
            $id_categoria = $this->post('id_categoria');

            $productoModel = $this->loadModel('Producto');
            $resultado = $productoModel->create($nombre, $descripcion, $precio, $stock, $id_categoria);

            if ($resultado['ok']) {
                $this->addLog('productos', 'INSERT', "Producto agregado: $nombre");
                $this->redirect('producto/listar');
            }

            $categoriaModel = $this->loadModel('Categoria');
            $categorias = $categoriaModel->getAll();

            $this->render('productos/crear', [
                'error' => "Error al guardar",
                'categorias' => $categorias
            ]);

        } else {
            $categoriaModel = $this->loadModel('Categoria');
            $categorias = $categoriaModel->getAll();

            $this->render('productos/crear', [
                'categorias' => $categorias
            ]);
        }
    }

    public function editar($id = null) {

        // Si no vino $id por URL, intentar leer GET
        if ($id === null) {
            $id = $this->get('id');
        }

        // Si sigue sin existir, redirigir
        if (!$id) {
            $this->redirect('producto/listar');
            return;
        }

        $productoModel = $this->loadModel('Producto');

        if ($this->isPost()) {

            $nombre = $this->post('nombre');
            $descripcion = $this->post('descripcion');
            $precio = $this->post('precio');
            $id_categoria = $this->post('id_categoria');
            $estado = $this->post('estado');

            $resultado = $productoModel->update($id, $nombre, $descripcion, $precio, $stock, $id_categoria, $estado);

            if ($resultado['ok']) {
                $this->addLog('productos', 'UPDATE', "Producto actualizado: $nombre (ID: $id)");
                $this->redirect('producto/listar');
            }

            $producto = $productoModel->getById($id);
            $categoriaModel = $this->loadModel('Categoria');
            $categorias = $categoriaModel->getAll();

            $this->render('productos/editar', [
                'error' => "Error al actualizar",
                'producto' => $producto,
                'categorias' => $categorias
            ]);

        } else {

            $producto = $productoModel->getById($id);

            if (!$producto) {
                $this->redirect('producto/listar');
                return;
            }

            $categoriaModel = $this->loadModel('Categoria');
            $categorias = $categoriaModel->getAll();

            $this->render('productos/editar', [
                'producto' => $producto,
                'categorias' => $categorias
            ]);
        }
    }
}