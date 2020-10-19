<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Teacher;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'des',
        'level',
        'teacher_id'
    ];

    protected $hidden = [
        'updated_at',
        'created_at'
    ];

    public function teacher(){
        return $this->belongsTo(Teacher::class,'teacher_id','id');
    }

}
