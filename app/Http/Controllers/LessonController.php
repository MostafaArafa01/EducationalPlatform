<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use Illuminate\Support\Facades\Gate;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Lesson::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLessonRequest $request)
    {
        return Lesson::create([
            'title' => $request->title,
            'course_id' => $request->course_id,
            'status' => $request->status,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Lesson $lesson)
    {
        Gate::authorize('view',$lesson);
        return $lesson;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLessonRequest $request, Lesson $lesson)
    {
        $lesson->update([
            'title' => $request->title,
            'course_id' => $request->course_id,
            'status' => $request->status,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lesson $lesson)
    {
        Gate::authorize('delete',$lesson);
        $lesson->delete();
    }
}
