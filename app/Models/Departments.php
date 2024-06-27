<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Departments extends Model
{

    use HasFactory;
    protected $table='departments';
    protected $quarded=['id'];

    protected $fillable = ['department_name', 'headOfDepartment_id','head_name','numberofstage'];

    public function headOfDepartment()
    {
        return $this->belongsTo(User::class, 'headOfDepartment_id');
    }
    public function result():HasMany{
        return $this->hasMany(resultmarks::class,'department_id');

    }
    public function subjects():HasMany{
        return $this->hasMany(Subjects::class,'department_id');
    }
    public function staffs():HasMany{
        return $this->hasMany(staff::class,'department_id');
    }

}
