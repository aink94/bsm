<?php

namespace bsm\Http\Controllers;

use bsm\Model\Pegawai as Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        if ($request->ajax()) {
            $this->validate($request, [
                'username' => 'required',
                'password' => 'required',
            ]);
            $credentials = $request->only('username', 'password');
            if (!Auth::attempt($credentials, $request->has('remember'))) {
                return Response()
                    ->json(['title'=>'error', 'message'=>'Username atau Password yang anda masukan salah'], 401);
            }

            $user = $user->find(Auth::user()->id);

            return Response()->json([
                'intended' => URL::route('dashboard'),
            ], 201);
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
