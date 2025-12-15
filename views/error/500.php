<!-- views/error/500.php -->
<?php require_once 'views/layout/header.php'; ?>
<?php require_once 'views/layout/sidebar.php'; ?>

<div class="main-content">
    <div class="error-container">
        <div class="error-icon">💥</div>
        <h1 class="error-code-big error-server">500</h1>
        <h2 class="error-title">Error Interno del Servidor</h2>
        <p class="error-message">
            ¡Ups! Algo salió mal en nuestro servidor.<br>
            Nuestro equipo ha sido notificado y estamos trabajando en solucionarlo.
        </p>

        <div class="error-details">
            <?php if (isset($error_details) && !empty($error_details)): ?>
                <details>
                    <summary>Ver detalles técnicos</summary>
                    <pre><?= htmlspecialchars($error_details) ?></pre>
                </details>
            <?php endif; ?>
        </div>

        <div class="btn-group mt-3">
            <a href="<?= base_url ?>dashboard/index" class="btn btn-primary">🏠 Volver al Dashboard</a>
            <a href="javascript:location.reload()" class="btn btn-warning">🔄 Reintentar</a>
        </div>
    </div>
</div>

<?php require_once 'views/layout/footer.php'; ?>