<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\ResultMarkController;
use App\Models\resultmarks;


class AuthController extends Controller
{
    //the user register
    public function register(Request $req)
    {
        $validatedData = $req->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'phone' => 'nullable|regex:/^[0-9\- ]{10}$/|unique:users,phone',
            'role' => 'required|string|in:user,student,headofdepartment,staff',
            'student_name' => $req->role === 'student' ? 'nullable|string' : 'nullable|string',
        ]);

        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = bcrypt($validatedData['password']);
        $user->role = $validatedData['role'];

        if ($validatedData['role'] === 'student') {
            $user->student_name = $validatedData['student_name'];
            $resultMarkController = new ResultMarkController();
            $resultMarkController->store($req);
        }

        if (array_key_exists('phone', $validatedData)) {
            $user->phone = $validatedData['phone'];
        }

        if ($user->save()) {
            return response()->json([
                'success' => true,
                'user' => $user,
                'token' => $user->createToken('authToken')->plainTextToken,
            ]);
        } else {
            return response()->json([
                'success' => false,
            ]);
        }
    }
    // the user login
    public function login(Request $req)
    {
        $user = User::where('email', $req->post('email'))
        ->where('role', $req->post('role'))
        ->first();

        if ($user && Hash::check($req->post('password'), $user->password)) {
        if ($user->role === $req->post('role')) {
            // Login successful
            return response()->json([
                'success' => true,
                'user' => $user,
                'token' => $user->createToken('authToken')->plainTextToken,
            ]);
        } else {
            // Role mismatch
            return response()->json([
                'success' => false,
                'message' => 'Role mismatch',
            ], 401);
        }
        }

        // Login failed
        return response()->json([
        'success' => false,
        'message' => 'Invalid credentials',
        ], 401);

    }   
    //function for all users 
    public function index()
    {
        $user = User::all();
        return response()->json($user);
    } 
    //function only for staff roles
    public function index2()
    {
        $staff = User::where('role', 'staff')->select('name','id')->get();
        return response()->json($staff);
    }
 
    //function for delete users
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->update($request->all());
        return response()->json(['message' => 'User updated successfully', 'user' => $user]);
    }
    public function profile(Request $request)
    {
        $user = $request->user();

        return response()->json($user);
        
        }
  
}
