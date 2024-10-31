<!-- employee_profile.blade.php -->
<!DOCTYPE html>
<html>
<head>
  <title>Employee Profile Page</title>
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

  <!-- Employee Profile Page Content -->
  <div class="container">
    <h1>Employee Profile Information</h1>

    <div class="profile-field">
      <span>Last Name:</span> <input type="text" value=" {{ $employee->last_name }}">
    </div>
    <div class="profile-field">
      <span>First Name:</span> {{ $employee->first_name }}
    </div>
    <div class="profile-field">
      <span>Middle Name:</span> {{ $employee->middle_name }}
    </div>
    <div class="profile-field">
      <span>Birth Date:</span> {{ $employee->birthdate }}
    </div>
    <div class="profile-field">
      <span>Sex:</span> {{ $employee->sex }}
    </div>
    <div class="profile-field">
      <span>Position:</span> {{ $employee->position }}
    </div>
    <div class="profile-field">
      <span>Mobile Number:</span> {{ $employee->mobile_number }}
    </div>
    <div class="profile-field">
      <span>Email:</span> {{ $employee->email }}
    </div>
    <div class="profile-field">
      <span>Province:</span> {{ $employee->province }}
    </div>
    <div class="profile-field">
      <span>Municipality:</span> {{ $employee->municipality }}
    </div>
    <div class="profile-field">
      <span>Barangay:</span> {{ $employee->barangay }}
    </div>

    <button class="edit-link">Edit Profile</button>
  </div>

</body>
</html>
