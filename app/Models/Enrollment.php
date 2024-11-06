<?php

namespace App\Models;

use App\Observers\EnrollmentObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([EnrollmentObserver::class])]
class Enrollment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =[
        'user_id',
        'course_id',
        'progress'
    ];

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function completedLessons(){
        return $this->belongsToMany(Lesson::class);
    }
}
