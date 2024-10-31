<!DOCTYPE html>
<html>
<head>
  <title>Profile Page</title>
  <link rel="shortcut icon" href="{{ asset('assets/favicon.ico') }}" type="image/x-icon">
  
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <style>
    /* Navbar */
    .navbar {
      background-color: #FFC300;
      height: 60px;
      display: flex;
      align-items: center;
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 100;
    }

    .logo {
      margin-right: 20px;
      color: white;
      width: 30px;
      height: 30px;
    }

    .logo img {
      width: 100%;
      height: 100%;
      margin-left: 15px;
    }

    .logo-text {
      color: black;
      font-size: 18px;
      font-weight: bold; 
    }

    /* Other Styles */
    body {
      height: 100vh;
      margin: 0;
      padding-top: 60px;
      font-family: 'Poppins', sans-serif;
      background-color: #f4f4f9;
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

    .profile-field {
      margin: 10px 0;
      text-align: left;
      width: 100%;
    }

    .profile-field span {
      font-weight: bold;
      margin-right: 10px;
    }

    .edit-link {
      margin-top: 20px;
      display: inline-block;
      color: #FFC300;
      text-decoration: none;
      font-weight: bold;
    }

    .edit-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <header class="navbar">
    <div class="logo">
      <img src="{{ asset('assets/logo.png') }}" alt="Logo" />
    </div>
    <div class="logo-text">BiPSU Anxiety Monitoring System</div>
  </header>

  <!-- Profile Page Content -->
  <div class="container">
    <h1>Profile Information</h1>

    <div class="profile-field">
     <span>Last Name:</span> <input type="text" value="{{ $student->last_name }}">
    </div>
    <div class="profile-field">
      <span>First Name:</span><input type="text"  value="{{ $student->first_name }}">
    </div>
    <div class="profile-field">
      <span>Middle Name:</span> <input type="text" value="{{ $student->middle_name }}">
    </div>
    <div class="profile-field">
      <span>Birth Date:</span> <input type="text" value="{{ $student->birthdate }}">
    </div>
    <div class="profile-field">
      <span>Sex:</span> {{ $student->sex }}
    </div>
    <div class="profile-field">
      <span>Program:</span> {{ $student->program->program_name }}
    </div>
    <div class="profile-field">
      <span>Mobile Number:</span> {{ $student->mobile_number }}
    </div>
    <div class="profile-field">
      <span>Email:</span> {{ $student->email }}
    </div>
    <div class="profile-field">
      <span>Province:</span> {{ $student->province }}
    </div>
    <div class="profile-field">
      <span>Municipality:</span> {{ $student->municipality }}
    </div>
    <div class="profile-field">
      <span>Barangay:</span> {{ $student->barangay }}
    </div>

    <a href="{{ route('student.update', $student->student_id) }}" class="edit-link">Update Profile</a>
  </div>

</body>
</html>
