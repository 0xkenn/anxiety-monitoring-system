@extends('layouts.admin')

<div class="container" style="margin:100px 0px 0px 200px;" >
     <a href="{{ route('admin.charts.show', ['type' => 'student']) }}" class="btn btn-primary">Student</a>
        <a href="{{ route('admin.charts.show', ['type' => 'employee']) }}" class="btn btn-secondary">Employee</a>
    <div class="row mb-4" style="display: flex; justify-content: flex-end;"> <!-- Changed to flex-end -->
    <!-- Card 1 -->
  
</div>

<div class="row">
    <!-- Chart 1 -->
   
   <div class="chart-cont" id="chart-cont">
            @if($chartType === 'employee')
                @include('admin.chart.student-chart')
            @elseif($chartType === 'employee')
                @include('admin.chart.employee-chart')
            @else
                @include('admin.chart.student-chart') <!-- Default chart -->
            @endif
        </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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


</div>
