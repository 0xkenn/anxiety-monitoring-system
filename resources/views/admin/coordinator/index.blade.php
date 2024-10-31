@extends('layouts.admin')

@section('content')
<div class="container-fluid" style="padding: 20px; margin-top: 80px; margin-left: 240px;">
    <h3 style="margin-left: 0;">Coordinator List</h3>
    
    <!-- Create Button Positioned Above the Table and Floated Right -->
    <div class="create-btn" style="margin-bottom: 10px; text-align: right;">
        <a href="{{ route('create.coordinator') }}" class="btn btn-sm" style="background-color: green; color: white; margin-right:300px;">Create</a>
    </div>
    
    <div class="table-container" style="font-family: 'Poppins', sans-serif; font-size: 12px; margin-top: 4px; padding-left: 20px; width: calc(100% - 300px); max-width: 900px;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="word-wrap: break-word; white-space: normal; padding: 10px; border: 1px solid #dee2e6;">No.</th>
                    <th style="word-wrap: break-word; white-space: normal; padding: 10px; border: 1px solid #dee2e6;">School</th>
                    <th style="word-wrap: break-word; white-space: normal; padding: 10px; border: 1px solid #dee2e6;">User ID</th>
                    <th style="word-wrap: break-word; white-space: normal; padding: 10px; border: 1px solid #dee2e6;">Last Name</th>
                    <th style="word-wrap: break-word; white-space: normal; padding: 10px; border: 1px solid #dee2e6;">First Name</th>
                    <th style="word-wrap: break-word; white-space: normal; padding: 10px; border: 1px solid #dee2e6;">Middle Name</th>
                    <th style="word-wrap: break-word; white-space: normal; padding: 10px; border: 1px solid #dee2e6;">Sex</th>
                    <th style="word-wrap: break-word; white-space: normal; padding: 10px; border: 1px solid #dee2e6;">Mobile Number</th>
                    <th style="word-wrap: break-word; white-space: normal; padding: 10px; border: 1px solid #dee2e6;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($coordinators as $coordinator)
                <tr>
                    <td style="padding: 10px; border: 1px solid #dee2e6;">{{ $loop->iteration }}</td>
                    <td style="padding: 10px; border: 1px solid #dee2e6;">{{ $coordinator->school->school_name }}</td>
                    <td style="padding: 10px; border: 1px solid #dee2e6;">{{ $coordinator->coordinator_id }}</td>
                    <td style="padding: 10px; border: 1px solid #dee2e6;">{{ $coordinator->last_name }}</td>
                    <td style="padding: 10px; border: 1px solid #dee2e6;">{{ $coordinator->first_name }}</td>
                    <td style="padding: 10px; border: 1px solid #dee2e6;">{{ $coordinator->middle_name }}</td>
                    <td style="padding: 10px; border: 1px solid #dee2e6;">{{ $coordinator->sex }}</td>
                    <td style="padding: 10px; border: 1px solid #dee2e6;">{{ $coordinator->mobile_number }}</td>
                    <td style="padding: 10px; border: 1px solid #dee2e6; text-align: center;">
                        <div style="display: flex; justify-content: center; align-items: center;">
                            <a href="{{ route('edit.coordinator', $coordinator->id) }}" class="btn btn-sm btn-primary" style="margin-right: 8px; padding:2px 2px; border-radius: 2px; font-size: 14px; display: flex; align-items: center; justify-content: center;">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('delete.coordinator', $coordinator->id) }}" method="post" style="display:inline;">
                                @csrf
                                <button class="btn btn-sm btn-danger" style="padding: 1px 1px; border-radius: 2px; font-size: 14px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
