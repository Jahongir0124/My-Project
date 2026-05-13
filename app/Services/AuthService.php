<?php

namespace app\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Request;

class AuthService {


    public function login(array $data)
    {
        if(!Auth::attempt($data)){
                return null;
            }
        request()->session()->regenerate();
        return Auth::user();
    }


   
}