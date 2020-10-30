<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Assignment;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = ['assignment_id','user_id'];

    protected $hidden = ['created_at'];
    public $timestamps = false;

    public function student(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function assignment(){
        return $this->belongsTo(Assignment::class,'assignment_id','id');

    }


}
