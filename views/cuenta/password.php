<div id="modalPassword" class="modal-overlay hidden">
    <div class="modal-box">

        <div class="modal-header">
            <h3>🔐 Cambiar Contraseña</h3>
            <button type="button" class="modal-close" id="cerrarModalPassword">
                <span>✕</span>
            </button>
        </div>

        <form method="POST" action="<?= base_url ?>cuenta/password" id="formPassword">

            <div class="form-group">
                <label>Contraseña Actual *</label>
                <input type="password" name="password_actual" id="password_actual"
                       class="form-control" required minlength="6">
            </div>

            <div class="form-group">
                <label>Nueva Contraseña * (mínimo 6 caracteres)</label>
                <input type="password" name="password_nueva" id="password_nueva"
                       class="form-control" required minlength="6">
            </div>

            <div class="form-group">
                <label>Confirmar Nueva Contraseña *</label>
                <input type="password" name="password_confirmar" id="password_confirmar"
                       class="form-control" required minlength="6">
            </div>

            <div class="modal-buttons">
                <button type="submit" class="btn btn-primary">
                    💾 Actualizar Contraseña
                </button>

                <button type="button" class="btn btn-secondary"
                    onclick="document.getElementById('cerrarModalPassword').click()">
                    ✖ Cancelar
                </button>
            </div>

        </form>

    </div>
</div>

<link rel="stylesheet" href="<?= base_url ?>assets/css/modal.css">

<script>
document.addEventListener("DOMContentLoaded", () => {

    const modal = document.getElementById("modalPassword");
    const btnCerrar = document.getElementById("cerrarModalPassword");
    const formPassword = document.getElementById("formPassword");

    if (!modal || !btnCerrar || !formPassword) return;

    /* ==================================================
       ✅ VALIDACIÓN DEL FORMULARIO ANTES DE ENVIAR
    ================================================== */
    formPassword.addEventListener("submit", (e) => {
        e.preventDefault();

        const actual = document.getElementById("password_actual").value.trim();
        const nueva = document.getElementById("password_nueva").value.trim();
        const confirmar = document.getElementById("password_confirmar").value.trim();

        // Validar que no estén vacíos
        if (!actual || !nueva || !confirmar) {
            modalAlert("Error de Validación", "Todos los campos son obligatorios");
            return;
        }

        // Validar longitud mínima
        if (nueva.length < 6) {
            modalAlert("Error de Validación", "La nueva contraseña debe tener al menos 6 caracteres");
            return;
        }

        // Validar que las contraseñas coincidan
        if (nueva !== confirmar) {
            modalAlert("Error de Validación", "La nueva contraseña y su confirmación no coinciden");
            return;
        }

        // Validar que la nueva sea diferente a la actual
        if (actual === nueva) {
            modalAlert("Error de Validación", "La nueva contraseña debe ser diferente a la actual");
            return;
        }

        // Si todo es válido, enviar el formulario
        formPassword.submit();
    });

    /* ==================================================
       🔴 CERRAR MODAL
    ================================================== */
    btnCerrar.addEventListener("click", () => {
        modal.classList.add("closing");
        setTimeout(() => {
            modal.classList.remove("closing");
            modal.classList.add("hidden");
            
            // Limpiar el formulario al cerrar
            formPassword.reset();
        }, 300);
    });

    /* ==================================================
       🔴 CERRAR AL HACER CLIC FUERA
    ================================================== */
    modal.addEventListener("click", (e) => {
        if (e.target === modal) btnCerrar.click();
    });

    /* ==================================================
       🔴 CERRAR CON TECLA ESC
    ================================================== */
    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape" && !modal.classList.contains("hidden")) {
            btnCerrar.click();
        }
    });

});
</script>