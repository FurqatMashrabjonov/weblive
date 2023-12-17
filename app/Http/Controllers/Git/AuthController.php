<?php

namespace App\Http\Controllers\Git;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\NoReturn;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirect($driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    public function callback($driver)
    {
        $user = Socialite::driver($driver)->user();
        $localUser = User::where('email', $user->getEmail())->first();
        if (!$localUser) {
            $localUser = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => bcrypt('12345678'),
            ]);
        }

        $localUser->versionControlDrivers()->updateOrCreate(
            ['driver' => $driver],
            [
                'driver_id' => $user->getId(),
                'token' => $user->token,
                'refresh_token' => $user->refreshToken,
                'expires_in' => $user->expiresIn,
                'nickname' => $user->getNickname(),
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'avatar' => $user->getAvatar(),
                'user' => $user->user,
            ]);


        auth()->login($localUser, true);
        return redirect()->to('/dashboard');
    }
}
