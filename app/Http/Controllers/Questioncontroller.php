<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use Auth;
use DB;
use Illuminate\Http\Request;

class Questioncontroller extends Controller
{
     public function questions(QuestionRequest $questionRequest)
    {
        // Validate and get the data from the request
        $data = $questionRequest->validated();
          $currentTime = now();
            
       if (auth()->guard('employee')->check()) {
    $id = Auth::guard('employee')->id();
    $data['employee_id'] = $id;

    $lastAssessment = Question::with('employee')
        ->where('employee_id', $id)
        ->orderBy('created_at', 'desc')
        ->first();
} elseif (auth()->guard('student')->check()) {
    $id = Auth::guard('student')->id();
    $data['student_id'] = $id;

    $lastAssessment = Question::with('student')
        ->where('student_id', $id)
        ->orderBy('created_at', 'desc')
        ->first();
}

         
    
                               

    // Check if the last assessment exists
    if ($lastAssessment) {
        // Get the time when they will be eligible to submit again
        $eligibleTime = $lastAssessment->created_at->addWeeks(2);

        // Check if the eligible time is greater than the current time
        if ($eligibleTime > $currentTime) {
            // Calculate the remaining time
            $remainingTime = $eligibleTime->diffInMinutes($currentTime);
            $remainingMinutes = $remainingTime % 60;
            $remainingHours = ($remainingTime / 60) % 24;
            $remainingDays = floor($remainingTime / 1440);

            return redirect()->back()->with('message', 
            
                ' Oops!! You need to wait ' . 
                ($remainingDays > 0 ? $remainingDays . ' days, ' : '') . 
                ($remainingHours > 0 ? $remainingHours . ' hours, ' : '') . 
                $remainingMinutes . ' minutes  before you can take a new assessment again.'
            );
        }}

        // Calculate the total score from AS1 to AS21
        $totalScore = 0;
        for ($i = 0; $i <= 20; $i++) {
            $totalScore += (int)$data["q$i"];
        }
        
        // Prepare a new test instance for KNN prediction
        $testInstance = array_values($data); // Assuming AS1 to AS21 are part of the validated data
        $testInstance['score'] = $totalScore;

        // Fetch training data from the database
        $trainingData = [];
        $trainingLabels = [];
        $dataset = DB::table('questions')->select('q0', 'q1', 'q2', 'q3', 'q4', 'q5', 'q6', 'q7', 'q8', 'q9', 'q10', 'q11', 'q12', 'q13', 'q14', 'q15', 'q16', 'q17', 'q18', 'q19', 'q20', 'score', 'status')->get();

        foreach ($dataset as $row) {
            // Prepare training data for KNN
            $trainingData[] = [
                (int)$row->q0, (int)$row->q1, (int)$row->q2, (int)$row->q3, (int)$row->q4,
                (int)$row->q5, (int)$row->q6, (int)$row->q7, (int)$row->q8, (int)$row->q9,
                (int)$row->q10, (int)$row->q11, (int)$row->q12, (int)$row->q13, (int)$row->q14,
                (int)$row->q15, (int)$row->q16, (int)$row->q17, (int)$row->q18, (int)$row->q19,
                (int)$row->q20,       
            ];
            $trainingLabels[] = $row->status; // Store corresponding anxiety level
        }

        // KNN classification
        $k = 3; // Set the number of nearest neighbors
        $predictedStatus = $this->knn($trainingData, $trainingLabels, $testInstance, $k);

        $data['score'] = $totalScore;
        $data['status'] = $predictedStatus;
       
        // Insert the new record into the questions table with the predicted values
        Question::create($data);
        // Assuming you have determined $predictedStatus and $totalScore
       $message = 'Total Score: ' . $totalScore;

// Append additional messages based on the predicted status
if ($predictedStatus == 'Low') {
    $message = "Low Anxiety: You are experiencing a low anxiety level.\n\n";
    $message .= "When you feel anxious, try these tips:\n";
    $message .= "• Take deep breaths. Inhale and exhale slowly.\n";
    $message .= "• Count to 10 slowly. Repeat, and count to 20 if necessary.\n";
    $message .= "• Eat well-balanced meals. Do not skip any meals. Do keep healthful, energy-boosting snacks on hand.\n";
    $message .= "• Exercise daily to help you feel good and maintain your health.\n";
    $message .= "• Welcome humor. A good laugh goes a long way.\n";
    $message .= "• Maintain a positive attitude. Replace negative thoughts with positive ones.\n";
    $message .= "• Do your best. Instead of aiming for perfection, be proud of however close you get.\n";
}

elseif ($predictedStatus == 'Moderate') {
    $message = "Moderate Anxiety: You are experiencing a moderate anxiety level.\n\n";
    $message .= "When you feel anxious, try these tips:\n";
    $message .= "• Take a time-out. Practice yoga, listen to music, meditate, or get a massage.\n";
    $message .= "• Limit alcohol and caffeine, which can aggravate anxiety and trigger panic attacks.\n";
    $message .= "• Talk to someone. Tell friends and family you’re feeling overwhelmed.\n";
    $message .= "• Get enough sleep. When stressed, your body needs extra rest.\n";
    $message .= "• Learn what triggers your anxiety. Write in a journal and look for patterns.\n";
    $message .= "• Get involved. Volunteer or find ways to be active in your community.\n";
}

elseif ($predictedStatus == 'Severe') {
    $message = "Severe Anxiety: You are experiencing a severe anxiety level.\n\n";
    $message .= "When you feel anxious, try these tips:\n";
    $message .= "• Talk to a counselor or therapist for professional help.\n";
    $message .= "• Actively participate in treatment plans and follow recommendations.\n";
    $message .= "• Accept that you cannot control everything. Put your stress in perspective.\n";
}

// Redirect with the constructed message
return redirect()->back()->with('message', $message);

    }

    // KNN Algorithm
    private function knn($trainingData, $trainingLabels, $testInstance, $k)
    {
        $distances = [];

        // Calculate distances
        foreach ($trainingData as $index => $trainInstance) {
            $distance = $this->calculateEuclideanDistance($trainInstance, $testInstance);
            $distances[] = ['distance' => $distance, 'label' => $trainingLabels[$index]];
        }

        // Sort distances
        usort($distances, function($a, $b) {
            return $a['distance'] <=> $b['distance'];
        });

        // Get top K neighbors
        $neighbors = array_slice($distances, 0, $k);
        $classVotes = [];

        // Count votes
        foreach ($neighbors as $neighbor) {
            $label = $neighbor['label'];
            $classVotes[$label] = ($classVotes[$label] ?? 0) + 1;
        }

        // Return the class with the most votes
        arsort($classVotes);
        return key($classVotes);
    }

    // Calculate Euclidean distance
    private function calculateEuclideanDistance($data1, $data2)
    {
        $distance = 0;
        for ($i = 0; $i < count($data1); $i++) {
            $distance += pow(($data1[$i] - $data2[$i]), 2);
        }
        return sqrt($distance);
    }
}
