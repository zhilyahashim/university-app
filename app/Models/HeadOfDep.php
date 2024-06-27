<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeadOfDep extends Model
{
    use HasFactory;
    protected $fillable=[
        'head_name',
        'head_email',
        'head_password',
        'head_phone',
        'head_stage',
        'head_image',
        'role',
    ];
}
