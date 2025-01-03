<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

use function Laravel\Folio\name;
use function Livewire\Volt\{state, rules, mount};

state(['token', 'email', 'password', 'passwordConfirmation']);
rules(['token' => 'required', 'email' => 'required|email', 'password' => 'required|min:8|same:passwordConfirmation']);
name('password.reset');

mount(function ($token) {
    $this->email = request()->query('email', '');
    $this->token = $token;
});

$resetPassword = function () {
    $this->validate();

    $response = Password::broker()->reset(
        [
            'token' => $this->token,
            'email' => $this->email,
            'password' => $this->password,
        ],
        function ($user, $password) {
            $user->password = Hash::make($password);

            $user->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));

            Auth::guard()->login($user);
        },
    );

    if ($response == Password::PASSWORD_RESET) {
        session()->flash(trans($response));

        return redirect('/');
    }

    $this->addError('email', trans($response));
};

?>

<x-layouts.main>
    <div class="flex flex-col items-stretch justify-center w-screen min-h-screen py-10 sm:items-center">

        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <a href="{{ route('home') }}">
                {{-- <flux:logo class="w-auto h-10 mx-auto text-gray-700 fill-current dark:text-gray-100" /> --}}
            </a>
            <h2 class="mt-5 text-2xl font-extrabold leading-9 text-center text-gray-800 dark:text-gray-200">Reset
                password</h2>
        </div>
        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div
                class="px-10 py-0 sm:py-8 sm:shadow-sm sm:bg-white dark:sm:bg-gray-950/50 dark:border-gray-200/10 sm:border sm:rounded-lg border-gray-200/60">
                @volt('auth.password.token')
                    <form wire:submit="resetPassword" class="space-y-6">
                        <flux:input label="Email address" type="email" id="email" name="email" wire:model="email" />
                        <flux:input label="Password" type="password" id="password" name="password" wire:model="password" />
                        <flux:input label="Confirm Password" type="password" id="password_confirmation"
                            name="password_confirmation" wire:model="passwordConfirmation" />
                        <flux:button type="primary" rounded="md" submit="true">Reset password</flux:button>
                    </form>
                @endvolt
            </div>
        </div>
    </div>
</x-layouts.main>
