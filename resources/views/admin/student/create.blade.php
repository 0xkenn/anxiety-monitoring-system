<!DOCTYPE html>
<html>
<head>
    <title>Create Student</title>
</head>
<body>
    <h1>Create New Student</h1>

    <form action="{{ route('students.store') }}" method="POST">
        @csrf

        <label>First Name:</label>
        <input type="text" name="first_name" required>
        @error('first_name')<p>{{ $message }}</p>@enderror

        <label>Last Name:</label>
        <input type="text" name="last_name" required>
        @error('last_name')<p>{{ $message }}</p>@enderror

        <label>Email:</label>
        <input type="email" name="email" required>
        @error('email')<p>{{ $message }}</p>@enderror

        <label>Password:</label>
        <input type="password" name="password" required>
        @error('password')<p>{{ $message }}</p>@enderror

        <label>Confirm Password:</label>
        <input type="password" name="password_confirmation" required>

        <label>Sex:</label>
        <select name="sex" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
        @error('sex')<p>{{ $message }}</p>@enderror

        <button type="submit">Create Student</button>
    </form>
</body>
</html>
