<div class="main-content">
    <div class="page-header">
        <h2>📋 Gestión de Clientes</h2>
        <button id="btnNuevoCliente" class="btn btn-primary">+ Nuevo Cliente</button>
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
                    <th>Documento</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Dirección</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php if (empty($clientes)): ?>
                    <tr>
                        <td colspan="8" class="text-center">No hay clientes registrados</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($clientes as $c): ?>
                    <tr>
                        <td><?= $c['id_cliente'] ?></td>
                        <td><?= $c['documento'] ?? '-' ?></td>
                        <td><?= $c['nombres'] ?></td>
                        <td><?= $c['apellidos'] ?></td>
                        <td><?= $c['telefono'] ?? '-' ?></td>
                        <td><?= $c['email'] ?? '-' ?></td>
                        <td><?= $c['direccion'] ?? '-' ?></td>

                        <td class="text-center">
                            <div class="table-actions">
                                <button 
                                    class="btn btn-info btn-sm btn-ver"
                                    data-id="<?= $c['id_cliente'] ?>"
                                    title="Ver historial"
                                >
                                    👁 Ver 
                                </button>

                                <button 
                                    class="btn btn-warning btn-sm btn-editar"
                                    data-id="<?= $c['id_cliente'] ?>"
                                    data-documento="<?= $c['documento'] ?? '' ?>"
                                    data-nombres="<?= $c['nombres'] ?>"
                                    data-apellidos="<?= $c['apellidos'] ?>"
                                    data-telefono="<?= $c['telefono'] ?? '' ?>"
                                    data-email="<?= $c['email'] ?? '' ?>"
                                    data-direccion="<?= $c['direccion'] ?? '' ?>"
                                >
                                    ✏ Editar
                                </button>

                                <button 
                                    class="btn btn-danger btn-sm btn-eliminar"
                                    data-id="<?= $c['id_cliente'] ?>"
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

<!-- Modal para Crear/Editar Cliente -->
<?php require 'views/clientes/modal_cliente.php'; ?>

<script src="<?= base_url ?>assets/script/modal.js"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {

    const modal = document.getElementById("modalCliente");
    const btnNuevoCliente = document.getElementById("btnNuevoCliente");
    const btnCerrar = document.getElementById("cerrarModalCliente");

    const titulo = document.getElementById("modalClienteTitulo");
    const formCliente = document.getElementById("formCliente");

    const id_cliente = document.getElementById("id_cliente");
    const documento = document.getElementById("documento");
    const nombres = document.getElementById("nombres");
    const apellidos = document.getElementById("apellidos");
    const telefono = document.getElementById("telefono");
    const email = document.getElementById("email");
    const direccion = document.getElementById("direccion");

    /* ======================================================
       🟦 NUEVO CLIENTE
    ====================================================== */
    btnNuevoCliente.addEventListener("click", () => {
        titulo.innerText = "Nuevo Cliente";

        id_cliente.value = "";
        documento.value = "";
        nombres.value = "";
        apellidos.value = "";
        telefono.value = "";
        email.value = "";
        direccion.value = "";

        formCliente.action = "<?= base_url ?>cliente/crear";

        modal.classList.remove("hidden");
    });

    /* ======================================================
       🟧 EDITAR CLIENTE
    ====================================================== */
    document.querySelectorAll(".btn-editar").forEach(btn => {
        btn.addEventListener("click", () => {
            titulo.innerText = "Editar Cliente";

            id_cliente.value = btn.dataset.id;
            documento.value = btn.dataset.documento;
            nombres.value = btn.dataset.nombres;
            apellidos.value = btn.dataset.apellidos;
            telefono.value = btn.dataset.telefono;
            email.value = btn.dataset.email;
            direccion.value = btn.dataset.direccion;

            formCliente.action = "<?= base_url ?>cliente/editar/" + btn.dataset.id;

            modal.classList.remove("hidden");
        });
    });

    /* ======================================================
       👁 VER HISTORIAL
    ====================================================== */
    document.querySelectorAll(".btn-ver").forEach(btn => {
        btn.addEventListener("click", () => {
            window.location.href = "<?= base_url ?>cliente/historial/" + btn.dataset.id;
        });
    });

    /* ======================================================
       🔴 CERRAR MODAL
    ====================================================== */
    btnCerrar.addEventListener("click", () => {
        modal.classList.add("hidden");
    });

    /* ======================================================
       🗑 ELIMINAR CLIENTE
    ====================================================== */
    document.querySelectorAll(".btn-eliminar").forEach(btn => {
        btn.addEventListener("click", () => {
            modalConfirm("¿Seguro que deseas eliminar este cliente?", () => {
                window.location.href =
                    "<?= base_url ?>cliente/eliminar/" + btn.dataset.id;
            });
        });
    });

});
</script>