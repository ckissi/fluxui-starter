<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Revolution\Bluesky\Session\OAuthSession;
use Revolution\Bluesky\Facades\Bluesky;
use Illuminate\Http\RedirectResponse;

class SocialiteController extends Controller
{
    public function login(Request $request)
    {
        // A form page to submit a login hint.
        return view('login');
    }

    public function redirect(Request $request)
    {
        // You can specify the handle, DID, or PDS URL as a login hint. It can be empty.
        $hint = $request->input('login_hint');
        $request->session()->put('hint', $hint);

        return Socialite::driver('bluesky')
            ->hint($hint)
            ->redirect();

        // If you don’t need a hint you can skip this step and just redirect straight away like with other providers.
    }

    public function callback(Request $request)
    {
        if ($request->missing('code')) {
            dd($request);
        }

        $hint = $request->session()->pull('hint');

        /**
         * @var \Laravel\Socialite\Two\User
         */
        $user = Socialite::driver('bluesky')
            ->hint($hint)
            ->user();

        /** @var OAuthSession $session */
        $session = $user->session;
        //dd($session->toArray());


        // Since $user has an OAuthSession, it is saved in Laravel's session.
        $request->session()->put('bluesky_session', $session->toArray());
        //dd(auth()->id());

        $loginUser = Account::updateOrCreate([
            'did' => $session->did(), // Bluesky DID (did:plc:...)
        ], [
            'user_id' => auth()->id(),
            'iss' => $session->issuer(), // Bluesky iss (https://bsky.social)p
            'handle' => $session->handle(), // Bluesky handle (alice.test)
            'display_name' => $session->displayName(), // Bluesky displayName (Alice)
            'avatar' => $session->avatar(),
            'access_token' => $session->token(),
            'refresh_token' => $session->refresh(),
            'session_data' => serialize($session->toArray()), // Bluesky session data (JSON)
        ]);

        return to_route('dashboard');
    }

    public function loginSocial(Request $request, string $provider): RedirectResponse
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callbackSocial(Request $request, string $provider)
    {
        $newUser = false;
        $response = Socialite::driver($provider)->user();
        $user = User::whereEmail($response->getEmail())->first();
        if ($user) {
            $password = $user->password;
            $email_verified_at = $user->email_verified_at;
        } else {
            $password = '&o7V&ZnEzxqThX';
            $newUser = true;
        }
        if (!isset($email_verified_at)) $email_verified_at = now();
        $user = User::updateOrCreate(
            ['email' => $response->getEmail()],
            [
                'name' => $response->getName() ?? $response->getNickname,
                'provider' => $provider,
                'provider_id' => $response->getId(),
                'token' => $response->token,
                'token_secret' => $response->tokenSecret,
                'avatar'  => strlen($response->getAvatar()) < 255 ? $response->getAvatar() : null,
                'password' => $password,
                'email_verified_at' => $email_verified_at,
            ]
        );

        Auth::login($user, remember: true);

        if ($newUser)
            return redirect()->route('profile.edit')->with('status', 'registered');
        else
            return redirect()->route('dashboard');
    }
}
