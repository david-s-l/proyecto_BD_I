<?php

class VentasController extends Controller
{
    /* ============================================================
       📌 LISTAR VENTAS
    ============================================================ */
    public function listar()
    {
        $ventas = $this->loadModel("Ventas");
        $clientes  = $this->loadModel("Cliente");
        $productos = $this->loadModel("Producto");

        return $this->render("ventas/listar", [
            "ventas" => $ventas->listar(),
            "clientes"  => $clientes->listar(),
            "productos" => $productos->listarActivos()
        ]);
    }

    /* ============================================================
       📌 REGISTRAR VENTA (POST)
    ============================================================ */
    public function registrar() {
        if (!$this->isPost()) {
            return $this->redirect("ventas/listar");
        }

        $id_cliente = $this->post("id_cliente");
        $items = $_POST["productos"] ?? [];
        $id_usuario = Auth::id();

        if (empty($items)) {
            return $this->redirect("ventas/listar?error=" . urlencode("Debes agregar al menos un producto"));
        }

        $model = $this->loadModel("Ventas");
        $inventarioModel = $this->loadModel("Inventario");

        $subtotal = 0.00;
        foreach ($items as $p) {
            $precio = (float)$p["precio"];
            $cantidad = (int)$p["cantidad"];
            $subtotal += $precio * $cantidad; // Subtotal sin IGV
        }

        $igv_rate = $this->loadModel("Configuracion")->obtenerIGV(); // Asegúrate de tener un modelo para obtener el IGV
        $igv = $subtotal * ($igv_rate / 100);  // Calculamos el IGV
        $total = $subtotal + $igv; // Total con IGV

        // Registrar cabecera de la venta con el IGV y total
        $res = $model->registrarVenta($id_cliente, $id_usuario, $subtotal, $igv, $total);
        if (!$res || !isset($res["id_venta"])) {
            return $this->redirect("ventas/listar?error=" . urlencode("Error al crear la venta."));
        }

        $id_venta = $res["id_venta"];
        $error_en_detalle = false;

        // Registrar detalle de la venta
        foreach ($items as $p) {
            $id_producto = (int)$p["id_producto"];
            $cantidad = (int)$p["cantidad"];
            $precio = (float)$p["precio"];

            if ($cantidad > 0 && $precio > 0) {
                $detalle_res = $model->registrarDetalle($id_venta, $id_producto, $cantidad, $precio);
                if ($detalle_res === false) {
                    $error_en_detalle = true;
                    break;
                }
            }
        }

        if ($error_en_detalle) {
            $model->anular($id_venta);
            return $this->redirect("ventas/listar?error=" . urlencode("Error de stock o al registrar el detalle. Venta ID $id_venta anulada por seguridad."));
        }

        $this->addLog("ventas", "INSERT", "Venta registrada ID $id_venta.");
        return $this->redirect("ventas/detalle/" . $id_venta);
    }


    /* ============================================================
       📌 DETALLE DE VENTA
    ============================================================ */
    public function detalle($id)
    {
        $ventas = $this->loadModel("Ventas");

        return $this->render("ventas/detalle", [
            "ventas"   => $ventas->obtener($id),
            "detalle" => $ventas->obtenerDetalle($id)
        ]);
    }

    /* ============================================================
       📌 ANULAR LA VENTA
    ============================================================ */
    public function anular($id)
    {
        $ventas = $this->loadModel("Ventas");

        // 1️⃣ Obtener la venta
        $venta = $ventas->obtener($id);

        // 2️⃣ Validar existencia
        if (!$venta) {
            return $this->render("ventas/listar", [
                "error" => "La venta no existe"
            ]);
        }

        // 3️⃣ Validar estado
        if ($venta['estado'] === 'ANULADA') {
            return $this->render("ventas/listar", [
                "error" => "La venta ya está anulada"
            ]);
        }

        // 4️⃣ Anular
        $res = $ventas->anular($id);

        if ($res) {
            $this->addLog(
                "ventas",
                "ANULAR",
                "Venta anulada ID: $id"
            );
            return $this->redirect("ventas/listar");
        }

        // 5️⃣ Error general
        return $this->render("ventas/listar", [
            "error" => "No se pudo anular la venta"
        ]);
    }

    /* ============================================================
       📌 IMPRIMIR LA VENTA
    ============================================================ */
    public function imprimir($id)
    {
        $ventas = $this->loadModel("Ventas");

        $this->render("ventas/imprimir", [
            "venta"   => $ventas->obtener($id),
            "detalle" => $ventas->obtenerDetalle($id)
        ]);
    }

    /* ============================================================
   📊 ANÁLISIS DE VENTAS
    ============================================================ */
    public function analisis()
    {
        $ventas = $this->loadModel("Ventas");

        // 📅 Fechas por defecto (mes actual)
        $inicio = $_GET['inicio'] ?? date('Y-m-01');
        $fin    = $_GET['fin'] ?? date('Y-m-t');

        // 📊 Datos de análisis
        $data = [
            "inicio" => $inicio,
            "fin"    => $fin,

            "porFechas"  => $ventas->ventasPorFechas($inicio, $fin),
            "porProducto"=> $ventas->ventasPorProducto(),
            "porCliente" => $ventas->ventasPorCliente(),
            "porMetodo"  => $ventas->ventasPorMetodoPago(),
            "anuladas"   => $ventas->ventasAnuladas()
        ];

        return $this->render("ventas/analisis", $data);
    }

}
