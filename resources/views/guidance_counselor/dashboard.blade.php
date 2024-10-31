@extends('layouts.counselor')

@section('content')
<main class="h-full overflow-y-auto" id="main-content">
    <div class="container px-6 mx-auto">
        <!-- Card Section -->
       
        <!-- Chart Selection -->


        <a href="{{ route('charts.show', ['type' => 'student']) }}" class="btn btn-primary">Student</a>
        <a href="{{ route('charts.show', ['type' => 'employee']) }}" class="btn btn-secondary">Employee</a>

        <!-- Chart Section -->
        <div class="chart-cont" id="chart-cont">
            @if($chartType === 'student')
                @include('guidance_counselor.student-chart')
            @elseif($chartType === 'employee')
                @include('guidance_counselor.employee-chart')
            @else
                @include('guidance_counselor.student-chart') <!-- Default chart -->
            @endif
        </div>
    </div>
</main>
@endsection
