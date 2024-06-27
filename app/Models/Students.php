<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Students extends Model
{
    use HasFactory;
    protected $fillable=[
        'students_name',
        'students_email',
        'students_password',
        'students_phone',
        'students_stage',
        'students_image',
        'role',


    ];
    public function marks() {
        return $this->hasMany(resultmarks::class, 'student_id');
    }
    public function resultMarks(): HasMany
    {
        return $this->hasMany(resultMarks::class);
    }
}
