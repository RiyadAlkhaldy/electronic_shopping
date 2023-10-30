<?php

namespace App\Actions\Fortify;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AuthenticateUser  
{
    public function authenticate($request)
    {
        $username = $request->post(Config('fortify.
        username'));
        $password = $request->post('password');
        $user = Admin::where('username',$username)
        ->orWhere('email',$username)
        ->orWhere('phone_number',$username)
        ->first();
        
        if($user && Hash::check($password,$user->password)){
            return $user;
        }
        return false;
    }
     
}
