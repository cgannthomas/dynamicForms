<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;
use DB;
use Illuminate\Foundation\Validation\ValidatesRequests;


class AdminAuthController extends Controller
{

    protected $guardName = 'admin';

    use AuthenticatesUsers {
        logout as performLogout;
    }

    public function __construct()
    {
        $this->loginRoute = '/admin-login';
    }

    public function getLogin()
    {
        return view('admin.auth.login');
    }

    public function postLogin(Request $request)
    {
        $validatedData =$request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);
        
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            $this->sendLockoutResponse($request);
        }

        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];
        
        if (Auth::guard($this->guardName)->attempt($credentials)) {
            $request->session()->regenerate();
            $this->clearLoginAttempts($request);
            return redirect()->route('admin.dashboard');
        } else {
            $this->incrementLoginAttempts($request);
            return redirect()->back()
                ->withInput()
                ->with('commonError', 'Incorrect user login details!');
        }
    }

    
}
