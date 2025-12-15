<div class="main-content">

    <div class="page-header">
        <h2>📦 Productos Vendidos</h2>
    </div>

    <div class="table-container">

        <?php if (empty($datos)): ?>
            <div class="alert alert-info">
                No hay productos vendidos.
            </div>
        <?php else: ?>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad Vendida</th>
                        <th>Total Ingresos</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($datos as $d): ?>
                        <tr>
                            <td><?= htmlspecialchars($d['producto']) ?></td>
                            <td><?= $d['total_vendido'] ?></td>
                            <td>
                                <strong>S/. <?= number_format($d['total_ingreso'], 2) ?></strong>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <?php endif; ?>

    </div>

</div>
