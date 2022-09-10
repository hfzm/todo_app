<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Auth;
use DB;

class AuthController extends Controller
{
    public function authentication(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = User::where('email', $request->email)->first();

            shell_exec('php ../artisan passport:install');
            $successToken = $user->createToken('my-api-token')->accessToken;
            session()->put('token', $successToken);

            return redirect()->intended('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request) 
    {
        $user = Auth::user();
        DB::table('oauth_access_tokens')->where('id', $request->token_id)->where('user_id', $user->id)->update(['revoked' => 1]);

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
