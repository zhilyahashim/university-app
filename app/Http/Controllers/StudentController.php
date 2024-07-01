<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
   

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
