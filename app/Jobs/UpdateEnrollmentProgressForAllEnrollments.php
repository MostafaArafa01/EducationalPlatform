<?php

namespace App\Jobs;

use App\Models\Enrollment;
use App\Models\Lesson;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class UpdateEnrollmentProgressForAllEnrollments implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public $lesson;

    public function __construct(Lesson $lesson)
    {
        $this->lesson = $lesson;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $lesson = $this->lesson;
        $enrollments = Enrollment::all();
        foreach($enrollments as $enrollment){
            $completedLessonsCount=DB::table('enrollment_lesson')->where('enrollment_id', $enrollment->id)->count();
            $lessonsCount = Lesson::where('course_id',$lesson->course_id)->count();
            if($lessonsCount>0){
                $enrollment->progress = $completedLessonsCount / $lessonsCount * 100;
                $enrollment->save();
            }
            else{
                $enrollment->progress = 0;
                $enrollment->save();
            }
        }
    }
}
