<div id="modalCliente" class="modal-overlay hidden">
    <div class="modal-box modal-large">
        <div class="modal-header">
            <h3 id="modalClienteTitulo">✨ Nuevo Cliente</h3>
            <button type="button" class="modal-close" id="cerrarModalCliente">
                <span>✕</span>
            </button>
        </div>

        <form id="formCliente" method="POST">
            <input type="hidden" name="id_cliente" id="id_cliente">

            <div class="form-row">
                <div class="form-group">
                    <label>Documento (DNI/RUC)</label>
                    <input type="text" name="documento" id="documento" class="form-control" placeholder="Ej: 12345678 o 20123456789" maxlength="20">
                </div>

                <div class="form-group">
                    <label>Teléfono</label>
                    <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Ej: 999888777" maxlength="20">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Nombres *</label>
                    <input type="text" name="nombres" id="nombres" class="form-control" placeholder="Nombres del cliente" required maxlength="120">
                </div>

                <div class="form-group">
                    <label>Apellidos *</label>
                    <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Apellidos del cliente" required maxlength="120">
                </div>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="ejemplo@correo.com" maxlength="120">
            </div>

            <div class="form-group">
                <label>Dirección</label>
                <textarea name="direccion" id="direccion" class="form-control" rows="3" placeholder="Dirección completa del cliente" maxlength="255"></textarea>
            </div>

            <div class="modal-buttons">
                <button type="submit" class="btn btn-success">
                    💾 Guardar Cliente
                </button>
                <button type="button" class="btn btn-secondary" onclick="document.getElementById('cerrarModalCliente').click()">
                    ✖ Cancelar
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Llamar al CSS genérico -->
<link rel="stylesheet" href="<?=base_url?>assets/css/modal.css">

<script>
// Script mejorado para el modal de clientes
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('modalCliente');
    const btnCerrar = document.getElementById('cerrarModalCliente');
    
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