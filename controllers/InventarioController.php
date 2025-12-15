<?php

class InventarioController extends Controller
{
    public function __construct()
    {
        // Admin (1) y almacenero (3)
        RoleMiddleware::allow([1, 3]);
    }

    /* ============================================================
       📌 LISTAR INVENTARIO
    ============================================================ */
    public function listar()
    {
        $model = $this->loadModel("Inventario");
        $inventario = $model->listarInventario();

        $this->render("inventario/listar", [
            "inventario" => $inventario
        ]);
    }

    /* ============================================================
       📌 VER MOVIMIENTOS
    ============================================================ */
    public function movimientos()
    {
        $model = $this->loadModel("Inventario");
        $movimientos = $model->listarMovimientos();

        $this->render("inventario/movimientos", [
            "movimientos" => $movimientos
        ]);
    }

    /* ============================================================
       📌 FORMULARIO DE ENTRADA
    ============================================================ */
    public function entrada()
    {
        $model = $this->loadModel("Inventario");
        $productos = $model->productos();

        $this->render("inventario/entrada", [
            "productos" => $productos
        ]);
    }

    /* Procesar entrada */
    public function registrarEntrada()
    {
        if (!$this->isPost()) return $this->redirect("inventario/entrada");

        $id_producto = intval($this->post("id_producto"));
        $cantidad = intval($this->post("cantidad"));
        $motivo = trim($this->post("motivo"));
        $id_usuario = Auth::id();

        if ($cantidad <= 0) {
            return $this->render("inventario/entrada", [
                "error" => "La cantidad debe ser mayor a 0",
                "productos" => $this->loadModel("Inventario")->productos()
            ]);
        }

        $this->loadModel("Inventario")->registrarEntrada(
            $id_producto,
            $cantidad,
            $motivo,
            $id_usuario
        );

        $this->addLog("inventario", "ENTRADA", "Entrada de $cantidad unidades (Producto $id_producto)");
        return $this->redirect("inventario/listar");
    }

    /* ============================================================
       📌 FORMULARIO SALIDA
    ============================================================ */
    public function salida()
    {
        $model = $this->loadModel("Inventario");
        $productos = $model->productos();

        $this->render("inventario/salida", [
            "productos" => $productos
        ]);
    }

    /* Procesar salida */
    public function registrarSalida()
    {
        if (!$this->isPost()) return $this->redirect("inventario/salida");

        $id_producto = intval($this->post("id_producto"));
        $cantidad = intval($this->post("cantidad"));
        $motivo = trim($this->post("motivo"));
        $id_usuario = Auth::id();

        if ($cantidad <= 0) {
            return $this->render("inventario/salida", [
                "error" => "La cantidad debe ser mayor a 0",
                "productos" => $this->loadModel("Inventario")->productos()
            ]);
        }

        $this->loadModel("Inventario")->registrarSalida(
            $id_producto,
            $cantidad,
            $motivo,
            $id_usuario
        );

        $this->addLog("inventario", "SALIDA", "Salida de $cantidad unidades (Producto $id_producto)");
        return $this->redirect("inventario/listar");
    }

    /* ============================================================
       📌 FORMULARIO AJUSTES
    ============================================================ */
    public function ajustes()
    {
        $productos = $this->loadModel("Inventario")->productos();

        $this->render("inventario/ajustes", [
            "productos" => $productos
        ]);
    }

    /* Procesar ajustes */
    public function registrarAjuste()
    {
        if (!$this->isPost()) return $this->redirect("inventario/ajustes");

        $id_producto = intval($this->post("id_producto"));
        $cantidad = intval($this->post("cantidad"));
        $motivo = trim($this->post("motivo"));
        $id_usuario = Auth::id();

        if ($cantidad == 0) {
            return $this->render("inventario/ajustes", [
                "error" => "El ajuste no puede ser 0",
                "productos" => $this->loadModel("Inventario")->productos()
            ]);
        }

        $this->loadModel("Inventario")->registrarAjuste(
            $id_producto,
            $cantidad,
            $motivo,
            $id_usuario
        );

        $this->addLog("inventario", "AJUSTE", "Ajuste de $cantidad unidades (Producto $id_producto)");
        return $this->redirect("inventario/listar");
    }
}
