<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Exception;
use App\Services\StoreUserService;
use App\Services\UpdateUserService;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            return User::paginate(20);
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request, StoreUserService $storeUserService)
    {
        try{
            return $storeUserService->execute($request);
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        try{
            return $user;
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user, UpdateUserService $updateUserService)
    {
        try{
            return $updateUserService->execute($request,$user);
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try{
            Gate::authorize('delete',$user);
            $user->delete();
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }
}
