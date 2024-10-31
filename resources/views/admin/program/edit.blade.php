@extends('layouts.admin')

@section('content')
<div class="container" style="max-width: 600px; margin: 50px auto; padding: 20px; background-color: #fff; border-radius: 5px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
    <h3 style="text-align: left; margin-bottom: 20px;">Edit Program</h3> <!-- Title aligned to the left -->

    <form action="{{ route('edit.program.auth', $program->id) }}" method="post" style="text-align: left;"> <!-- Left-align the form -->
        @csrf
        <div class="input-group" style="margin-bottom: 15px;">
            <label for="program_name" style="font-weight: bold;">Program Name</label>
            <input type="text" id="program_name" name="program_name" value="{{ old('program_name', $program->program_name) }}" required style="width: 100%; height: 40px; padding: 8px; font-size: 14px; border-radius: 5px; border: 1px solid #ccc;">
        </div>
    
        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 10px; font-size: 16px; font-weight: bold; background-color: #007bff; color: #fff; border: none; cursor: pointer; border-radius: 5px;">Update Program</button>
    </form>

    <!-- Cancel Button -->
    <div style="text-align: center; margin-top: 15px; color: #007bff; cursor: pointer;" onclick="window.history.back();">Cancel</div>
</div>
@endsection

@section('scripts')
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> <!-- Include Font Awesome -->
@endsection
