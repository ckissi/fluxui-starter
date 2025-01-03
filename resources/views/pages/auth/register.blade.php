<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Models\UserDetail;
use App\Models\Referral;
use App\Models\Social;
use App\Models\ViewsSum;

use function Laravel\Folio\{middleware, name};
use function Livewire\Volt\{state, rules};

middleware(['guest']);
state(['name' => '', 'email' => '', 'password' => '', 'passwordConfirmation' => '']);
rules(['name' => 'required', 'email' => 'required|email|unique:users', 'password' => 'required|min:8|same:passwordConfirmation']);
name('register');

$register = function () {
    $this->validate();

    $user = User::create([
        'email' => $this->email,
        'name' => $this->name,
        'password' => Hash::make($this->password),
    ]);

    // $referralCode = Cookie::get(config('referral.cookie_name'));
    // if ($referralCode != '') {
    //     $referrer = Referral::userByReferralCode($referralCode);
    //     $user->createReferralAccount($referrer->id);
    // }

    event(new Registered($user));

    Auth::login($user, true);

    return redirect()->intended('/profile/edit')->with('status', 'registered');
};

?>

<x-layouts.main>

    <div class="flex flex-col items-stretch justify-center w-screen min-h-screen py-0 sm:items-center">

        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <a href="{{ route('home') }}" class="flex justify-center">
                {{-- <x-ui.logo class="w-auto h-10 mx-auto text-gray-700 fill-current dark:text-gray-100" /> --}}
            </a>
            <h2 class="mt-5 text-2xl font-extrabold leading-9 text-center text-gray-800 dark:text-gray-200">Create a
                new
                account</h2>
            <div class="text-sm leading-5 text-center text-gray-600 dark:text-gray-400 space-x-0.5">
                <span>Or</span>
                <a href="{{ route('login') }}" class="underline">sign in to your account</a>
            </div>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div
                class="px-10 py-0 sm:py-8 sm:shadow-sm sm:bg-white dark:sm:bg-gray-950/50 dark:border-gray-200/10 sm:border sm:rounded-lg border-gray-200/60">
                <div class="-mt-4">
                    <x-ui.google-button />
                    <x-ui.github-button />
                </div>

                @if (env('EMAIL_LOGIN_ENABLED', false))
                    <flux:separator text="or" class="my-8" />
                    @volt('auth.register')
                        <form wire:submit="register" class="space-y-6">
                            <flux:input label="Name" type="text" id="name" name="name" wire:model="name" />
                            <flux:input label="Email address" type="email" id="email" name="email"
                                wire:model="email" />
                            <flux:input label="Password" type="password" id="password" name="password"
                                wire:model="password" />
                            <flux:input label="Confirm Password" type="password" id="password_confirmation"
                                name="password_confirmation" wire:model="passwordConfirmation" />
                            <flux:button type="primary" rounded="md" submit="true">Register</flux:button>
                        </form>
                    @endvolt
                @endif
            </div>
        </div>

    </div>

</x-layouts.main>
