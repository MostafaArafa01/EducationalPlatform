<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterRequest;
use App\Models\Course;
use Illuminate\Http\Request;
use Exception;

class FilterCoursesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(FilterRequest $request)
    {
        try{
            return Course::where('title','LIKE','%'.$request->keyword.'%')->get();
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }
}
