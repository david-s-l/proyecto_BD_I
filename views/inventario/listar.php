<!-- views/inventario/listar.php -->
<div class="main-content">

    <div class="page-header">
        <h2>📦 Inventario Actual</h2>

        <div>
            <a href="<?= base_url ?>inventario/entrada" class="btn btn-success">📥 Registrar Entrada</a>
            <a href="<?= base_url ?>inventario/salida" class="btn btn-danger">📤 Registrar Salida</a>
            <a href="<?= base_url ?>inventario/ajustes" class="btn btn-warning">⚙ Ajustes</a>
            <a href="<?= base_url ?>inventario/movimientos" class="btn btn-info">🔄 Ver Movimientos</a>
        </div>
    </div>

    <div class="table-container">
        <h3>📋 Lista de Productos</h3>

        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Stock Actual</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($inventario as $item): ?>
                <tr>
                    <td><?= $item['id_producto'] ?></td>
                    <td><strong><?= htmlspecialchars($item['nombre']) ?></strong></td>
                    <td><?= htmlspecialchars($item['categoria']) ?></td>
                    <td>S/. <?= number_format($item['precio'], 2) ?></td>
                    <td>
                        <strong style="color:<?= $item['stock_actual'] <= 5 ? 'red' : '#27ae60' ?>">
                            <?= $item['stock_actual'] ?>
                        </strong>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
