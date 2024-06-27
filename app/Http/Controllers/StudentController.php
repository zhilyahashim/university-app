<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    //
    
    // public function register(Request $req)
    // {
    //     $student = new Students();

    //     $validatedData = $req->validate([
    //         'student_name' => 'required|string',
    //         'student_email' => 'required|email|unique:users,email',
    //         'student_password' => 'required|string|min:8',
    //         'student_phone' => 'required|nullable|regex:/^[0-9\- ]{10}$/|unique:users,phone',
    //         'role' => 'required|string|in:user,student,headofdepartment,staff',
    //     ]);
        
    //     $student->name = $validatedData['student_name'];
    //     $student->email = $validatedData['student_email'];
    //     $student->password = bcrypt($validatedData['student_password']);
        
    //     // Check if 'phone' key exists before accessing it
    //     if (array_key_exists('student_phone', $validatedData)) {
    //         $student->phone = $validatedData['student_phone'];
    //     }
        
    //     if ($student->save()) {
    //         return response()->json([
    //             'success' => true,
    //         ]);
    //     } else {
    //         return response()->json([
    //             'success' => false,
    //         ]);
    //     }
    //     $redirectRoute = '';
    //     switch ($student->role) {
    //         case 'student':
    //             $redirectRoute = 'student.dashboard';
    //             break;
    //         case 'headofdepartment':
    //             $redirectRoute = 'headofdepartment.dashboard';
    //             break;
    //         case 'staff':
    //             $redirectRoute = 'staff.dashboard';
    //             break;
    //         default:
    //             $redirectRoute = 'user.dashboard';
    //             break;
    //     }
    
    //     return redirect()->route($redirectRoute);
        

    // }

    public function login(Request $req)
    {
        $student = Students::where('student_email', $req->post('student_email'))->first();

    if ($student && Hash::check($req->post('student_password'), $student->password)) {
    // Login successful
    return response()->json([
        'success' => true,
        'user' => $student,
        'token' => $student->createToken('authToken')->plainTextToken,
    ]);
    } else {
        // Login failed
        return response()->json([
            'success' => false,
        ]);
    }

    }

    public function index()
{
    $students = User::where('role', 'student')->select('id','name', 'role')->get();
    return response()->json($students);
}
}
