<div id="modalVenta" class="modal-overlay hidden">
    <div class="modal-box modal-large">
        
        <div class="modal-header">
            <h3>🧾 Nueva Venta</h3>
            <button type="button" class="modal-close" id="cerrarModalVenta">
                <span>✕</span>
            </button>
        </div>

        <form id="formVenta" method="POST" action="<?= base_url ?>ventas/registrar">

            <div class="form-group">
                <label>Cliente</label>
                <select name="id_cliente" id="id_cliente" class="form-control">
                    <option value="">-- Cliente ocasional --</option>
                    <?php 
                    // Asegúrate de que $clientes esté disponible desde el Controller
                    foreach ($clientes as $c): 
                    ?>
                        <option value="<?= $c['id_cliente'] ?>">
                            <?= htmlspecialchars($c['nombres'] . ' ' . $c['apellidos']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <hr>

            <h4>🧩 Productos</h4>

            <div class="form-row">
                <div class="form-group">
                    <label>Producto</label>
                    <select id="productoSelect" class="form-control" required>
                        <option value="">-- Seleccione un producto --</option>
                        <?php 
                        // Asegúrate de que $productos esté disponible desde el Controller
                        foreach ($productos as $p): 
                        ?>
                            <option 
                                value="<?= $p['id_producto'] ?>"
                                data-nombre="<?= htmlspecialchars($p['nombre']) ?>"
                                data-precio="<?= $p['precio'] ?>"
                                data-stock="<?= $p['stock'] ?>"
                            >
                                <?= htmlspecialchars($p['nombre']) ?> (Stock: <?= $p['stock'] ?>)
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
                    <input type="number" id="precioInput" min="0.1" step="0.01" class="form-control" value="0.00"> 
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

                <tbody>
                    </tbody>
                
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-right"><strong>Subtotal (S/IGV):</strong></td>
                        <td colspan="2" id="subtotalVentaMuestra" style="font-weight:bold; color:#34495e;">
                            S/. 0.00
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="3" class="text-right"><strong>IGV (18%):</strong></td>
                        <td colspan="2" id="igvVentaMuestra" style="font-weight:bold; color:#e67e22;">
                            S/. 0.00
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="3" class="text-right"><strong>Total a Pagar:</strong></td>
                        <td colspan="2" id="totalVentaMuestra" style="font-weight:bold; font-size: 1.2em; color:#27ae60;">
                            S/. 0.00
                        </td>
                    </tr>
                </tfoot>

            </table>
            
            <div class="modal-buttons">
                <button type="button" class="btn btn-secondary"
                    onclick="document.getElementById('cerrarModalVenta').click()">
                    ✖ Cancelar
                </button>

                <button type="submit" class="btn btn-primary">
                    💾 Registrar Venta
                </button>
            </div>

        </form>
    </div>
</div>

<link rel="stylesheet" href="<?= base_url ?>assets/css/modal.css">
<script src="<?= base_url ?>assets/script/modal.js"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {

    const formVenta = document.getElementById("formVenta"); 
    const tablaDetalleBody = document.querySelector("#tablaDetalle tbody");
    const selProd = document.getElementById("productoSelect");
    const precioInput = document.getElementById("precioInput");
    const cantidadInput = document.getElementById("cantidadInput");

    // Elementos VISIBLES para mostrar el cálculo en el pie de tabla (<tfoot>)
    const subtotalDisplay = document.getElementById("subtotalVentaMuestra");
    const igvDisplay = document.getElementById("igvVentaMuestra");
    const totalConIgvDisplay = document.getElementById("totalVentaMuestra"); 

    // Constantes de Cálculo (deben coincidir con el Trigger de MySQL)
    const TASA_IGV = 0.18; 
    const FACTOR_IGV = 1 + TASA_IGV; // 1.18


    // 👉 Cargar el precio del producto seleccionado
    function cargarPrecio() {
        if (selProd.options.length > 0) { 
            const option = selProd.options[selProd.selectedIndex];
            if (option && option.value) {
                const precio = parseFloat(option.dataset.precio || 0); 
                precioInput.value = precio.toFixed(2);
            } else {
                 precioInput.value = '0.00';
            }
        }
    }
    cargarPrecio(); // Carga inicial

    // 👉 Cuando cambie el producto
    selProd.addEventListener("change", () => {
        cargarPrecio();
        // Reset cantidad al cambiar de producto
        cantidadInput.value = 1; 
    });

    /**
     * Calcula el subtotal, IGV y total de la venta basado en las filas de la tabla.
     */
    function actualizarTotal() {
        let totalBrutoConIgv = 0; // Acumulador del total de items CON IGV

        // 1. Sumar todos los subtotales CON IGV de las filas
        tablaDetalleBody.querySelectorAll("tr").forEach(tr => {
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
        subtotalDisplay.textContent = "S/. " + subtotal.toFixed(2);
        igvDisplay.textContent = "S/. " + igvMonto.toFixed(2);
        totalConIgvDisplay.textContent = "S/. " + totalConIgv.toFixed(2);
    }


    // Agregar producto
    let index = 0; // Contador para generar índices únicos en los arrays de PHP

    document.getElementById("btnAgregarProducto").addEventListener("click", () => {
        const id = selProd.value;
        
        if (!id) {
            // Asumo que tienes una función modalAlert o similar
            modalAlert("Mensaje Venta","Seleccione un producto válido."); 
            return;
        }

        const option = selProd.options[selProd.selectedIndex];
        const nombre = option.dataset.nombre;
        const stock = parseInt(option.dataset.stock || 0);
        const cantidad = parseFloat(cantidadInput.value);
        const precio = parseFloat(precioInput.value); // Precio CON IGV

        // Validaciones
        if (isNaN(cantidad) || cantidad <= 0 || isNaN(precio) || precio <= 0) {
            modalAlert("Mensaje Venta","La cantidad y el precio deben ser valores válidos y positivos.");
            return;
        }
        if (cantidad > stock) {
            modalAlert("Mensaje Venta",`Stock insuficiente. Disponible: ${stock}`);
            return;
        }
        
        const subtotalConIgv = cantidad * precio;

        // Crear una nueva fila de detalle en la tabla
        const tr = document.createElement("tr");
        // Almacenamos el subtotal CON IGV en el dataset
        tr.dataset.subtotalconigv = subtotalConIgv; 

        // Utilizamos el índice para que los datos sean enviados como un array en PHP
        tr.innerHTML = `
            <td>${nombre}<input type="hidden" name="productos[${index}][id_producto]" value="${id}"></td>
            <td>${cantidad}<input type="hidden" name="productos[${index}][cantidad]" value="${cantidad}"></td>
            <td>S/. ${precio.toFixed(2)}<input type="hidden" name="productos[${index}][precio]" value="${precio}"></td>
            <td><strong>S/. ${subtotalConIgv.toFixed(2)}</strong></td>
            <td><button type="button" class="btn btn-danger btn-sm btn-remove">🗑</button></td>
        `;

        index++;

        tr.querySelector(".btn-remove").addEventListener("click", () => {
            tr.remove();
            actualizarTotal();
        });

        tablaDetalleBody.appendChild(tr);
        actualizarTotal();

        // Reset cantidad
        cantidadInput.value = 1;
    });

    // ====================================================================
    // 💥 VALIDACIÓN FINAL AL ENVIAR
    // ====================================================================

    formVenta.addEventListener("submit", function (event) {
        
        event.preventDefault(); 
        
        // 1. VALIDACIÓN: ¿Hay productos en la tabla?
        if (tablaDetalleBody.children.length === 0) {
            modalAlert("Mensaje Venta","Debe agregar al menos un producto para registrar la venta.");
            return; 
        }

        // 2. Si la validación pasa, enviar el formulario
        this.submit(); 
    });
    
    // 💡 Mejora: Añadir un listener para actualizar los precios si el foco deja el campo
    precioInput.addEventListener('change', (e) => {
        // Asegura que el formato sea de dos decimales
        e.target.value = parseFloat(e.target.value || 0).toFixed(2);
    });

});
</script>