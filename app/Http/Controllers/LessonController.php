<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use Illuminate\Support\Facades\Gate;
use Exception;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            return Lesson::paginate(10);
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLessonRequest $request)
    {
        try{
            return Lesson::create([
                'title' => $request->title,
                'course_id' => $request->course_id,
            ]);
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Lesson $lesson)
    {
        try{
            Gate::authorize('view',$lesson);
            return $lesson;
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLessonRequest $request, Lesson $lesson)
    {
        try{
            $lesson->update([
                'title' => $request->title,
                'course_id' => $request->course_id,
            ]);
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lesson $lesson)
    {
        try{
            Gate::authorize('delete',$lesson);
            $lesson->delete();
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }
}
