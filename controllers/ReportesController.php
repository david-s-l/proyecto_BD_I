<?php

class ReportesController extends Controller
{
    /* ============================================================
       📅 VENTAS POR FECHA
    ============================================================ */
    public function ventas_fecha()
    {
        $inicio = $this->get("inicio");
        $fin    = $this->get("fin");

        $reportes = $this->loadModel("Reportes");

        return $this->render("reportes/ventas_fecha", [
            "datos"  => ($inicio && $fin)
                ? $reportes->ventasPorFechas($inicio, $fin)
                : [],
            "inicio" => $inicio,
            "fin"    => $fin
        ]);
    }

    /* ============================================================
       📦 PRODUCTOS VENDIDOS
    ============================================================ */
    public function productos_vendidos()
    {
        $reportes = $this->loadModel("Reportes");

        return $this->render("reportes/productos_vendidos", [
            "datos" => $reportes->ventasPorProducto()
        ]);
    }

    /* ============================================================
       🏭 COMPRAS POR PROVEEDOR
    ============================================================ */
    public function compras_proveedor()
    {
        $reportes = $this->loadModel("Reportes");

        return $this->render("reportes/compras_proveedor", [
            "datos" => $reportes->comprasPorProveedor()
        ]);
    }

    /* ============================================================
       💵 GANANCIAS DEL MES
    ============================================================ */
    public function ganancias_mes()
    {
        $mes  = $this->get("mes")  ?? date('m');
        $anio = $this->get("anio") ?? date('Y');

        $reportes = $this->loadModel("Reportes");

        return $this->render("reportes/ganancias_mes", [
            "ganancia" => $reportes->gananciasDelMes($mes, $anio),
            "mes"      => $mes,
            "anio"     => $anio
        ]);
    }
}
