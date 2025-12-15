<?php
class DashboardController extends Controller {

    public function index() {

        $db = Database::connect();

        // ============================
        // MÉTRICAS DEL DASHBOARD
        // ============================

        // Ingresos HOY
        $ingresosHoy = $db->query("SELECT 
                IFNULL(SUM(total), 0) AS total
            FROM ventas
            WHERE DATE(fecha_venta) = CURDATE()
        ")->fetch_object()->total;

        // Gastos HOY
        $gastosHoy = $db->query("SELECT 
                IFNULL(SUM(total), 0) AS total
            FROM compras
            WHERE DATE(fecha_compra) = CURDATE()
        ")->fetch_object()->total;

        // Ingresos del mes
        $ingresosMes = $db->query("SELECT 
                IFNULL(SUM(total), 0) AS total
            FROM ventas
            WHERE MONTH(fecha_venta) = MONTH(CURDATE())
              AND YEAR(fecha_venta) = YEAR(CURDATE())
        ")->fetch_object()->total;

        // Gastos del mes
        $gastosMes = $db->query("SELECT 
                IFNULL(SUM(total), 0) AS total
            FROM compras
            WHERE MONTH(fecha_compra) = MONTH(CURDATE())
              AND YEAR(fecha_compra) = YEAR(CURDATE())
        ")->fetch_object()->total;

        // Beneficio
        $beneficio = $ingresosMes - $gastosMes;

        // Balance total histórico
        $balance = $db->query("SELECT 
                (SELECT IFNULL(SUM(total), 0) FROM ventas)
                -
                (SELECT IFNULL(SUM(total), 0) FROM compras)
            AS balance
        ")->fetch_object()->balance;

        // ============================
        // GRÁFICO INGRESOS VS GASTOS (últimos 30 días)
        // ============================

        $data = $db->query("SELECT FechaBase.fecha,
                   IFNULL(v.total, 0) AS ingresos,
                   IFNULL(c.total, 0) AS gastos
            FROM (
                SELECT DATE(NOW() - INTERVAL n DAY) AS fecha
                FROM (
                    SELECT 0 n UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION 
                    SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION
                    SELECT 10 UNION SELECT 11 UNION SELECT 12 UNION SELECT 13 UNION SELECT 14 UNION 
                    SELECT 15 UNION SELECT 16 UNION SELECT 17 UNION SELECT 18 UNION SELECT 19 UNION
                    SELECT 20 UNION SELECT 21 UNION SELECT 22 UNION SELECT 23 UNION SELECT 24 UNION
                    SELECT 25 UNION SELECT 26 UNION SELECT 27 UNION SELECT 28 UNION SELECT 29 UNION
                    SELECT 30
                ) AS x
            ) AS FechaBase
            LEFT JOIN (
                SELECT DATE(fecha_venta) AS fecha, SUM(total) AS total
                FROM ventas
                WHERE fecha_venta >= CURDATE() - INTERVAL 30 DAY
                GROUP BY DATE(fecha_venta)
            ) AS v ON v.fecha = FechaBase.fecha
            LEFT JOIN (
                SELECT DATE(fecha_compra) AS fecha, SUM(total) AS total
                FROM compras
                WHERE fecha_compra >= CURDATE() - INTERVAL 30 DAY
                GROUP BY DATE(fecha_compra)
            ) AS c ON c.fecha = FechaBase.fecha
            ORDER BY FechaBase.fecha ASC
        ");

        $fechas = [];
        $ingresos = [];
        $gastos = [];

        while ($row = $data->fetch_assoc()) {
            $fechas[]   = $row['fecha'];
            $ingresos[] = (float) $row['ingresos'];
            $gastos[]   = (float) $row['gastos'];
        }

        // -------------------
        // Enviar a la vista
        // -------------------

        $this->render("layout/dashboard", [
            "ingresosHoy" => $ingresosHoy,
            "gastosHoy" => $gastosHoy,
            "ingresosMes" => $ingresosMes,
            "gastosMes" => $gastosMes,
            "beneficio" => $beneficio,
            "balance" => $balance,
            "fechas" => json_encode($fechas),
            "ingresos" => json_encode($ingresos),
            "gastos" => json_encode($gastos),
        ]);
    }

    public function ajax_rango() {

        header("Content-Type: application/json; charset=utf-8");

        $rango = isset($_GET['rango']) ? intval($_GET['rango']) : 30;

        $db = Database::connect();

        // Definir intervalo
        if ($rango == 7) {
            $interval = "INTERVAL 7 DAY";
        } elseif ($rango == 30) {
            $interval = "INTERVAL 30 DAY";
        } elseif ($rango == 90) {
            $interval = "INTERVAL 90 DAY";
        } elseif ($rango == 365) {
            $interval = "INTERVAL 1 YEAR";
        } else {
            $interval = "INTERVAL 30 DAY";
        }

        // ========================
        // INGRESOS (ventas)
        // ========================
        $qIngresos = $db->query("SELECT 
                DATE(fecha_venta) AS fecha,
                SUM(total) AS ingresos
            FROM ventas
            WHERE fecha_venta >= DATE(NOW() - $interval)
            GROUP BY DATE(fecha_venta)
            ORDER BY fecha ASC
        ");

        // ========================
        // GASTOS (compras)
        // ========================
        $qGastos = $db->query("SELECT 
                DATE(c.fecha_compra) AS fecha,
                SUM(dc.subtotal) AS gastos
            FROM compras c
            INNER JOIN detalle_compra dc ON dc.id_compra = c.id_compra
            WHERE c.fecha_compra >= DATE(NOW() - $interval)
            GROUP BY DATE(c.fecha_compra)
            ORDER BY fecha ASC
        ");

        // Mapear ingresos por fecha
        $mapIngresos = [];
        while ($row = $qIngresos->fetch_assoc()) {
            $mapIngresos[$row['fecha']] = floatval($row['ingresos']);
        }

        // Mapear gastos por fecha
        $mapGastos = [];
        while ($row = $qGastos->fetch_assoc()) {
            $mapGastos[$row['fecha']] = floatval($row['gastos']);
        }

        // ========================
        // UNIFICAR TODAS LAS FECHAS
        // ========================
        $fechas = array_unique(array_merge(
            array_keys($mapIngresos),
            array_keys($mapGastos)
        ));
        sort($fechas);

        $ingresos = [];
        $gastos = [];

        foreach ($fechas as $f) {
            $ingresos[] = $mapIngresos[$f] ?? 0;
            $gastos[]   = $mapGastos[$f] ?? 0;
        }

        echo json_encode([
            "status"   => "success",
            "fechas"   => $fechas,
            "ingresos" => $ingresos,
            "gastos"   => $gastos
        ]);

        return;
    }


}
