@extends('layouts.admin')

@section('content')

<div style="font-family: 'Poppins', sans-serif; background-color: #f2f2f2; padding: 20px;">
    <div style="max-width: 400px; margin: 50px auto; padding: 20px; background-color: #fff; border-radius: 10px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);">
        <h3 style="text-align: center; margin-bottom: 20px; color: #333; font-size: 14px;">Add New Coordinator</h3>
        <form action="{{ route('create.coordinator.auth') }}" method="post">
            @csrf

            <div style="margin-bottom: 15px;">
                <label for="school" style="font-weight: bold; color: #555; font-size: 12px;">School</label>
                <select id="school" name="school_id" required style="width: 100%; height: 35px; padding: 5px; font-size: 12px; border-radius: 5px; border: 1px solid #ccc;">
                    <option value="" disabled>Select a School</option>
                    @foreach ($schools as $school)
                        <option value="{{ $school->id }}">
                            {{ $school->school_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 15px;">
                <label for="coordinator_id" style="font-weight: bold; color: #555; font-size: 12px;">Coordinator ID</label>
                <input type="text" id="coordinator_id" name="coordinator_id" value="{{ old('coordinator_id') }}" required style="width: 100%; height: 35px; padding: 5px; font-size: 12px; border-radius: 5px; border: 1px solid #ccc;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="last_name" style="font-weight: bold; color: #555; font-size: 12px;">Last Name</label>
                <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required style="width: 100%; height: 35px; padding: 5px; font-size: 12px; border-radius: 5px; border: 1px solid #ccc;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="first_name" style="font-weight: bold; color: #555; font-size: 12px;">First Name</label>
                <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required style="width: 100%; height: 35px; padding: 5px; font-size: 12px; border-radius: 5px; border: 1px solid #ccc;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="middle_name" style="font-weight: bold; color: #555; font-size: 12px;">Middle Name</label>
                <input type="text" id="middle_name" name="middle_name" value="{{ old('middle_name') }}" style="width: 100%; height: 35px; padding: 5px; font-size: 12px; border-radius: 5px; border: 1px solid #ccc;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="sex" style="font-weight: bold; color: #555; font-size: 12px;">Sex</label>
                <select id="sex" name="sex" required style="width: 100%; height: 35px; padding: 5px; font-size: 12px; border-radius: 5px; border: 1px solid #ccc;">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>

            <div style="margin-bottom: 15px;">
                <label for="password" style="font-weight: bold; color: #555; font-size: 12px;">Password</label>
                <input type="password" id="password" name="password" value="{{ old('password') }}" required style="width: 100%; height: 35px; padding: 5px; font-size: 12px; border-radius: 5px; border: 1px solid #ccc;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="mobile_number" style="font-weight: bold; color: #555; font-size: 12px;">Mobile Number</label>
                <input type="text" id="mobile_number" name="mobile_number" value="{{ old('mobile_number') }}" required style="width: 100%; height: 35px; padding: 5px; font-size: 12px; border-radius: 5px; border: 1px solid #ccc;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="email" style="font-weight: bold; color: #555; font-size: 12px;">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required style="width: 100%; height: 35px; padding: 5px; font-size: 12px; border-radius: 5px; border: 1px solid #ccc;">
            </div>

            <button type="submit" style="width: 100%; padding: 8px; font-size: 16px; font-weight: bold; background-color: #007bff; color: #fff; border: none; cursor: pointer; border-radius: 5px; transition: background-color 0.3s;">Create Coordinator</button>
        </form>
        <div style="text-align: center; margin-top: 15px; color: #007bff; cursor: pointer;" onclick="window.history.back();">Cancel</div>
    </div>
</div>

@endsection
