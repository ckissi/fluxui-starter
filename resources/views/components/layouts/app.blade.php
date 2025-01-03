<x-layouts.main>

    <x-ui.app.header-app />
    <div class="mx-auto max-w-7xl" x-data="{
        show_sidebar: localStorage.getItem('show_sidebar') === 'true' || localStorage.getItem('show_sidebar') === null
    }">
        {{-- <x-ui.app.sidebar /> --}}
        {{ $slot }}
    </div>
</x-layouts.main>
