<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
</head>
<body>
    <h1>Edit Student</h1>

    <form action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>First Name:</label>
        <input type="text" name="first_name" value="{{ $student->first_name }}" required>
        @error('first_name')<p>{{ $message }}</p>@enderror

        <label>Last Name:</label>
        <input type="text" name="last_name" value="{{ $student->last_name }}" required>
        @error('last_name')<p>{{ $message }}</p>@enderror

        <label>Email:</label>
        <input type="email" name="email" value="{{ $student->email }}" required>
        @error('email')<p>{{ $message }}</p>@enderror

        <label>Password (leave empty to keep current password):</label>
        <input type="password" name="password">
        @error('password')<p>{{ $message }}</p>@enderror

        <label>Confirm Password:</label>
        <input type="password" name="password_confirmation">

        <label>Sex:</label>
        <select name="sex" required>
            <option value="male" {{ $student->sex == 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ $student->sex == 'female' ? 'selected' : '' }}>Female</option>
        </select>
        @error('sex')<p>{{ $message }}</p>@enderror

        <button type="submit">Update Student</button>
    </form>
</body>
</html>
