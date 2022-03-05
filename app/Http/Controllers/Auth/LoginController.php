<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{

    use AuthenticatesUsers;


    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'login' => 'required',
            'password' => 'required',
        ]);

        Log::info($request->all());

        $login_type = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'staffId';

        $request->merge([
            $login_type => $request->input('login')
        ]);

        $userCheck = DB::connection('mysql')->table('mktusers')->where('email', $request->input('login'))->orWhere('staffId', $request->input('login'))->exists();

        if(!$userCheck) {
            return redirect()->back()
                ->withInput()
                ->withErrors([
                    'login' => 'Hey! User does not exist Ok.',
                ]);
        }

        if (Auth::attempt($request->only($login_type, 'password'))) {
            $user = auth()->user();
            if($user->hasRole('admin') && $user->status == true) {

                return redirect('/dashboard');

            } elseif ($user->hasRole('marketer') && $user->status == true) {

                return redirect('/dashboard');

            } elseif ($user->hasRole('team-leader') && $user->status == true) {

                return redirect('/dashboard');

            } elseif ($user->hasRole('hod') && $user->status == true) {
                return redirect('/dashboard');

            } elseif($user->hasRole('region-head') && $user->status == true) {
                return redirect('/dashboard');
            } else {

                Auth::logout();

                session()->flush();

                session()->regenerate();

                return redirect('/');
            }
        }

        return redirect()->back()
            ->withInput()
            ->withErrors([
                'login' => 'These credentials do not match our records.',
            ]);
    }

    // public function authenticated()
    // {
    //     $user = auth()->user();

    //     if($user->hasRole('admin') && $user->status == true) {

    //         return redirect('/dashboard');

    //     } elseif ($user->hasRole('marketer') && $user->status == true) {

    //         return redirect('/dashboard');

    //     } elseif ($user->hasRole('team-leader') && $user->status == true) {

    //         return redirect('/dashboard');

    //     } elseif ($user->hasRole('hod') && $user->status == true) {
    //         return redirect('/dashboard');

    //     } elseif($user->hasRole('region-head') && $user->status == true) {
    //         return redirect('/dashboard');
    //     } else {

    //         Auth::logout();

    //         session()->flush();

    //         session()->regenerate();

    //         return redirect('/');
    //     }
    // }
}
