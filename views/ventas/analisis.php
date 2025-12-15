<div class="main-content">

    <div class="page-header">
        <h2>📊 Análisis de Ventas</h2>
        <a href="<?= base_url ?>ventas/listar" class="btn btn-secondary">
            ← Volver a ventas
        </a>
    </div>

    <!-- =======================
         FILTRO POR FECHAS
    ======================== -->
    <div class="form-container">
        <form method="GET" action="<?= base_url ?>ventas/analisis" class="form-inline">
            <label>Desde:</label>
            <input type="date" name="inicio" value="<?= $inicio ?>" class="form-control">

            <label>Hasta:</label>
            <input type="date" name="fin" value="<?= $fin ?>" class="form-control">

            <button type="submit" class="btn btn-primary">
                🔍 Filtrar
            </button>
        </form>
    </div>

    <!-- =======================
         VENTAS POR FECHA
    ======================== -->
    <div class="table-container">
        <h3>📅 Ventas por Fecha</h3>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Cantidad</th>
                    <th>Total (S/.)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($porFechas as $v): ?>
                <tr>
                    <td><?= $v['fecha'] ?></td>
                    <td><?= $v['cantidad'] ?></td>
                    <td><strong>S/. <?= number_format($v['total_vendido'], 2) ?></strong></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- =======================
         PRODUCTOS MÁS VENDIDOS
    ======================== -->
    <div class="table-container">
        <h3>📦 Productos más vendidos</h3>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Total Vendido</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($porProducto as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p['producto']) ?></td>
                    <td><?= $p['total_vendido'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- =======================
         MEJORES CLIENTES
    ======================== -->
    <div class="table-container">
        <h3>👥 Mejores Clientes</h3>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Total Comprado (S/.)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($porCliente as $c): ?>
                <tr>
                    <td><?= htmlspecialchars($c['cliente']) ?></td>
                    <td><strong>S/. <?= number_format($c['total'], 2) ?></strong></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- =======================
         MÉTODOS DE PAGO
    ======================== -->
    <div class="table-container">
        <h3>💳 Métodos de Pago</h3>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Método</th>
                    <th>Total (S/.)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($porMetodo as $m): ?>
                <tr>
                    <td><?= htmlspecialchars($m['metodo']) ?></td>
                    <td><strong>S/. <?= number_format($m['total'], 2) ?></strong></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- =======================
         VENTAS ANULADAS
    ======================== -->
    <div class="table-container">
        <h3 style="color:#c0392b;">🗑 Ventas Anuladas</h3>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($anuladas as $a): ?>
                <tr>
                    <td>#<?= $a['id_venta'] ?></td>
                    <td><?= date('d/m/Y', strtotime($a['fecha_venta'])) ?></td>
                    <td>S/. <?= number_format($a['total'], 2) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>
