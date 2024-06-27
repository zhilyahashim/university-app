<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\HeadOfDepController;
use App\Http\Controllers\ResultMarkController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TimetableController;
use App\Http\Middleware\Cors;
use App\Models\Departments;
use App\Models\HeadOfDepartment;
use App\Models\Subjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
  });

  Route::post('register', [AuthController::class, 'register']);
  Route::get('students', [StudentController::class, 'index']);
  Route::post('studentlogin', [StudentController::class, 'login']);
  Route::post('login', [AuthController::class, 'login']);
  Route::post('subject', [SubjectController::class, 'createSubject']);
  Route::post('departments', [DepartmentController::class, 'store']);
  Route::post('save-marks', [ResultMarkController::class, 'store']);
  Route::get('subjects', [ResultMarkController::class, 'subjects']);
  Route::get('departmentsName', [ResultMarkController::class, 'department']);
  Route::post('timetable/bulk-update', [TimetableController::class, 'store']);


  Route::middleware('auth:api')->group(function () {
      Route::get('dropdown-options', [DropdownController::class, 'getOptions']);
      Route::get('marks', [ResultMarkController::class, 'getMarksForStudent']);
      Route::get('users', [DepartmentController::class, 'index'])->name('users.index');
  });
  Route::middleware('auth')->group(function () {
  Route::get('user/profile', [AuthController::class,'profile']);
  Route::get('all_users', [AuthController::class, 'index']);
});


 Route::delete('users/{id}', [AuthController::class,'destroy']);
 Route::put('users/{id}', [AuthController::class,'update']);
 Route::get('all_users', [AuthController::class, 'index']);
 Route::get('staff-users', [SubjectController::class, 'index']);
 Route::get('subject_name', [ResultMarkController::class, 'getSubjectNames']);
 Route::get('departmentname', [ResultMarkController::class, 'getSubjectNames']);
 Route::get('department_name', [TimetableController::class, 'getDepartmenttNames']);
 Route::get('head-users', [DepartmentController::class, 'head']);
 Route::get('/user/marks', [ResultMarkController::class,'getMarks']);
 Route::get('/get/timetable', [TimetableController::class,'getTimetable']);

 

  




