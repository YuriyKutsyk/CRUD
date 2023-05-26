<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\User\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Application as App;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class AuthController extends Controller
{
    public function __construct(public readonly UserRepository $userRepository)
    {
    }

    public function login(): Application|Factory|View|App
    {
        return view('auth.login');
    }

    public function postLogin(LoginRequest $request): Application|App|RedirectResponse|Redirector
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard')->withSuccess('You have successfully logged.');
        }
        return redirect("login")->withDanger('Oppes! You have entered invalid credentials.');
    }

    public function register(): Application|Factory|View|App
    {
        return view('auth.register');
    }

    public function postRegister(RegisterRequest $request): Application|App|RedirectResponse|Redirector
    {
        $this->userRepository->create(
            [
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => password_hash($request->password, PASSWORD_BCRYPT)
            ]
        );
        return redirect()->route('login')->withSuccess('Registration Success. Please Login!');
    }

    public function dashboard(): Application|Factory|View|App|RedirectResponse|Redirector
    {
        if(Auth::check()){
            return view('auth.dashboard');
        }

        return redirect("login")->withSuccess('Opps! You do not have access...');
    }

    public function logout(): Application|App|RedirectResponse|Redirector
    {
        Session::flush();
        Auth::logout();

        return redirect('login');
    }
}
