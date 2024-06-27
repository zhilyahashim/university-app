<?php
namespace App\Http\Controllers;

use App\Models\Subjects;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubjectController extends Controller
{
    //function only for staff roles
    public function index()
    {
        $staff = User::where('role', 'staff')->select('name', 'id')->get();
        return response()->json($staff);
    }

    //craeting subjects
    public function createSubject(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'stage' => 'required|string',
            'subject_name' => 'required|string|unique:subjects,subject_name',
            'lecturer_id' => 'required|exists:users,id',
            'lecturer_name' => 'required|string',
            'semester' => 'required|string',
            'practice' => 'required|boolean',
            'department_id' => 'nullable|exists:departments,id',
            'staff_id' => 'nullable|exists:users,id',
        ]);

        $lecturerName = $validatedData['lecturer_name']; 

        // Create new subject
        $subject = new Subjects();
        $subject->lecturer_name = $lecturerName;
        $subject->stage = $validatedData['stage'];
        $subject->subject_name = $validatedData['subject_name'];
        $subject->lecturer_id = $validatedData['lecturer_id'];
        $subject->semester = $validatedData['semester'];
        $subject->practice = $validatedData['practice'];

        if (isset($validatedData['department_id'])) {
            $subject->department()->associate($validatedData['department_id']);
        }

        // Save subject
        try {
            $subject->save();
            return response()->json([
                'success' => true,
                'message' => 'Subject created successfully',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create subject: ' . $e->getMessage(),
            ], 500);
        }
    }

    
}
