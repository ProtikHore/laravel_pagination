<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
//        protected $maxAttempts = 1;
//        protected $decayMinutes = 1;
        $loginData = $request->except('_token', 'confirmed');
        $loginData['password'] = sha1($loginData['password']);
        $user = User::where($loginData)->where('status', 'Active')->first();
        if ($user) {
            session([
                'login_status' => true,
                'id' => $user->id,
                'name' => $user->name
            ]);
            return response()->json('Authorized User');
        } else {
            return response()->json('Unauthorized Access!');
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }
}
