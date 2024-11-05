<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =[
        'title',
        'course_id',
        'status'
    ];

    public function course(){
        return $this->belongsTo(Course::class);
    }
}
