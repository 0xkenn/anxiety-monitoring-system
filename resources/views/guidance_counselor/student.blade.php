@extends('layouts.counselor')

<div class="container" style="margin-top: 80px; margin-left: 200px; max-width: 100%; font-family: 'Poppins', sans-serif; font-size: 12px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;"> 
        <h3 style="margin-left:100px;">Student List</h3>
        <input type="text" class="form-control" placeholder="Search..." style="width:180px; margin-right:250px;">
    </div>

    <div style="width: 100%;">
        <div style="overflow-x: auto;"> <!-- Make table responsive -->
            <table class="table table-bordered" style="width: 80%; table-layout: auto; border-collapse: collapse; font-family: 'Poppins', sans-serif; font-size: 12px;margin-left:50px;">
                <thead class="thead-light">
                    <tr>
                        <th style="padding: 8px; border: 1px solid #dee2e6;">ID</th>
                        <th style="padding: 8px; border: 1px solid #dee2e6;">User ID</th>
                        <th style="padding: 8px; border: 1px solid #dee2e6; ">Student Name</th> <!-- Adjusted padding and width -->
                        <th style="padding: 4px; border: 1px solid #dee2e6;text-align: center;">Sex</th> <!-- Reduced width and padding -->
                        <th style="padding: 8px; border: 1px solid #dee2e6;">School</th> <!-- Changed from Program to School -->
                        <th style="padding: 8px; border: 1px solid #dee2e6;">Score</th>
                        <th style="padding: 8px; border: 1px solid #dee2e6;">Status</th>
                        <th style="padding: 8px; border: 1px solid #dee2e6;">Mobile Number</th>
                        <th style="padding: 8px; border: 1px solid #dee2e6;">Email</th>
                    </tr>
                </thead>
                <tbody id="studentTableBody">
                   @foreach ($students as $student)
    <tr>
        <td style="word-wrap: break-word; white-space: normal; padding: 8px; border: 1px solid #dee2e6; width: 5%;">{{ $loop->iteration }}</td>
        <td style="word-wrap: break-word; white-space: normal; padding: 8px; border: 1px solid #dee2e6; width: 8%;">{{ $student->user_id }}</td>
<!-- Student Name Cell -->
<td style="word-wrap: break-word; white-space: normal; padding: 8px; border: 1px solid #dee2e6; width: 20%;" 
    data-toggle="modal" 
    data-target="#studentModal"
    onclick="populateModal('{{ $student->first_name }}', '{{ $student->middle_name }}', '{{ $student->last_name }}', {{ $student->student_id }})">
    {{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}
</td>





        <td style="word-wrap: break-word; white-space: normal; padding: 4px; border: 1px solid #dee2e6; text-align: center; width: 5%;">{{ $student->sex }}</td>
        <td style="padding: 10px; border: 1px solid #dee2e6; width: 10%;">{{ $student->school->abbrev }}</td>
        
        <!-- Consolidate question scores and statuses into single cells -->
        <td style="word-wrap: break-word; white-space: normal; padding: 8px; border: 1px solid #dee2e6; width: 10%;">
            @if ($student->questions->isNotEmpty())
                {!! $student->questions->pluck('score')->implode('<hr>') !!} 
            @else
                N/A
            @endif
        </td>
       <td style="word-wrap: break-word; white-space: normal; padding: 8px; border: 1px solid #dee2e6; width: 10%; color: 
    {{ $student->questions->pluck('status')->contains('Severe') ? 'red' : ($student->questions->pluck('status')->contains('Moderate') ? 'gold' : 'green') }};">
    @if ($student->questions->isNotEmpty())
        {!! $student->questions->pluck('status')->implode('<hr>') !!} 
    @else
        N/A
    @endif
</td>

        
        <td style="word-wrap: break-word; white-space: normal; padding: 8px; border: 1px solid #dee2e6; width: 10%;">{{ $student->mobile_number }}</td>
        <td style="word-wrap: break-word; white-space: normal; padding: 8px; border: 1px solid #dee2e6; width: 15%;">{{ $student->email }}</td>
    </tr>
@endforeach

                </tbody>
            </table>
        </div> <!-- End of .table-responsive -->
    </div> 
</div>
<!-- Modal Structure -->
<div class="modal fade" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="studentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="studentModalLabel">Student Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="studentName"></p>
                <canvas id="bar-chart"></canvas>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Script to Populate Modal -->
<script>
    function populateModal(firstName, middleName, lastName) {
        const fullName = `${firstName} ${middleName ? middleName + ' ' : ''}${lastName}`;
        document.getElementById('studentName').innerText = fullName;
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
<!-- HTML: JavaScript for Modal Interaction -->
<script>
    // Function to open the modal and load student data
    function populateModal(firstName, middleName, lastName, studentId) {
    console.log("Student ID:", studentId);  // Debugging output
    const fullName = `${firstName} ${middleName ? middleName + ' ' : ''}${lastName}`;
    document.getElementById('studentName').innerText = fullName;

    // Fetch student scores and statuses using Fetch API
    fetch('http://127.0.0.1:8000/student-scores/4')
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    return response.json(); // Parse the JSON response
  })
  .then(data => {
    console.log(data); // Process the data
  })
  .catch(error => {
    console.error('There was a problem with the fetch operation:', error);
  });

}


    // Function to update the chart with new data
    function updateChart(data) {
        // Prepare scores and statuses for the chart
        const scores = data.map(item => parseInt(item.score));
        const statuses = data.map(item => item.status);
        const colors = statuses.map(status => {
            if (status === 'Severe') return 'red';
            if (status === 'Low') return 'green';
            return 'orange';
        });

        // Clear the old chart if it exists
        if (window.studentChart) {
            window.studentChart.destroy();
        }

        // Create a new bar chart with the updated data
        const ctx = document.getElementById('bar-chart').getContext('2d');
        window.studentChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: Array.from({ length: scores.length }, (_, i) => `Record ${i + 1}`),
                datasets: [{
                    label: 'Score',
                    data: scores,
                    backgroundColor: colors
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
</script>
