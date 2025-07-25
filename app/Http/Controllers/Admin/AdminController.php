<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    /*
     * After logging as admin the dashboard for admin
     * @return \Illuminate\Contracts\Support\Referable
     * */
    public function adminDashboard()
    {
        $admin = Auth::guard('admin')->user();
        if($admin){
            Session::put(['name' => $admin->name, 'email' => $admin->email]);
        }

        return view('admin.dashboard');
    }

    /**
     * Logout function
     *
     * @return void
     */
    public function adminLogout()
    {
        Auth::guard('admin')->logout();
        Session::flush();
        return redirect()->route('admin.login');
    }
}
