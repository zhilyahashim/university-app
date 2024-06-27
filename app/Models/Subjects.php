<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subjects extends Model
{
    use HasFactory;
    protected $table='subjects';
    protected $quarded=['id'];

    protected $fillable = [
        'stage',
        'subject_name',
        'lecturer_id',
        'semster',
        'practice',
        'department_id',
        'staff_id',
    ];


  

    public function result():HasMany{
        return   $this -> hasMany(resultmarks::class,'subject_id');
    }

    public function department():BelongsTo{
        return $this->belongsTo(Departments::class,'department_id');
    }

   
}
