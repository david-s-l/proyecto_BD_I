<div class="main-content">

    <!-- ENCABEZADO -->
    <div class="page-header">
        <h2>📅 Ventas por Fecha</h2>
    </div>

    <!-- FORMULARIO DE FILTRO -->
    <div class="form-container">
        <form method="get" class="form-row">
            <div class="form-group">
                <label>Desde:</label>
                <input type="date" name="inicio" value="<?= $inicio ?>" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Hasta:</label>
                <input type="date" name="fin" value="<?= $fin ?>" class="form-control" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary" style="margin-top: 27px;">
                    🔍 Consultar
                </button>
            </div>
        </form>
    </div>

    <!-- TABLA DE RESULTADOS -->
    <div class="table-container">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th class="text-center">Cantidad de Ventas</th>
                    <th class="text-right">Total Vendido</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($datos)): ?>
                    <tr>
                        <td colspan="3" class="text-center">
                            No hay ventas registradas en el rango seleccionado
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($datos as $d): ?>
                        <tr>
                            <td>
                                <strong><?= date('d/m/Y', strtotime($d['fecha'])) ?></strong>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-primary"><?= $d['cantidad'] ?></span>
                            </td>
                            <td class="text-right">
                                <strong style="color:#27ae60;">
                                    S/. <?= number_format($d['total'], 2) ?>
                                </strong>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
            
            <!-- TOTAL GENERAL (OPCIONAL) -->
            <?php if (!empty($datos)): ?>
            <tfoot>
                <tr style="background-color: #f8f9fa; font-weight: bold;">
                    <td>TOTAL</td>
                    <td class="text-center">
                        <?= array_sum(array_column($datos, 'cantidad')) ?>
                    </td>
                    <td class="text-right" style="color:#27ae60;">
                        S/. <?= number_format(array_sum(array_column($datos, 'total')), 2) ?>
                    </td>
                </tr>
            </tfoot>
            <?php endif; ?>
        </table>
    </div>

</div>