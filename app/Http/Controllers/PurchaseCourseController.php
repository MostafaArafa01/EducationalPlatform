<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnrollmentRequest;
use App\Models\Course;
use Illuminate\Http\Request;

class PurchaseCourseController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreEnrollmentRequest $request)
    {
        $course = Course::find($request->course_id);
        if($course->type == 'regular'){
            $paymentIntent = $request->user()->pay($course->price*100);
            return response()->json([
                'clientSecret' => $paymentIntent->client_secret,
            ]);
        }
        else{
            return $request->user()->newSubscription('basic','price_1QIUWVLetA65yvrK0ILQdMky')->create($request->paymentMethod);
        }
    }
}
