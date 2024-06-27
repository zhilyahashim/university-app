<?php

namespace App\Http\Controllers;

use App\Models\HeadOfDep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class headOfDepController extends Controller
{
    //
    public function register(Request $req)
    {
        $head = new HeadOfDep();

        $validatedData = $req->validate([
            'head_name' => 'required|string',
            'head_email' => 'required|email|unique:users,email',
            'head_password' => 'required|string|min:8',
            'head_phone' => 'required|nullable|regex:/^[0-9\- ]{10}$/|unique:users,phone',
            'role' => 'required|string|in:user,student,headofdepartment,staff',
        ]);
        
        $head->name = $validatedData['head_name'];
        $head->email = $validatedData['head_email'];
        $head->password = bcrypt($validatedData['head_password']);
        $head->role=$validatedData['role'];
        
        // Check if 'phone' key exists before accessing it
        if (array_key_exists('headphone', $validatedData)) {
            $head->phone = $validatedData['head_phone'];
        }
        
        if ($head->save()) {
            return response()->json([
                'success' => true,
            ]);
        } else {
            return response()->json([
                'success' => false,
            ]);
        }
        $redirectRoute = '';
        switch ($head->role) {
            case 'student':
                $redirectRoute = 'student.dashboard';
                break;
            case 'headofdepartment':
                $redirectRoute = 'headofdepartment.dashboard';
                break;
            case 'staff':
                $redirectRoute = 'staff.dashboard';
                break;
            default:
                $redirectRoute = 'user.dashboard';
                break;
        }
    
        return redirect()->route($redirectRoute);
        

    }

    public function login(Request $req)
    {
        $head = HeadOfDep::where('student_email', $req->post('student_email'))->first();

    if ($head && Hash::check($req->post('student_password'), $head->password)) {
    // Login successful
    return response()->json([
        'success' => true,
        'user' => $head,
        'token' => $head->createToken('authToken')->plainTextToken,
    ]);
    } else {
        // Login failed
        return response()->json([
            'success' => false,
        ]);
    }

    }
}
