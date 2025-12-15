<div class="main-content">
    <div class="title">Cuadro de Mando</div>

    <div class="cards-grid">

        <div class="card card-income-today">
            <div>
                <div class="card-label">Ingresos - Hoy</div>
                <div class="card-value">S/. <?= number_format($ingresosHoy, 2) ?></div>
            </div>
            <button class="card-button">➕ Añadir Depósito</button>
        </div>

        <div class="card card-expense-today">
            <div>
                <div class="card-label">Gastos - Hoy</div>
                <div class="card-value">S/. <?= number_format($gastosHoy, 2) ?></div>
            </div>
            <button class="card-button">➕ Añadir Gasto</button>
        </div>

        <div class="card card-income-month">
            <div>
                <div class="card-label">Ingresos este Mes</div>
                <div class="card-value">S/. <?= number_format($ingresosMes, 2) ?></div>
            </div>
            <button class="card-button">➕ Ver detalles</button>
        </div>

        <div class="card card-expense-month">
            <div>
                <div class="card-label">Gastos este Mes</div>
                <div class="card-value">S/. <?= number_format($gastosMes, 2) ?></div>
            </div>
            <button class="card-button">➕ Ver detalles</button>
        </div>

    </div>


    <!-- ======================= -->
    <!-- GRÁFICO PRINCIPAL -->
    <!-- ======================= -->
    <div class="chart-section">

        <div class="chart-header">
            <div class="chart-title" id="tituloGrafico">
                Ingresos & Gastos - Últimos 30 días
            </div>

            <select id="selectorRango" class="select-rango">
                <option value="7">Últimos 7 días</option>
                <option value="30" selected>Últimos 30 días</option>
                <option value="90">Últimos 90 días</option>
                <option value="365">Último año</option>
            </select>
        </div>

        <div class="chart-container">
            <canvas id="myChart"></canvas>
        </div>

    </div>


    <!-- ======================= -->
    <!-- BENEFICIO NETO -->
    <!-- ======================= -->
    <div class="chart-section">
        <div class="chart-title">Beneficio Neto & Balances</div>

        <div style="margin-top: 20px; padding: 20px; background-color: #f8f9fa; border-radius: 4px;">
            <div style="margin-bottom: 15px;">
                <div style="font-size: 14px; color: #7f8c8d;">Beneficio Neto</div>
                <div style="font-size: 24px; font-weight: bold; color: #27ae60;">
                    S/. <?= number_format($beneficio, 2) ?>
                </div>
            </div>

            <div>
                <div style="font-size: 14px; color: #7f8c8d;">Balance Total</div>
                <div style="font-size: 24px; font-weight: bold; color: #3498db;">
                    S/. <?= number_format($balance, 2) ?>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- ============================= -->
<!-- SCRIPT DEL GRÁFICO (AJAX) -->
<!-- ============================= -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

document.addEventListener("DOMContentLoaded", () => {

    let chart;

    function crearGrafico(labels, ingresos, gastos) {

        const ctx = document.getElementById('myChart');

        if (chart) chart.destroy();

        chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Ingresos',
                        data: ingresos,
                        borderColor: '#27ae60',
                        backgroundColor: 'rgba(39, 174, 96, 0.3)',
                        fill: true,
                        tension: 0.3
                    },
                    {
                        label: 'Gastos',
                        data: gastos,
                        borderColor: '#e74c3c',
                        backgroundColor: 'rgba(231, 76, 60, 0.25)',
                        fill: true,
                        tension: 0.3
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }

    // Gráfico inicial
    crearGrafico(<?= $fechas ?>, <?= $ingresos ?>, <?= $gastos ?>);

    // AJAX manual
    document.getElementById("selectorRango").addEventListener("change", function() {

        const rango = this.value;
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "<?= base_url ?>Dashboard/ajax_rango?rango=" + rango);

        xhr.onload = function() {

            try {
                const data = JSON.parse(xhr.responseText);

                // Cambiar título del gráfico
                let texto = "Últimos " + rango + " días";
                if (rango == 365) texto = "Último año";

                document.getElementById("tituloGrafico").innerText =
                    "Ingresos & Gastos - " + texto;

                // Actualizar gráfico
                crearGrafico(data.fechas, data.ingresos, data.gastos);

            } catch(e) {
                console.error("Error parsing JSON:", xhr.responseText);
            }
        };

        xhr.send();
    });

});

</script>
