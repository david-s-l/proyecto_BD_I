<div class="main-content">

    <div class="page-header">
        <h2>🧾 Detalle de Venta #<?= $ventas['id_venta'] ?></h2>
        <a href="<?= base_url ?>ventas/listar" class="btn btn-secondary">
            ← Volver
        </a>
    </div>

    <div class="form-container">

        <h3>Cliente</h3>
        <p>
            <strong>
                <?= !empty($ventas['cliente']) ? htmlspecialchars($ventas['cliente']) : 'Cliente ocasional' ?>
            </strong>
        </p>
        <p>Fecha: <?= date('d/m/Y H:i', strtotime($ventas['fecha_venta'])) ?></p>
        <p>Vendedor: <?= htmlspecialchars($ventas['usuario']) ?></p>

    </div>

    <div class="table-container">
        <h3>Productos Vendidos</h3>

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
                    <td><?= htmlspecialchars($d['nom_producto']) ?></td>
                    <td><?= $d['cantidad'] ?></td>
                    <td>S/. <?= number_format($d['precio_con_igv'], 2) ?></td>
                    <td><strong>S/. <?= number_format($d['subtotal_item_con_igv'], 2) ?></strong></td>
                </tr>
                <?php endforeach; ?>
            </tbody>

        </table>

        <h3 style="text-align:right; margin-top:10px;">
            Subtotal: 
            <span style="color:#27ae60;">
                S/. <?= number_format($ventas['subtotal'], 2) ?>
            </span>
        </h3>
        <h3 style="text-align:right; margin-top:10px;">
            IGV: 
            <span style="color:#27ae60;">
                S/. <?= number_format($ventas['igv'], 2) ?>
            </span>
        </h3>
        <h3 style="text-align:right; margin-top:10px;">
            Total General: 
            <span style="color:#27ae60;">
                S/. <?= number_format($ventas['total'], 2) ?>
            </span>
        </h3>

    </div>

</div>