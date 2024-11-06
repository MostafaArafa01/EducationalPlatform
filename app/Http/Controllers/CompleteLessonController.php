<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompleteLessonRequest;
use App\Jobs\UpdateEnrollmentProgressForSingleEnrollment;
use App\Models\Enrollment;
use App\Models\Lesson;
use DB;
use Exception;
use Illuminate\Http\Request;

class CompleteLessonController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CompleteLessonRequest $request)
    {
        try{
            $enrollment = Enrollment::find($request->enrollment_id);
            $lesson = Lesson::find($request->lesson_id);
            $enrollment->completedLessons()->attach($lesson);
            UpdateEnrollmentProgressForSingleEnrollment::dispatch($enrollment, $lesson);
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }
}
