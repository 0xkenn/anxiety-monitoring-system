@extends('layouts.admin')

@section('content')
<div style="max-width: 400px; margin: 15px auto; padding: 20px; background-color: #fff; border-radius: 5px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
    <h1 style="text-align: center; margin-bottom: 20px;">Create New Student</h1>

    <form action="{{ route('students.store') }}" method="POST">
        @csrf

        <div style="margin-bottom: 15px;">
            <label style="font-weight: bold;">First Name:</label>
            <input type="text" name="first_name" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            @error('first_name')<p style="color: red;">{{ $message }}</p>@enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label style="font-weight: bold;">Last Name:</label>
            <input type="text" name="last_name" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            @error('last_name')<p style="color: red;">{{ $message }}</p>@enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label style="font-weight: bold;">Email:</label>
            <input type="email" name="email" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            @error('email')<p style="color: red;">{{ $message }}</p>@enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label style="font-weight: bold;">Password:</label>
            <input type="password" name="password" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            @error('password')<p style="color: red;">{{ $message }}</p>@enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label style="font-weight: bold;">Confirm Password:</label>
            <input type="password" name="password_confirmation" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="font-weight: bold;">Sex:</label>
            <select name="sex" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            @error('sex')<p style="color: red;">{{ $message }}</p>@enderror
        </div>

        <button type="submit" style="width: 100%; padding: 10px; background-color: #007bff; color: #fff; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">Create Student</button>
    </form>

    <div style="text-align: center; margin-top: 15px; color: #007bff; cursor: pointer;" onclick="window.history.back();">Cancel</div>
</div>
@endsection
