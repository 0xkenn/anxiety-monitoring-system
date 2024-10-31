@extends('layouts.student')

@section('content')
    <div class="container mt-4" style="margin-left: 180px;"> <!-- Adjust the margin-left to fit your sidebar -->
        <h4 style="margin-top: 120px;">Assessments History</h4> <!-- Add margin-top to the h2 tag -->
        <table class="table" style="margin-top: 15px;"> <!-- Optional: add margin-top to the table -->
            <thead>
                <tr>
                    <th>No</th> <!-- Add a header for the ID column -->
                    <th>Score</th>
                    <th>Status</th>
                    <th>Assessment Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($histories as $index => $history) <!-- Use $index to get the auto-incrementing ID -->
                    <tr>
                        <td>{{ $index + 1 }}</td> <!-- Display the auto-incrementing ID -->
                        <td>{{ $history->score }}</td>
                        <td>
                            <span style="
                                @if($history->status === 'Severe') color: red;
                                @elseif($history->status === 'Moderate') color: goldenrod;
                                @elseif($history->status === 'Low') color: green;
                                @endif">
                                {{ $history->status }}
                            </span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($history->assessment_date)->format('F j, Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Align the button to the right with margin-right adjustment -->
        <div class="text-right" style="margin-right: 20px;"> 
            <a href="{{ route('student.assessment') }}" class="btn btn-primary" style="margin-left: 20px;">Back to Assessment</a> <!-- Add margin-left for spacing -->
        </div>
    </div>
@endsection
