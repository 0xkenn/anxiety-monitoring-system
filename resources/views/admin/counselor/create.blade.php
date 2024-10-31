@extends('layouts.admin')

@section('content')
  <div style="max-width: 400px; margin: 100px auto; padding: 10px; background-color: #fff; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); font-family: 'Poppins', sans-serif;">
    <h3 style="text-align: center; margin-bottom: 15px; font-weight: 600; font-size: 16px;">Add Counselor</h3>

    <!-- Form for adding a new counselor -->
    <form action="{{ route('create.addCounselor') }}" method="post">
      @csrf

      <div style="margin-bottom: 10px; margin-top:10px;">
        <label for="school" style="font-weight: bold; margin-bottom: 3px; display: block; font-size: 12px;">School</label>
        <select id="school" name="school_id" required style="width: 100%; height: 30px; padding: 4px 8px; font-size: 12px; border-radius: 4px; border: 1px solid #ccc;">
          <option value="" disabled selected>Select a School</option>
          @foreach ($schools as $school)
            <option value="{{ $school->id }}">{{ $school->school_name }}</option>
          @endforeach
        </select>
        @error('school_id')
          <div style="color: red; font-size: 9px;">{{ $message }}</div>
        @enderror
      </div>

      <div style="margin-bottom: 10px;">
        <label for="counselor_id" style="font-weight: bold; margin-bottom: 3px; display: block; font-size: 12px;">Counselor ID</label>
        <input type="text" id="counselor_id" name="counselor_id" placeholder="Counselor ID" required value="{{ old('counselor_id') }}" style="width: 100%; height: 30px; padding: 4px 8px; font-size: 12px; border-radius: 4px; border: 1px solid #ccc;">
        @error('counselor_id')
          <div style="color: red; font-size: 9px;">{{ $message }}</div>
        @enderror
      </div>

      <div style="margin-bottom: 10px;">
        <label for="last_name" style="font-weight: bold; margin-bottom: 3px; display: block; font-size: 12px;">Last Name</label>
        <input type="text" id="last_name" name="last_name" placeholder="Last Name" required value="{{ old('last_name') }}" style="width: 100%; height: 30px; padding: 4px 8px; font-size: 12px; border-radius: 4px; border: 1px solid #ccc;">
        @error('last_name')
          <div style="color: red; font-size: 9px;">{{ $message }}</div>
        @enderror
      </div>

      <div style="margin-bottom: 10px;">
        <label for="first_name" style="font-weight: bold; margin-bottom: 3px; display: block; font-size: 12px;">First Name</label>
        <input type="text" id="first_name" name="first_name" placeholder="First Name" required value="{{ old('first_name') }}" style="width: 100%; height: 30px; padding: 4px 8px; font-size: 12px; border-radius: 4px; border: 1px solid #ccc;">
        @error('first_name')
          <div style="color: red; font-size: 9px;">{{ $message }}</div>
        @enderror
      </div>

      <div style="margin-bottom: 10px;">
        <label for="middle_name" style="font-weight: bold; margin-bottom: 3px; display: block; font-size: 12px;">Middle Name</label>
        <input type="text" id="middle_name" name="middle_name" placeholder="Middle Name" required value="{{ old('middle_name') }}" style="width: 100%; height: 30px; padding: 4px 8px; font-size: 12px; border-radius: 4px; border: 1px solid #ccc;">
        @error('middle_name')
          <div style="color: red; font-size: 9px;">{{ $message }}</div>
        @enderror
      </div>

      <div style="margin-bottom: 10px;">
        <label for="sex" style="font-weight: bold; margin-bottom: 3px; display: block; font-size: 12px;">Sex</label>
        <select id="sex" name="sex" required style="width: 100%; height: 30px; padding: 4px 8px; font-size: 12px; border-radius: 4px; border: 1px solid #ccc;">
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
        @error('sex')
          <div style="color: red; font-size: 9px;">{{ $message }}</div>
        @enderror
      </div>

      <div style="margin-bottom: 10px;">
        <label for="password" style="font-weight: bold; margin-bottom: 3px; display: block; font-size: 12px;">Password</label>
        <input type="password" id="password" name="password" placeholder="Password" required value="{{ old('password') }}" style="width: 100%; height: 30px; padding: 4px 8px; font-size: 12px; border-radius: 4px; border: 1px solid #ccc;">
        @error('password')
          <div style="color: red; font-size: 9px;">{{ $message }}</div>
        @enderror
      </div>

      <div style="margin-bottom: 10px;">
        <label for="mobile_number" style="font-weight: bold; margin-bottom: 3px; display: block; font-size: 12px;">Mobile Number</label>
        <input type="text" id="mobile_number" name="mobile_number" placeholder="Mobile Number" required value="{{ old('mobile_number') }}" style="width: 100%; height: 30px; padding: 4px 8px; font-size: 12px; border-radius: 4px; border: 1px solid #ccc;">
        @error('mobile_number')
          <div style="color: red; font-size: 9px;">{{ $message }}</div>
        @enderror
      </div>

      <div style="margin-bottom: 10px;">
        <label for="email" style="font-weight: bold; margin-bottom: 3px; display: block; font-size: 12px;">Email</label>
        <input type="email" id="email" name="email" placeholder="Email" required value="{{ old('email') }}" style="width: 100%; height: 30px; padding: 4px 8px; font-size: 12px; border-radius: 4px; border: 1px solid #ccc;">
        @error('email')
          <div style="color: red; font-size: 9px;">{{ $message }}</div>
        @enderror
      </div>

      <button type="submit" style="width: 100%; padding: 8px; font-size: 14px; font-weight: bold; background-color: #007bff; color: #fff; border: none; cursor: pointer; border-radius: 5px; transition: background-color 0.3s ease;">Create Counselor</button>
    </form>

    <!-- Cancel Button -->
    <div style="text-align: center; margin-top: 15px; color: #007bff; cursor: pointer;" onclick="window.history.back();">Cancel</div>
  </div>
@endsection
