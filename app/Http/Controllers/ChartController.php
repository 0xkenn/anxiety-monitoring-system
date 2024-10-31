<?php

namespace App\Http\Controllers;

use App\Models\Question;
use DB;
use Illuminate\Http\Request;

class ChartController extends Controller
{
   public function showChart($type = 'student') // Default to 'student'
    {
        $chartType = $type; // Set the chart type based on the route parameter
        $lowStudent = Question::where('status', 'Low')->whereNotNull('student_id')->count();
        $moderateStudent = Question::where('status', 'Moderate')->whereNotNull('student_id')->count();
        $severeStudent = Question::where('status', 'Severe')->whereNotNull('student_id')->count();
         $lowEmployee = Question::where('status', 'Low')->whereNotNull('employee_id')->count();
        $moderateEmployee = Question::where('status', 'Moderate')->whereNotNull('employee_id')->count();
        $severeEmployee = Question::where('status', 'Severe')->whereNotNull('employee_id')->count();
        $totalStudents = $lowStudent + $moderateStudent + $severeStudent;
        $totalEmployees = $lowEmployee + $moderateEmployee + $severeEmployee;

    //    $schoolIds = Question::with('student') // Load the associated students
    // ->join('students', 'questions.student_id', '=', 'students.student_id') // Join the students table
    // ->distinct() // Get distinct school_ids
    // ->pluck('students.school_id');
    // $schoolNames = Question::join('students', 'questions.student_id', '=', 'students.student_id') // Join the students table
    // ->join('schools', 'students.school_id', '=', 'schools.id') // Join the schools table
    // ->distinct() // Get distinct school_ids
    // ->pluck('schools.abbrev', 'schools.id');
    $lowAnxietyCounts = Question::join('students', 'questions.student_id', '=', 'students.student_id')
        ->join('schools', 'students.school_id', '=', 'schools.id')
        ->select('schools.abbrev', DB::raw('COUNT(questions.student_id) as student_count'))
        ->where('questions.status', 'Low') // Filter for low anxiety status
        ->groupBy('schools.abbrev') // Group by school abbreviation
        ->get(); // Execute the query
      
        
        $moderateAnxietyCounts = Question::join('students', 'questions.student_id', '=', 'students.student_id')
        ->join('schools', 'students.school_id', '=', 'schools.id')
        ->select('schools.abbrev', DB::raw('COUNT(questions.student_id) as student_count'))
        ->where('questions.status', 'Moderate') // Filter for low anxiety status
        ->groupBy('schools.abbrev') // Group by school abbreviation
        ->get(); // Execute the query
       


        $severeAnxietyCounts = Question::join('students', 'questions.student_id', '=', 'students.student_id')
        ->join('schools', 'students.school_id', '=', 'schools.id')
        ->select('schools.abbrev', DB::raw('COUNT(questions.student_id) as student_count'))
        ->where('questions.status', 'Severe') // Filter for low anxiety status
        ->groupBy('schools.abbrev') // Group by school abbreviation
        ->get(); // Execute the query
        
 $combinedCounts = [];
    
    // Prepare combined counts for each anxiety status
    foreach ($lowAnxietyCounts as $count) {
        $combinedCounts[$count->abbrev]['Low'] = $count->student_count;
    }

    foreach ($moderateAnxietyCounts as $count) {
        $combinedCounts[$count->abbrev]['Moderate'] = $count->student_count;
    }

    foreach ($severeAnxietyCounts as $count) {
        $combinedCounts[$count->abbrev]['Severe'] = $count->student_count;
    }
   
        
        // $school = Question::with('student')->where('school_id', )

      $studentData = [
    'labels' => ['Severe', 'Moderate', 'Low'],
    'datasets' => [
        [
            'label' => 'Students',
            'data' => [
                ($totalStudents > 0) ? round(($lowStudent / $totalStudents) * 100, 2) : 0,
                ($totalStudents > 0) ? round(($moderateStudent / $totalStudents) * 100, 2) : 0,
                ($totalStudents > 0) ? round(($severeStudent / $totalStudents) * 100, 2) : 0,
            ],
            'backgroundColor' => [
                'rgba(255, 0, 0, 0.6)',    // Red for "Low"
                'rgba(255, 215, 0, 0.6)',  // Gold for "Moderate"
                'rgba(0, 128, 0, 0.6)'     // Green for "Severe"
            ],
        ],
    ],
];


$employeeData = [
    'labels' => ['Severe', 'Moderate', 'Low'],
    'datasets' => [
        [
            'label' => 'Employees',
            'data' => [$lowEmployee, $moderateEmployee, $severeEmployee],
            'backgroundColor' => [
                'rgba(255, 0, 0, 0.6)',    // Red for "s"
                'rgba(255, 215, 0, 0.6)',  // Gold for "Moderate"
                'rgba(0, 128, 0, 0.6)'     // Green for "l"
            ], // Example color for employees
        ],
    ],
];

$subQuery = DB::table('questions as a')
    ->join('students as st', 'a.student_id', '=', 'st.student_id')
    ->join('schools as s', 'st.school_id', '=', 's.id')
    ->select(
        's.school_name',
        DB::raw('COUNT(a.student_id) as moderate_count')
    )
    ->where('a.status', '=', 'Moderate')  // Filter by Moderate status
    ->groupBy('s.school_name')
    ->orderBy('moderate_count', 'DESC');  // Sort by the count in descending order

// Get the data
$data = $subQuery->get();

// Transform the data for Chart.js format
$chartData = [
    'labels' => [],
    'datasets' => [
        [
            'label' => 'Moderate Assessment Status',
            'data' => []
        ]
    ]
];

foreach ($data as $row) {
    $chartData['labels'][] = $row->school_name;
    $chartData['datasets'][0]['data'][] = $row->moderate_count;
}
$eSubQuery = DB::table('questions as a')
    ->join('employees as st', 'a.employee_id', '=', 'st.employee_id')
    ->join('schools as s', 'st.school_id', '=', 's.id')
    ->select(
        's.school_name',
        DB::raw('COUNT(a.employee_id) as moderate_count')
    )
    ->where('a.status', '=', 'Moderate')  // Filter by Moderate status
    ->groupBy('s.school_name')
    ->orderBy('moderate_count', 'DESC');  // Sort by the count in descending order

// Get the data
$empData = $eSubQuery->get();

// Transform the data for Chart.js format
$empChartData = [
    'labels' => [],
    'datasets' => [
        [
            'label' => 'Moderate Assessment Status',
            'data' => []
        ]
    ]
];

foreach ($empData as $row) {
    $empChartData['labels'][] = $row->school_name;
    $empChartData['datasets'][0]['data'][] = $row->moderate_count;
}

// Now pass $chartData to your Chart.js frontend

   


        return view('guidance_counselor.dashboard', compact('chartType', 'lowStudent', 'moderateStudent', 'severeStudent', 'lowEmployee', 'moderateEmployee', 'severeEmployee', 'studentData', 'employeeData', 'chartData', 'empChartData')); // Pass the variable to the view // Pass the variable to the view
    }


 public function studentChart(){
        return view('guidance_counselor.student-chart');
    }

    public function employeeChart()
    
    {

        $lowEmployee = Question::where('status', 'Low')->whereNotNull('employee_id')->count();
        $moderateEmployee = Question::where('status', 'Moderate')->whereNotNull('employee_id')->count();
        $severeEmployee = Question::where('status', 'Severe')->whereNotNull('employee_id')->count();
        $totalEmployees = $lowEmployee + $moderateEmployee + $severeEmployee;
         $lowAnxietyCounts = Question::join('students', 'questions.student_id', '=', 'students.student_id')
        ->join('schools', 'students.school_id', '=', 'schools.id')
        ->select('schools.abbrev', DB::raw('COUNT(questions.student_id) as student_count'))
        ->where('questions.status', 'Low') // Filter for low anxiety status
        ->groupBy('schools.abbrev') // Group by school abbreviation
        ->get(); // Execute the query
      
        
        $moderateAnxietyCounts = Question::join('students', 'questions.student_id', '=', 'students.student_id')
        ->join('schools', 'students.school_id', '=', 'schools.id')
        ->select('schools.abbrev', DB::raw('COUNT(questions.student_id) as student_count'))
        ->where('questions.status', 'Moderate') // Filter for low anxiety status
        ->groupBy('schools.abbrev') // Group by school abbreviation
        ->get(); // Execute the query
       


        $severeAnxietyCounts = Question::join('students', 'questions.student_id', '=', 'students.student_id')
        ->join('schools', 'students.school_id', '=', 'schools.id')
        ->select('schools.abbrev', DB::raw('COUNT(questions.student_id) as student_count'))
        ->where('questions.status', 'Severe') // Filter for low anxiety status
        ->groupBy('schools.abbrev') // Group by school abbreviation
        ->get(); // Execute the query
        
 $combinedCounts = [];
    
    // Prepare combined counts for each anxiety status
    foreach ($lowAnxietyCounts as $count) {
        $combinedCounts[$count->abbrev]['Low'] = $count->student_count;
    }

    foreach ($moderateAnxietyCounts as $count) {
        $combinedCounts[$count->abbrev]['Moderate'] = $count->student_count;
    }

    foreach ($severeAnxietyCounts as $count) {
        $combinedCounts[$count->abbrev]['Severe'] = $count->student_count;
    }
   
        
        // $school = Question::with('student')->where('school_id', )

      $employeeData = [
    'labels' => ['Severe', 'Moderate', 'Low'],
    'datasets' => [
        [
            'label' => 'Employees',
            'data' => [
                ($totalEmployees > 0) ? round(($lowEmployee / $totalEmployees) * 100, 2) : 0,
                ($totalEmployees > 0) ? round(($moderateEmployee / $totalEmployees) * 100, 2) : 0,
                ($totalEmployees > 0) ? round(($severeEmployee / $totalEmployees) * 100, 2) : 0,
            ],
              'backgroundColor' => [
                'rgba(255, 0, 0, 0.6)',    // Red for "s"
                'rgba(255, 215, 0, 0.6)',  // Gold for "Moderate"
                'rgba(0, 128, 0, 0.6)'     // Green for "l"
            ],
        ],
    ],
];


$eSubQuery = DB::table('questions as a')
    ->join('employees as st', 'a.employee_id', '=', 'st.employee_id')
    ->join('schools as s', 'st.school_id', '=', 's.id')
    ->select(
        's.school_name',
        DB::raw('COUNT(a.employee_id) as moderate_count')
    )
    ->where('a.status', '=', 'Moderate')  // Filter by Moderate status
    ->groupBy('s.school_name')
    ->orderBy('moderate_count', 'DESC');  // Sort by the count in descending order

// Get the data
$empData = $eSubQuery->get();

// Transform the data for Chart.js format
$empChartData = [
    'labels' => [],
    'datasets' => [
        [
            'label' => 'Moderate Assessment Status',
            'data' => []
        ]
    ]
];

foreach ($empData as $row) {
    $empChartData['labels'][] = $row->school_name;
    $empChartData['datasets'][0]['data'][] = $row->moderate_count;
}
        return view('guidance_counselor.employee-chart', compact('lowEmployee', 'moderateEmployee', 'severeEmployee', 'employeeData'));
    }
}
