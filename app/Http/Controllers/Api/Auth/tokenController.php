<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TokenController extends Controller
{
  public function criarToken(Request $request): JsonResponse
  {
    $credenciais = $request->only('email', 'password');

    if (Auth::attempt($credenciais) === false) {
      return response()->json(['message' => 'Login e/ou senha inválidos.'], 401);
    }

    /** @var User $usuario */
    $usuario = Auth::user();

    return response()->json([
      'token' => $this->conferirTokenUserExistente($usuario),
    ]);
  }

  // alternativa de criarToken usando o banco de dados para validar a senha, sem usar o Auth::attempt
  private function criarToken_usandoBanco(Request $request): JsonResponse
  {
    $credenciais = $request->only('email', 'password');
    $senha = Hash::make(" ");

    $usuario = User::where('email', $credenciais['email'])->first();
    if( $usuario !== null ){
      $senha = $usuario->password;
    }

    if( $usuario === null || Hash::check($senha, $usuario->password) === false ){
      return response()->json(['message' => 'Login e/ou senha inválidos.'], 401);
    }

    $token = $usuario->createToken('token_login_' . $credenciais['email'], ['*'], now()->addDays(7));

    return response()->json(['token' => $token->plainTextToken]);
  }

  /**
   * Sanctum stores only a hash of the token, so an existing plain-text token
   * cannot be recovered. Rotate the login token and return the new plain token.
   */
  private function conferirTokenUserExistente(User $usuario): string
  {
    $nomeToken = 'token_login_' . $usuario->email;

    $usuario->tokens()
      ->where('name', $nomeToken)
      ->delete();

    $token = $usuario->createToken($nomeToken, ['*'], now()->addDays(7));

    return $token->plainTextToken;
  }
}
