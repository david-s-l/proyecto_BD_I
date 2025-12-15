<div class="main-content">

    <!-- Cabecera -->
    <div class="page-header">
        <h2>📦 Compras por Proveedor</h2>
        <a href="<?= base_url ?>proveedor/listar" class="btn btn-secondary">
            ← Volver a Proveedores
        </a>
    </div>

    <!-- Información del Proveedor -->
    <div class="form-container">

        <h3 style="
            margin-bottom: 20px; 
            color: #2c3e50; 
            border-bottom: 2px solid #ddd; 
            padding-bottom: 10px;">
            🏢 Proveedor: <?= htmlspecialchars($proveedor['nombre']) ?>
        </h3>

        <div class="form-row">
            <div class="form-group">
                <label>RUC:</label>
                <input type="text" class="form-control" 
                       value="<?= htmlspecialchars($proveedor['ruc'] ?? 'N/A') ?>" readonly>
            </div>

            <div class="form-group">
                <label>Teléfono:</label>
                <input type="text" class="form-control" 
                       value="<?= htmlspecialchars($proveedor['telefono'] ?? 'N/A') ?>" readonly>
            </div>

            <div class="form-group">
                <label>Email:</label>
                <input type="text" class="form-control" 
                       value="<?= htmlspecialchars($proveedor['email'] ?? 'N/A') ?>" readonly>
            </div>
        </div>

        <?php if (!empty($proveedor['direccion'])): ?>
        <div class="form-group">
            <label>Dirección:</label>
            <textarea class="form-control" readonly rows="2"><?= htmlspecialchars($proveedor['direccion']) ?></textarea>
        </div>
        <?php endif; ?>

    </div>

    <!-- Tabla de Compras -->
    <div class="table-container">
        <div class="table-header">
            <h2>📋 Historial de Compras</h2>

            <span class="badge badge-info" style="font-size: 14px; padding: 8px 15px;">
                Total: <?= count($compras) ?> compras
            </span>
        </div>

        <?php if (empty($compras)): ?>
            <div class="alert alert-info">
                ℹ️ Este proveedor aún no tiene compras registradas.
            </div>

        <?php else: ?>

            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID Compra</th>
                        <th>Fecha</th>
                        <th>Registrado por</th>
                        <th class="text-right">Total</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                <?php 
                $total_general = 0;
                foreach ($compras as $c):
                    $total_general += $c['total'];
                ?>
                    <tr>
                        <td><strong>#<?= $c['id_compra'] ?></strong></td>
                        <td><?= date('d/m/Y H:i', strtotime($c['fecha'])) ?></td>
                        <td><?= htmlspecialchars($c['usuario'] ?? 'N/A') ?></td>
                        <td class="text-right">
                            <strong style="color:#e67e22;">S/. <?= number_format($c['total'], 2) ?></strong>
                        </td>
                        <td class="text-center">
                            <a href="<?= base_url ?>compras/detalle/<?= $c['id_compra'] ?>" 
                               class="btn btn-info btn-sm">
                                👁 Ver Detalle
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>

                <tfoot>
                    <tr style="background:#f8f9fa; font-weight:bold;">
                        <td colspan="3" class="text-right">TOTAL GENERAL:</td>
                        <td class="text-right" style="color:#e67e22; font-size:16px;">
                            S/. <?= number_format($total_general, 2) ?>
                        </td>
                        <td></td>
                    </tr>
                </tfoot>

            </table>

        <?php endif; ?>
    </div>

    <!-- Cards de estadísticas -->
    <?php if (!empty($compras)): ?>
    <div class="cards-grid" style="margin-top: 30px;">

        <div class="card card-income-month">
            <div>
                <div class="card-label">Total Comprado al Proveedor</div>
                <div class="card-value">S/. <?= number_format($total_general, 2) ?></div>
            </div>
        </div>

        <div class="card card-income-today">
            <div>
                <div class="card-label">Número de Compras</div>
                <div class="card-value"><?= count($compras) ?></div>
            </div>
        </div>

        <div class="card card-expense-month">
            <div>
                <div class="card-label">Promedio por Compra</div>
                <div class="card-value">
                    S/. <?= number_format($total_general / count($compras), 2) ?>
                </div>
            </div>
        </div>

        <div class="card card-expense-today">
            <div>
                <div class="card-label">Última Compra</div>
                <div class="card-value" style="font-size:18px;">
                    <?= date('d/m/Y', strtotime($compras[0]['fecha'])) ?>
                </div>
            </div>
        </div>

    </div>
    <?php endif; ?>
</div>
