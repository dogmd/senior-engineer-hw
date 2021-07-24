<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = $request->user();
            
            // revoke current tokens and generate a new one
            $user->tokens()->delete();
            $token = $user->createToken('access');

            return ['token' => $token->plainTextToken];
        }

        return [
            'username' => 'The provided credentials do not match our records.',
        ];
    }

    public function signout(Request $request) {
      // revoke tokens and save sign out datetime
      $user = $request->user();
      $user->tokens()->delete();
      $time = \Carbon\Carbon::now();
      $user->signed_out_at = $time->toDateTimeString();
      $user->save();

      return [
        'status' => 'Successfully signed out'
      ];
    }
}