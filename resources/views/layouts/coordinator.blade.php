<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Coordinator Page</title>
    <link rel="shortcut icon" href="{{ asset('assets/favicon.ico') }}" type="image/x-icon">
  
  <!-- Google Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap">
  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha512-..." crossorigin="anonymous" />
  
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-..." crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-..." crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-..." crossorigin="anonymous"></script>
  
  <style>
    /* Apply Poppins font */
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
    }

    .container {
      margin-top: 20px;
      max-width: 100%;
    }

    .header-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 15px;
    }

    .table-container {
      width: 110%;
    }

    table {
      width: 100%;
      table-layout: auto;
      border-collapse: collapse;
    }

    th,
    td {
      word-wrap: break-word;
      white-space: normal;
      padding: 10px;
      text-align: left;
      border: 1px solid #dee2e6;
    }

    /* Set column-specific widths */
    th:nth-child(1),
    td:nth-child(1) {
      width: 1%;
    }

    th:nth-child(2),
    td:nth-child(2) {
      width: 8%;
    }

    th:nth-child(3),
    td:nth-child(3) {
      width: 25%;
    }

    th:nth-child(4),
    td:nth-child(4) {
      width: 2%;
    }

    th:nth-child(5),
    td:nth-child(5) {
      width: 1%;
    }

    th:nth-child(6),
    td:nth-child(6) {
      width: 1%;
    }

    th:nth-child(7),
    td:nth-child(7) {
      width: 2%;
    }

    th:nth-child(8),
    td:nth-child(8) {
      width: 10%;
    }

    th:nth-child(9),
    td:nth-child(9) {
      width: 20%;
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
      z-index: 2;
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
      background-color: #FFC300 !important;
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

    /* Main content and canvas adjustments */
    main {
      margin-top: 70px;
      margin-left: 220px;
      padding: 20px;
    }

    canvas {
      max-width: 100%;
      max-height: auto;
      margin: auto;
    }

    @media (max-width: 767px) {
      main {
        margin-left: 0;
      }

      .sidebar {
        top: 60px;
      }

      .sidebar.active {
        transform: translateX(0);
      }
    }

    /* Ensures Home link remains highlighted */
    .sidebar a.home-active {
      color: black;
      padding-left: 20px;
      padding-right: 20px;
      font-weight: bold;
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
      <a href="{{ route('guidance_coordinator.dashboard') }}" target="main-content" class="active home-active"><i class="fas fa-home"></i> Home</a>
      <a href="{{ url('/coordinator/student') }}" target="main-content"><i class="fas fa-graduation-cap"></i> Student</a>
      <a href="{{ url('/coordinator/employee') }}" target="main-content"><i class="fas fa-users"></i> Employee</a>
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
          <form action="{{ route('guidance_coordinator.logout') }}" method="post">@csrf
            <button class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</button>
          </form>
        </div>
      </div>
    </div>
    @yield('content')
  </div>
  <script>
    $(document).ready(function () {
      var sidebarLinks = document.querySelectorAll('.sidebar a');

      sidebarLinks.forEach(function (link) {
        link.addEventListener('click', function () {
          sidebarLinks.forEach(function (link) {
            link.classList.remove('active');
          });
          this.classList.add('active'); // Only the clicked link gets active class
        });
      });
    });
  </script>
</body>

</html>
