<?php


namespace App\Services;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class LoginService{
    public function login(LoginRequest $request)
    {
        $user = User::where('email',$request->email)->first();
        if ($user && Hash::check($request->password , $user -> password)) {
            $token = $user->createToken($request->email);
            return $token;
        }
        return 'The provided credentials do not match our records.';
    }
}