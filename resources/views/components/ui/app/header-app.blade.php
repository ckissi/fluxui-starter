<flux:header sticky container class="mx-auto border-b bg-zinc-50 dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

    <flux:brand href="{{ url('/dashboard') }}" logo="{{ url('/') }}/assets/images/logo.png"
        name="{{ env('APP_NAME') }}" class="font-bold max-lg:hidden dark:hidden" />
    <flux:brand href="{{ url('/dashboard') }}" logo="{{ url('/') }}/assets/images/logo.png" name="BSkyBanner"
        class="max-lg:!hidden hidden dark:flex" />

    <flux:navbar class="-mb-px max-lg:hidden">
        <flux:navbar.item href="/accounts">Accounts</flux:navbar.item>
        <flux:separator vertical variant="subtle" class="my-2" />
    </flux:navbar>



    <flux:spacer />

    {{-- <flux:navbar class="mr-4">
        <flux:button label="Login" href="/auth/login">Submit</flux:button>
    </flux:navbar> --}}

    @if (auth()->check())
        <flux:dropdown position="top" align="start">

            <flux:profile
                avatar="{{ auth()->user()->avatar != '' ? auth()->user()->avatar : 'https://ui-avatars.com/api/?name=' . auth()->user()->name . '&color=7F9CF5&background=EBF4FF' }}" />

            <flux:menu>
                <flux:menu.item href="{{ route('profile.edit') }}">{{ auth()->user()->name }}</flux:menu.item>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item icon="arrow-right-start-on-rectangle"
                        onclick="event.preventDefault(); this.closest('form').submit();">Logout</flux:menu.item>
                </form>

            </flux:menu>
        </flux:dropdown>
    @else
        @if (env('LOGIN_ENABLED'))
            <flux:button label="Login" href="/auth/login">Login</flux:button>
        @endif
    @endif

    <flux:sidebar stashable sticky
        class="z-20 border-r lg:hidden bg-zinc-50 dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <flux:brand href="#" logo="{{ url('/') }}/assets/images/logo.png" name="{{ env('APP_NAME') }}"
            class="px-2 dark:hidden" />
        <flux:brand href="#" logo="{{ url('/') }}/assets/images/logo.png" name="{{ env('APP_NAME') }}"
            class="hidden px-2 dark:flex" />

        <flux:navlist variant="outline">
            <flux:navlist.item href="/dashboard">Dashboard</flux:navlist.item>
            <flux:navlist.item href="/accounts">Accounts</flux:navlist.item>
        </flux:navlist>
    </flux:sidebar>
</flux:header>
