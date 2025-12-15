<!-- views/clientes/historial.php -->

<div class="main-content">
    <!-- Cabecera con información del cliente -->
    <div class="page-header">
        <h2>📊 Historial de Compras</h2>
        <a href="<?= base_url ?>cliente/listar" class="btn btn-secondary">
            ← Volver a Clientes
        </a>
    </div>

    <!-- Información del Cliente -->
    <div class="form-container">
        <h3 style="margin-bottom: 20px; color: #2c3e50; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px;">
            👤 Cliente: <?= htmlspecialchars($cliente['nombres']) ?> <?= htmlspecialchars($cliente['apellidos']) ?>
        </h3>
        
        <div class="form-row">
            <div class="form-group">
                <label>Documento:</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($cliente['documento'] ?? 'N/A') ?>" readonly>
            </div>

            <div class="form-group">
                <label>Teléfono:</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($cliente['telefono'] ?? 'N/A') ?>" readonly>
            </div>

            <div class="form-group">
                <label>Email:</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($cliente['email'] ?? 'N/A') ?>" readonly>
            </div>
        </div>

        <?php if (!empty($cliente['direccion'])): ?>
        <div class="form-group">
            <label>Dirección:</label>
            <textarea class="form-control" readonly rows="2"><?= htmlspecialchars($cliente['direccion']) ?></textarea>
        </div>
        <?php endif; ?>
    </div>

    <!-- Tabla de Historial de Ventas -->
    <div class="table-container">
        <div class="table-header">
            <h2>📋 Historial de Ventas</h2>
            <span class="badge badge-info" style="font-size: 14px; padding: 8px 15px;">
                Total: <?= count($historial) ?> ventas
            </span>
        </div>

        <?php if (empty($historial)): ?>
            <div class="alert alert-info">
                ℹ️ Este cliente aún no tiene ventas registradas.
            </div>
        <?php else: ?>
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID Venta</th>
                        <th>Fecha</th>
                        <th>Vendedor</th>
                        <th class="text-right">Total</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $total_general = 0;
                    foreach($historial as $h): 
                        $total_general += $h['total'];
                    ?>
                    <tr>
                        <td><strong>#<?= $h['id_venta'] ?></strong></td>
                        <td><?= date('d/m/Y H:i', strtotime($h['fecha'])) ?></td>
                        <td><?= htmlspecialchars($h['vendedor'] ?? 'N/A') ?></td>
                        <td class="text-right">
                            <strong style="color: #27ae60;">S/. <?= number_format($h['total'], 2) ?></strong>
                        </td>
                        <td class="text-center">
                            <a href="<?= base_url ?>ventas/detalle/<?= $h['id_venta'] ?>" 
                               class="btn btn-info btn-sm">
                                👁 Ver Detalle
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr style="background-color: #f8f9fa; font-weight: bold;">
                        <td colspan="3" class="text-right">TOTAL GENERAL:</td>
                        <td class="text-right" style="color: #27ae60; font-size: 16px;">
                            S/. <?= number_format($total_general, 2) ?>
                        </td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        <?php endif; ?>
    </div>

    <!-- Estadísticas Adicionales (Opcional) -->
    <?php if (!empty($historial)): ?>
    <div class="cards-grid" style="margin-top: 30px;">
        <div class="card card-income-month">
            <div>
                <div class="card-label">Total Comprado</div>
                <div class="card-value">S/. <?= number_format($total_general, 2) ?></div>
            </div>
        </div>

        <div class="card card-income-today">
            <div>
                <div class="card-label">Número de Ventas</div>
                <div class="card-value"><?= count($historial) ?></div>
            </div>
        </div>

        <div class="card card-expense-month">
            <div>
                <div class="card-label">Promedio por Venta</div>
                <div class="card-value">S/. <?= number_format($total_general / count($historial), 2) ?></div>
            </div>
        </div>

        <div class="card card-expense-today">
            <div>
                <div class="card-label">Última Compra</div>
                <div class="card-value" style="font-size: 18px;">
                    <?= date('d/m/Y', strtotime($historial[0]['fecha'])) ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>