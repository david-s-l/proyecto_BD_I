<div class="main-content">

    <div class="page-header">
        <h2>🕵️ Auditoría del Sistema</h2>
    </div>

    <div class="table-container">

        <?php if (empty($logs)): ?>
            <div class="alert alert-info">
                No hay registros de auditoría.
            </div>
        <?php else: ?>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tabla</th>
                        <th>Operación</th>
                        <th>Descripción</th>
                        <th>Fecha</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($logs as $l): ?>
                        <tr>
                            <td><?= htmlspecialchars($l['tabla']) ?></td>
                            <td>
                                <span class="badge">
                                    <?= htmlspecialchars($l['operacion']) ?>
                                </span>
                            </td>
                            <td><?= htmlspecialchars($l['descripcion']) ?></td>
                            <td><?= date('d/m/Y H:i:s', strtotime($l['fecha'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <?php endif; ?>

    </div>

</div>
