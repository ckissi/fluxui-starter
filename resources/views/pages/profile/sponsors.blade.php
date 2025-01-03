<?php
use function Laravel\Folio\{middleware, name};
use function Livewire\Volt\{with, state, rules, mount, updated};
use Illuminate\Validation\Rule;
use App\Models\Sponsor;

state(['user' => auth()->user()])->locked();

state(['title', 'image', 'description', 'link', 'enabled']);

middleware(['auth', 'verified', 'is.admin']);

mount(function () {
    $sponsor = Sponsor::first();
    $this->title = $sponsor?->title;
    $this->description = $sponsor?->description;
    $this->link = $sponsor?->link;
    $this->enabled = $sponsor?->enabled === 1;
});

updated([
    'enabled' => function () {
        $sponsor = Sponsor::first();
        if (!$sponsor) {
            Flux::toast(heading: 'Error.', variant: 'danger', text: 'There is no sponsor defined.');
            return;
        }
        $sponsor->enabled = $this->enabled;
        $sponsor->save();
        Flux::toast(heading: 'Changes saved.', variant: 'success', text: 'Successfully updated status.');
    },
]);

$updateSponsor = function () {
    $validated = $this->validate([
        'title' => 'nullable|string|min:3',
        'description' => 'required|min:10|max:200',
        'link' => 'required|url',
    ]);

    // if the user hasn't changed their name or email and we also want to make, don't update and show error
    $sponsor = Sponsor::first();
    if ($sponsor?->title == $this->title && $sponsor?->description == $this->description && $sponsor?->link == $this->link) {
        //$this->dispatch('toast', message: 'Nothing to update.', data: ['position' => 'top-right', 'type' => 'info']);
        Flux::toast(heading: 'Nothing to update.', variant: 'warning', text: 'There were no changes made.');
        return;
    }
    if (!$sponsor) {
        $sponsor = new Sponsor();
    }

    $sponsor->title = $this->title;
    $sponsor->description = $this->description;
    $sponsor->link = $this->link;
    $sponsor->save();

    Flux::toast(heading: 'Changes saved.', variant: 'success', text: 'Successfully updated profile.');
};
?>

<x-layouts.app>
    @volt('profile.sponsors')
        <flux:main>

            <div class="flex justify-between w-full">
                <div>
                    <flux:heading size="xl">Sponsors</flux:heading>
                    <flux:subheading>This information will be displayed publicly.</flux:subheading>
                </div>
                <div>
                    <flux:switch wire:model.live="enabled" label="Enable sponsor" />
                </div>
            </div>

            <div>
                {{-- Update Profile Section --}}
                <section
                    class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg dark:bg-gray-900/50 dark:border dark:border-gray-200/10">
                    <div class="max-w-xl">
                        <livewire:sponsor-image />
                        <form wire:submit="updateSponsor" class="mt-6 space-y-6">
                            <flux:input label="Title" wire:model="title" />
                            <flux:textarea label="Description" type="email" wire:model="description" />
                            <flux:input label="Link" wire:model="link" />
                            <div class="flex items-start">
                                <div>
                                    <flux:button type="submit" variant="primary" submit="true">{{ __('Update') }}
                                    </flux:button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
                {{-- End Update Profile Information --}}
                <flux:toast />
            </div>
        </flux:main>
    @endvolt

</x-layouts.app>
