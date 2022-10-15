<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Hash;

class AuthController extends Controller
{

    public function index()
    {
        if(Auth::check()){
            $url = str_replace('_','',Auth::user()->role);
            return redirect($url);
        }
        return view('login');
    }

    public function login(Request $request){
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        $user = $request->only('login', 'password');
        $redirect = "login";

        if(Auth::attempt($user)) {
            $role = Auth::user()->role;
            $r = new RoleController();
            $successMessage = $r->getAuthMessage($role);
            $redirect = $r->redirectRole($role);
            session(['userRole'=>$role]);
            session(['userDescription'=> $r->getRoleDescription($role)]);
            return redirect($redirect)->with('success_msg', $successMessage);
        }

        return redirect($redirect)->with('error_msg', "Login yoki parol xato!");
    }

    public function logout() {
        Session::flush();
        Auth::logout();

        return redirect('login');
    }
}
