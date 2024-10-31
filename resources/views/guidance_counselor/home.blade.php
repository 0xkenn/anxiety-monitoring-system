<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .container {
            margin-top: 20px;
        }
        .status-container {
            display: flex;
            justify-content: space-around;
            margin-bottom: 10px;
        }
        .status-box {
            width: 30%;
            padding: 5px;
            color: white;
            border-radius: 10px;
            text-align: left;
            height: 50px;
            display: flex;
            align-items: center;
            margin: 0 5px;
        }
        .icon-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 5px;
            background-color: rgba(255, 255, 255, 0.2);
        }
        .low { background-color: #4CAF50; }
        .moderate { background-color: #FFC107; }
        .severe { background-color: #F44336; }
        .status-box h3 { font-size: 14px; }
        .legend-container {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin-top: 20px;
        }
        .legend-box {
            width: 20px;
            height: 15px;
            border-radius: 5px;
            margin: 0 5px;
        }
        .legend-box span {
            font-size: 8px;
            color: black;
            margin-left: 5px;
        }
        .legend-label {
            display: flex;
            align-items: center;
            margin-right: 15px;
        }
        .dropdown {
            position: relative;
            margin-left: 20px;
            margin-top: 0;
        }
        .dropdown-toggle {
            width: 100%;
        }
        .dropdown-menu {
            position: absolute;
            z-index: 1000;
            display: none;
            margin: 0;
            padding: 0;
            background-color: white;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
        }
        .dropdown-item {
            padding: 10px;
            color: #007bff;
            text-decoration: none;
            display: block;
        }
        .dropdown-item:hover {
            background-color: #f8f9fa;
        }
        /* Combined Color Container for Each School */
        .school-box {
            height: 35px; /* Adjusted height */
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            color: white;
            font-weight: bold;
            font-size: 16px; /* Adjusted font size */
            background: linear-gradient(to right, #4CAF50 33%, #FFC107 33%, #FFC107 66%, #F44336 66%);
        }
        /* Bottom Container Styles */
        .bottom-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .left-container {
            width: 50%;
            background-color: gray;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
            border-radius: 5px;
            margin-top: 60px;
        }
        .right-container {
            width: 45%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background-color: gray;
            padding: 10px;
            border-radius: 5px;
            margin-top: 60px;
        }
        /* Pie Chart Styles */
        .pie-chart-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 250px; /* Increased height */
            position: relative;
            margin: 0 auto;
        }
        .pie-chart {
            width: 200px; /* Increased width */
            height: 200px; /* Increased height */
            border-radius: 50%;
            clip-path: polygon(50% 50%, 100% 0, 100% 100%);
            position: absolute;
        }
        .pie-chart.red {
            background-color: #F44336;
            transform: rotate(0deg);
        }
        .pie-chart.yellow {
            background-color: #FFC107;
            transform: rotate(120deg);
        }
        .pie-chart.green {
            background-color: #4CAF50;
            transform: rotate(240deg);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="status-container">
        <div class="status-box low">
            <div class="icon-circle">
                <i class="fas fa-users fa-lg"></i>
            </div>
            <h3>Low</h3>
        </div>
        <div class="status-box moderate">
            <div class="icon-circle">
                <i class="fas fa-users fa-lg"></i>
            </div>
            <h3>Moderate</h3>
        </div>
        <div class="status-box severe">
            <div class="icon-circle">
                <i class="fas fa-users fa-lg"></i>
            </div>
            <h3>Severe</h3>
        </div>
    </div>

    <!-- Legend Container -->
    <div class="legend-container">
        <div class="legend-label">
            <div class="legend-box low" style="background-color: #4CAF50;"></div>
            <span>Low</span>
        </div>
        <div class="legend-label">
            <div class="legend-box moderate" style="background-color: #FFC107;"></div>
            <span>Moderate</span>
        </div>
        <div class="legend-label">
            <div class="legend-box severe" style="background-color: #F44336;"></div>
            <span>Severe</span>
        </div>

        <!-- Custom Dropdown for Roles -->
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="roleDropdownButton" aria-haspopup="true" aria-expanded="false">
                Select to View
            </button>
            <div class="dropdown-menu" aria-labelledby="roleDropdownButton">
                <a class="dropdown-item" href="#" data-role="students">Students</a>
                <a class="dropdown-item" href="#" data-role="employees">Employees</a>
            </div>
        </div>
    </div>

    <!-- Bottom Inline Containers -->
    <div class="bottom-container">
        <!-- Left: Pie Chart -->
        <div class="left-container">
            <div class="pie-chart-container">
                <div class="pie-chart red"></div>
                <div class="pie-chart yellow"></div>
                <div class="pie-chart green"></div>
            </div>
        </div>

        <!-- Right: School Display -->
        <div class="right-container" id="schoolContainer">
            <!-- Schools will be displayed here based on role selection -->
        </div>
    </div>
</div>

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        // Show dropdown menu on click
        $('.dropdown-toggle').on('click', function() {
            $('.dropdown-menu').toggle();
        });

        // Close dropdown when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.dropdown').length) {
                $('.dropdown-menu').hide();
            }
        });

        // Handle role selection
        $('.dropdown-item').on('click', function() {
            var role = $(this).data('role');
            $('#schoolContainer').empty(); // Clear previous content

            // Display schools based on selected role with combined color blocks
            if (role === 'students' || role === 'employees') {
                const schools = ['LHS', 'SAS', 'SOE', 'SME', 'STED', 'STCS', 'SCJE'];
                schools.forEach(school => {
                    $('#schoolContainer').append(`
                        <div class="school-box">
                            ${school}
                        </div>
                    `);
                });
            }
        });
    });
</script>

</body>
</html>
