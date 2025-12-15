<?php

class ComprasController extends Controller {

    public function __construct() {
        // Acceso permitido: Administrador (1) y Almacenero (3)
        RoleMiddleware::allow([1, 3]);
    }

    /* ============================================================
       📌 LISTAR TODAS LAS COMPRAS (Se mantiene igual)
    ============================================================ */
    public function listar() {

        $compraModel = $this->loadModel("Compras");
        $compras     = $compraModel->listar();

        // Cargar datos para el modal
        $proveedores = $this->loadModel("Proveedor")->listar();
        $productos   = $this->loadModel("Producto")->listar();

        $this->render("compras/listar", [
            "compras"     => $compras,
            "proveedores" => $proveedores,
            "productos"   => $productos
        ]);
    }

    /* ============================================================
       📌 REGISTRAR COMPRA (USO DE SPs) - CORREGIDO
       Ahora procesa Subtotal, IGV y Total del formulario.
    ============================================================ */
    public function registrar() {
        // Solo acepta POST
        if (!$this->isPost()) {
            return $this->redirect("compras/listar");
        }

        /* 1️⃣ Capturar datos del POST */
        $id_proveedor = $this->post("id_proveedor");
        $items        = $_POST["productos"] ?? [];
        $id_usuario   = Auth::id();

        // 💡 Nuevos campos de totales capturados del formulario
        $subtotal_compra = $this->post("subtotal_compra", 0.00);
        $igv_compra      = $this->post("igv_compra", 0.00);
        $total_con_igv   = $this->post("total_con_igv_compra", 0.00);

        // Validar datos mínimos
        if (!$id_proveedor || empty($items) || $total_con_igv <= 0) {
            // Se puede agregar un mensaje de error más específico aquí
            return $this->redirect("compras/listar?error=datosInvalidos");
        }

        $model = $this->loadModel("Compras");

        /* 2️⃣ Registrar cabecera con totales (USA SP) */
        // La función registrarCompra ahora espera los 3 montos
        $res = $model->registrarCompra(
            $id_proveedor, 
            $id_usuario, 
            $subtotal_compra, 
            $igv_compra, 
            $total_con_igv
        );

        if (!$res || !isset($res["id_compra"])) {
            return $this->redirect("compras/listar?error=cabecera");
        }

        $id_compra = $res["id_compra"];

        /* 3️⃣ Registrar cada detalle (SP actualiza inventario y movimientos) */
        foreach ($items as $p) {

            // Aseguramos que los campos existan y sean válidos
            if (!isset($p["id_producto"], $p["cantidad"], $p["precio"])) {
                continue;
            }
            // Limpiamos y aseguramos que sean numéricos (aunque el formulario ya lo hace)
            $id_producto = (int)$p["id_producto"];
            $cantidad    = (int)$p["cantidad"];
            $precio      = (float)$p["precio"]; // Precio del ítem C/IGV

            if ($cantidad > 0 && $precio > 0) {
                 $model->registrarDetalle(
                    $id_compra,
                    $id_producto,
                    $cantidad,
                    $precio,
                    $id_usuario
                );
            }
        }

        /* 4️⃣ Registrar log */
        $this->addLog("compras", "INSERT", "Compra registrada ID $id_compra. Total: S/. $total_con_igv");

        /* 5️⃣ Redirigir a pantalla detalle */
        return $this->redirect("compras/detalle/" . $id_compra);
    }


    /* ============================================================
       📌 r_egistrar (ELIMINADO - Era código obsoleto/duplicado)
    ============================================================ */
    // La función r_egistrar fue eliminada para evitar redundancia, ya que 'registrar'
    // ahora usa los SPs y es el método recomendado.
    // ...

    /* ============================================================
       📌 VER DETALLE DE COMPRA (Se mantiene igual)
    ============================================================ */
    public function detalle($id = null) {
        $id = $id ?? $this->get("id");
        
        if (!$id) {
            return $this->redirect("compras/listar");
        }

        $compraModel = $this->loadModel("Compras");

        // El modelo 'obtener' ya trae los campos subtotal, igv, total
        $compra  = $compraModel->obtener($id); 
        $detalle = $compraModel->obtenerDetalle($id);

        if (!$compra) {
            return $this->redirect("compras/listar");
        }

        $this->render("compras/detalle", [
            "compras"  => $compra, // Renombrado a 'compra' singular para claridad
            "detalle" => $detalle
        ]);
    }

    /* ============================================================
       📌 ELIMINAR COMPRA (Se mantiene igual)
    ============================================================ */
    public function eliminar($id = null) {
        $compraModel = $this->loadModel("Compras");

        // Si llega por POST (ajax)
        if ($this->isPost()) {
            $id = $_POST['id'] ?? null;

            header('Content-Type: application/json; charset=utf-8');

            if (!$id) {
                echo json_encode(['ok' => false, 'error' => 'ID no válido']);
                exit();
            }

            // Nota: Esta eliminación directa es simple y no revierte inventario,
            // que es un riesgo conocido en tu lógica actual.
            $res = $compraModel->eliminar($id); 

            if (isset($res['ok']) && $res['ok']) {
                $this->addLog('compras', 'DELETE', "Compra eliminada (ID: $id)");
                echo json_encode(['ok' => true]);
                exit();
            }

            echo json_encode(['ok' => false, 'error' => 'Error al eliminar la compra']);
            exit();
        }

        // Si no es POST -> eliminación por link (GET)
        $id = $id ?? $this->get('id');
        if (!$id) return $this->redirect('compras/listar');

        $res = $compraModel->eliminar($id);

        if (isset($res['ok']) && $res['ok']) {
            $this->addLog('compras', 'DELETE', "Compra eliminada (ID: $id)");
            return $this->redirect('compras/listar');
        }

        $this->render('compras/listar', [
            'compras' => $compraModel->listar(),
            'error' => 'Error al eliminar la compra'
        ]);
    }

    /* ============================================================
       📌 COMPRAS POR PROVEEDOR (Se mantiene igual)
    ============================================================ */
    public function porProveedor($id = null) {
        $id = $id ?? $this->get("id");
        
        if (!$id) {
            return $this->redirect("compras/listar");
        }

        $compraModel = $this->loadModel("Compras");
        $proveedores = $this->loadModel("Proveedor");

        $proveedor = $proveedores->obtener($id);
        $compras = $compraModel->porProveedor($id);

        if (!$proveedor) {
            return $this->redirect("compras/listar");
        }

        $this->render("compras/por_proveedor", [
            "proveedor" => $proveedor,
            "compras" => $compras
        ]);
    }
}