<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
    <link rel="shortcut icon" href="{{ asset('assets/favicon.ico') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">

    <style>
        /* Navbar */
        .navbar {
            background-color: #FFC300;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            color: black;
            flex-wrap: nowrap;
        }

        .navbar-logo {
            height: 30px;
            width: 30px;
            margin-right: 5px;
        }

        .navbar-title {
            font-family: 'Poppins', sans-serif;
            font-weight: bold;
            font-size: 18px;
            flex-shrink: 1;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
            height: 100vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .center {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 90%;
            max-width: 350px;
            background: #5e85ed;
            border-radius: 30px;
            padding: 20px;
            box-sizing: border-box;
            border: 2px solid #ffffff;
        }

        h1 {
            text-align: center;
            font-family: 'Poppins', sans-serif;
            font-size: 22px;
            color: whitesmoke;
            margin-top: -10px;
            margin-bottom: 15px;
            font-weight: 550;
            letter-spacing: 1px;
            text-transform: uppercase;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        }

        .login_form {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .txt_field {
            margin: 15px 0 5px 0;
            width: 100%;
            position: relative;
            max-width: 220px;
        }

        .txt_field input {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            border: none;
            background: whitesmoke;
            outline: none;
            border-radius: 25px;
            text-align: center;
            font-family: 'Poppins', sans-serif;
        }

        .txt_field label {
            position: absolute;
            top: 50%;
            left: 20px;
            transform: translateY(-50%);
            font-size: 12px;
            transition: all 0.3s ease;
            pointer-events: none;
        }

        .txt_field input:focus + label,
        .txt_field input:valid + label {
            top: -10px;
            left: 20px;
            color: black;
            font-size: 14px;
        }

        .options {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            width: 100%;
            max-width: 220px;
            margin: 5px 0 10px 0;
            font-size: 12px;
        }

        .toggle_password {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
            color: #ffffff;
        }

        .toggle_password input[type="checkbox"] {
            margin-right: 5px;
        }

        .forgot {
            color: #000000;
            cursor: pointer;
            text-decoration: underline;
            text-align: right;
            align-self: flex-end;
        }

        .forgot:hover {
            font-weight: bold;
        }

        input[type="submit"] {
            width: 100%;
            max-width: 220px; 
            height: 35px;
            border: none;
            background-color: #FFC300;
            border-radius: 30px;
            font-size: 16px;
            color: #000000;
            font-weight: 700;
            cursor: pointer;
            outline: none;
            margin-top: 20px;
            font-family: 'Poppins', sans-serif;
        }

        input[type="submit"]:hover {
            background-color: #ffdb4d;
            transition: .5s;
        }

        .users_signup {
            margin: 20px 0;
            text-align: center;
            font-size: 13px;
            color: black;
        }

        .users_signup a {
            color: whitesmoke;
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            .navbar-title {
                font-size: 18px;
            }

            .center {
                width: 85%;
                padding: 15px;
            }

            h1 {
                font-size: 24px;
            }

            .txt_field input {
                padding: 7px;
            }

            input[type="submit"] {
                width: 80%;
                height: 30px;
                font-size: 15px;
            }

            .users_signup {
                font-size: 11px;
            }
        }

        @media (max-width: 480px) {
            .navbar-title {
                font-size: 16px;
            }

            .center {
                width: 95%;
                padding: 10px;
                margin-bottom: 20px;
            }

            h1 {
                font-size: 22px;
            }

            .txt_field input {
                padding: 6px;
            }

            input[type="submit"] {
                width: 90%;
                height: 30px;
                font-size: 12px;
            }

            .options {
                font-size: 11px;
            }

            .users_signup {
                font-size: 11px;
            }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <img src="{{ asset('assets/logo.png') }}" alt="BiPSU Logo" class="navbar-logo">
        <span class="navbar-title">BiPSU Anxiety Monitoring System</span>
    </div>
    <div class="container">
        <div class="center">
            <h1>Login</h1>
            <form action="{{ route('auth.admin.login') }}" class="login_form" method="post">@csrf
                <div class="txt_field">
                    <input type="text" required autocomplete="off" name="user_id">
                    <label>User ID</label>
                    @error('user_id')
                        <p style="color: red;">{{ message }}</p>
                    @enderror
                </div>
                <div class="txt_field">
                    <input type="password" id="passwordInput" required autocomplete="off" name="password">
                    @error('password')
                        <p style="color: red;">{{ message }}</p>
                    @enderror
                    <label>Password</label>
                </div>
                <div class="options">
                    <div class="toggle_password">
                        <input type="checkbox" onclick="togglePasswordVisibility()">
                        <span>Show Password</span>
                    </div>
                    <div class="forgot">Forgot Password?</div>
                </div>

                <!-- Updated login button -->
                <input type="submit" value="Login">

            </form>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("passwordInput");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
    </script>
</body>
</html>
