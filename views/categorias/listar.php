<div class="main-content">

    <h2 class="title-center">Gestión de Categorías</h2>

    <!-- Alertas -->
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <?php if (isset($success)): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <!-- FORMULARIO CREAR / EDITAR -->
    <div class="form-container">

        <?php if (!empty($categoria_editar)): ?>
            <h3 class="text-center mb-2">✏ Editar Categoría</h3>
            <form method="POST" action="<?= base_url ?>categoria/editar&id=<?= $categoria_editar['id_categoria'] ?>">
        <?php else: ?>
            <h3 class="text-center mb-2">➕ Crear Nueva Categoría</h3>
            <form method="POST" action="<?= base_url ?>categoria/crear">
        <?php endif; ?>

            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control"
                    value="<?= $categoria_editar['nombre'] ?? '' ?>" required>
            </div>

            <div class="form-group">
                <label>Descripción</label>
                <textarea name="descripcion" class="form-control" rows="3"><?= $categoria_editar['descripcion'] ?? '' ?></textarea>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-success">
                    <?= empty($categoria_editar) ? "💾 Guardar Categoría" : "💾 Actualizar" ?>
                </button>

                <?php if (!empty($categoria_editar)): ?>
                    <a href="<?= base_url ?>categoria/listar" class="btn btn-secondary">
                        ✖ Cancelar
                    </a>
                <?php endif; ?>
            </div>

        </form>
    </div>

    <!-- LISTADO -->
    <div class="table-container">

        <div class="table-header">
            <h2>📋 Lista de Categorías</h2>
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
                <?php if (!empty($categorias)): ?>
                    <?php foreach ($categorias as $cat): ?>
                    <tr>
                        <td><?= $cat['id_categoria'] ?></td>
                        <td><?= $cat['nombre'] ?></td>
                        <td><?= $cat['descripcion'] ?></td>
                        <td class="text-center">
                            <div class="table-actions">

                                <a href="<?= base_url ?>categoria/editar&id=<?= $cat['id_categoria'] ?>" 
                                class="btn btn-warning btn-sm">✏ Editar</a>

                                <?php if ($cat['has_products']): ?>
                                    <button class="btn btn-danger btn-sm" disabled title="No se puede eliminar porque tiene productos asociados">
                                        🗑 Eliminar
                                    </button>
                                <?php else: ?>
                                    <a href="<?= base_url ?>categoria/eliminar&id=<?= $cat['id_categoria'] ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Seguro de eliminar esta categoría?');">
                                    🗑 Eliminar
                                    </a>
                                <?php endif; ?>

                            </div>

                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">No hay categorías registradas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>

        </table>
    </div>
</div>
