<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Counselor Dashboard Page</title>
  <link rel="shortcut icon" href="{{ asset('assets/favicon.ico') }}" type="image/x-icon">
  
  <!-- Google Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap">
  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha512-..." crossorigin="anonymous" />

  <style>
    /* Apply Poppins font */
    body {
      font-family: 'Poppins', sans-serif;
    }

    /* Sidebar styles */
    .sidebar {
      position: fixed;
      top: 60px;
      left: 0;
      bottom: 0;
      width: 200px;
      background-color: #4169E1;
      overflow-y: auto;
      transform: translateX(-100%);
      transition: transform 0.3s ease-in-out;
    }

    .sidebar.active {
      transform: translateX(0);
    }

    .sidebar a {
      display: block;
      color: white;
      padding: 15px; 
      font-size: 18px;
      text-decoration: none;
      transition: color 0.3s, background-color 0.2s;
    }

    .sidebar a.active,
    .sidebar a:hover {
      color: black;
      padding-left: 20px; 
      padding-right: 20px; 
    }

    .sidebar a.active {
      font-weight: bold;
    }

    .sidebar .nav-item {
      margin-bottom: 10px;
    }

    .sidebar .nav-item a {
      padding: 10px 15px; 
    }

    /* Navbar styles */
    #main-navbar {
      background-color:  #FFC300!important;
      padding: 10px;
      position: fixed;
      top: 0;
      width: 100%;
      height: 60px;
      z-index: 1;
    }

    .navbar-brand {
      font-size: 18px;
      font-weight: bold;
      display: flex;
      align-items: center;
    }

    .navbar-brand img {
      width: 30px;
      height: 30px;
      margin-right: 10px;
    }

    .navbar-toggler {
      border: none;
      background: transparent;
      padding: 0;
      font-size: 22px;
      cursor: pointer;
    }

    #sidebar-toggle.active {
      color: white;
    }

    .nav-icons {
      display: flex;
      justify-content: flex-end;
    }

    .nav-icons .nav-link {
      padding: 6px 12px;
      font-weight: bold;
    }

    .nav-icons .nav-link:hover {
      color: white;
    }

    .flex-fill {
      flex-grow: 1;
    }

    /* Responsive styles */
    @media (min-width: 768px) {
      .sidebar {
        transform: translateX(0);
      }

      .sidebar-toggler {
        display: none;
      }
    }

    /*iframe*/
    #main-content {
      height: calc(100vh - 60px);
      margin-left: 200px;
      margin-top: 70px;
      width: calc(100% - 200px);
    }

    @media (max-width: 767px) {
      #main-content {
        margin-left: 0;
        width: 100%;
      }

      .sidebar {
        top: 60px;
      }

      .sidebar.active {
        transform: translateX(0);
      }
    }

    /* Dropdown menu fix */
    .dropdown-menu {
      background: #4169E1; 
      padding: 0;
      margin: 0;
    }

    .dropdown-menu .dropdown-item {
      padding: 10px 15px;
    }

    .dropdown-menu .dropdown-item + .dropdown-item {
      margin-top: -6px; /* Adjust the spacing between items */
    }
  </style>
</head>

<body>
  <div class="flex flex-col flex-1 w-full">
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-primary">
      <button class="navbar-toggler sidebar-toggler" type="button" data-toggle="collapse" data-target="#sidebar"
        aria-controls="sidebar" aria-expanded="false" aria-label="Toggle sidebar" id="sidebar-toggle">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">
        <img src="{{ asset('assets/logo.png') }}" alt="Logo">
        <span>BiPSU Anxiety Monitoring System</span>
      </a>
    </nav>

    <div class="sidebar" id="sidebar">
      <!-- Sidebar content -->
      <a href="{{ route('counselor.dashboard') }}" target="main-content" class="active"><i class="fas fa-home"></i> Home</a>
      <a href="{{ route('counselor.student') }}" target="main-content"><i class="fas fa-graduation-cap"></i> Student</a>
      <a href="{{ url('/counselor/employee') }}" target="main-content"><i class="fas fa-users"></i> Employee</a>
      
      <div class="nav-item">
        <a href="#" class="nav-link" title="Notifications">
          <i class="fas fa-bell"></i> Notifications
        </a>
      </div>
      <div class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" id="profileDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false" title="Profile">
          <i class="fas fa-user"></i> Profile
        </a>
        <div class="dropdown-menu" aria-labelledby="profileDropdown">
          <a class="dropdown-item" href="#"><i class="fas fa-user"></i> Profile</a>
          <a class="dropdown-item" href="{{ url('/counselor/login') }}"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
      </div>
    </div>
    </div>
   
    @yield('content')
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-..." crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
      integrity="sha384-..." crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
      integrity="sha384-..." crossorigin="anonymous"></script>

    <script>
      $(document).ready(function () {
        var sidebarLinks = document.querySelectorAll('.sidebar a');

        sidebarLinks.forEach(function (link) {
          link.addEventListener('click', function () {
            sidebarLinks.forEach(function (link) {
              link.classList.remove('active');
            });
            this.classList.add('active');
          });
        });

        $('#sidebar-toggle').click(function () {
          $('#sidebar').toggleClass('active');
        });
      });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>

</html>