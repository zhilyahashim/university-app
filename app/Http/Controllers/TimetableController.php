<?php

namespace App\Http\Controllers;

use App\Models\Timetable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TimetableController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Log all incoming data
            Log::info('Received request data: ', $request->all());
    
            // Validate the incoming request
            $validatedData = $request->validate([
                'department_name' => 'required|string',
                'day' => 'required|string',
                'firstlecture' => 'required|string',
                'start_time' => 'required|date_format:H:i:s',
                'end_time' => 'required|date_format:H:i:s|after:start_time',
                'activity' => 'required|string',
                'secondlecture' => 'required|string',
                'starts_time' => 'required|date_format:H:i:s',
                'ends_time' => 'required|date_format:H:i:s|after:starts_time',
                'activitys' => 'required|string',
            ]);
    
            // Create new Timetable entry
            $timetable = new Timetable();
            $timetable->department_name = $validatedData['department_name'];
            $timetable->day = $validatedData['day'];
            $timetable->firstlecture = $validatedData['firstlecture'];
            $timetable->start_time = $validatedData['start_time'];
            $timetable->end_time = $validatedData['end_time'];
            $timetable->activity = $validatedData['activity'];
            $timetable->secondlecture = $validatedData['secondlecture'];
            $timetable->starts_time = $validatedData['starts_time'];
            $timetable->ends_time = $validatedData['ends_time'];
            $timetable->activitys = $validatedData['activitys'];
    
            // Save the timetable entry
            $timetable->save();
    
            return response()->json([
                'success' => true,
                'message' => 'Timetable entry created successfully',
                'data' => $timetable,
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error creating timetable entry: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to create timetable entry',
                'error' => $e->getMessage(), // Return the error message for debugging
            ], 500);
        }
    }
    



    public function getTimetable(Request $request)
    {
        $resultMarks = Timetable::all();

        $formattedMarks = $resultMarks->map(function ($resultMark) {
            return [
                'department_name' => $resultMark->department_name,
                'day' => $resultMark->day,
                'firstlecture' => $resultMark->firstlecture,
                'start_time' => $resultMark->start_time,
                'end_time' => $resultMark->end_time,
                'activity' => $resultMark->activity,
                'secondlecture' => $resultMark->secondlecture,
                'starts_time' => $resultMark->starts_time,
                'ends_time' => $resultMark->ends_time,
                'activitys' => $resultMark->activitys,
            

            ];
        });
    
        return response()->json($formattedMarks);
    }

    public function getDepartmenttNames(Request $request)
    {
        try {
            $departmentNames = Timetable::select('department_name')
                                        ->distinct()
                                        ->whereNotNull('department_name')
                                        ->pluck('department_name')
                                        ->toArray();
    
            Log::info('Fetched department names: ', $departmentNames);
    
            return response()->json($departmentNames, 200);
        } catch (\Exception $e) {
            Log::error('Failed to fetch Department names: ' . $e->getMessage());
    
            return response()->json(['error' => 'Failed to fetch department names'], 500);
        }
    }
    
}
