<div class="row mb-4" style="display: flex; justify-content: flex-end;"> <!-- Changed to flex-end -->
    <!-- Card 1 -->
    <div class="col-md-2 mb-1" style="padding-right: 1.5px;">
        <div class="card shadow" style="padding: 5px; display: flex; align-items: center; justify-content: flex-start; border-radius: 8px;">
            <div class="card-body" style="display: flex; align-items: center; padding: 5px; font-size: 12px;">
                <i class="fas fa-users text-danger" style="font-size: 1.2rem; margin-right: 5px;"></i>
                <div>
                    <h5 class="card-title" style="font-size: 0.9rem; margin: 0;">Severe</h5>
                    <p class="card-text" style="font-size: 0.8rem; margin: 0;">{{ $severeStudent }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 2 -->
    <div class="col-md-2 mb-1" style="padding-right: 1.5px;">
        <div class="card shadow" style="padding: 5px; display: flex; align-items: center; justify-content: flex-start; border-radius: 8px;">
            <div class="card-body" style="display: flex; align-items: center; padding: 5px; font-size: 12px;">
                <i class="fas fa-users text-warning" style="font-size: 1.2rem; margin-right: 5px;"></i>
                <div>
                    <h5 class="card-title" style="font-size: 0.9rem; margin: 0;">Moderate</h5>
                    <p class="card-text" style="font-size: 0.8rem; margin: 0;">{{ $moderateStudent }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 3 -->
    <div class="col-md-2 mb-1" style="padding-right: 1.5px;">
        <div class="card shadow" style="padding: 5px; display: flex; align-items: center; justify-content: flex-start; border-radius: 8px;">
            <div class="card-body" style="display: flex; align-items: left; padding: 5px; font-size: 12px;">
                <i class="fas fa-users text-success" style="font-size: 1.2rem; margin-right: 5px;"></i>
                <div>
                    <h5 class="card-title" style="font-size: 0.9rem; margin: 0;">Low</h5>
                    <p class="card-text" style="font-size: 0.8rem; margin: 0;">{{ $lowStudent }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Chart 1 -->
    <div class="col-md-6 mb-3">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title">Student Pie Chart</h5>
                <div class="chart-container" style="height: 300px; width: 300px;">
                    <canvas id="pie-chart" width="300" height="350"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- Chart 2 -->
    <div class="col-md-6 mb-3">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title">Student School Graph</h5>
                <div class="chart-container" style="height: 300px; width: 300px;">
                    <canvas id="bar-chart-horizontal" width="800" height="600"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
<script>
    let Sdata = {{ Js::from($studentData) }};
    let chartData = {{ Js::from($chartData) }};
    
    // Pie Chart
    new Chart(document.getElementById("pie-chart"), {
        type: 'pie',
        data: Sdata,
        options: {
            title: {
                display: true,
                text: 'Anxiety of Students'
            }
        }
    });

    // Horizontal Bar Chart
    new Chart(document.getElementById("bar-chart-horizontal"), {
        type: 'bar',
        data: {
            labels: chartData.labels,
            datasets: [{
                label: chartData.datasets[0].label,
                data: chartData.datasets[0].data,
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
            }]
        },
        options: {
            indexAxis: 'y', 
            legend: { display: false },
            title: {
                display: true,
                text: 'Predicted world population (millions) in 2050'
            }
        }
    });
</script>
