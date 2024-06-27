<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DropdownController extends Controller
{
    // drop down for users who login  as admin or teacher or sutudent or head of department--
    public function getOptions()
    {
        
        $options = ['Head of department', 'Teacher', ' Student','Admin'];

        return response()->json($options);
    }
}
