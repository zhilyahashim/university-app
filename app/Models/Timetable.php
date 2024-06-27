<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;

    protected $fillable = ['department_name', 'day','firstlecture','start_time','end_time', 'activity'
    ,'secondlecture','starts_time','ends_time','activitys'
];
}
