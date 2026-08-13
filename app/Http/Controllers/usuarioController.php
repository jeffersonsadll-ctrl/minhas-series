<?php 

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class usuarioController extends Controller
{
    public function create()
    {
        return view('usuario.create');
    }

    public function store()
    {
        $dados = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:3'],
        ]);

        $user = new User();
        $user->name = $dados['name'];
        $user->email = $dados['email'];
        $user->password = Hash::make($dados['password']);
        $user->save();

        Auth::login($user);

        return redirect()->route('series.index');
    }
}