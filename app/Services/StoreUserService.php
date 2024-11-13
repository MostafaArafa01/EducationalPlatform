<?php


namespace App\Services;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
class StoreUserService{
    public function execute(StoreUserRequest $request){
        try{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'timezone' => $request->timezone,
            ]);
            $role = Role::where('name',$request->role)->first();
            $user->assignRole($role);
            return 'User created successfully';
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }
}