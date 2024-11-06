<?php

namespace App\Jobs;

use App\Models\Enrollment;
use App\Models\Lesson;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class UpdateEnrollmentProgressForSingleEnrollment implements ShouldQueue
{
    use Queueable, Dispatchable;

    /**
     * Create a new job instance.
     */

    public $enrollment;
    public $lesson;

    public function __construct(Enrollment $enrollment, Lesson $lesson)
    {
        $this->enrollment = $enrollment;
        $this->lesson = $lesson;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $enrollment = $this->enrollment;
        $lesson = $this->lesson;

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
