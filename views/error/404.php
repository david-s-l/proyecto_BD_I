<?php require_once 'views/layout/header.php'; ?>
<?php require_once 'views/layout/sidebar.php'; ?>

<div class="main-content">
    <div class="error-container">
        <div class="error-icon">⚠️</div>
        <h1 class="error-code-big">404</h1>
        <h2 class="error-title">Página no encontrada</h2>
        <p class="error-message">
            Lo sentimos, la página que buscas no existe o ha sido movida.
        </p>

        <div class="btn-group mt-3">
            <a href="<?= base_url ?>dashboard/index" class="btn btn-primary">🏠 Volver al Dashboard</a>
            <a href="javascript:history.back()" class="btn btn-secondary">← Volver Atrás</a>
        </div>
    </div>
</div>

<?php require_once 'views/layout/footer.php'; ?>