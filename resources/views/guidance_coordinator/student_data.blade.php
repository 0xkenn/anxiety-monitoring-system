@extends('layouts.coordinator')
<main>
  <div class="container">
    <div class="content text-center mb-4">
      <div class="row">
        <!-- Card for Low Anxiety -->
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
             
                <h5 class="card-title">Low Anxiety</h5>
                <h5 class="card-title">{{ $lowAnxiety->count()  }} </h5>
            
         
            </div>
          </div>
        </div>
        
        <!-- Card for Moderate Anxiety -->
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Moderate Anxiety</h5>
              <h5 class="card-title">{{ $moderateAnxiety->count() }}</h5>
            </div>
          </div>
        </div>
        
        <!-- Card for Severe Anxiety -->
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Severe Anxiety</h5>
              <h5 class="card-title">{{ $severeAnxiety->count() }}</h5>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Dropdown for chart selection -->
    <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Dropdown button
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="{{ route('student.data') }}">Student Anxiety</a>
    <a class="dropdown-item" href="{{ route('employee.data') }}">Employee Anxiety</a>
  </div>
</div>

    <div class="row">
    <!-- Chart 1 -->
    <div class="col-md-6 mb-3">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title">Student Pie Chart</h5>
                <div class="chart-container" style="height: 300px; width: 300px;">
                    <canvas id="chart" width="300" height="350"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- Chart 2 -->
    <div class="col-md-6 mb-3">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title">Student Program Graph</h5>
                <div class="chart-container" style="height: 300px; width: 300px;">
                    <canvas id="bar-chart-horizontal" width="800" height="600"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
  </div>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script type="text/javascript">
  // Student Data
  let studentLabels = {{ Js::from($studentLabels) }};
  let studentUsers = {{ Js::from($studentData) }};
    // Access programData from PHP using Js::from
let programData = {{ Js::from($programData) }};

// Extract labels (program names) and data (counts)
let programDataArray = Object.values(programData);

// Extract labels (program names) and data (counts)
let programLabels = programDataArray.map(item => item.program);  // Extract program names
let programCounts = programDataArray.map(item => item.count);   // Extract student counts
console.log(programLabels);
console.log(programCounts);

  function createChart(data, labels) {
    var total = data.reduce((a, b) => a + b, 0);
    var percentages = data.map(user => ((user / total) * 100).toFixed(0));

    var colors = [
      'rgb(255, 255, 0)', // Color for moderate Anxiety
   
      'rgb(255, 99, 132)',// Color for low Anxiety
         'rgb(255, 0, 0)',   // Color for severe Anxiety
    ];

    const chartData = {
      labels: labels,
      datasets: [{
        label: 'Anxiety Percent',
        backgroundColor: data.map((_, index) => colors[index % colors.length]),
        borderColor: data.map((_, index) => colors[index % colors.length]),
        data: percentages,
      }]
    };

    return new Chart(document.getElementById('chart'), {
      type: 'pie', // You can change this to another type if needed
      data: chartData,
      options: {
        plugins: {
          datalabels: {
            formatter: (value, context) => {
              return value + '%';
            },
            color: '#000',
            anchor: 'end',
            align: 'end',
          },
        },
      },
    });
  }

  // Initial Chart Display
  let currentChart = createChart(studentUsers, studentLabels);

new Chart(document.getElementById("bar-chart-horizontal"), {
    type: 'bar',
    data: {
        labels: programLabels,  // Dynamic labels (program names)
        datasets: [{
            label: 'Number of Students',
            data: programCounts,  // Dynamic data (counts)
            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],  // Colors for each bar
        }]
    },
    options: {
        indexAxis: 'y',  // Horizontal bar chart
        scales: {
            x: {
                beginAtZero: true,
            }
        },
        legend: { display: true },
        title: {
            display: true,
            text: 'Number of Students by Program with Highest Anxiety Status'
        }
    }
});


</script>
