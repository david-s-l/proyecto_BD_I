<div class="main-content">

    <div class="page-header">
        <h2>💵 Ganancias del Mes</h2>
    </div>

    <div class="table-container">

        <?php if (empty($ganancia)): ?>
            <div class="alert alert-info">
                No hay datos para este mes.
            </div>
        <?php else: ?>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Mes</th>
                        <th>Ganancia</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td><?= str_pad($mes, 2, '0', STR_PAD_LEFT) ?>/<?= $anio ?></td>
                        <td>
                            <strong style="color:<?= $ganancia['ganancia'] >= 0 ? '#27ae60' : '#c0392b' ?>">
                                S/. <?= number_format($ganancia['ganancia'], 2) ?>
                            </strong>
                        </td>
                    </tr>
                </tbody>
            </table>

        <?php endif; ?>

    </div>
</div>
