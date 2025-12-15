<div class="main-content">

    <!-- ENCABEZADO -->
    <div class="page-header">
        <h2>🧾 Gestión de Ventas</h2>
        <button id="btnNuevaVenta" class="btn btn-primary">
            + Nueva Venta
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
                    <th>Cliente</th>
                    <th>Vendedor</th>
                    <th>Fecha</th>
                    <th class="text-right">Total</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php if (empty($ventas)): ?>
                    <tr>
                        <td colspan="6" class="text-center">
                            No hay ventas registradas
                        </td>
                    </tr>

                <?php else: ?>
                    <?php foreach ($ventas as $v): ?>
                    <tr>

                        <td><strong>#<?= $v['id_venta'] ?></strong></td>
                        
                        <td>
                            <?= !empty($v['cliente']) ? htmlspecialchars($v['cliente']) : '<em>Cliente ocasional</em>' ?>
                        </td>

                        <td><?= htmlspecialchars($v['usuario']) ?></td>

                        <td><?= date('d/m/Y H:i', strtotime($v['fecha_venta'])) ?></td>

                        <td class="text-right">
                            <strong style="color:#27ae60;">
                                S/. <?= number_format($v['total'], 2) ?>
                            </strong>
                        </td>

                        <td class="text-center">
                            <div class="table-actions">

                                <button 
                                    class="btn btn-info btn-sm btn-detalle"
                                    data-id="<?= $v['id_venta'] ?>"
                                    title="Ver detalle"
                                >
                                    👁 Ver Detalle
                                </button>

                                <button 
                                    class="btn btn-secondary btn-sm btn-imprimir"
                                    data-id="<?= $v['id_venta'] ?>"
                                    title="Imprimir"
                                >
                                    🖨 Imprimir
                                </button>

                            <?php if ($v['estado'] === 'ACTIVA'): ?>
                                <button
                                    class="btn btn-danger btn-sm btn-anular"
                                    data-id="<?= $v['id_venta'] ?>"
                                    title="Anular venta"
                                >
                                    🗑 Anular
                                </button>
                            <?php else: ?>
                                <button
                                    class="btn btn-secondary btn-sm"
                                    disabled
                                    title="Venta ya anulada"
                                >
                                    🚫 Anulada
                                </button>
                            <?php endif; ?>

                            </div>
                        </td>

                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>

        </table>
    </div>

</div>

<!-- MODAL NUEVA VENTA -->
<?php require 'views/ventas/crear.php'; ?>

<!-- MODAL IMPRIMIR TICKET -->
<?php require 'views/ventas/imprimir.php'; ?>

<script>
document.addEventListener("DOMContentLoaded", () => {

    const modal = document.getElementById("modalVenta");
    const btnNuevo = document.getElementById("btnNuevaVenta");
    const btnCerrar = document.getElementById("cerrarModalVenta");

    const formVenta = document.getElementById("formVenta");

    /* ==================================================
       🟩 NUEVA VENTA
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
                "<?= base_url ?>ventas/detalle/" + btn.dataset.id;
        });

    });

    /* ==================================================
       🖨 IMPRIMIR - CARGAR EN MODAL
    ================================================== */
    document.querySelectorAll(".btn-imprimir").forEach(btn => {

        btn.addEventListener("click", () => {
            const idVenta = btn.dataset.id;
            cargarTicketModal(idVenta);
        });

    });

    /* ==================================================
       🗑 ANULAR VENTA
    ================================================== */
    document.querySelectorAll(".btn-anular").forEach(btn => {
        btn.addEventListener("click", () => {

            modalConfirm("¿Está seguro de anular esta venta?", () => {
                window.location.href =
                    "<?= base_url ?>ventas/anular/" + btn.dataset.id;
            });

        });
    });
});

/* ==================================================
   📄 FUNCIÓN PARA CARGAR TICKET EN MODAL
================================================== */
function cargarTicketModal(idVenta) {
    const modal = document.getElementById("modalTicket");
    const ticketContent = document.getElementById("ticketContent");
    
    // Mostrar modal con loading
    modal.classList.remove("hidden");
    ticketContent.innerHTML = '<div style="text-align:center; padding:40px;"><p style="font-size:16px;">⏳ Cargando ticket...</p></div>';
    
    // Hacer petición AJAX para obtener el HTML del ticket
    fetch("<?= base_url ?>ventas/imprimir/" + idVenta)
        .then(response => response.text())
        .then(html => {
            // Extraer solo el contenido del ticket (sin layout)
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const ticketDiv = doc.querySelector('.ticket');
            
            if (ticketDiv) {
                ticketContent.innerHTML = ticketDiv.outerHTML;
            } else {
                ticketContent.innerHTML = html;
            }
        })
        .catch(error => {
            ticketContent.innerHTML = '<p style="text-align:center; color:red; padding:20px;">❌ Error al cargar el ticket</p>';
            console.error('Error:', error);
        });
}

/* ==================================================
   🖨 FUNCIÓN PARA IMPRIMIR EL TICKET
================================================== */
function imprimirTicket() {
    const contenido = document.getElementById("ticketContent").innerHTML;
    const ventana = window.open('', '', 'width=400,height=600');
    
    ventana.document.write(`
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Ticket de Venta</title>
            <link rel="stylesheet" href="<?= base_url ?>assets/css/ticket-styles.css">
        </head>
        <body onload="window.print(); window.close();">
            ${contenido}
        </body>
        </html>
    `);
    
    ventana.document.close();
}
</script>