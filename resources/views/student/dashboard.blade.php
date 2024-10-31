@extends('layouts.student')

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
      <a href="{{ url('/student/history') }}" target="main-content"><i class="fas fa-calendar-alt"></i> History</a>
      <a href="{{ url('/student/contact') }}" target="main-content"><i class="flip-icon fas fa-phone"></i> Contact Us</a>
           <div class="nav-item">
      </div>
      <div class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" id="profileDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false" title="Profile">
          <i class="fas fa-user"></i> Profile
        </a>
        <div class="dropdown-menu" aria-labelledby="profileDropdown">
          <a class="dropdown-item" href="#"><i class="fas fa-user"></i> Profile</a>
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
          <iframe name="main-content" id="main-content" src="{{ url('/student/home') }}" frameborder="0" scrolling="auto"></iframe>
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
