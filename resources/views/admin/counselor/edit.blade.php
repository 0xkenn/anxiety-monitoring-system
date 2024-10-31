@extends('layouts.admin')

@section('content')
<div style="max-width: 380px; margin: 50px auto; padding: 10px; background-color: #fff; border-radius: 5px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
    <h3 style="text-align: center; margin-bottom: 10px;">Edit Counselor</h3>

    <!-- Form for adding a new counselor -->
    <form action="{{ route('create.addCounselor', $counselor->id) }}" method="post">
        @csrf

        <div style="margin-bottom: 8px;">
            <label for="school" style="font-weight: bold;">School</label>
            <select id="school" name="school_id" required style="width: 100%; height: 28px; padding: 5px; font-size: 14px; border-radius: 5px; border: 1px solid #ccc;">
                <option value="" disabled>Select a School</option>
                @foreach ($schools as $school)
                    <option value="{{ $school->id }}">{{ $school->school_name }}</option>
                @endforeach
            </select>
            @error('school_id')
                <div class="text-color-red">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 8px;">
            <label for="counselor_id" style="font-weight: bold;">Counselor ID</label>
            <input type="text" id="counselor_id" name="counselor_id" placeholder="Counselor Id" required style="width: 100%; height: 28px; padding: 5px; font-size: 14px; border-radius: 5px; border: 1px solid #ccc;" value="{{ old('counselor_id') }}">
            @error('counselor_id')
                <div class="text-color-red">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 8px;">
            <label for="last_name" style="font-weight: bold;">Last Name</label>
            <input type="text" id="last_name" name="last_name" placeholder="Last Name" required style="width: 100%; height: 28px; padding: 5px; font-size: 14px; border-radius: 5px; border: 1px solid #ccc;" value="{{ old('last_name') }}">
            @error('last_name')
                <div class="text-color-red">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 8px;">
            <label for="first_name" style="font-weight: bold;">First Name</label>
            <input type="text" id="first_name" name="first_name" placeholder="First Name" required style="width: 100%; height: 28px; padding: 5px; font-size: 14px; border-radius: 5px; border: 1px solid #ccc;" value="{{ old('first_name') }}">
            @error('first_name')
                <div class="text-color-red">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 8px;">
            <label for="middle_name" style="font-weight: bold;">Middle Name</label>
            <input type="text" id="middle_name" name="middle_name" placeholder="Middle Name" required style="width: 100%; height: 28px; padding: 5px; font-size: 14px; border-radius: 5px; border: 1px solid #ccc;" value="{{ old('middle_name') }}">
            @error('middle_name')
                <div class="text-color-red">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 8px;">
            <label for="sex" style="font-weight: bold;">Sex</label>
            <select id="sex" name="sex" required style="width: 100%; height: 28px; padding: 5px; font-size: 14px; border-radius: 5px; border: 1px solid #ccc;">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            @error('sex')
                <div class="text-color-red">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 8px;">
            <label for="password" style="font-weight: bold;">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" required style="width: 100%; height: 28px; padding: 5px; font-size: 14px; border-radius: 5px; border: 1px solid #ccc;" value="{{ old('password') }}">
            @error('password')
                <div class="text-color-red">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 8px;">
            <label for="mobile_number" style="font-weight: bold;">Mobile Number</label>
            <input type="text" id="mobile_number" name="mobile_number" placeholder="Mobile Number" required style="width: 100%; height: 28px; padding: 5px; font-size: 14px; border-radius: 5px; border: 1px solid #ccc;" value="{{ old('mobile_number') }}">
            @error('mobile_number')
                <div class="text-color-red">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 8px;">
            <label for="email" style="font-weight: bold;">Email</label>
            <input type="email" id="email" name="email" placeholder="Email" required style="width: 100%; height: 28px; padding: 5px; font-size: 14px; border-radius: 5px; border: 1px solid #ccc;" value="{{ old('email') }}">
            @error('email')
                <div class="text-color-red">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 10px; font-size: 16px; font-weight: bold; background-color: #007bff; color: #fff; border: none; cursor: pointer; border-radius: 5px;">Save</button>
    </form>

    <div style="text-align: center; margin-top: 15px; color: #007bff; cursor: pointer;" onclick="window.history.back();">Cancel</div>
</div>
@endsection
