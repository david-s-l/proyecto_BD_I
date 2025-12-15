<div class="main-content">

    <!-- ENCABEZADO -->
    <div class="page-header">
        <h2>🧾 Gestión de Compras</h2>
        <button id="btnNuevaCompra" class="btn btn-primary">
            + Nueva Compra
        </button>
    </div>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <?php if (isset($success)): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <!-- TABLA -->
    <div class="table-container">

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Proveedor</th>
                    <th>Fecha</th>
                    <th>Registrado por</th>
                    <th class="text-right">Total</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php if (empty($compras)): ?>
                    <tr>
                        <td colspan="6" class="text-center">
                            No hay compras registradas
                        </td>
                    </tr>

                <?php else: ?>
                    <?php foreach ($compras as $c): ?>
                    <tr>

                        <td><strong>#<?= $c['id_compra'] ?></strong></td>
                        <td><?= htmlspecialchars($c['proveedor']) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($c['fecha_compra'])) ?></td>
                        <td><?= htmlspecialchars($c['usuario']) ?></td>

                        <td class="text-right">
                            <strong style="color:#27ae60;">
                                S/. <?= number_format($c['total'], 2) ?>
                            </strong>
                        </td>

                        <td class="text-center">
                            <div class="table-actions">

                                <button 
                                    class="btn btn-info btn-sm btn-detalle"
                                    data-id="<?= $c['id_compra'] ?>"
                                >
                                    👁 Ver Detalle
                                </button>

                            </div>
                        </td>

                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>

        </table>
    </div>

</div>

<!-- MODAL NUEVA COMPRA -->
<?php require 'views/compras/modal_compras.php'; ?>

<script>
document.addEventListener("DOMContentLoaded", () => {

    const modal = document.getElementById("modalCompra");
    const btnNuevo = document.getElementById("btnNuevaCompra");
    const btnCerrar = document.getElementById("cerrarModalCompra");

    const formCompra = document.getElementById("formCompra");

    /* ==================================================
       🟩 NUEVA COMPRA
    ================================================== */
    btnNuevo.addEventListener("click", () => {
        modal.classList.remove("hidden");
    });

    /* ==================================================
       🔴 CERRAR MODAL
    ================================================== */
    btnCerrar.addEventListener("click", () => {
        modal.classList.add("hidden");
    });

    /* ==================================================
       👁 VER DETALLE
    ================================================== */
    document.querySelectorAll(".btn-detalle").forEach(btn => {

        btn.addEventListener("click", () => {
            window.location.href =
                "<?= base_url ?>compras/detalle/" + btn.dataset.id;
        });

    });

});
</script>
