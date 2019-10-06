<?php

namespace oniyow\Http\Controllers\Auth;

use oniyow\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm($e = ""){
        $titulo = "login";
        return view("auth.login",compact("titulo","e"));
    }

    public function username(){
        return 'usuario';
    }

    public function login(Request $r){
        $usuario = $r->input("usuario");
        $pass = $r->input("password");

        if (Auth::attempt(['usuario' => $usuario, 'password' => $pass])){
            return redirect()->route("welcome");
        }
        return $this->showLoginForm("error-show-login");
    }
}
