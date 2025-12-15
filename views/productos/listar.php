<div class="main-content">
    <!-- Contenedor de tabla con cabecera -->
    <div class="table-container">
        <!-- Cabecera con título y botón -->
        <div class="table-header">
            <h2>📦 Listado de Productos</h2>
            <a href="<?= base_url ?>producto/crear" class="btn btn-primary">➕ Nuevo Producto</a>
        </div>

        <!-- Tabla responsive -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th>Producto</th>
                        <th>Descripción</th>
                        <th>Categoría</th>
                        <th class="text-center">Precio (S/.)</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                <?php if (!empty($productos)): ?>
                    <?php foreach ($productos as $p): ?>
                        <tr>
                            <td class="text-center"><?= $p['id_producto'] ?></td>
                            <td><?= $p['nombre'] ?></td>
                            <td><?= $p['descripcion'] ?></td>
                            <td><?= $p['categoria'] ?></td>
                            <td class="text-center">S/ <?= number_format($p['precio'], 2) ?></td>
                            <td class="text-center">
                                <div class="table-actions">
                                    <a href="<?= base_url ?>producto/editar/<?= $p['id_producto'] ?>" class="btn btn-sm btn-warning">✏️ Editar</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">
                            <div class="alert alert-info" style="margin: 20px;">
                                No hay productos registrados. <a href="<?= base_url ?>producto/crear">Crea uno ahora</a>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Opcional: Información de registros -->
        <?php if (!empty($productos)): ?>
        <div class="mt-2 text-center" style="color: #7f8c8d; font-size: 14px;">
            Mostrando <?= count($productos) ?> producto(s)
        </div>
        <?php endif; ?>
    </div>
</div>