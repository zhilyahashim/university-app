<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class resultmarks extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id', 
        'student_name',
        'subject_name',
        'department_name',
        'midterm_theory' ,
        'midterm_practice',
        'daily',
        'final_theory',
        'final_practice',
        'subject_id',
    ];
   

    protected $table ='resultmarks';
    protected $quarded=['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }
    
    public function student():BelongsTo{
        return $this->belongsTo(User::class,'student_id');
    }

    public function subject():BelongsTo{
        return $this->belongsTo(Subjects::class,'subject_id');
    }

    public function department():BelongsTo{
        return $this->belongsTo(Departments::class,'department_id');
    }

    public function staff():BelongsTo{
        return $this->belongsTo(staff::class,'staff_id');
    }
 


}
