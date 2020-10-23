<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Exam;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = ['exam_id','user_id','info','mark'];

    protected $hidden = ['created_at'];
    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function exam(){
        return $this->belongsTo(Exam::class,'exam_id','id');

    }


}
