<!DOCTYPE html>
<html>
<head>
  <title>Edit Profile</title>
  <link rel="shortcut icon" href="{{ asset('assets/favicon.ico') }}" type="image/x-icon">
  
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <style>
    /* Similar to Profile Page Styling */
    /* Add additional styling as needed */
    body {
      height: 100vh;
      margin: 0;
      padding-top: 60px;
      font-family: 'Poppins', sans-serif;
    }

    .container {
      background-color: #5e85ed;
      padding: 20px;
      margin: 50px auto;
      display: flex;
      flex-direction: column;
      align-items: center;
      width: 330px;
      border-radius: 10px;
      color: white;
    }

    .input-group {
      display: flex;
      flex-direction: column;
      margin-bottom: 10px;
      width: 100%;
    }

    .input-field {
      width: 100%;
      padding: 8px;
      font-size: 14px;
      border: none;
      background: whitesmoke;
      outline: none;
      border-radius: 25px;
      text-align: center;
      font-family: 'Poppins', sans-serif;
      margin-top: 5px;
    }

    .button {
      padding: 10px;
      background-color: #FFC300;
      border: none;
      border-radius: 25px;
      cursor: pointer;
      font-size: 14px;
      font-weight: bold;
      color: black;
      width: 100%;
    }

    .button:hover {
      background-color: #ffb700;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Edit Profile</h1>

    <form method="POST" action="{{ route('student.update', $student->id) }}">
      @csrf
      @method('PUT')

      <div class="input-group">
        <input type="text" class="input-field" name="last_name" value="{{ $student->last_name }}" required>
        <label>Last Name</label>
      </div>
      <div class="input-group">
        <input type="text" class="input-field" name="first_name" value="{{ $student->first_name }}" required>
        <label>First Name</label>
      </div>
      <div class="input-group">
        <input type="text" class="input-field" name="middle_name" value="{{ $student->middle_name }}" required>
        <label>Middle Name</label>
      </div>
      <div class="input-group">
        <input type="date" class="input-field" name="birthdate" value="{{ $student->birthdate }}" required>
        <label>Birth Date</label>
      </div>
      <div class="input-group">
        <select class="input-field" name="sex" required>
          <option value="male" {{ $student->sex == 'male' ? 'selected' : '' }}>Male</option>
          <option value="female" {{ $student->sex == 'female' ? 'selected' : '' }}>Female</option>
        </select>
        <label>Sex</label>
      </div>
      <div class="input-group">
        <input type="text" class="input-field" name="program" value="{{ $student->program }}" required>
        <label>Program</label>
      </div>
      <div class="input-group">
        <input type="text" class="input-field" name="mobile_number" value="{{ $student->mobile_number }}" required>
        <label>Mobile Number</label>
      </div>
      <div class="input-group">
        <input type="email" class="input-field" name="email" value="{{ $student->email }}" required>
        <label>Email</label>
      </div>
      <div class="input-group">
        <input type="text" class="input-field" name="province" value="{{ $student->province }}" required>
        <label>Province</label>
      </div>
      <div class="input-group">
        <input type="text" class="input-field" name="municipality" value="{{ $student->municipality }}" required>
        <label>Municipality</label>
      </div>
      <div class="input-group">
        <input type="text" class="input-field" name="barangay" value="{{ $student->barangay }}" required>
        <label>Barangay</label>
      </div>

      <button type="submit" class="button">Update Profile</button>
    </form>
  </div>

</body>
</html>
