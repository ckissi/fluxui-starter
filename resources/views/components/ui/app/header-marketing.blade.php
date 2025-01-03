<flux:header sticky container class="mx-auto border-b bg-zinc-50 dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

    <flux:brand href="{{ url('/') }}" logo="{{ url('/') }}/logo.png" name="{{ env('APP_NAME') }}"
        class="font-bold max-lg:hidden dark:hidden" />
    <flux:brand href="{{ url('/') }}" logo="{{ url('/') }}/logo.png" name="{{ env('APP_NAME') }}"
        class="max-lg:!hidden hidden dark:flex" />

    <flux:navbar class="-mb-px max-lg:hidden">
        {{-- <flux:navbar.item icon="bookmark" href="/favorites">My Favorites</flux:navbar.item>

        <flux:separator vertical variant="subtle" class="my-2" /> --}}

        {{-- <flux:dropdown class="max-lg:hidden">
            <flux:navbar.item icon-trailing="chevron-down">Other Projects</flux:navbar.item>
            <flux:navmenu>
                <flux:navmenu.item href="https://iconsax.dev/?ref=tablericons">Free SVG Icons</flux:navmenu.item>
            </flux:navmenu>
        </flux:dropdown> --}}
    </flux:navbar>

    {{-- <flux:navbar.item href="/become-a-sponsor" data-pan="become-a-sponsor">Become a Sponsor</flux:navbar.item>
    <flux:modal.trigger name="feedback">
        <flux:navbar.item data-pan="submit-feedback">Submit Request/Feedback</flux:navbar.item>
    </flux:modal.trigger> --}}

    <flux:spacer />

    <flux:navbar class="mr-4">
        <flux:button label="Login" href="/auth/login">Submit</flux:button>
    </flux:navbar>

    @if (auth()->check())
        <flux:dropdown position="top" align="start">
            <flux:profile avatar="{{ auth()->user()->avatar }}" />

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

    <flux:modal name="search" variant="bare" class="min-h-[30rem] w-full max-w-[30rem] px-6"
        x-on:keydown.cmd.k.document="$el.showModal()">
        <flux:command class="border-none shadow-lg">
            <flux:command.input placeholder="Search..." closable />

            <flux:command.items>
                <flux:command.item icon="user-plus" kbd="⌘A">Assign to…</flux:command.item>
                <flux:command.item icon="document-plus">Create new file</flux:command.item>
                <flux:command.item icon="folder-plus" kbd="⌘⇧N">Create new project</flux:command.item>
                <flux:command.item icon="book-open" href="/">Documentation</flux:command.item>
                <flux:command.item icon="newspaper">Changelog</flux:command.item>
                <flux:command.item icon="cog-6-tooth" kbd="⌘,">Settings</flux:command.item>
            </flux:command.items>
        </flux:command>
    </flux:modal>
</flux:header>


{{-- Settings modal --}}
<flux:modal name="please-login" class="space-y-6 md:w-96">
    <div>
        <flux:heading size="lg">Information</flux:heading>
        <flux:subheading>Setting are available for logged in users. Please register.</flux:subheading>
        <div class="flex justify-center mt-8">
            <flux:button href="/auth/login" variant="primary">Register</flux:button>
        </div>
    </div>
</flux:modal>
