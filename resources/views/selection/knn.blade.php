<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect user input for AS1 to AS21
	
	//$pid=post[]
	//$age=POSt[]
	//$y=POST[]
	//.
	//.
	//. include all atrributes
	
	
    $testInstance = [];
    for ($i = 1; $i <= 21; $i++) {
        $testInstance[] = isset($_POST["AS$i"]) ? (int)$_POST["AS$i"] : 0;  // Default to 0 if not set
    }

    // Example: You can print the test instance to see the user input
    echo "Test Instance: ";
    print_r($testInstance);

    // Database connection settings
    $servername = "localhost";  // Your server name
    $username = "root";         // Your database username
    $password = "";             // Your database password
    $dbname = "your_database";  // Your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Function to calculate Euclidean distance
    function calculateEuclideanDistance($data1, $data2) {
        $distance = 0;
        for ($i = 0; $i < count($data1); $i++) {
            $distance += pow(($data1[$i] - $data2[$i]), 2);
        }
        return sqrt($distance);
    }

    // KNN algorithm implementation
    function knn($trainingData, $trainingLabels, $testInstance, $k) {
        $distances = [];

        // Calculate distances from test instance to all training instances
        foreach ($trainingData as $index => $trainInstance) {
            $distance = calculateEuclideanDistance($trainInstance, $testInstance);
            $distances[] = ['distance' => $distance, 'label' => $trainingLabels[$index]];
        }

        // Sort distances by ascending order
        usort($distances, function($a, $b) {
            return $a['distance'] <=> $b['distance'];
        });

        // Get top K nearest neighbors
        $neighbors = array_slice($distances, 0, $k);

        // Count the votes for each class
        $classVotes = [];
        foreach ($neighbors as $neighbor) {
            $label = $neighbor['label'];
            if (!isset($classVotes[$label])) {
                $classVotes[$label] = 0;
            }
            $classVotes[$label]++;
        }

        // Return the class with the most votes
        arsort($classVotes);
        return key($classVotes);
    }

    // Fetch the dataset from the database
    $sql = "SELECT'q1', 'q2', 'q3', 'q4', 'q5', 'q6', 'q7', 'q8', 'q9', 
  'q10', 'q11', 'q12', 'q13', 'q14', 'q15', 'q16', 
  'q17', 'q18', 'q19', 'q20', 'q21', LAnxiety FROM anxiety_dataset";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $trainingData = [];
        $trainingLabels = [];

        // Prepare the dataset for KNN
        while ($row = $result->fetch_assoc()) {
            $trainingData[] = [
              (int)$row['q1'], (int)$row['q2'], (int)$row['q3'], (int)$row['q4'], (int)$row['q5'],
              (int)$row['q6'], (int)$row['q7'], (int)$row['q8'], (int)$row['q9'], (int)$row['q10'],
              (int)$row['q11'], (int)$row['q12'], (int)$row['q13'], (int)$row['q14'], (int)$row['q15'],
               (int)$row['q16'], (int)$row['q17'], (int)$row['q18'], (int)$row['q19'], (int)$row['q20'],
              (int)$row['q21']

            ];
            $trainingLabels[] = $row['LAnxiety'];
        }

        // Apply KNN classification
        $k = 3;  // Set the number of nearest neighbors
        $prediction = knn($trainingData, $trainingLabels, $testInstance, $k);

        echo "<br>Predicted anxiety level for the new instance: " . $prediction;
		
		//*****************************************************
		//Insert new records to anxiety records
		// $sql = "INSERT into anxiety_dataset values(profile_ID, age, year, program, AS1, AS2, AS3, AS4, AS5, AS6, AS7, AS8, AS9, AS10, AS11, AS12, AS13, AS14, AS15, AS16, AS17, AS18, AS19, AS20, AS21, score, LAnxiety ");
		//$result = $conn->query($sql);

		//*****************************************************
    } else {
        echo "No data found in the database.";
    }

    // Close connection
    $conn->close();
}
?>
