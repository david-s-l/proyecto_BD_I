<div class="main-content">

    <h2 class="title-center">👥 Gestión de Usuarios</h2>

    <!-- Alertas -->
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <?php if (isset($success)): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <!-- FORMULARIO CREAR / EDITAR -->
    <div class="form-container">

        <?php if (!empty($usuario_editar)): ?>
            <h3 class="text-center mb-2">✏️ Editar Usuario</h3>
            <!-- ✔ URL AMIGA CORRECTA -->
            <form method="POST" action="<?= base_url ?>usuario/editar/<?= $usuario_editar['id_usuario'] ?>">
        <?php else: ?>
            <h3 class="text-center mb-2">➕ Crear Nuevo Usuario</h3>
            <!-- ✔ URL AMIGA -->
            <form method="POST" action="<?= base_url ?>usuario/crear">
        <?php endif; ?>

            <div class="form-group">
                <label>Username *</label>
                <input type="text" name="username" class="form-control" 
                    value="<?= $usuario_editar['username'] ?? '' ?>" 
                    placeholder="Nombre de usuario único" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label><?= empty($usuario_editar) ? 'Contraseña *' : 'Nueva Contraseña (opcional)' ?></label>
                    <input type="password" name="password" class="form-control" 
                        placeholder="Mínimo 6 caracteres" <?= empty($usuario_editar) ? 'required' : '' ?>>
                </div>

                <div class="form-group">
                    <label>Confirmar Contraseña<?= empty($usuario_editar) ? ' *' : '' ?></label>
                    <input type="password" name="password_confirm" class="form-control" 
                        placeholder="Repetir contraseña" <?= empty($usuario_editar) ? 'required' : '' ?>>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Documento (DNI/CE)</label>
                    <input type="text" name="documento" class="form-control" 
                        value="<?= $usuario_editar['documento'] ?? '' ?>" 
                        placeholder="12345678" maxlength="20">
                </div>

                <div class="form-group">
                    <label>Teléfono</label>
                    <input type="text" name="telefono" class="form-control" 
                        value="<?= $usuario_editar['telefono'] ?? '' ?>" 
                        placeholder="987654321" maxlength="20">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Nombres *</label>
                    <input type="text" name="nombres" class="form-control" 
                        value="<?= $usuario_editar['nombres'] ?? '' ?>" 
                        placeholder="Juan Carlos" required>
                </div>

                <div class="form-group">
                    <label>Apellidos *</label>
                    <input type="text" name="apellidos" class="form-control" 
                        value="<?= $usuario_editar['apellidos'] ?? '' ?>" 
                        placeholder="Pérez Gómez" required>
                </div>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" 
                    value="<?= $usuario_editar['email'] ?? '' ?>" 
                    placeholder="usuario@example.com">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Roles</label>
                    <div style="border: 2px solid #e0e0e0; border-radius: 6px; padding: 15px; background-color: #f8f9fa;">
                        <?php if (!empty($roles)): ?>
                            <?php foreach ($roles as $rol): ?>
                                <div class="form-check">
                                    <input 
                                        type="checkbox" 
                                        name="roles[]" 
                                        value="<?= $rol['id_rol'] ?>" 
                                        id="rol_<?= $rol['id_rol'] ?>"
                                        <?= (isset($roles_ids_usuario) && in_array($rol['id_rol'], $roles_ids_usuario)) ? 'checked' : '' ?>
                                    >
                                    <label for="rol_<?= $rol['id_rol'] ?>">
                                        <strong><?= $rol['nombre'] ?></strong>
                                        <?php if (!empty($rol['descripcion'])): ?>
                                            - <small><?= $rol['descripcion'] ?></small>
                                        <?php endif; ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-center">No hay roles disponibles</p>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if (!empty($usuario_editar)): ?>
                    <div class="form-group">
                        <label>Estado</label>
                        <select name="estado" class="form-control">
                            <option value="1" <?= ($usuario_editar['estado'] == 1) ? 'selected' : '' ?>>Activo</option>
                            <option value="0" <?= ($usuario_editar['estado'] == 0) ? 'selected' : '' ?>>Inactivo</option>
                        </select>
                    </div>
                <?php endif; ?>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-success">
                    <?= empty($usuario_editar) ? "💾 Guardar Usuario" : "💾 Actualizar" ?>
                </button>

                <?php if (!empty($usuario_editar)): ?>
                    <a href="<?= base_url ?>usuario/listar" class="btn btn-secondary">
                        ✖ Cancelar
                    </a>
                <?php endif; ?>
            </div>

        </form>
    </div>

    <!-- LISTADO -->
    <div class="table-container">

        <div class="table-header">
            <h2>📋 Lista de Usuarios</h2>
        </div>

        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Documento</th>
                    <th>Nombres Completos</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Roles</th>
                    <th>Estado</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($usuarios)): ?>
                    <?php foreach ($usuarios as $user): ?>
                    <tr>
                        <td><?= $user['id_usuario'] ?></td>
                        <td><strong><?= $user['username'] ?></strong></td>
                        <td><?= $user['documento'] ?: 'N/A' ?></td>
                        <td><?= $user['nombres'] . ' ' . $user['apellidos'] ?></td>
                        <td><?= $user['email'] ?: 'N/A' ?></td>
                        <td><?= $user['telefono'] ?: 'N/A' ?></td>

                        <td>
                            <?php if (!empty($user['roles'])): ?>
                                <span class="badge badge-info"><?= $user['roles'] ?></span>
                            <?php else: ?>
                                <span class="badge badge-secondary">Sin roles</span>
                            <?php endif; ?>
                        </td>

                        <td>
                            <?php if ($user['estado'] == 1): ?>
                                <span class="badge badge-success">Activo</span>
                            <?php else: ?>
                                <span class="badge badge-danger">Inactivo</span>
                            <?php endif; ?>
                        </td>

                        <td class="text-center">
                            <div class="table-actions">

                                <!-- ✔ URL AMIGA -->
                                <a href="<?= base_url ?>usuario/editar/<?= $user['id_usuario'] ?>"
                                   class="btn btn-warning btn-sm">✏️ Editar</a>

                                <?php if ($user['has_relations']): ?>
                                    <button class="btn btn-danger btn-sm" disabled 
                                        title="No se puede eliminar porque tiene registros asociados">
                                        🗑️ Eliminar
                                    </button>
                                <?php else: ?>
                                   <button class="btn btn-danger btn-sm btn-eliminar" 
                                           data-id="<?= $user['id_usuario'] ?>">
                                       🗑️ Eliminar
                                    </button>
                                <?php endif; ?>

                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center">No hay usuarios registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>

        </table>
    </div>
</div>
<!-- AJAX -->
<script src="<?= base_url ?>assets/script/modal.js"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {

    document.querySelectorAll(".btn-eliminar").forEach(btn => {

        btn.addEventListener("click", () => {
            const id = btn.dataset.id;

            modalConfirm("¿Seguro que deseas eliminar este usuario?", () => {

                fetch("<?= base_url ?>usuario/eliminar", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: "id=" + encodeURIComponent(id)
                })
                .then(r => r.json())
                .then(res => {

                    if (res.ok) {
                        modalAlert("✔ Eliminado", "El usuario fue eliminado correctamente.");
                        setTimeout(() => location.reload(), 1000);
                    } else {
                        modalAlert("❌ Error", res.error);
                    }

                })
                .catch(() => {
                    modalAlert("⚠ Error", "No se pudo conectar con el servidor.");
                });

            });
        });

    });

});
</script>

