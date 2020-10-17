<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'content',
        'type',
        'level',
        'files',
    ];

    protected $hidden = [
        'updated_at',
        'created_at'
    ];

}
