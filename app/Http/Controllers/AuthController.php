<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use  App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{   
    // Login view bilan ulash
    public function loginView()
    {
        return view('auth.login');
    }


    // Login controller 
    public function __construct(private AuthService $authservice){}

    public function login(LoginRequest $request)
    {

        $user = $this->authservice->login($request->validated());

        if (!$user) {
            return back()->withErrors([
                'email' => 'Login yoki parol notogri'
            ]);
        }
       
        return $this->redirectByRole($user);

    }


    private function redirectByRole($user){

        return match ($user->role) {
            
            'admin' => redirect('admin/dashboard'),
            'teacher' => redirect('teacher/dashboard'),
             'student' => redirect('/dashboard')
        };

    }


    public function logout(Request $request)
        {
            Auth::logout();


            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect('login');
        }

}
