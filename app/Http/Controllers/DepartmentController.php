<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Departments;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


        

class DepartmentController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Log all incoming data
            Log::info('Received request data: ', $request->all());
    
            // Validate the incoming request
            $validatedData = $request->validate([
            'department_name' => 'required|string',
            'headOfDepartment_id' => 'required|integer',
            'head_name' => 'required|string|max:255',
            'numberofstage' => 'required|array',

            ]);
    
            // Create new Timetable entry
            $department = new Departments([
                'department_name' => $request->department_name,
               'headOfDepartment_id' => $request->headOfDepartment_id,
                'head_name' => $request->head_name,
                'numberofstage' => json_encode($request->numberofstage),
            ]);
           
    
            // Save the timetable entry
            $department->save();
    
            return response()->json([
                'success' => true,
                'message' => 'Department created successfully',
                'data' => $department,
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error creating Department : ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to create Department',
                'error' => $e->getMessage(), // Return the error message for debugging
            ], 500);
        }
    }


    
    //function for fetch all the user's
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }
    
    //function for fetch the headofdepartment user's
    public function head()
    {
        $head = User::where('role', 'headofdepartment')->select('id','name', 'role')->get();
        return response()->json($head);
    }
}