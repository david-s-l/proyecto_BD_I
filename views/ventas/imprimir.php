<div id="modalTicket" class="modal-overlay hidden">
    <div class="modal-box modal-ticket">
        
        <div class="modal-header">
            <h3>🖨️ Ticket de Venta</h3>
            <button type="button" class="modal-close" id="cerrarModalTicket">
                <span>✕</span>
            </button>
        </div>

        <div id="ticketContent" class="modal-body">
            <div class="ticket">
                <h2>MI TIENDA</h2>
                <h3>Venta #<?= $venta['id_venta'] ?></h3>

                <p><strong>Fecha:</strong> <?= date('d/m/Y H:i', strtotime($venta['fecha_venta'])) ?></p>
                <p><strong>Cliente:</strong> <?= !empty($venta['cliente']) ? htmlspecialchars($venta['cliente']) : 'Cliente ocasional' ?></p>
                <p><strong>Vendedor:</strong> <?= htmlspecialchars($venta['usuario']) ?></p>

                <hr>

                <table class="ticket-table">
                    <?php foreach ($detalle as $d): ?>
                    <tr>
                        <td><?= htmlspecialchars($d['nom_producto']) ?></td>
                        <td><?= $d['cantidad'] ?> x S/. <?= number_format($d['precio_con_igv'], 2) ?></td>
                        <td>S/. <?= number_format($d['subtotal_item_con_igv'], 2) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>

                <hr>

                <p>
                    Subtotal: S/. <?= number_format($venta['subtotal'], 2) ?>
                </p>
                <p>
                    IGV (18%): S/. <?= number_format($venta['igv'], 2) ?>
                </p>
                
                <p class="ticket-total">
                    TOTAL: S/. <?= number_format($venta['total'], 2) ?>
                </p>

                <hr>

                <p class="ticket-footer">¡Gracias por su compra!</p>
            </div>
        </div>

        <div class="modal-buttons">
            <button type="button" class="btn btn-secondary" id="btnCerrarTicket">
                ✖ Cerrar
            </button>

            <button type="button" class="btn btn-success" onclick="imprimirTicket()">
                🖨 Imprimir
            </button>
        </div>

    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const modalTicket = document.getElementById("modalTicket");
    const btnCerrarTicket = document.getElementById("btnCerrarTicket");
    const btnCerrarX = document.getElementById("cerrarModalTicket");

    // Cerrar modal con botón "Cerrar"
    btnCerrarTicket.addEventListener("click", () => {
        modalTicket.classList.add("hidden");
    });

    // Cerrar modal con "X"
    btnCerrarX.addEventListener("click", () => {
        modalTicket.classList.add("hidden");
    });

    // Cerrar modal al hacer clic fuera
    modalTicket.addEventListener("click", (e) => {
        if (e.target === modalTicket) {
            modalTicket.classList.add("hidden");
        }
    });

    // Nota: La función imprimirTicket() debe estar definida en algún otro script
    // o aquí para que funcione el onclick del botón. Por ejemplo:
    /*
    window.imprimirTicket = function() {
        var content = document.getElementById('ticketContent').innerHTML;
        var printWindow = window.open('', '', 'height=600,width=400');
        printWindow.document.write('<html><head><title>Ticket de Venta</title>');
        // Si necesitas CSS para imprimir, agrégalo aquí
        printWindow.document.write('</head><body>');
        printWindow.document.write(content);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    };
    */
});
</script>