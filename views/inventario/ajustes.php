<!-- views/inventario/ajustes.php -->
<div class="main-content">

    <div class="page-header">
        <h2>⚙ Ajuste de Inventario</h2>
        <a href="<?= base_url ?>inventario/listar" class="btn btn-secondary">← Volver</a>
    </div>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <div class="form-container">

        <form action="<?= base_url ?>inventario/registrarAjuste" method="POST">

            <div class="form-group">
                <label>Producto</label>
                <select name="id_producto" class="form-control" required>
                    <option value="">Seleccione</option>
                    <?php foreach ($productos as $p): ?>
                        <option value="<?= $p['id_producto'] ?>">
                            <?= htmlspecialchars($p['nombre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Cantidad (puede ser + o -)</label>
                <input type="number" name="cantidad" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Motivo</label>
                <textarea name="motivo" class="form-control" rows="2"></textarea>
            </div>

            <button class="btn btn-warning">⚙ Registrar Ajuste</button>

        </form>
    </div>
</div>
