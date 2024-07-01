<?php

namespace App\Http\Controllers;

use App\Models\Departments;
use App\Models\ResultMark;
use App\Models\resultmarks;
use App\Models\Subjects;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ResultMarkController extends Controller
{
    // function for store the marks
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'student_id' => 'required|integer|exists:users,id',
                'student_name' => 'required|string',
                'department_name' => 'required|string',
                'subject_name' => 'required|string',
                'midterm_theory' => 'required|numeric',
                'midterm_practice' => 'required|numeric',
                'daily' => 'required|numeric',
                'final_theory' => 'required|numeric',
                'final_practice' => 'required|numeric',
                'subject_id' => 'required|exists:subjects,id',
              
            ]);
    
       
    
            // Retrieve student details
            $studentName = $validatedData['student_name'];
            $subjectName = $validatedData['subject_name']; 
            $departmentName = $validatedData['department_name']; 
            $studentId = $validatedData['student_id'];
            $subjectId = $validatedData['subject_id'];
    
            $resultMark = new resultmarks(); 
    
            $resultMark->subject_id = $subjectId;
            $resultMark->student_id = $studentId;
            $resultMark->student_name = $studentName;
            $resultMark->subject_name = $subjectName;
            $resultMark->department_name = $departmentName;
            $resultMark->midterm_theory = $validatedData['midterm_theory'];
            $resultMark->midterm_practice = $validatedData['midterm_practice'];
            $resultMark->daily = $validatedData['daily'];
            $resultMark->final_theory = $validatedData['final_theory'];
            $resultMark->final_practice = $validatedData['final_practice'];
    
            // Save the resultmark object to the database
            $resultMark->save();
    
            return response()->json(['message' => 'Marks stored successfully'], 201);
        } catch (\Exception $e) {
            Log::error('Failed to store marks: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'exception' => $e,
            ]);
    
            return response()->json(['error' => 'Failed to store marks. ' . $e->getMessage()], 500);
        }
    }
    
    //function for get subjects
      public function subjects()
    {
        try {
            $subjects = Subjects::all(); 

            return response()->json($subjects, 200);
        } catch (\Exception $e) {
            Log::error('Failed to load subjects: ' . $e->getMessage());

            return response()->json(['error' => 'Failed to load subjects'], 500);
        }
    }
    public function department()
    {
        try {
            $subjects = Departments::all(); 

            return response()->json($subjects, 200);
        } catch (\Exception $e) {
            Log::error('Failed to load department: ' . $e->getMessage());

            return response()->json(['error' => 'Failed to load department'], 500);
        }
    }

    // function for get all the marks for all students
    public function getMarks(Request $request)
    {
        $resultMarks = resultmarks::all();

        $formattedMarks = $resultMarks->map(function ($resultMark) {
            return [
                'student_name' => $resultMark->student_name,
                'subject_name' => $resultMark->subject_name,
                'midterm_theory' => $resultMark->midterm_theory,
                'midterm_practice' => $resultMark->midterm_practice,
                'daily' => $resultMark->daily,
                'final_theory' => $resultMark->final_theory,
                'final_practice' => $resultMark->final_practice,
            ];
        });
    
        return response()->json($formattedMarks);
    }

     public function getSubjectNames(Request $request)
    {
        try {
            $subjectNames = resultmarks::select('subject_name')->distinct()->pluck('subject_name')->toArray();

            return response()->json($subjectNames, 200);
        } catch (\Exception $e) {
            Log::error('Failed to fetch subject names: ' . $e->getMessage());

            return response()->json(['error' => 'Failed to fetch subject names'], 500);
        }
    }

    public function getDepartmentNames(Request $request)
    {
        try {
            $departmentName = resultmarks::select('department_name')->distinct()->pluck('department_name')->toArray();

            return response()->json($departmentName, 200);
        } catch (\Exception $e) {
            Log::error('Failed to fetch department names: ' . $e->getMessage());

            return response()->json(['error' => 'Failed to fetch department names'], 500);
        }
    }


}
