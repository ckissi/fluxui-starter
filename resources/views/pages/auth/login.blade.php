<?php

use App\Models\User;
use Illuminate\Auth\Events\Login;
use function Laravel\Folio\{middleware, name};
use function Livewire\Volt\{state, rules};

//middleware(['guest']);
state(['email' => '', 'password' => '', 'remember' => false]);
rules(['email' => 'required|email', 'password' => 'required']);
name('login');

$authenticate = function () {
    $this->validate();

    if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
        $this->addError('email', trans('auth.failed'));

        return;
    }

    event(new Login(auth()->guard('web'), User::where('email', $this->email)->first(), $this->remember));

    return redirect()->intended('/profile/edit');
};

?>

<x-layouts.main>

    <div class="flex flex-col items-stretch justify-center w-screen min-h-screen py-10 sm:items-center">

        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <a href="{{ route('home') }}">
                {{-- <x-ui.logo class="w-auto h-10 mx-auto text-gray-700 fill-current dark:text-gray-100" /> --}}
            </a>

            <h2 class="mt-5 text-2xl font-extrabold leading-9 text-center text-gray-800 dark:text-gray-200">Sign in to
                your account</h2>
            @if (env('EMAIL_LOGIN_ENABLED', false))
                <div class="text-sm leading-5 text-center text-gray-600 dark:text-gray-400 space-x-0.5">
                    <span>Or</span>
                    <a href="{{ route('register') }}" class="underline">create a new account</a>
                </div>
            @endif

            @env('local')
            <x-login-link email="ckissi@gmail.com" />
            @endenv
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
                    @volt('auth.login')
                        <form wire:submit="authenticate" class="space-y-6">

                            <flux:input label="Email address" type="email" id="email" name="email"
                                wire:model="email" />
                            <flux:input label="Password" type="password" id="password" name="password"
                                wire:model="password" />

                            <div class="flex items-center justify-between mt-6 text-sm leading-5">
                                <flux:checkbox label="Remember me" id="remember" name="remember" wire:model="remember" />
                                <a href="{{ route('password.request') }}" class="underline">Forgot your password?</a>
                            </div>

                            <flux:button type="primary" rounded="md" submit="true">Sign in</flux:button>
                        </form>
                    @endvolt
                @endif
            </div>
        </div>

    </div>

</x-layouts.main>
