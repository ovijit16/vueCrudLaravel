<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'class_id', 'section_id', 'name', 'gender', 'phone', 'password', 'email', 'photo', 'address'
    ];
}
