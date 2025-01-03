<x-layouts.main>
    <div class="max-w-4xl mx-auto" x-data="{
        show_sidebar: localStorage.getItem('show_sidebar') === 'true' || localStorage.getItem('show_sidebar') === null
    }">
        {{-- <x-ui.app.sidebar /> --}}
        {{ $slot }}
    </div>
</x-layouts.main>
