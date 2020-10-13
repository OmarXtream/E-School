<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
    use HasFactory;
    protected $fillable = ['key'];
    protected $hidden = ['created_at'];
    public $timestamps = false;


    public function students(){
        return $this->hasMany('App\Models\User','key','key');
    }
}
