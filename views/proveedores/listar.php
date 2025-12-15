<div class="main-content">
    <div class="page-header">
        <h2>📦 Gestión de Proveedores</h2>
        <button id="btnNuevoProveedor" class="btn btn-primary">+ Nuevo Proveedor</button>
    </div>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <?php if (isset($success)): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <div class="table-container">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>RUC</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Dirección</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php if (empty($proveedores)): ?>
                    <tr>
                        <td colspan="8" class="text-center">No hay proveedores registrados</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($proveedores as $p): ?>
                    <tr>
                        <td><?= $p['id_proveedor'] ?></td>
                        <td><?= $p['nombre'] ?></td>
                        <td><?= $p['ruc'] ?? '-' ?></td>
                        <td><?= $p['telefono'] ?? '-' ?></td>
                        <td><?= $p['email'] ?? '-' ?></td>
                        <td><?= $p['direccion'] ?? '-' ?></td>

                        <td class="text-center">
                            <div class="table-actions">

                                <button 
                                    class="btn btn-info btn-sm btn-ver"
                                    data-id="<?= $p['id_proveedor'] ?>"
                                    title="Ver Compras Realizadas"
                                >
                                    👁 Ver Compras
                                </button>

                                <button 
                                    class="btn btn-warning btn-sm btn-editar"
                                    data-id="<?= $p['id_proveedor'] ?>"
                                    data-nombre="<?= $p['nombre'] ?>"
                                    data-ruc="<?= $p['ruc'] ?? '' ?>"
                                    data-telefono="<?= $p['telefono'] ?? '' ?>"
                                    data-email="<?= $p['email'] ?? '' ?>"
                                    data-direccion="<?= $p['direccion'] ?? '' ?>"
                                >
                                    ✏ Editar
                                </button>
                                
                                <button 
                                    class="btn btn-danger btn-sm btn-eliminar"
                                    data-id="<?= $p['id_proveedor'] ?>"
                                >
                                    🗑 Eliminar
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

<!-- Modal de proveedores -->
<?php require 'views/proveedores/modal_proveedor.php'; ?>
<script src="<?= base_url ?>assets/script/modal.js"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {

    const modal = document.getElementById("modalProveedor");
    const btnNuevo = document.getElementById("btnNuevoProveedor");
    const btnCerrar = document.getElementById("cerrarModalProveedor");

    const titulo = document.getElementById("modalProveedorTitulo");
    const formProveedor = document.getElementById("formProveedor");

    const id_proveedor = document.getElementById("id_proveedor");
    const nombre = document.getElementById("nombre");
    const ruc = document.getElementById("ruc");
    const telefono = document.getElementById("telefono");
    const email = document.getElementById("email");
    const direccion = document.getElementById("direccion");

    /* ==================================================
       🟩 NUEVO PROVEEDOR
    ================================================== */
    btnNuevo.addEventListener("click", () => {

        titulo.innerText = "Nuevo Proveedor";

        id_proveedor.value = "";
        nombre.value = "";
        ruc.value = "";
        telefono.value = "";
        email.value = "";
        direccion.value = "";

        formProveedor.action = "<?= base_url ?>proveedor/crear";

        modal.classList.remove("hidden");
    });


    /* ======================================================
       👁 VER COMPRAS POR PROVEEDOR
    ====================================================== */
    document.querySelectorAll(".btn-ver").forEach(btn => {
        btn.addEventListener("click", () => {
            window.location.href = "<?= base_url ?>proveedor/compras/" + btn.dataset.id;
        });
    });

    /* ==================================================
       🟧 EDITAR PROVEEDOR
    ================================================== */
    document.querySelectorAll(".btn-editar").forEach(btn => {
        btn.addEventListener("click", () => {

            titulo.innerText = "Editar Proveedor";

            id_proveedor.value = btn.dataset.id;
            nombre.value = btn.dataset.nombre;
            ruc.value = btn.dataset.ruc;
            telefono.value = btn.dataset.telefono;
            email.value = btn.dataset.email;
            direccion.value = btn.dataset.direccion;

            formProveedor.action = "<?= base_url ?>proveedor/editar/" + btn.dataset.id;

            modal.classList.remove("hidden");
        });
    });

    /* ==================================================
       🔴 CERRAR MODAL
    ================================================== */
    btnCerrar.addEventListener("click", () => {
        modal.classList.add("hidden");
    });

    /* ==================================================
       🗑 ELIMINAR
    ================================================== */
    document.querySelectorAll(".btn-eliminar").forEach(btn => {
        btn.addEventListener("click", () => {

            modalConfirm("¿Seguro que deseas eliminar este proveedor?", () => {
                window.location.href =
                    "<?= base_url ?>proveedor/eliminar/" + btn.dataset.id;
            });

        });
    });
});
</script>
