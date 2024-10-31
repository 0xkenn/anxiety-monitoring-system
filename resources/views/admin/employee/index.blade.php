@extends('layouts.admin')

@section('content')
<div class="table-container" style="margin-top: 100px; padding-left: 200px; font-family: 'Poppins', sans-serif; font-size: 12px;">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h2>All Employees</h2>
        <input type="text" placeholder="Search employees..." style="padding: 5px; font-size: 12px; border: 1px solid #dee2e6; border-radius: 5px; width: 200px;">
    </div>

    <table class="employee-table" style="width: 100%; border-collapse: collapse; margin-top: 20px; margin-left: 20px;">
        <thead>
            <tr>
                <th style="padding: 10px; border: 1px solid #dee2e6;">No.</th> <!-- New column for employee count -->
                <th style="padding: 10px; border: 1px solid #dee2e6;">First Name</th>
                <th style="padding: 10px; border: 1px solid #dee2e6;">Last Name</th>
                <th style="padding: 10px; border: 1px solid #dee2e6;">Middle Name</th>
                <th style="padding: 10px; border: 1px solid #dee2e6;">Email</th>
                <th style="padding: 10px; border: 1px solid #dee2e6;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td style="padding: 10px; border: 1px solid #dee2e6;">{{ $loop->iteration }}</td> <!-- Row count using loop iteration -->
                    <td style="padding: 10px; border: 1px solid #dee2e6;">{{ $employee->first_name }}</td>
                    <td style="padding: 10px; border: 1px solid #dee2e6;">{{ $employee->last_name }}</td>
                    <td style="padding: 10px; border: 1px solid #dee2e6;">{{ $employee->middle_name }}</td>
                    <td style="padding: 10px; border: 1px solid #dee2e6;">{{ $employee->email }}</td>
                    <td style="padding: 10px; border: 1px solid #dee2e6;">
                        <form action="{{ route('employee.destroy', $employee->employee_id) }}" method="post" style="display:inline;">
                            @csrf
                            <button type="submit" style="background-color: #dc3545; border: none; color: white; padding: 2px 10px; font-size: 12px; cursor: pointer; border-radius: 5px; transition: background-color 0.3s ease;">
                                <i class="fas fa-trash"></i> <!-- Trash icon only -->
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
