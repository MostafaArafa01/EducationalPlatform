<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterRequest;
use App\Models\Course;
use Illuminate\Http\Request;

class FilterCoursesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(FilterRequest $request)
    {
        return Course::where('title','LIKE','%'.$request->keyword.'%')->get();
    }
}
