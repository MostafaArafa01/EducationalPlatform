<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Http\Requests\StoreEnrollmentRequest;
use App\Http\Requests\UpdateEnrollmentRequest;
use Illuminate\Support\Facades\Gate;
use Exception   ;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            return Enrollment::paginate(10);
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEnrollmentRequest $request)
    {
        try{
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $paymentIntent = PaymentIntent::retrieve($request->paymentIntentId);
            if($paymentIntent->status==='succeeded'){
                return Enrollment::create([
                    'user_id' => Auth()->user()->id,
                    'course_id' => $request->course_id,
                ]);
            }
            else{
                return response()->json('Payment failed');
            }
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Enrollment $enrollment)
    {
        try{
            Gate::authorize('view',$enrollment);
            return $enrollment;
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEnrollmentRequest $request, Enrollment $enrollment)
    {
        try{
            $enrollment->update($request->validated());
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enrollment $enrollment)
    {
        try{
            Gate::authorize('delete',$enrollment);
            $enrollment->delete();
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }
}
