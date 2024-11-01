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
            @if($chartType === 'student')
                @include('admin.chart.student-chart')
            @elseif($chartType === 'employee')
                @include('admin.chart.employee-chart')
            @else
                @include('admin.chart.student-chart') <!-- Default chart -->
            @endif
        </div>
</div>



</div>
