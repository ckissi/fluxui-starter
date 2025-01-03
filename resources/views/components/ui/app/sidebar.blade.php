<?php

use function Livewire\Volt\{state, mount};
use App\Models\Svg;

state([
    'stroke' => '2',
    'size' => '24',
    'categories' => '',
]);

mount(function () {});
?>

<flux:sidebar sticky stashable class="border-r bg-zinc-50 dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700"
    x-show="show_sidebar">
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

    @volt('sidebar')
        <flux:navlist variant="outline">
            <div class="pt-6" wire:ignore>
                <flux:navlist.item href="{{ url('/') }}">All Icons</flux:navlist.item>
                <flux:navlist.group heading="Categories" class="hidden mt-2 lg:grid">
                </flux:navlist.group>
            </div>
        </flux:navlist>
    @endvolt

    <flux:spacer />
    {{-- <flux:navlist variant="outline">
        <flux:navlist.item icon="cog-6-tooth" href="#">Settings</flux:navlist.item>
        <flux:navlist.item icon="information-circle" href="#">Help</flux:navlist.item>
    </flux:navlist> --}}
</flux:sidebar>
