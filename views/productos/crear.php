<div class="main-content">
    <!-- Título centrado para formularios -->
    <h2 class="title-center">Registrar Nuevo Producto</h2>

    <!-- Alertas -->
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <?php if (isset($success)): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <!-- Contenedor del formulario -->
    <div class="form-container">
        <form method="POST" action="<?= base_url ?>producto/crear">
            
            <div class="form-group">
                <label>Nombre del producto</label>
                <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre del producto" required>
            </div>

            <div class="form-group">
                <label>Descripción del producto</label>
                <textarea name="descripcion" class="form-control" rows="3" placeholder="Ingrese la descripción del producto"></textarea>
            </div>

            <!-- Dos columnas para campos relacionados -->
            <div class="form-row">
                <div class="form-group">
                    <label>Precio (S/.)</label>
                    <input type="number" name="precio" step="0.01" class="form-control" placeholder="0.00" required>
                </div>
            </div>

            <div class="form-group">
                <label>Categoría</label>
                <select name="id_categoria" class="form-control" required>
                    <option value="">-- Seleccione una categoría --</option>
                    <?php foreach ($categorias as $c): ?>
                        <option value="<?= $c['id_categoria'] ?>"><?= $c['nombre'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Botones con espaciado -->
            <div class="btn-group mt-3">
                <button type="submit" class="btn btn-success">💾 Guardar Producto</button>
                <a href="<?= base_url ?>producto/listar" class="btn btn-secondary">✖ Cancelar</a>
            </div>
        </form>
    </div>
</div>