<div id="modalCompra" class="modal-overlay hidden">
    <div class="modal-box modal-large">
        
        <div class="modal-header">
            <h3>Nueva Compra</h3>
            <button type="button" class="modal-close" id="cerrarModalCompra">
                <span>✕</span>
            </button>
        </div>

        <form id="formCompra" method="POST" action="<?= base_url ?>compras/registrar">

            <div class="form-group">
                <label>Proveedor *</label>
                <select name="id_proveedor" id="id_proveedor" class="form-control" required>
                    <option value="">-- Seleccionar proveedor --</option>
                    <?php foreach ($proveedores as $p): ?>
                        <option value="<?= $p['id_proveedor'] ?>">
                            <?= htmlspecialchars($p['nombre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <hr>

            <h4>🧩 Productos</h4>

            <div class="form-row">
                <div class="form-group">
                    <label>Producto</label>
                    <select id="productoSelect" class="form-control">
                        <?php foreach ($productos as $p): ?>
                            <option 
                                value="<?= $p['id_producto'] ?>"
                                data-nombre="<?= htmlspecialchars($p['nombre']) ?>"
                                data-precio="<?= $p['precio'] ?>"
                            >
                                <?= htmlspecialchars($p['nombre']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Cantidad</label>
                    <input type="number" id="cantidadInput" min="1" class="form-control" value="1">
                </div>

                <div class="form-group">
                    <label>Precio (C/IGV)</label>
                    <input type="number" id="precioInput" min="0.1" step="0.10" class="form-control" value="1.00">
                </div>

                <div class="form-group">
                    <button type="button" id="btnAgregarProducto" class="btn btn-success" style="margin-top: 27px;">
                        + Agregar
                    </button>
                </div>
            </div>

            <table class="table table-striped" id="tablaDetalle">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio (C/IGV)</th>
                        <th>Subtotal (C/IGV)</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody></tbody>
                
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-right"><strong>Subtotal:</strong></td>
                        <td colspan="2" id="subtotalMuestra" style="font-weight:bold; color:#34495e;">
                            S/. 0.00
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="3" class="text-right"><strong>IGV (18%):</strong></td>
                        <td colspan="2" id="igvMuestra" style="font-weight:bold; color:#e67e22;">
                            S/. 0.00
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="3" class="text-right"><strong>Total a Pagar:</strong></td>
                        <td colspan="2" id="totalConIgvMuestra" style="font-weight:bold; font-size: 1.2em; color:#27ae60;">
                            S/. 0.00
                        </td>
                    </tr>
                </tfoot>
                </table>
            
            <input type="hidden" name="subtotal_compra" id="subtotalCompra" value="0.00">
            <input type="hidden" name="igv_compra" id="igvCompra" value="0.00">
            <input type="hidden" name="total_con_igv_compra" id="totalConIgvCompra" value="0.00">

            <div class="modal-buttons">
                <button type="submit" class="btn btn-primary">
                    💾 Registrar Compra
                </button>

                <button type="button" class="btn btn-secondary"
                    onclick="document.getElementById('cerrarModalCompra').click()">
                    ✖ Cancelar
                </button>
            </div>

        </form>
    </div>
</div>

<link rel="stylesheet" href="<?= base_url ?>assets/css/modal.css">
<script src="<?= base_url ?>assets/script/modal.js"></script>

<script>
document.addEventListener("DOMContentLoaded", () => {

    // 1. Elementos DOM
    const tabla = document.querySelector("#tablaDetalle tbody");
    const selProd = document.getElementById("productoSelect");
    const precioInput = document.getElementById("precioInput");
    
    // Elementos VISIBLES para mostrar el cálculo en el pie de tabla (<tfoot>)
    const subtotalDisplay = document.getElementById("subtotalMuestra");
    const igvDisplay = document.getElementById("igvMuestra");
    const totalConIgvDisplay = document.getElementById("totalConIgvMuestra"); 

    // Campos OCULTOS para enviar el cálculo final al servidor (inputs hidden)
    const subtotalInput = document.getElementById("subtotalCompra");
    const igvInput = document.getElementById("igvCompra");
    const totalConIgvInput = document.getElementById("totalConIgvCompra");

    // 2. Constantes de Cálculo
    const TASA_IGV = 0.18; 
    const FACTOR_IGV = 1 + TASA_IGV; // 1.18

    // 👉 Cargar el precio del primer producto al abrir (función OK)
    function cargarPrecioInicial() {
        // Solo ejecuta si el select tiene opciones
        if (selProd && selProd.options.length > 0) {
            const option = selProd.options[selProd.selectedIndex];
            if (option && option.dataset.precio) {
                precioInput.value = parseFloat(option.dataset.precio).toFixed(2);
            }
        }
    }
    cargarPrecioInicial();

    // 👉 Evento: Cuando cambie el producto (función OK)
    selProd.addEventListener("change", () => {
        const option = selProd.options[selProd.selectedIndex];
        // Validar que exista el precio
        if (option && option.dataset.precio) {
            const precio = parseFloat(option.dataset.precio);
            precioInput.value = precio.toFixed(2);
        }
    });

    /**
     * Calcula el subtotal, IGV y total de la compra basado en las filas de la tabla.
     */
    function actualizarTotal() {
        let totalBrutoConIgv = 0; // Acumulador del total de items CON IGV

        // 1. Sumar todos los subtotales CON IGV de las filas
        tabla.querySelectorAll("tr").forEach(tr => {
            // Utilizamos el dataset 'subtotalconigv'
            totalBrutoConIgv += parseFloat(tr.dataset.subtotalconigv || 0); 
        });

        // 2. Realizar los cálculos:
        const totalConIgv = totalBrutoConIgv;
        
        // Subtotal (sin IGV): Total Bruto / 1.18
        const subtotal = totalConIgv / FACTOR_IGV; 
        
        // Monto del IGV: Total Bruto - Subtotal
        const igvMonto = totalConIgv - subtotal; 

        // 3. Actualizar la interfaz VISIBLE (Pie de tabla)
        // Solo actualiza si los elementos existen (después de la corrección HTML)
        if (subtotalDisplay) subtotalDisplay.textContent = "S/. " + subtotal.toFixed(2);
        if (igvDisplay) igvDisplay.textContent = "S/. " + igvMonto.toFixed(2);
        if (totalConIgvDisplay) totalConIgvDisplay.textContent = "S/. " + totalConIgv.toFixed(2);

        // 4. Actualizar los campos OCULTOS (Para enviar los datos al servidor)
        if (subtotalInput) subtotalInput.value = subtotal.toFixed(2);
        if (igvInput) igvInput.value = igvMonto.toFixed(2);
        if (totalConIgvInput) totalConIgvInput.value = totalConIgv.toFixed(2); 
    }

    // Agregar producto
    let index = 0;

    document.getElementById("btnAgregarProducto").addEventListener("click", () => {
        
        // Validar que el select tenga un producto seleccionado
        if (!selProd.value) {
            alert("Debe seleccionar un producto.");
            return;
        }

        const id = selProd.value;
        const nombre = selProd.options[selProd.selectedIndex].dataset.nombre;
        const cantidad = parseFloat(document.getElementById("cantidadInput").value);
        const precio = parseFloat(document.getElementById("precioInput").value);
        
        if (cantidad <= 0 || precio <= 0) {
            alert("La cantidad y el precio deben ser mayores a cero.");
            return;
        }
        
        const subtotalConIgv = cantidad * precio;

        // Crear una nueva fila
        const tr = document.createElement("tr");
        tr.dataset.subtotalconigv = subtotalConIgv; 

        tr.innerHTML = `
            <td>${nombre}<input type="hidden" name="productos[${index}][id_producto]" value="${id}"></td>
            <td>${cantidad}<input type="hidden" name="productos[${index}][cantidad]" value="${cantidad}"></td>
            <td>S/. ${precio.toFixed(2)}<input type="hidden" name="productos[${index}][precio]" value="${precio.toFixed(2)}"></td>
            <td><strong>S/. ${subtotalConIgv.toFixed(2)}</strong></td>
            <td><button type="button" class="btn btn-danger btn-sm btn-remove">🗑</button></td>
        `;
        // Nota: Aseguré que el precio hidden se guarde con 2 decimales.

        // Aumentamos el índice para el siguiente producto
        index++;  

        tr.querySelector(".btn-remove").addEventListener("click", () => {
            tr.remove();
            actualizarTotal();
        });

        tabla.appendChild(tr);
        actualizarTotal();
    });
});
</script>