<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use App\Models\Teacher;
use App\Models\Activity;
use App\Models\User;
use Auth;
class Assignment extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'content',
        'type',
        'level',
        'files',
        'teacher_id'
    ];

    protected $hidden = [
        'updated_at',
        'created_at'
    ];
    public function teacher(){
        return $this->belongsTo(Teacher::class,'teacher_id','id');
    }

    public function url(){
        return url("/Assignments/{$this->id}-".Str::slug($this->name));
    }

    public function activities(){
        return $this->hasMany(Activity::class);

    }
    public function InActiveStudents(){
        return User::select('name','id')->whereDoesntHave('activities', function($query) {
            $query->where('assignment_id',$this->id);
          })->where('level',Auth::user()->level)->get();
        }

}
