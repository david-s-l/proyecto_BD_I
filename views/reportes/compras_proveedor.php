<div class="main-content">

    <div class="page-header">
        <h2>🏭 Compras por Proveedor</h2>
    </div>

    <div class="table-container">

        <?php if (empty($datos)): ?>
            <div class="alert alert-info">
                No hay compras registradas.
            </div>
        <?php else: ?>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Proveedor</th>
                        <th>Total Compras</th>
                        <th>Monto Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datos as $d): ?>
                        <tr>
                            <td><?= htmlspecialchars($d['proveedor']) ?></td>
                            <td><?= $d['compras'] ?></td>
                            <td>
                                <strong>S/. <?= number_format($d['total'], 2) ?></strong>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <?php endif; ?>

    </div>

</div>
