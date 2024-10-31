<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roles Selection</title>
    <link rel="shortcut icon" href="{{ asset('assets/favicon.ico') }}" type="image/x-icon">
    
    <!-- Link to Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        p, li {
            font-size: 18px;
        }
        a {
            text-decoration: none;
        } 
        body {
            background-image: url('{{ asset('assets/Bipsu.jpg') }}'); 
            background-size: cover;
            background-position: center bottom; 
            background-repeat: no-repeat;
            position: relative;
            height: 100vh;
            overflow: hidden;
            margin: 0; 
        }

        /* Overlay to make content more visible */
        .background-overlay {
            position: fixed; 
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 1, 0.6); 
            z-index: -1; 
        }

        nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 60px;
            background-color: #FFC300;
            padding: 10px 20px;
            color: black;
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 100;
            transition: padding 0.3s ease;
        }
        .logo {
            font-size: 18px;
            margin-right: 20px; 
        }
        .logo img {
            width: 30px;
            height: 30px;
            margin: 10px;
            vertical-align: middle;
        }
        .logo span {
            font-weight: bold; 
        }

        .container {
            width: 400px;
            margin: 135px auto; 
            padding: 20px;
            background: transparent;
            border: none; 
            box-shadow: none; 
            height: 400px;
            display: flex;
            justify-content: center; 
            align-items: center; 
            flex-wrap: wrap;
        }

        .vertical-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex-basis: 100%; 
        }

        .vertical-content div {
            margin: 10px;
            text-align: center;
            padding: 7px;
            border-radius: 15px;
            margin-top: 10px;
            min-width: 150px; 
        }

        .vertical-content div a {
            font-size: 14px;
        }

        .student, .employee, .guidance-coordinator, .counselor, .admin {
            background: #4169E1;
            color: white;
        }

        .student a, .employee a, .guidance-coordinator a, .counselor a, .admin a {
            color: white;
        }

        /* add media queries for responsive design */
        @media only screen and (max-width: 768px) {
            nav {
                padding: 10px;
                flex-direction: column;
                height: auto;
            }

            .logo {
                font-size: 16px;
                display: flex;
                align-items: center;
            }

            .logo img {
                width: 25px;
                height: 25px;
                margin-right: 10px;
            }

            .container {
                width: 300px;
            }

            .vertical-content div {
                width: 100px;
            }
        }

        @media only screen and (max-width: 480px) {
            nav {
                padding: 5px;
            }

            .logo {
                font-size: 14px;
            }

            .logo img {
                width: 20px;
                height: 20px;
                margin-right: 5px;
            }

            .container {
                width: 200px;
            }

            .vertical-content div {
                width: 80px;
            }

            .vertical-content div a {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="background-overlay"></div>
    <nav>
        <div class="logo">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo">
            <span>BiPSU Anxiety Monitoring System</span>
        </div>
    </nav>
    
    <section class="sec1">
        <section class="content">
            <div class="container">
                <div class="vertical-content">
                    <div class="student">
                        @if (auth()->guard('student')->check())
                            <a href="{{ route('student.dashboard') }}">Dashboard</a>
                            @else
                            <a href="{{ route('student.login') }}">Student</a>
                        @endif
                       
                    </div>
                    <div class="employee">
                        @if (auth()->guard('employee')->check())
                           <a href="{{ route('employee.dashboard') }}">Dashboard</a>
                        @else
                            <a href="{{ url('/employee/login') }}">Employee</a>
                        @endif
                    </div>
                    <div class="guidance-coordinator">
                      @if (auth()->guard('coordinator')->check())
                            <a href="{{ route('guidance_coordinator.dashboard') }}">Dashboard</a>
                      @else
                            <a href="{{ url('/coordinator/login') }}">Coordinator</a>
                      @endif
                    </div>
                    <div class="counselor">
                        @if (auth()->guard('counselor')->check())
                            <a href="{{ route('counselor.dashboard') }}">Dashboard</a>
                        @else
                            <a href="{{ url('/counselor/login') }}">Counselor</a>
                        @endif
                    </div>
                    <div class="admin">
                        <a href="{{ url('/admin/login') }}">Admin</a>
                    </div>
                </div>
            </div>
        </section>
    </section>

    <script type="text/javascript">
        window.addEventListener('scroll', function(){
            const nav = document.querySelector('nav');
            // Add your scroll event logic here
        });
    </script>
</body>
</html>
