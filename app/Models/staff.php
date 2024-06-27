<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class staff extends Model
{
    use HasFactory;
    protected $table='staffs';
    protected $quarded=['id'];

    public function result():HasMany{
        return $this->hasMany(resultmarks::class,'staff_id');
    }
    public function headofdepartment():HasMany{
        return $this->hasMany(headofdepartment::class,'staff_id');
    }

    public function department():BelongsTo{
        return $this->belongsTo(Departments::class,'department_id');
    }

  
}
