// 🔥 CREA UN MODAL TIPO ALERTA (CORREGIDO)
function modalAlert(title, message) {
    const overlay = document.createElement("div");
    overlay.className = "modal-overlay";

    // 1. Usar la clase .modal-header de tu CSS
    overlay.innerHTML = `
        <div class="modal-box modal-small">
            
            <div class="modal-header"> 
                <h3>${title}</h3>
                <button type="button" class="modal-close" id="closeAlert">
                    <span>✕</span>
                </button>
            </div>
            
            <div class="modal-body">
                <p>${message}</p>
            </div>
        </div>
    `;

    document.body.appendChild(overlay);
    
    let autoCloseTimer = null; 

    // Se cierra solo en 5 segundos
    autoCloseTimer = setTimeout(() => overlay.remove(), 5000);

    // Agregar el evento click al botón "✕"
    document.getElementById("closeAlert").onclick = () => {
        clearTimeout(autoCloseTimer);
        overlay.remove();
    };
}

// 🔥 CREA UN MODAL DE CONFIRMACIÓN
function modalConfirm(message, callbackYes) {

    const overlay = document.createElement("div");
    overlay.className = "modal-overlay";

    overlay.innerHTML = `
        <div class="modal-box">
            <h2>Confirmación</h2>
            <p>${message}</p>

            <div class="modal-buttons">
                <button class="modal-btn modal-btn-gray" id="cancelModal">Cancelar</button>
                <button class="modal-btn modal-btn-red" id="acceptModal">Eliminar</button>
            </div>
        </div>
    `;

    document.body.appendChild(overlay);

    document.getElementById("cancelModal").onclick = () => overlay.remove();

    document.getElementById("acceptModal").onclick = () => {
        overlay.remove();
        callbackYes(); // Ejecutar la acción final
    };
}

