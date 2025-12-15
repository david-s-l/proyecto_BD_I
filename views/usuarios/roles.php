<div class="main-content">
    <div class="content-header">
        <h2>Gestión de Roles</h2>
        <button id="btnNuevoRol" class="btn btn-primary">+ Nuevo Rol</button>
    </div>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <?php if (isset($success)): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre del Rol</th>
                    <th>Descripción</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($roles as $r): ?>
                <tr>
                    <td><?= $r['id_rol'] ?></td>
                    <td><?= $r['nombre'] ?></td>
                    <td><?= $r['descripcion'] ?></td>

                    <td class="text-center">
                        <button 
                            class="btn btn-warning btn-sm btn-editar"
                            data-id="<?= $r['id_rol'] ?>"
                            data-nombre="<?= $r['nombre'] ?>"
                            data-descripcion="<?= $r['descripcion'] ?>"
                        >
                            ✏ Editar
                        </button>

                        <button class="btn btn-danger btn-sm btn-eliminar"
                                data-id="<?= $r['id_rol'] ?>">
                            🗑 Eliminar
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal para Crear/Editar Rol -->
<?php require 'views/usuarios/modal_rol.php'; ?>

<script src="<?= base_url ?>assets/script/modal.js"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {

    const modal = document.getElementById("modalRol");
    const btnNuevoRol = document.getElementById("btnNuevoRol");
    const btnCerrar = document.getElementById("cerrarModalRol");

    const titulo = document.getElementById("modalRolTitulo");
    const formRol = document.getElementById("formRol");

    const id_rol = document.getElementById("id_rol");
    const nombre = document.getElementById("nombre");
    const descripcion = document.getElementById("descripcion");

    /* ======================================================
       🟦 NUEVO ROL
    ====================================================== */
    btnNuevoRol.addEventListener("click", () => {
        titulo.innerText = "Nuevo Rol";

        id_rol.value = "";
        nombre.value = "";
        descripcion.value = "";

        formRol.action = "<?= base_url ?>rol/crear";

        modal.classList.remove("hidden");
    });

    /* ======================================================
       🟧 EDITAR ROL
    ====================================================== */
    document.querySelectorAll(".btn-editar").forEach(btn => {
        btn.addEventListener("click", () => {
            titulo.innerText = "Editar Rol";

            id_rol.value = btn.dataset.id;
            nombre.value = btn.dataset.nombre;
            descripcion.value = btn.dataset.descripcion;

            formRol.action = "<?= base_url ?>rol/editar/" + btn.dataset.id;

            modal.classList.remove("hidden");
        });
    });

    /* ======================================================
       🔴 CERRAR MODAL
    ====================================================== */
    btnCerrar.addEventListener("click", () => {
        modal.classList.add("hidden");
    });

    /* ======================================================
       🗑 ELIMINAR ROL (Ya existe tu modalConfirm)
    ====================================================== */
    document.querySelectorAll(".btn-eliminar").forEach(btn => {
        btn.addEventListener("click", () => {
            modalConfirm("¿Seguro que deseas eliminar este rol?", () => {
                window.location.href =
                    "<?= base_url ?>rol/eliminar/" + btn.dataset.id;
            });
        });
    });

});
</script>

