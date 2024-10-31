<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MLController extends Controller
{
    // This method will handle the KNN algorithm and form submission
    public function algorithm(Request $request)
    {
        // Collect user input for AS1 to AS21
        $testInstance = [];
        for ($i = 1; $i <= 21; $i++) {
            $testInstance[] = $request->input("AS$i", 0); // Default to 0 if not set
        }

        // Example: You can print the test instance to see the user input
        // return response()->json(['Test Instance' => $testInstance]);

        // Function to calculate Euclidean distance
        function calculateEuclideanDistance($data1, $data2)
        {
            $distance = 0;
            for ($i = 0; $i < count($data1); $i++) {
                $distance += pow(($data1[$i] - $data2[$i]), 2);
            }
            return sqrt($distance);
        }

        // KNN algorithm implementation
        function knn($trainingData, $trainingLabels, $testInstance, $k)
        {
            $distances = [];

            // Calculate distances from test instance to all training instances
            foreach ($trainingData as $index => $trainInstance) {
                $distance = calculateEuclideanDistance($trainInstance, $testInstance);
                $distances[] = ['distance' => $distance, 'label' => $trainingLabels[$index]];
            }

            // Sort distances by ascending order
            usort($distances, function ($a, $b) {
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
        $dataset = DB::table('anxiety_dataset')->get(['q1', 'q2', 'q3', 'q4', 'q5', 'q6', 'q7', 'q8', 'q9', 'q10', 'q11', 'q12', 'q13', 'q14', 'q15', 'q16', 'q17', 'q18', 'q19', 'q20', 'q21', 'LAnxiety']);

        if ($dataset->isNotEmpty()) {
            $trainingData = [];
            $trainingLabels = [];

            // Prepare the dataset for KNN
            foreach ($dataset as $row) {
                $trainingData[] = [
                    (int) $row->q1, (int) $row->q2, (int) $row->q3, (int) $row->q4, (int) $row->q5,
                    (int) $row->q6, (int) $row->q7, (int) $row->q8, (int) $row->q9, (int) $row->q10,
                    (int) $row->q11, (int) $row->q12, (int) $row->q13, (int) $row->q14, (int) $row->q15,
                    (int) $row->q16, (int) $row->q17, (int) $row->q18, (int) $row->q19, (int) $row->q20,
                    (int) $row->q21
                ];
                $trainingLabels[] = $row->LAnxiety;
            }

            // Apply KNN classification
            $k = 3; // Set the number of nearest neighbors
            $prediction = knn($trainingData, $trainingLabels, $testInstance, $k);

            // Output the prediction (You can return it as JSON or pass it to the view)
            return response()->json([
                'testInstance' => $testInstance,
                'predicted_anxiety_level' => $prediction
            ]);
        } else {
            return response()->json(['message' => 'No data found in the database.']);
        }
    }
}
