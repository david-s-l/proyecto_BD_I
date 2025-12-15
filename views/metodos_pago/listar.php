<div class="main-content">

    <h2 class="title-center">Gestión de Métodos de Pago</h2>

    <!-- Alertas -->
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <?php if (isset($success)): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <!-- FORMULARIO CREAR / EDITAR -->
    <div class="form-container">

        <?php if (!empty($metodo_editar)): ?>
            <h3 class="text-center mb-2">✏ Editar Método de Pago</h3>
            <form method="POST" action="<?= base_url ?>metodoPago/editar/<?= $metodo_editar['id_metodo_pago'] ?>">
        <?php else: ?>
            <h3 class="text-center mb-2">➕ Crear Nuevo Método de Pago</h3>
            <form method="POST" action="<?= base_url ?>metodoPago/crear">
        <?php endif; ?>

            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control"
                    value="<?= $metodo_editar['nombre'] ?? '' ?>" required>
            </div>

            <div class="form-group">
                <label>Descripción</label>
                <textarea name="descripcion" class="form-control" rows="3"><?= $metodo_editar['descripcion'] ?? '' ?></textarea>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-success">
                    <?= empty($metodo_editar) ? "💾 Guardar Método de Pago" : "💾 Actualizar" ?>
                </button>

                <?php if (!empty($metodo_editar)): ?>
                    <a href="<?= base_url ?>metodoPago/listar" class="btn btn-secondary">
                        ✖ Cancelar
                    </a>
                <?php endif; ?>
            </div>

        </form>
    </div>

    <!-- LISTADO -->
    <div class="table-container">

        <div class="table-header">
            <h2>💳 Lista de Métodos de Pago</h2>
        </div>

        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($metodos_pago)): ?>
                    <?php foreach ($metodos_pago as $metodo): ?>
                    <tr>
                        <td><?= $metodo['id_metodo_pago'] ?></td>
                        <td><?= $metodo['nombre'] ?></td>
                        <td><?= $metodo['descripcion'] ?></td>
                        <td class="text-center">
                            <div class="table-actions">

                                <a href="<?= base_url ?>metodoPago/editar/<?= $metodo['id_metodo_pago'] ?>" 
                                class="btn btn-warning btn-sm">✏ Editar</a>

                                <?php if ($metodo['has_payments']): ?>
                                    <button class="btn btn-danger btn-sm" disabled title="No se puede eliminar porque tiene pagos asociados">
                                        🗑 Eliminar
                                    </button>
                                <?php else: ?>
                                    <a href="<?= base_url ?>metodoPago/eliminar/<?= $metodo['id_metodo_pago'] ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Seguro de eliminar este método de pago?');">
                                    🗑 Eliminar
                                    </a>
                                <?php endif; ?>

                            </div>

                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">No hay métodos de pago registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>

        </table>
    </div>
</div>