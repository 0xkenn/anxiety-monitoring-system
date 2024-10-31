@extends('layouts.admin')

@section('content')
<div class="container" style="margin-top: 30px; padding-left: 220px; font-family: 'Poppins', sans-serif; font-size: 12px;">
    <h3>Counselor List</h3>

    <div class="create-btn" style="margin-bottom: 20px; text-align: right;">
        <a href="{{ route('create.counselor') }}" class="btn btn-sm" style="background-color: green; color: white;margin-top:50px;">Create</a>
    </div>

    <div class="table-container">
        <table style="width: 100%; border-collapse: collapse; font-size: 12px;">
            <thead>
                <tr>
                    <th style="padding: 10px; border: 1px solid #dee2e6;">No.</th> <!-- New column for auto-incrementing ID -->
                    <th style="padding: 10px; border: 1px solid #dee2e6;">Counselor ID</th>
                    <th style="padding: 10px; border: 1px solid #dee2e6;">Last Name</th>
                    <th style="padding: 10px; border: 1px solid #dee2e6;">First Name</th>
                    <th style="padding: 10px; border: 1px solid #dee2e6;">Middle Name</th>
                    <th style="padding: 10px; border: 1px solid #dee2e6;">Sex</th>
                    <th style="padding: 10px; border: 1px solid #dee2e6;">Mobile Number</th>
                    <th style="padding: 10px; border: 1px solid #dee2e6;">Email</th>
                    <th style="padding: 10px; border: 1px solid #dee2e6;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($counselors as $counselor)
                <tr>
                    <td style="padding: 10px; border: 1px solid #dee2e6;">{{ $loop->iteration }}</td> <!-- Auto-incrementing ID -->
                    <td style="padding: 10px; border: 1px solid #dee2e6;">{{ $counselor->counselor_id }}</td>
                    <td style="padding: 10px; border: 1px solid #dee2e6;">{{ $counselor->last_name }}</td>
                    <td style="padding: 10px; border: 1px solid #dee2e6;">{{ $counselor->first_name }}</td>
                    <td style="padding: 10px; border: 1px solid #dee2e6;">{{ $counselor->middle_name }}</td>
                    <td style="padding: 10px; border: 1px solid #dee2e6;">{{ $counselor->sex }}</td>
                    <td style="padding: 10px; border: 1px solid #dee2e6;">{{ $counselor->mobile_number }}</td>
                    <td style="padding: 10px; border: 1px solid #dee2e6;">{{ $counselor->email }}</td>
                    <td style="padding: 10px; border: 1px solid #dee2e6; text-align: center;">
                        <!-- Edit button with blue color and icon only -->
                        <a href="{{ route('edit.counselor', $counselor->id) }}" class="btn btn-sm" style="background-color: blue; color: white; padding: 2px 5px;">
                            <i class="fa fa-edit"></i> <!-- Edit icon -->
                        </a>
                        <!-- Delete button with red color and icon only -->
                        <form action="{{ route('delete.counselor', $counselor->id) }}" method="post" style="display: inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-sm" style="background-color: red; color: white; padding: 2px 5px;">
                                <i class="fa fa-trash"></i> <!-- Delete icon -->
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
