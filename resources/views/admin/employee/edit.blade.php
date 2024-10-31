<!DOCTYPE html>
<html>
<head>
    <title>Edit Employee</title>
</head>
<body>
    <h1>Edit Employee</h1>

    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>First Name:</label>
        <input type="text" name="first_name" value="{{ $employee->first_name }}" required>
        @error('first_name')<p>{{ $message }}</p>@enderror

        <label>Last Name:</label>
        <input type="text" name="last_name" value="{{ $employee->last_name }}" required>
        @error('last_name')<p>{{ $message }}</p>@enderror

        <label>Email:</label>
        <input type="email" name="email" value="{{ $employee->email }}" required>
        @error('email')<p>{{ $message }}</p>@enderror

        <label>Password (leave empty to keep current password):</label>
        <input type="password" name="password">
        @error('password')<p>{{ $message }}</p>@enderror

        <label>Confirm Password:</label>
        <input type="password" name="password_confirmation">

        <label>Sex:</label>
        <select name="sex" required>
            <option value="male" {{ $employee->sex == 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ $employee->sex == 'female' ? 'selected' : '' }}>Female</option>
        </select>
        @error('sex')<p>{{ $message }}</p>@enderror

        <button type="submit">Update Employee</button>
    </form>
</body>
</html>
