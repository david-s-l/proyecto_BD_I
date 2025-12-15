<!-- views/inventario/movimientos.php -->
<div class="main-content">

    <div class="page-header">
        <h2>🔄 Movimientos de Inventario</h2>
        <a href="<?= base_url ?>inventario/listar" class="btn btn-secondary">← Volver</a>
    </div>

    <div class="table-container">
        <table class="table table-hover table-striped">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Producto</th>
                    <th>Tipo</th>
                    <th>Cantidad</th>
                    <th>Motivo</th>
                    <th>Usuario</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($movimientos as $m): ?>
                <tr>
                    <td><?= $m['id_movimiento'] ?></td>
                    <td><?= date("d/m/Y H:i", strtotime($m['fecha'])) ?></td>
                    <td><?= htmlspecialchars($m['producto']) ?></td>

                    <td>
                        <?php 
                        $color = [
                            'entrada' => 'green',
                            'salida' => 'red',
                            'ajuste' => 'orange'
                        ][$m['tipo']];
                        ?>
                        <span style="color: <?= $color ?>; font-weight: bold;">
                            <?= strtoupper($m['tipo']) ?>
                        </span>
                    </td>

                    <td><strong><?= $m['cantidad'] ?></strong></td>
                    <td><?= htmlspecialchars($m['motivo'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($m['usuario']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>
</div>
