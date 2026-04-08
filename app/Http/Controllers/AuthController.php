<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function redirect()
    {
        return Socialite::driver('azure')
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    public function callback()
    {
        try {
            $azureUser = Socialite::driver('azure')->user();

            $user = User::updateOrCreate([
                'email' => $azureUser->email,
            ], [
                'name' => $azureUser->name,
                'password' => bcrypt(str()->random(24)),
            ]);

            Auth::login($user);
            $token = $user->createToken('auth_token')->plainTextToken;

            return view('auth.callback_js', compact('token'));

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Auth failed: ' . $e->getMessage());
            return view('auth.callback_js', ['error' => $e->getMessage()]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Redirect to Microsoft Logout to clear their session too
        $tenant = env('AZURE_TENANT_ID', 'common');
        $logoutUrl = "https://login.microsoftonline.com/{$tenant}/oauth2/v2.0/logout?post_logout_redirect_uri=" . urlencode(route('login'));

        return redirect($logoutUrl);
    }
}
