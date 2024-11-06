<?php


namespace App\Services;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
class UpdateUserService{
    public function execute(UpdateUserRequest $request,User $user){
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $role = Role::where('name',$request->role)->first();
        $user->syncRoles($role);
        return 'User updated successfully';
    }
}