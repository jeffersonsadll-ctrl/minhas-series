<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function index()
    {
      return view('login.index');
    }

    public function autenticar()
    {
        $credenciais = request()->only(['email', 'password']);

        if( !Auth::attempt($credenciais) ) {
            return redirect()->route('login.index')->withErrors(['email' => 'E-mail ou senha inválidos.']);
        }

        return redirect()->route('series.index');
    }

    public function deslogar()
    {
        Auth::logout();
        return redirect()->route('login.index');
    }
}