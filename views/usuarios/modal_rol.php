<div id="modalRol" class="modal-overlay hidden">
    <div class="modal-box">
        <div class="modal-header">
            <h3 id="modalRolTitulo">✨ Nuevo Rol</h3>
            <button type="button" class="modal-close" id="cerrarModalRol">
                <span>✕</span>
            </button>
        </div>

        <form id="formRol" method="POST">
            <input type="hidden" name="id_rol" id="id_rol">

            <div class="form-group">
                <label>Nombre del Rol *</label>
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ej: Administrador, Vendedor" required>
            </div>

            <div class="form-group">
                <label>Descripción *</label>
                <textarea name="descripcion" id="descripcion" class="form-control" rows="4" placeholder="Describe las funciones y permisos de este rol" required></textarea>
            </div>

            <div class="modal-buttons">
                <button type="submit" class="btn btn-success">
                    💾 Guardar Rol
                </button>
                <button type="button" class="btn btn-secondary" onclick="document.getElementById('cerrarModalRol').click()">
                    ✖ Cancelar
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Llamar al CSS genérico -->
<link rel="stylesheet" href="<?=base_url?>assets/css/modal.css">

<script>
// Script mejorado para el modal de roles
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('modalRol');
    const btnCerrar = document.getElementById('cerrarModalRol');
    
    if (!modal || !btnCerrar) return;
    
    // Cerrar modal con animación
    btnCerrar.addEventListener('click', function() {
        modal.classList.add('closing');
        setTimeout(() => {
            modal.classList.remove('closing');
            modal.classList.add('hidden');
        }, 300);
    });

    // Cerrar al hacer clic fuera del modal
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            btnCerrar.click();
        }
    });

    // Cerrar con tecla ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            btnCerrar.click();
        }
    });
});
</script>