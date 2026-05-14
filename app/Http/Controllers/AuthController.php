<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index(){
        return view("modules/auth/login");
    }

    public function logear(Request $request) {
        $creadenciales = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($creadenciales)) {
            $rol = Auth::user()->rol;
            if ($rol == 'administrador') {
                return to_route('admin.home');
            } else {
                return to_route('home');
            }
        } else {
            return to_route('login');
        }
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return to_route('login');
    }
    
    public function home() {
        return view('modules/dashboard/home');
    }

    public function adminHome() {
        return view('modules/admin/dashboard');
    }
}
