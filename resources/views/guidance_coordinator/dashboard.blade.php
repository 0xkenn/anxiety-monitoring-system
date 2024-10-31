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

    <div style="height: 300px; width: 300px;">
      <canvas id="chart"></canvas>
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
  
  // Employee Data
  let employeeLabels = {{ Js::from($employeeLabels) }}; 
  let employeeUsers = {{ Js::from($employeeData) }}; 

  function createChart(data, labels) {
    var total = data.reduce((a, b) => a + b, 0);
    var percentages = data.map(user => ((user / total) * 100).toFixed(0));

    var colors = [
      'rgb(255, 255, 0)', // Color for moderate Anxiety
      'rgb(255, 0, 0)',   // Color for severe Anxiety
      'rgb(255, 99, 132)',// Color for low Anxiety
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

  // Event Listener for Dropdown
  // JavaScript Code for Switching Charts
document.getElementById('chartSelector').addEventListener('change', function() {
  // Destroy previous chart instance if it exists
  if (currentChart) {
    currentChart.destroy();
    console.log('Previous chart destroyed');
  }

  // Create a new chart based on the selected option
  switch (this.value) {
    case 'students':
      currentChart = createChart(studentUsers, studentLabels);
      console.log('Student chart created');
      break;
    case 'employees':
      currentChart = createChart(employeeUsers, employeeLabels);
      console.log('Employee chart created');
      break;
    default:
      console.error('Invalid chart type selected');
  }

  // Additional logging to help with debugging
  if (currentChart === undefined) {
    console.error('Error creating chart');
  }
});

</script>
