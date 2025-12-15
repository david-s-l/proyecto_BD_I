<div id="modalProveedor" class="modal-overlay hidden">
    <div class="modal-box modal-large">
        <div class="modal-header">
            <h3 id="modalProveedorTitulo">✨ Nuevo Proveedor</h3>

            <button type="button" class="modal-close" id="cerrarModalProveedor">
                <span>✕</span>
            </button>
        </div>

        <form id="formProveedor" method="POST">
            <input type="hidden" name="id_proveedor" id="id_proveedor">

            <div class="form-group">
                <label>Nombre del Proveedor *</label>
                <input type="text" name="nombre" id="nombre" 
                    class="form-control" required maxlength="150">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>RUC</label>
                    <input type="text" name="ruc" id="ruc" class="form-control" maxlength="20">
                </div>

                <div class="form-group">
                    <label>Teléfono</label>
                    <input type="text" name="telefono" id="telefono" class="form-control" maxlength="20">
                </div>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" id="email" class="form-control" maxlength="120">
            </div>

            <div class="form-group">
                <label>Dirección</label>
                <textarea name="direccion" id="direccion" class="form-control" rows="3" maxlength="255"></textarea>
            </div>

            <div class="modal-buttons">
                <button type="submit" class="btn btn-success">
                    💾 Guardar Proveedor
                </button>

                <button type="button" class="btn btn-secondary"
                    onclick="document.getElementById('cerrarModalProveedor').click()">
                    ✖ Cancelar
                </button>
            </div>

        </form>
    </div>
</div>

<link rel="stylesheet" href="<?=base_url?>assets/css/modal.css">

<script>
document.addEventListener("DOMContentLoaded", () => {

    const modal = document.getElementById("modalProveedor");
    const btnCerrar = document.getElementById("cerrarModalProveedor");

    if (!modal || !btnCerrar) return;

    btnCerrar.addEventListener("click", () => {
        modal.classList.add("closing");
        setTimeout(() => {
            modal.classList.remove("closing");
            modal.classList.add("hidden");
        }, 300);
    });

    modal.addEventListener("click", (e) => {
        if (e.target === modal) btnCerrar.click();
    });

    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape" && !modal.classList.contains("hidden")) {
            btnCerrar.click();
        }
    });

});
</script>
