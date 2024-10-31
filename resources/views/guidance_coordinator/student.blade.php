@extends('layouts.coordinator')

<div class="container" style="margin-top: 80px; margin-left: 200px; max-width: 100%; font-family: 'Poppins', sans-serif; font-size: 12px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3>Student List</h3>
        <input type="text" class="form-control" placeholder="Search..." style="width:180px; margin-right:250px;">
    </div>

    <div style="width: 100%;">
        <div style="overflow-x: auto;"> <!-- Make table responsive -->
            <table class="table table-bordered" style="width: 80%; table-layout: auto; border-collapse: collapse; font-family: 'Poppins', sans-serif; font-size: 12px;margin-left:50px;">
                <thead class="thead-light">
                    <tr>
                        <th style="padding: 8px; border: 1px solid #dee2e6;">ID</th>
                        <th style="padding: 8px; border: 1px solid #dee2e6;">User ID</th>
                        <th style="padding: 8px; border: 1px solid #dee2e6; width: 15%;">Student Name</th> <!-- Adjusted padding and width -->
                        <th style="padding: 4px; border: 1px solid #dee2e6; width: 60px; text-align: center;">Sex</th> <!-- Reduced width and padding -->
                        <th style="padding: 8px; border: 1px solid #dee2e6;">Program</th>
                        <th style="padding: 8px; border: 1px solid #dee2e6;">Score</th>
                        <th style="padding: 8px; border: 1px solid #dee2e6;">Status</th>
                        <th style="padding: 8px; border: 1px solid #dee2e6;">Mobile Number</th>
                        <th style="padding: 8px; border: 1px solid #dee2e6;">Email</th>
                    </tr>
                </thead>
                <tbody id="studentTableBody">
                    @foreach ($students as $student)
                    <tr>
                        <td style="word-wrap: break-word; white-space: normal; padding: 8px; border: 1px solid #dee2e6;">{{ $loop->iteration }}</td> <!-- Auto-incrementing ID -->
                        <td style="word-wrap: break-word; white-space: normal; padding: 8px; border: 1px solid #dee2e6;">{{ $student->user_id }}</td>
                        <td style="word-wrap: break-word; white-space: normal; padding: 8px; border: 1px solid #dee2e6;">{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}</td>
                        <td style="word-wrap: break-word; white-space: normal; padding: 4px; border: 1px solid #dee2e6; text-align: center;">{{ $student->sex }}</td>
                        <td style="word-wrap: break-word; white-space: normal; padding: 8px; border: 1px solid #dee2e6;">{{ $student->program->abbrev ?? "Not Assigned" }}</td>
                        
                        @if ($student->questions->isNotEmpty())
                        @foreach ($student->questions as $question)
                            <td style="word-wrap: break-word; white-space: normal; padding: 8px; border: 1px solid #dee2e6;">{{ $question->score }}</td>
                            <td style="word-wrap: break-word; white-space: normal; padding: 8px; border: 1px solid #dee2e6; color: {{ $question->status == 'Severe' ? 'red' : ($question->status == 'Moderate' ? 'gold' : 'green') }};">
                                {{ $question->status }}
                            </td>
                        @endforeach
                        @else
                            <td style="word-wrap: break-word; white-space: normal; padding: 8px; border: 1px solid #dee2e6;">N/A</td>
                            <td style="word-wrap: break-word; white-space: normal; padding: 8px; border: 1px solid #dee2e6; color: green;">N/A</td>
                        @endif
                        
                        <td style="word-wrap: break-word; white-space: normal; padding: 8px; border: 1px solid #dee2e6;">{{ $student->mobile_number }}</td>
                        <td style="word-wrap: break-word; white-space: normal; padding: 8px; border: 1px solid #dee2e6;">{{ $student->email }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div> <!-- End of .table-responsive -->
    </div> 
</div>
