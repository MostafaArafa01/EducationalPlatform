<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =[
        'title',
        'instructor_id'
    ];

    public function instructor(){
        return $this->belongsTo(User::class,'instructor_id');
    }

    public function students(){
        return $this->hasMany(Enrollment::class);
    }

    public function lessons(){
        return $this->hasMany(Lesson::class);
    }
}
