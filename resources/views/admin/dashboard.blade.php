@extends('layouts.admin')

  <div class="flex flex-col flex-1 w-full">
 

   
        <div class="content">
          <iframe name="main-content" id="main-content" src="{{ url('/admin/home') }}" frameborder="0" scrolling="auto"></iframe>
        </div>
     

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
  </div>
