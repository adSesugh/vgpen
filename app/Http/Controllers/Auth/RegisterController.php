<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Models\Role;

class RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'staffId'  =>   ['required', 'string', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        $slug = request()-> get('name').' '.'PS0215';
        $user = User::create([
            'name' => request()-> get('name'),
            'email' => request()-> get('email'),
            'password' => Hash::make(request()-> get('password')),
            'staffId'   =>  'PS0215',
            'status'    => true,
            'slug'  => Str::of($slug)->slug('-'),
        ]);

        $role = Role::where('name', 'admin')->first();

        $user->assignRole($role);

        return $user;
    }
}
