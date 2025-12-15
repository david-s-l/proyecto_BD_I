<div class="main-content">

    <div class="page-header">
        <h2>👤 Mi Cuenta</h2>
    </div>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <?php if (isset($success)): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <!-- Mensajes específicos para contraseña -->
    <?php if (isset($_SESSION['error_password'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error_password'] ?>
            <?php unset($_SESSION['error_password']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['success_password'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['success_password'] ?>
            <?php unset($_SESSION['success_password']); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?= base_url ?>cuenta/actualizar" class="form-container">

        <h3>Información Personal</h3>

        <div class="form-row">
            <div class="form-group">
                <label>Documento</label>
                <input type="text" name="documento" class="form-control"
                       value="<?= htmlspecialchars($user_account['documento'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label>Teléfono</label>
                <input type="text" name="telefono" class="form-control"
                       value="<?= htmlspecialchars($user_account['telefono'] ?? '') ?>" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Nombres *</label>
                <input type="text" name="nombres" class="form-control" required
                       value="<?= htmlspecialchars($user_account['nombres'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Apellidos *</label>
                <input type="text" name="apellidos" class="form-control" required
                       value="<?= htmlspecialchars($user_account['apellidos'] ?? '') ?>">
            </div>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control"
                   value="<?= htmlspecialchars($user_account['email'] ?? '') ?>" required>
        </div>

        <div class="btn-group">

            <button type="button" class="btn btn-secondary" id="btnPassword">
                🔐 Cambiar Contraseña
            </button>
            
            <button type="submit" class="btn btn-primary">
                💾 Guardar Cambios
            </button>
        </div>
    </form>
</div>

<?php require 'views/cuenta/password.php'; ?>

<script src="<?= base_url ?>assets/script/modal.js"></script>

<script>
document.addEventListener("DOMContentLoaded", () => {

    const modal = document.getElementById("modalPassword");
    const btnAbrir = document.getElementById("btnPassword");

    /* ==================================================
       🔐 ABRIR MODAL CAMBIAR CONTRASEÑA
    ================================================== */
    btnAbrir.addEventListener("click", () => {
        modal.classList.remove("hidden");
    });

});
</script>