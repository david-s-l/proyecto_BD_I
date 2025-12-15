<div class="main-content">

    <div class="page-header">
        <h2>🧾 Detalle de Compra #<?= $compras['id_compra'] ?></h2>
        <a href="<?= base_url ?>compras/listar" class="btn btn-secondary">
            ← Volver
        </a>
    </div>

    <div class="form-container">

        <h3>Proveedor</h3>
        <p><strong><?= htmlspecialchars($compras['proveedor']) ?></strong></p>
        <p>Fecha: <?= date('d/m/Y H:i', strtotime($compras['fecha_compra'])) ?></p>
        <p>Registrado por: <?= htmlspecialchars($compras['usuario']) ?></p>

    </div>

    <div class="table-container">
        <h3>Productos Comprados</h3>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($detalle as $d): ?>
                <tr>
                    <td><?= htmlspecialchars($d['producto']) ?></td>
                    <td><?= $d['cantidad'] ?></td>
                    <td>S/. <?= number_format($d['precio'], 2) ?></td>
                    <td><strong>S/. <?= number_format($d['subtotal'], 2) ?></strong></td>
                </tr>
                <?php endforeach; ?>
            </tbody>

        </table>

        <h3 style="text-align:right; margin-top:10px;">
            Subtotal: 
            <span style="color:#27ae60;">
                S/. <?= number_format($compras['subtotal'], 2) ?>
            </span>
        </h3>
        <h3 style="text-align:right; margin-top:10px;">
            IGV: 
            <span style="color:#27ae60;">
                S/. <?= number_format($compras['igv'], 2) ?>
            </span>
        </h3>
        <h3 style="text-align:right; margin-top:10px;">
            Total General: 
            <span style="color:#27ae60;">
                S/. <?= number_format($compras['total'], 2) ?>
            </span>
        </h3>
    </div>

</div>
