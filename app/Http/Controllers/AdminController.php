<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * Admin Login Form Show
     */
    public function showAdminLoginForm(){
        return view('admin.login');
    }


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * Admin Register Form Show
     */
    public function showAdminRegisterForm(){
        return view('admin.register');
    }


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * Admin DAshboard Show
     */
    public function showAdminDashboard(){
        return view('admin.dashboard');
    }
}
