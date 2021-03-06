<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Assignment;
use App\Models\Exam;
class Teacher extends Authenticatable
{
    use HasFactory;
    // use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'instagram',
        'whatsapp',
        'level'
    ];

    protected $hidden = [
        'password',
        'created_at'

    ];
    public function Assignments(){
        return $this->hasMany(Assignment::class,'teacher_id','id');
    }
    public function Exams(){
        return $this->hasMany(Exam::class,'teacher_id','id');

    }
}
