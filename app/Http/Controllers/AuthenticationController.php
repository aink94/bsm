<?php

namespace bsm\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use bsm\Model\Pegawai as Users;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationController extends Controller
{
    public function getLogin()
    {
        return view('login');
    }

    public function postLogin(Request $request, Users $user)
    {
        $credentials = $request->only('username', 'password');
        if(!Auth::attempt($credentials, $request->has('remember')))
        {
            return Response()->json(['Username atau Password yang anda masukan salah'], 401);
        }

        $user = $user->find(Auth::user()->id);

        return Response()->json([
            'intended' => URL::route('dashboard')
        ], 201);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
