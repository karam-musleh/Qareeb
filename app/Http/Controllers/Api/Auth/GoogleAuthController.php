<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    //
    public function redirect()
    {
        return Socialite::driver('google')
            ->stateless()
            ->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')
                ->stateless()
                ->user();

            $user = User::updateOrCreate(
                [
                    'email' => $googleUser->getEmail()
                ],
                [
                    'name' => $googleUser->getName(),
                    'google_id' => $googleUser->getId(),
                    'password' => Hash::make(Str::random(24)),
                    'email_verified_at' => now(),
                ]
            );


            $token = Auth::guard('api')->login($user);
            $frontendUrl = env('FRONTEND_URL', 'http://localhost:3000');

            $userData = base64_encode(json_encode([
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
            ]));
            return redirect("{$frontendUrl}/auth/callback?token={$token}&user={$userData}");

            // return response()->json([
            //     'status' => true,
            //     'message' => 'تم تسجيل الدخول بنجاح',
            //     'user' => $user,
            //     'token' => $token,
            // ]);
        } catch (\Exception $e) {
            // return response()->json([
            //     'status' => false,
            //     'message' => 'فشل تسجيل الدخول مع Google',
            //     'error' => $e->getMessage()
            // ], 500);
            $frontendUrl = env('FRONTEND_URL', 'http://localhost:3000');
            return redirect("{$frontendUrl}?error=google_auth_failed");
        }
    }
}
