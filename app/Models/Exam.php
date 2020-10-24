<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Teacher;
use App\Models\Answer;
use App\Models\User;
use Illuminate\Support\Str;
use Auth;
class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'level',
        'teacher_id',
        'count',
        'info'
    ];

    protected $hidden = [
        'updated_at',
        'created_at'
    ];

    public function teacher(){
        return $this->belongsTo(Teacher::class,'teacher_id','id');
    }
    public function url(){
        return url("/Exams/{$this->id}-".Str::slug(json_decode($this->info)->name));
    }
    public function Resulturl(){
        return url("teacher/Result/{$this->id}-".Str::slug(json_decode($this->info)->name));
    }


    public function answers(){
        return $this->hasMany(Answer::class);

    }

    public function students(){
        return $this->hasManyThrough(Answer::class,User::class);

    }



}
