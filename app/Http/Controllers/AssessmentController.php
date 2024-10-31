<?php
namespace App\Http\Controllers;

use App\Http\Requests\AssesmentRequest;
use App\Models\Assessment;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function store(AssesmentRequest $request)
{
       
    $currentTime = now();
    $id = Auth::guard('student')->id();
    $lastAssessment = Assessment::with('student')
                                ->where('student_id', $id)
                                ->orderBy('created_at', 'desc') 
                                ->first();
                               

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
                'You need to wait ' . 
                ($remainingDays > 0 ? $remainingDays . ' days, ' : '') . 
                ($remainingHours > 0 ? $remainingHours . ' hours, ' : '') . 
                $remainingMinutes . ' minutes before you can create a new assessment.'
            );
        }
    }
    // If no assessment exists or it is eligible for a new one
    $validatedData = $request->validated();
    $validatedData['student_id'] = $id;
    $validatedData['assessment_date'] = $currentTime;

    Assessment::create($validatedData);
    return redirect()->back()->with('message', 'Assessment saved successfully.');
}

}
