<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompleteLessonRequest;
use App\Models\Enrollment;
use App\Models\Lesson;
use DB;
use Illuminate\Http\Request;

class CompleteLessonController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CompleteLessonRequest $request)
    {
        $enrollment = Enrollment::find($request->enrollment_id);
        $lesson = Lesson::find($request->lesson_id);
        $enrollment->completedLessons()->attach($lesson);
        $enrollment->progress = DB::table('enrollment_lesson')->where('enrollment_id', $enrollment->id)->count() 
        / Lesson::where('course_id',$lesson->course_id)->count()*100;
        $enrollment->save();
    }
}
