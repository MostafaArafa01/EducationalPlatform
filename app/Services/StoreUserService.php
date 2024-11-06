<?php


namespace App\Services;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
class StoreUserService{
    public function execute(StoreUserRequest $request){
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $role = Role::where('name',$request->role)->first();
        $user->assignRole($role);
        return 'User created successfully';
    }
}