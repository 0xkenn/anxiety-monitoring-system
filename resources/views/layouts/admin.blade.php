<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Admin Page</title>
  <link rel="shortcut icon" href="{{ asset('assets/favicon.ico') }}" type="image/x-icon">
  
  <!-- Google Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap" rel="stylesheet">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
   
    /*iframe*/
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

    .modal-body {
      margin-top: 15px;
    }

    .modal-footer {
      display: flex;
      justify-content: flex-end;
      margin-top: 20px;
    }

    .close {
      color: #888;
      float: right;
      font-size: 24px;
      font-weight: bold;
      cursor: pointer;
    }

    .close:hover {
      color: #333;
    }
  </style>
</head>

<body>
  <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-primary">
    <button class="navbar-toggler sidebar-toggler" type="button" data-toggle="collapse" data-target="#sidebar"
      aria-controls="sidebar" aria-expanded="false" aria-label="Toggle sidebar" id="sidebar-toggle">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">
      <img src="{{ asset('assets/logo.png') }}" alt="Logo">
      <span>Bipsu Anxiety Monitoring System</span>
    </a>
  </nav>

  <div class="sidebar" id="sidebar">
    <!-- Sidebar content -->
    <a href="{{ url('/admin/home') }}" target="main-content" class="{{ request()->is('admin/home') ? 'active' : '' }}">
      <i class="fas fa-home"></i> Home
    </a>
    <a href="{{ url('/admin/verify') }}" target="main-content" class="{{ request()->is('admin/verify') ? 'active' : '' }}">
      <i class="fas fa-check-circle"></i> Verification
    </a>
    <a href="{{ url('/admin/report') }}" target="main-content" class="{{ request()->is('admin/report') ? 'active' : '' }}">
      <i class="fas fa-file-alt"></i> Report
    </a>
    <a class="dropdown-item" href="{{ route('admin.student.index') }}" class="{{ request()->is('admin/student*') ? 'active' : '' }}">
      <i class="fas fa-user-graduate"></i> Student
    </a>
    <a class="dropdown-item" href="{{ route('admin.employee.index') }}" class="{{ request()->is('admin/employee*') ? 'active' : '' }}">
      <i class="fas fa-user"></i> Employee
    </a>
    <a class="dropdown-item" href="{{ route('show.coordinator') }}" class="{{ request()->is('admin/coordinator') ? 'active' : '' }}">
      <i class="fas fa-user-shield"></i> Coordinator
    </a>
    <a class="dropdown-item" href="{{ route('counselor.show') }}" class="{{ request()->is('admin/counselor') ? 'active' : '' }}">
      <i class="fas fa-user-md"></i> Counselor
    </a>
    <a class="dropdown-item" href="{{ url('/admin/addschool') }}" class="{{ request()->is('admin/addschool') ? 'active' : '' }}">
      <i class="fas fa-school"></i> School
    </a>
    <a class="dropdown-item" href="{{ route('admin.program') }}" class="{{ request()->is('admin/program') ? 'active' : '' }}">
      <i class="fas fa-book-open"></i> Program
    </a>
    <form class="dropdown-item" action="{{ route('admin.logout') }}" method="post">@csrf
     <button> <i class="fas fa-sign-out-alt">Logout</i> </button>
    </form>
  </div>

  <main class="h-full overflow-y-auto">
    <div class="container px-6 mx-auto grid bg">
      @yield('content')
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
