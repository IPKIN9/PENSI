<?php

namespace App\Http\Controllers\MyAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('Landing.Login');
    }

    public function register()
    {
        return view('Landing.Register');
    }

    public function store(Request $request)
    {
        $valid = array(
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'confirmed|min:6'
        );
        $request->validate($valid);
        $data = array(
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'created_at' => now(),
            'updated_at' => now()
        );
        DB::table('users')->insert($data);
        return redirect(round('login'))->with('status', 'Register success');
    }

    public function authcheck(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $users = DB::table('users')
            ->where('email', $request->input('email'))
            ->value('name');
        if (Auth::attempt($credentials)) {
            $request->session()->put('users', $users);
            return redirect(route('dashboard.index'));
        }
        return redirect(route('Auth.index'))->with('status', 'Username or Password not match!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }
}
