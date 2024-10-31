<!-- resources/views/programs/create_program.blade.php -->

@extends('layouts.admin')

@section('content')
<div class="container" style="max-width: 900px; margin: 60px auto; padding: 20px; background-color: #fff; border-radius: 5px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
    <h3 style="text-align: center; margin-bottom: 20px; ">Create a New Program</h3>

    <div class="form-card" style="padding: 20px; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9;">
      <form action="{{ route('create.program') }}" method="POST">
        @csrf
        <div class="form-group">
          <label for="school_id" style="display: block; margin-bottom: 5px;">Select School</label>
          <select name="school_id" id="school_id" class="form-control" required style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
            <option value="">Select School</option>
            @foreach($schools as $school)
              <option value="{{ $school->id }}">{{ $school->school_name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="program_name" style="display: block; margin-bottom: 5px;">Program Name</label>
          <input type="text" name="program_name" id="program_name" class="form-control" required style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
        </div>
          <div class="form-group">
          <label for="abbrev" style="display: block; margin-bottom: 5px;">Abbrevation</label>
          <input type="text" name="abbrev" id="abbrev" class="form-control" required style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
          @error('abbrev')
            <p style="color: red">{{ $message }}</p>
          @enderror
        </div>
        <div style="text-align: right;"> <!-- Aligns the button to the right -->
            <button type="submit" class="btn btn-success" style="padding: 5px 10px; border: 2px solid transparent; border-radius: 4px; background-color: #28a745; color: #fff; font-size: 12px; cursor: pointer;">Create Program</button>
        </div>
      </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> <!-- Include Font Awesome -->
@endsection
