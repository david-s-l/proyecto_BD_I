<div class="main-content">
    <!-- Título centrado -->
    <h2 class="title-center">✏️ Editar Producto</h2>

    <!-- Alertas -->
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <?php if (isset($success)): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <!-- Contenedor del formulario -->
    <div class="form-container">
        <form method="POST" action="<?= base_url ?>producto/editar/<?= $producto['id_producto'] ?>">
            
            <!-- Campo oculto con el ID -->
            <input type="hidden" name="id_producto" value="<?= $producto['id_producto'] ?>">

            <div class="form-group">
                <label>Nombre del producto</label>
                <input type="text" name="nombre" class="form-control" value="<?= $producto['nombre'] ?>" placeholder="Ingrese el nombre del producto" required>
            </div>

            <div class="form-group">
                <label>Descripción del producto</label>
                <textarea name="descripcion" class="form-control" rows="3" placeholder="Ingrese la descripción del producto" required><?= $producto['descripcion'] ?></textarea>
            </div>

            <!-- Dos columnas para Precio y Stock -->
            <div class="form-row">
                <div class="form-group">
                    <label>Precio (S/.)</label>
                    <input type="number" name="precio" step="0.01" class="form-control" value="<?= $producto['precio'] ?>" placeholder="0.00" required>
                </div>
            </div>

            <!-- Dos columnas para Categoría y Estado -->
            <div class="form-row">
                <div class="form-group">
                    <label>Categoría</label>
                    <select name="id_categoria" class="form-control" required>
                        <option value="">-- Seleccione una categoría --</option>
                        <?php foreach ($categorias as $c): ?>
                            <option value="<?= $c['id_categoria'] ?>" <?= ($c['id_categoria'] == $producto['id_categoria']) ? 'selected' : '' ?>>
                                <?= $c['nombre'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Estado</label>
                    <select name="estado" class="form-control">
                        <option value="1" <?= ($producto['estado'] == 1) ? 'selected' : '' ?>>Activo</option>
                        <option value="0" <?= ($producto['estado'] == 0) ? 'selected' : '' ?>>Inactivo</option>
                    </select>
                </div>
            </div>

            <!-- Botones con espaciado -->
            <div class="btn-group mt-3">
                <button type="submit" class="btn btn-success">💾 Actualizar Producto</button>
                <a href="<?= base_url ?>producto/listar" class="btn btn-secondary">✖ Cancelar</a>
            </div>
        </form>
    </div>
</div>