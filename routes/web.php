<?php

use App\Http\Controllers\AdminChartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GuidanceCoordinatorController;
use App\Http\Controllers\GuidanceCounselorController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\Questioncontroller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Models\Program;
use App\Models\School;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('selection.selection');
});

 

    Route::prefix('student')->group(function(){
    Route::get('/register', [StudentController::class, 'create'])->name('student.register');
    Route::post('/register', [StudentController::class, 'store'])->name('student.store');
    Route::get('/login', [StudentController::class, 'login'])->name('student.login');
    Route::post('/login-student', [StudentController::class, 'authenticate'])->name('student.authenticate');

 
});

// This is for the Student Routing group
   
Route::prefix('student')->middleware( ['auth:student'])->group(function () {
    // Route to show the dashboard
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    // Route to show history
    Route::get('/history-stud', [HistoryController::class, 'studentHistory'])->name('student.history');
    // Route to show about us page
    Route::get('/contact', [StudentController::class, 'contact'])->name('contact');
    // Route to show assessment
    Route::get('/assessment', [StudentController::class, 'assessment'])->name('student.assessment');
    Route::post('/assessment/store', [Questioncontroller::class, 'questions'])->name('student.assessment.store');
    // Route to show home
    Route::get('/home', [StudentController::class, 'home'])->name('studenthome');
    // Route to view and edit student profile
    Route::get('/profile/{id}', [StudentController::class, 'show'])->name('student.profile');
    Route::get('/profile/{id}/edit', [StudentController::class, 'edit'])->name('edit');
    Route::put('/profile/{id}', [StudentController::class, 'update'])->name('student.update');
    Route::post('logout', [StudentController::class, 'logout'])->name('student.logout');
});


    Route::prefix('employee')->group(function () {
        Route::get('/register', [EmployeeController::class, 'create'])->name('employee.register');
    Route::post('/register', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('/login', [EmployeeController::class, 'login'])->name('employee.login');
    Route::post('/login-employee', [EmployeeController::class, 'authenticate'])->name('employee.authenticate');
    Route::post('logout', [EmployeeController::class, 'logout'])->name('employee.logout');

});
  // This is for the Employee Routing group
    
Route::prefix('employee')->middleware( ['auth:employee'])->group(function ()  {
    // Route to show the dashboard
     Route::post('/assessment/store', [Questioncontroller::class, 'questions'])->name('assessment.store');
    Route::get('/dashboard', [EmployeeController::class, 'dashboard'])->name('employee.dashboard');
    // Route to show history
    Route::get('/history', [EmployeeController::class, 'history'])->name('employee.history');
    // Route to show contact
    Route::get('/contact', [EmployeeController::class, 'contact'])->name('employee.contact');
    // Route to show assessment
    Route::get('/assessment', [EmployeeController::class, 'assessment'])->name('employee.assessment');
   
  
    // Route to show home
    Route::get('/home', [EmployeeController::class, 'home'])->name('employee.home');
    // Route to view and edit student profile
    Route::get('/profile/{id}', [EmployeeController::class, 'show'])->name('employee.profile');
    Route::get('/profile/{id}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::put('/profile/{id}', [EmployeeController::class, 'update'])->name('employee.update');
   
});

// This is for the Guidance Counselor Routing group 

Route::prefix('counselor')->group(function () {
     Route::get('/login',[GuidanceCounselorController::class, 'Login']);
     Route::post('/login/request', [GuidanceCounselorController::class, 'loginCounselor'])->name('login.counselor');

});
    
Route::prefix('counselor')->middleware( ['auth:counselor'])->group(function ()  {

    Route::get('/student-scores/{id}', [GuidanceCounselorController::class, 'getStudentScores']);
    Route::get('/dashboard', [ChartController::class, 'showChart'])->name('counselor.dashboard');
    Route::post('/register', [GuidanceCounselorController::class, 'store']);
    Route::get('/home',      [GuidanceCounselorController::class, 'Home']);
    Route::get('/student', [GuidanceCounselorController::class, 'Student'])->name('counselor.student');
    Route::get('/employee', [GuidanceCounselorController::class, 'Employee']);
    Route::get('/report', [GuidanceCounselorController::class, 'Report']);
    Route::get('/addStudent', [GuidanceCounselorController::class, 'AddStudent']);
    Route::get('/addEmployee', [GuidanceCounselorController::class, 'AddEmployee']);
    Route::get('/addCoordinator', [GuidanceCounselorController::class, 'AddCoordinator']);
    Route::get('/aboutus', [GuidanceCounselorController::class, 'AboutUs']);

    Route::get('/charts/{type}', [ChartController::class, 'showChart'])->name('charts.show');
     Route::get('/charts/student', [ChartController::class, 'studentChart']);
    Route::get('/charts/employee', [ChartController::class, 'employeeChart'])->name('emp.chart.counselor');
});



// This is for the Guidance Coordinator Routing group


     Route::prefix('coordinator')->group(function () {
    
    Route::get('/login', [GuidanceCoordinatorController::class,'Login']);
    Route::post('/loginCoordinator', [GuidanceCoordinatorController::class, 'loginCoordinator'])->name('coordinator.login.auth');


});
   

    
Route::prefix('coordinator')->middleware( ['auth:coordinator'])->group(function ()  {   
    Route::get('/schoolData', [GuidanceCoordinatorController::class, 'school']);
    Route::get('/dashboard', [GuidanceCoordinatorController::class,'dashboard'])->name('guidance_coordinator.dashboard');
    Route::get('/home', [GuidanceCoordinatorController::class,  'Home']);
    Route::get('/student', [GuidanceCoordinatorController::class, 'Student']);
    Route::get('/employee', [GuidanceCoordinatorController::class, 'Employee']);
    Route::post('logout', [GuidanceCoordinatorController::class, 'logout'])->name('guidance_coordinator.logout');
    Route::get('student-data', [GuidanceCoordinatorController::class, 'studentData'])->name('student.data');
    Route::get('employee-data', [GuidanceCoordinatorController::class, 'employeeData'])->name('employee.data');
});


   
   

   



// This is for the Admin Routing group
    
     Route::prefix('admin')->group(function () {
     Route::get('/login', [AdminController::class, 'Login']);
     Route::post('login/auth-a', [AdminController::class, 'authLogin'])->name('auth.admin.login');

});

Route::prefix('admin')->middleware( ['auth:admin'])->group(function ()  {
   
    Route::get('/dashboard', [AdminController::class, 'Dashboard'])->name('admin.dashboard');
    Route::get('/register', [AdminController::class, 'Register']);
    Route::get('/addschool', [AdminController::class, 'School']);
    Route::get('/home', [AdminController::class, 'Home']);
    Route::get('/verify', [AdminController::class, 'Verification']);
    Route::get('/users', [AdminController::class, 'Users']);
    Route::get('/report', [AdminController::class, 'Report']); 
    Route::get('/contact', [AdminController::class, 'contact']); 
    Route::get('/addprogram', [AdminController::class, 'Program']);
    Route::get('/coordinator', [AdminController::class, 'showCoordinator'])->name('show.coordinator');
    Route::get('/counselor', [AdminController::class, 'showCounselor'])->name('show.counselor');
    Route::get('/create', [AdminController::class, 'createCoordinator'])->name('create.coordinator');
    Route::get('/student/index', [AdminController::class, 'studentIndex'])->name('admin.student.index');
    Route::get('/employee/index', [AdminController::class, 'employeeIndex'])->name('admin.employee.index');

    Route::get('/program', [AdminController::class, 'showProgram'])->name('admin.program');
    Route::get('create/proggram', [AdminController::class, 'showCreateProgram'])->name('show.create.program');
    Route::get('/edit/program/page/{id}', [AdminController::class, 'editProgram'])->name('edit.program');
    Route::get('/counselor/page', [AdminController::class, 'showCounselor'])->name('counselor.show');
    Route::get('/create/counselor', [AdminController::class, 'showCreateCounselor'])->name('create.counselor');

   Route::post('/addcoordinator-create', [AdminController::class, 'AddCoordinator'])->name('create.coordinator.auth');
    Route::post('/register', [AdminController::class, 'store']);
    // Route::post('/program-create', [AdminController::class, 'AddProgram'])->name('create.program');
    Route::post('/school-create', [AdminController::class, 'AddSchool'])->name('create.school');
    Route::get('/edit-coordinator/{id}', [AdminController::class, 'editCoordinator'])->name('edit.coordinator');
     Route::post('/delete-coordinator/{id}', [AdminController::class, 'deleteCoordinator'])->name('delete.coordinator');
     Route::post('/update', [AdminController::class, 'update'])->name('update.coordinator');
    Route::post('/delete/employee/{id}', [AdminController::class, 'deleteEmployee'])->name('employee.destroy');
     Route::post('/delete/student/{id}', [AdminController::class, 'deleteStudent'])->name('student.destroy');
     Route::post('/program/create', [AdminController::class, 'createProgram'])->name('create.program');
     Route::post('/edit/program/{id}', [AdminController::class, 'editProgramAuth'])->name('edit.program.auth');
     Route::post('/delete/program/{id}', [AdminController::class, 'deleteProgram'])->name('delete.program');
     Route::post('/create/counselor/auth', [AdminController::class, 'addCounselor'])->name('create.addCounselor');
    Route::get('/edit-counselor/{id}', [AdminController::class, 'editcounselor'])->name('edit.counselor');
    Route::post('/delete-counselor/{id}', [AdminController::class, 'deletecounselor'])->name('delete.counselor');
    Route::post('/delete-question/{id}', [AdminController::class, 'deletequestion'])->name('question.destroy');
    Route::post('logout/naka', [AdminController::class, 'logout'])->name('admin.logout');
     Route::get('/charts/{type}', [AdminChartController::class, 'chartController'])->name('admin.charts.show');
});
    