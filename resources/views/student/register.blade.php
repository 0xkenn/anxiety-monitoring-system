<!DOCTYPE html>
<html>
<head>
  <title>Registration Form</title>
  <link rel="shortcut icon" href="{{ asset('assets/favicon.ico') }}" type="image/x-icon">
  
  
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <style>
    /* Navbar */
    .navbar {
      background-color:#FFC300;
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
      font-weight: bold; /* Bold the logo text */
    }

    /* Other Styles */
    body {
      height: 100vh;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      padding-top: 60px;
      font-family: 'Poppins', sans-serif;
    }

    h1 {
      
      margin: 20px;
      text-align: center; 
      font-family: 'Poppins', sans-serif;
      font-size: 22px; 
      color: whitesmoke; 
      font-weight: 550; 
      letter-spacing: 1px; 
      text-transform: uppercase; 
      text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2); 
    }

    .container {
      background-color: #5e85ed;
      padding: 20px;
      margin: 10px;
      display: flex;
      flex-direction: column;
      align-items: center;
      height: calc(95vh - 60px);
      width: 330px;
      overflow-y: auto;
      margin-bottom: 160px;
      margin-top: 200px;
    }

    .input-group {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      margin-bottom: 10px;
      position: relative;
      text-align: left;
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
      margin-top: 15px;
      box-sizing: border-box;
    }

    .label {
      position: absolute;
      top: 50%;
      color: black;
      font-size: 0px;
      pointer-events: none;
      opacity: 0.7;
      transition: all 0.3s ease;
      text-align: left;
      padding-left: 10px;
      
    }

    .input-field:focus + .label,
    .input-field:valid + .label,
    .input-field:not(:placeholder-shown) + .label {
      top: -3px;
      font-size: 14px;
      color:black;
      font-weight: bold;
      margin-left: 13px;
      
    }

    .input-field::placeholder {
      color: black;
      font-size: 12px;
      opacity: 1;
      font-weight: bold;
      text-align: left;
    }

    .h1-heading {
      font-size: 17px;
      margin: 20px 0;
      text-align: left;
      margin-left: -10px;
      font-weight: normal; 
      color: white;
    }

    .inline-fields {
      display: flex;
      justify-content: flex-start;
      margin-bottom: 10px;
      height: 40px;
    }

    .dropdown {
      
        width: 100%;
        padding: 8px;
        font-size: 14px;
        border: none;
        background: whitesmoke;
        outline: none;
        border-radius: 25px;
        text-align: center;
        color: black;
        font-weight: bold;
        font-family: 'Poppins', sans-serif;
        margin-top: 15px;
        box-sizing: border-box;
}
    

    .button {
       width: 100%;
        padding: 8px;
        font-size: 14px;
        border: none;
        background: #FFC300;
        outline: none;
        border-radius: 25px;
        text-align: center;
        color: black;
        font-family: 'Poppins', sans-serif;
        font-weight: bold;
        margin-top: 15px;
        box-sizing: border-box;
    }

    .address-text {
      font-size: 12px;
      color: white;
      
    }

    .text-link {
      text-align: center;
      color: black;
      margin-top: 10px;
      font-size: 13px;
      
    }

    .sign-in {
      color: whitesmoke;
      text-decoration: underline;
      font-weight: bold;
    }

    .show-password-label {
      color: white;
      font-size: 10px;
      cursor: pointer;
      text-align: left;
      margin-top: -8px;
      margin-bottom: -15px;
      margin-left: 8px;
      
      
    }
  </style>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
   <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
</head>
  

</head>
<body>
  <!-- Navbar -->
  <header class="navbar">
    <div class="logo">
      <img src="{{ asset('assets/logo.png') }}" alt="Logo" />
    </div>
    <div class="logo-text">BiPSU Anxiety Monitoring System</div>
  </header>

  <div class="container">
    <h1>Registration </h1>
    <div class="registration-section">
      <!-- Registration Form -->
      <form method ="POST" action="{{ route('student.store') }}" 
    >
        @csrf
         <div class="input-group">
          <select  class="input-field" name="program_id" id="program_id" required placeholder="School ID" value={{ old('program_id') }}  x-model='school' x-on:change="onSchoolChange">
            <option >Select a Progam</option>
         @foreach ($programs as $program)
         <option value="{{ $program->id }}">{{ $program->program_name }}</option>
             @endforeach
       
          </select>
          <label class="label">School ID</label>
           @error('program_id')
            <div><p class="text-danger">{{ $message }}</p>
</div>


          @enderror
        </div>


        
        <div class="input-group">
          <input type="text" class="input-field" name="user_id" required placeholder="User ID"  value={{ old('user_id') }}>
          <label class="label">User ID</label>
          @error('user_id')
            <div><p class="text-danger">{{ $message }}</p>
</div>
          @enderror
        </div>
        <div class="input-group">
          <input type="password" class="input-field" name="password" id="password" required placeholder="Password" value={{ old('password') }}>
          <label class="label">Password</label>
           @error('password')
            <div><p class="text-danger">{{ $message }}</p>
</div>
          @enderror
        </div>
        
        <div class="input-group">
          <p class="show-password-label">
            <input type="checkbox" id="show-password">
            Show Password
          </p>
        </div>
        <div class="input-group">
          <input type="password" class="input-field" name="password_confirmation" id="confirm-password" required placeholder="Confirm Password"  value={{ old('confirm_password') }}>

          <label class="label">Confirm Password</label>
        </div>
          @error('password_confirmation')
            <div><p class="text-danger">{{ $message }}</p>
</div>
          @enderror
        <h3 class="h1-heading">Personal Information</h3>
        <div class="input-group">
          <input type="text" class="input-field" name="last_name" required placeholder="Last Name"  value={{ old('last_name') }}>
          <label class="label">Last Name</label>
        </div>
          @error('last_name')
            <div><p class="text-danger">{{ $message }}</p>
</div>
          @enderror
        <div class="input-group">
          <input type="text" class="input-field" name="first_name" required placeholder="First Name"  value={{ old('first_name') }}>
          <label class="label">First Name</label>
        </div>
          @error('first_name')
            <div><p class="text-danger">{{ $message }}</p>
</div>
          @enderror
        <div class="input-group">
          <input type="text" class="input-field" name="middle_name" required placeholder="Middle Name"  value={{ old('middle_name') }}>
          <label class="label">Middle Name</label>
        </div>
          @error('middle_name')
            <div><p class="text-danger">{{ $message }}</p>
</div>
          @enderror
        <div class="input-group">
          <input type="date" class="input-field" name="birthdate" required placeholder="Birth Date"  value={{ old('birthdate') }}>
          <label class="label">Birth Date</label>
        </div>
          @error('birthdate')
            <div><p class="text-danger">{{ $message }}</p>
</div>
          @enderror
        <div class="input-group">
          <select class="dropdown" name="sex" required  value={{ old('sex') }}>
            <option value="" disabled selected>Sex</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
          </select>
          <label class="label">Sex</label>
        </div>
          @error('sex')
            <div><p class="text-danger">{{ $message }}</p>
</div>
          @enderror
       
        <div class="input-group">
          <input type="text" class="input-field" name="mobile_number" required placeholder="Mobile Number"  value={{ old('mobile_number') }}>
          <label class="label">Mobile Number</label>
        </div>
          @error('mobile_number')
            <div><p class="text-danger">{{ $message }}</p>
</div>
          @enderror
        <div class="input-group">
          <input type="email" class="input-field" name="email" required placeholder="Email"  value={{ old('email') }}>
          <label class="label">Email</label>
        </div>
          @error('email')
            <div><p class="text-danger">{{ $message }}</p>
</div>
          @enderror
        <div class="input-group">
          <input type="text" class="input-field" name="province" required placeholder="Province"  value={{ old('province') }}>
          <label class="label">Province</label>
        </div>
          @error('province')
            <div><p class="text-danger">{{ $message }}</p>
</div>
          @enderror
        <div class="input-group">
          <input type="text" class="input-field" name="municipality" required placeholder="Municipality"  value={{ old('municipality') }}>
          <label class="label">Municipality</label>
        </div>
          @error('municipality')
            <div><p class="text-danger">{{ $message }}</p>
</div>
          @enderror
        <div class="input-group">
          <input type="text" class="input-field" name="barangay" required placeholder="Barangay"  value={{ old('barangay') }}>
          <label class="label">Barangay</label>
        </div>
          @error('barangay')
            <div><p class="text-danger">{{ $message }}</p>
</div>
          @enderror
        <button type="submit" class="button">Register</button>
        
      </form>
      <p class="text-link">Already have an account? <a href="{{ route('student.login') }}" class="sign-in">Login</a></p>
    </div>
  </div>
  
  <script>
    document.getElementById('show-password').addEventListener('change', function() {
      const passwordField = document.getElementById('password');
      const confirmPasswordField = document.getElementById('confirm-password');
      if (this.checked) {
        passwordField.type = 'text';
        confirmPasswordField.type = 'text';
      } else {
        passwordField.type = 'password';
        confirmPasswordField.type = 'password';
      }
    });
  </script>
</body>
</html>
