@extends('layouts.admin')

@section('content')
<div class="container" style="max-width: 400px; margin: 30px auto; padding: 15px; background-color: #fff; border-radius: 5px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h4 style="margin: 15px 0;">Edit Coordinator</h4> <!-- Title aligned to the left with margin-top -->
        
    </div>

    <form action="{{ route('update.coordinator') }}" method="post">
        @csrf

        <div class="input-group" style="margin-bottom: 15px;">
            <label for="school" style="font-weight: bold;">School</label>
            <select id="school" name="school_id" required style="width: 100%; height: 34px; padding: 6px; font-size: 14px; border-radius: 5px; border: 1px solid #ccc;">
                <option value="" disabled>Select a School</option>
                @foreach ($schools as $school)
                    <option value="{{ $school->id }}">
                        {{ $school->school_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="input-group" style="margin-bottom: 15px;">
            <label for="coordinator_id" style="font-weight: bold;">Coordinator ID</label>
            <input type="text" id="coordinator_id" name="coordinator_id" value="{{ old('coordinator_id') }}" required style="width: 100%; height: 34px; padding: 6px; font-size: 14px; border-radius: 5px; border: 1px solid #ccc;">
        </div>

        <div class="input-group" style="margin-bottom: 15px;">
            <label for="last_name" style="font-weight: bold;">Last Name</label>
            <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required style="width: 100%; height: 34px; padding: 6px; font-size: 14px; border-radius: 5px; border: 1px solid #ccc;">
        </div>

        <div class="input-group" style="margin-bottom: 15px;">
            <label for="first_name" style="font-weight: bold;">First Name</label>
            <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required style="width: 100%; height: 34px; padding: 6px; font-size: 14px; border-radius: 5px; border: 1px solid #ccc;">
        </div>

        <div class="input-group" style="margin-bottom: 15px;">
            <label for="middle_name" style="font-weight: bold;">Middle Name</label>
            <input type="text" id="middle_name" name="middle_name" value="{{ old('middle_name') }}" style="width: 100%; height: 34px; padding: 6px; font-size: 14px; border-radius: 5px; border: 1px solid #ccc;">
        </div>

        <div class="input-group" style="margin-bottom: 15px;">
            <label for="sex" style="font-weight: bold;">Sex</label>
            <select id="sex" name="sex" required style="width: 100%; height: 34px; padding: 6px; font-size: 14px; border-radius: 5px; border: 1px solid #ccc;">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>

        <div class="input-group" style="margin-bottom: 15px;">
            <label for="password" style="font-weight: bold;">Password</label>
            <input type="password" id="password" name="password" value="{{ old('password') }}" required style="width: 100%; height: 34px; padding: 6px; font-size: 14px; border-radius: 5px; border: 1px solid #ccc;">
        </div>

        <div class="input-group" style="margin-bottom: 15px;">
            <label for="mobile_number" style="font-weight: bold;">Mobile Number</label>
            <input type="text" id="mobile_number" name="mobile_number" value="{{ old('mobile_number') }}" required style="width: 100%; height: 34px; padding: 6px; font-size: 14px; border-radius: 5px; border: 1px solid #ccc;">
        </div>

        <div class="input-group" style="margin-bottom: 15px;">
            <label for="email" style="font-weight: bold;">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required style="width: 100%; height: 34px; padding: 6px; font-size: 14px; border-radius: 5px; border: 1px solid #ccc;">
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 10px; font-size: 16px; font-weight: bold; background-color: #007bff; color: #fff; border: none; cursor: pointer; border-radius: 5px;">Update Coordinator</button>
        
        <!-- Cancel Button -->
        <div style="text-align: center; margin-top: 15px; color: #007bff; cursor: pointer;" onclick="window.history.back();">Cancel</div>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> <!-- Include Font Awesome -->
@endsection
