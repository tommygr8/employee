<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Interfaces\Auth\AuthInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    private AuthInterface $service;

    public function __construct(AuthInterface $service)
    {
       // $this->middleware('guest', ['except' => 'logout']);

        $this->service = $service;
    }

    public function loginPage()
    {
        return view('auth.login');

    }

    public function login(LoginRequest $request)
    {
        $response = $this->service->login($request->all());
        if(!$response) {
            return back()->with('error','Invalid Username or Password');
        }

        return redirect('waitlist');

    }

    public function username()
    {
        return 'username';
    }
    public function logout(Request $request)
    {
        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/login');

    }
}
