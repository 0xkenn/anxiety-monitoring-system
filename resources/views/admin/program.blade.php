@extends('layouts.admin')

@section('content')
<div class="container" style="max-width: 900px; margin: 60px auto; padding: 20px; background-color: #fff; border-radius: 5px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
    <h3 style="text-align: center; margin-bottom: 20px; ">Program List</h3>
    <div class="create-btn" style="display: flex; justify-content: flex-end; margin-bottom: 10px;"> 
      <!-- Add New School Button or Other Actions Can Go Here -->
    </div>
    <div class="create-btn" style="display: flex; justify-content: flex-end; margin-bottom: 10px;">
    <a href="{{ route('show.create.program') }}" class="btn btn-primary" style="padding:3px 5px; border-radius: 3px; background-color: green; color: white; font-size: 14px; text-decoration: none;">
        Add Program
        </a>
        </div>

    
    <div class="table-container" style="overflow-x: hidden;"> <!-- Removed horizontal scroll -->
        <table style="width: calc(100% - 50px); margin-left: 50px; border-collapse: collapse; max-width: calc(100% - 50px);"> <!-- Added left margin to the table -->
            <thead>
                <tr>
                    <th style="width: 10%; padding: 10px; border: 1px solid #ccc; text-align: left; font-size: 12px; background-color: #007bff; color: #fff;">No.</th>
                    <th style="width: 40%; padding: 10px; border: 1px solid #ccc; text-align: left; font-size: 12px;">School</th>
                    <th style="width: 40%; padding: 10px; border: 1px solid #ccc; text-align: left; font-size: 12px;">Program Name</th>
                    <th style="width: 40%; padding: 10px; border: 1px solid #ccc; text-align: left; font-size: 12px;">Abbrevation</th>
                    <th style="width: 10%; padding: 10px; border: 1px solid #ccc; text-align: left; font-size: 12px;">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($schools as $school)
                <tr>
                    <td style="padding: 10px; border: 1px solid #ccc; text-align: left; font-size: 12px;">{{ $loop->iteration }}</td>
                    <td style="padding: 10px; border: 1px solid #ccc; text-align: left; font-size: 12px;">{{ $school->school_name }}</td>
                    
                    <td style="padding: 10px; border: 1px solid #ccc; text-align: left; font-size: 12px;">
                        @foreach($programs as $program)
                            @if($program->school_id == $school->id)
                                {{ $program->program_name }} <br>
                            @endif
                        @endforeach
                    </td>
                     <td style="padding: 10px; border: 1px solid #ccc; text-align: left; font-size: 12px;">
 @foreach($programs as $program)
                         @if($program->school_id == $school->id)
                                {{ $program->abbrev }} <br>
                            @endif
                              @endforeach
                     </td>
                    
                    <td style="padding: 10px; border: 1px solid #ccc; text-align: left; font-size: 12px;">
                        <div class="action-buttons" style="display: flex; gap: 5px; flex-wrap: wrap;">
                            @foreach($programs as $program)
                                @if($program->school_id == $school->id)
                                    <div style="display: flex; gap: 10px;">
                                        <a href="{{ route('edit.program', $program->id) }}" class="btn btn-sm" style="padding: 2px; border: 2px solid transparent; border-radius: 4px; background-color: #007bff; color: #fff; font-size: 12px; text-decoration: none;">
                                            <i class="fas fa-edit" style="margin-right: 2px;"></i>
                                        </a>
                                        <form action="{{ route('delete.program', $program->id) }}" method="post" style="display:inline-block;">
                                            @csrf
                                            <button class="btn btn-sm" style="padding: 2px; border: 2px solid transparent; border-radius: 4px; background-color: #dc3545; color: #fff; font-size: 12px; cursor: pointer;">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

  
@endsection

@section('scripts')
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> <!-- Include Font Awesome -->
@endsection
