<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Student Dashboard Page</title>
  <link rel="shortcut icon" href="{{ asset('assets/favicon.ico') }}" type="image/x-icon">
  
  <!-- Google Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap">
  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />

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
      transition: color 0.3s, background-color 0.3s;
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

    /* Flip the phone icon */
    .flip-icon {
      transform: scaleX(-1); 
      display: inline-block; 
    }

    /* Navbar styles */
    #main-navbar {
      background-color: #FFC300!important;
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

    /* iframe */
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
      display: none;
    }

    .dropdown-menu.show {
      display: block;
      background: #4169E1; 
    }
    .container {
      width: 100%; 
      max-width: 900px;
      margin: 0 auto; 
      position: relative; 
      padding: 0;
      height: auto;
    }

    .container img {
      width: 100%; 
      height: auto; 
      display: block;
      padding: 0;
    }

    .text-wrapper {
      position: absolute;
      top: 110px;
      right: 20px; 
      font-family: 'Poppins', sans-serif;
      width: calc(100% - 40px); 
      max-width: 400px; 
      margin-right: -50px;
    }

    .text-24 {
      font-size: 36px;
      margin-bottom: 20px;
      line-height: 1.2;
    }

    .text-24 .line1 {
      color: black;
      font-weight: bold;
    }

    .text-24 .line2 {
      color: yellow;
      white-space: nowrap;
      font-weight: bold;
    }

    .text-14 {
      font-size: 16px;
      color: rgba(14, 1, 20, 0.959);
      text-align: right;
      line-height: 1.3;
      margin-top: 90px; 
      white-space: normal; 
      margin-right: 90px;
    }

    .link {
      position: absolute;
      bottom: 40px; 
      right: 20px; 
      margin-bottom: 40px; 
    }

    a {
      text-decoration: none;
      color: blue;
      font-size: 16px;
      font-family: 'Poppins', sans-serif;
      font-weight: bold;
    }

    a span {
      margin-left: 5px;
    }

    a:hover {
      color: darkblue;
    }

    /* Media Queries for responsiveness */
    @media (max-width: 768px) {
      .text-24 {
        font-size: 28px;
      }

      .text-14 {
        font-size: 12px;
      }

      .text-wrapper {
        right: 10px; 
        max-width: 300px; 
      }
    }

    @media (max-width: 576px) {
      .text-24 {
        font-size: 24px;
      }

      .text-14 {
        font-size: 10px;
        margin-top: 30px;   
      }

      .link {
        bottom: 50px;
        right: 10px; 
        font-size: 10px;
      }
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
      <a href="{{ url('/student/home') }}" target="main-content" class="active"><i class="fas fa-home"></i> Home</a>
      <a href="{{ url('/student/assessment') }}" target="main-content"><i class="fas fa-clipboard-check"></i> Assessment</a>
      <a href="{{ route('student.history') }}" target="main-content"><i class="fas fa-calendar-alt"></i> History</a>
      <a href="{{ url('/student/contact') }}" target="main-content"><i class="flip-icon fas fa-phone"></i> Contact Us</a>
           <div class="nav-item">
      </div>
      <div class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" id="profileDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false" title="Profile">
          <i class="fas fa-user"></i> Profile
        </a>
        <div class="dropdown-menu" aria-labelledby="profileDropdown">
          <a class="dropdown-item" href="{{ route('student.update', $studentId) }}"><i class="fas fa-user"></i> Profile</a>
          <form action="{{ route('student.logout') }}" method="POST" >
            @csrf
            <button class="dropdown-item" ><i class="fas fa-sign-out-alt" ></i> Logout</button>
          </form>
        </div>
      </div>
    </div>

    <main class="h-full overflow-y-auto">
      <div class="container px-6 mx-auto grid bg">
        <div class="content">
         @yield('content')
        </div>
      </div>
    </main>
     
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-..." crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-..." crossorigin="anonymous"></script>

    <script>
      $(document).ready(function () {
        var sidebarLinks = document.querySelectorAll('.sidebar a');

        sidebarLinks.forEach(function (link) {
          link.addEventListener('click', function () {
            sidebarLinks.forEach(function (link) {
              link.classList.remove('active');
            });
            this.classList.add('active');

            var sidebar = document.getElementById('sidebar');
            var sidebarToggle = document.getElementById('sidebar-toggle');

            if (window.innerWidth < 768) {
              sidebar.classList.remove('active');
              sidebarToggle.classList.remove('active');
            }
          });
        });

        var sidebarToggle = document.getElementById('sidebar-toggle');
        sidebarToggle.addEventListener('click', function () {
          this.classList.toggle('active');
          var sidebar = document.getElementById('sidebar');
          sidebar.classList.toggle('active');
        });

        // Dropdown toggle
        $('.dropdown-toggle').on('click', function () {
          $(this).next('.dropdown-menu').toggleClass('show');
        });

        $(document).on('click', function (e) {
          if (!$(e.target).closest('.dropdown-toggle').length) {
            $('.dropdown-menu').removeClass('show');
          }
        });
      });

      window.addEventListener('resize', function () {
        var sidebar = document.getElementById('sidebar');
        var sidebarToggle = document.getElementById('sidebar-toggle');

        if (window.innerWidth >= 768) {
          sidebar.classList.add('active');
          sidebarToggle.classList.add('active');
        } else {
          sidebar.classList.remove('active');
          sidebarToggle.classList.remove('active');
        }
      });
    </script>
  </div>
</body>

</html>
