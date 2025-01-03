@props(['handle', 'account_id', 'id', 'uuid'])
<div class="p-4 border rounded-lg">
    <div class="">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <span class="text-sm font-semibold text-gray-600">Account #{{ $id }}:</span>
                <flux:badge color="sky" size="lg">{{ $handle }}</flux:badge>
            </div>
            <div class="flex items-center space-x-4">
                <flux:switch wire:model.live="notifications" label="Live Update"
                    wire:click="setLiveUpdate('{{ $account_id }}')"
                    wire:target="setLiveUpdate('{{ $account_id }}')" />
                <button class="text-gray-600" wire:click='deleteConfirm("{{ $account_id }}")'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" class="w-6 h-6">
                        <path d="M3 6h18" />
                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                        <line x1="10" x2="10" y1="11" y2="17" />
                        <line x1="14" x2="14" y1="11" y2="17" />
                    </svg>
                </button>

            </div>
        </div>
        @if (Storage::disk('public')->exists('original-' . $uuid . '.jpg'))
            <div class="relative my-4">
                <flux:badge variant="solid" color="zinc" size="sm" class="absolute z-10 top-2 right-2">
                    Original Banner
                </flux:badge>
                <img src="/storage/original-{{ $uuid }}.jpg" class="rounded-md">
            </div>
        @endif
        @if (Storage::disk('public')->exists($uuid . '.png'))
            <div class="relative my-4">
                <flux:badge variant="solid" color="zinc" size="sm" class="absolute z-10 top-2 right-2">
                    Generated Banner
                </flux:badge>
                <img src="/storage/{{ $uuid }}.png?v={{ time() }}" class="border-2 rounded-md">
            </div>
        @endif
        <div class="flex justify-end space-x-2">
            {{-- <flux:button variant="danger" wire:click="getOrgBanner('{{ $account_id }}')">Get
                account info
            </flux:button> --}}
            <flux:button wire:click="generateBanner('{{ $account_id }}')" variant="primary"
                wire:key='generate-{{ $account_id }}' wire:target="generateBanner('{{ $account_id }}')">Generate
                Banner
            </flux:button>
            <flux:button wire:click="setToGeneratedBanner('{{ $account_id }}')"
                wire:target="setToGeneratedBanner('{{ $account_id }}')" variant="primary">Set To Generated
                Banner
            </flux:button>
            <flux:button variant="danger" wire:click="revertOrgBanner('{{ $account_id }}')"
                wire:target="revertOrgBanner('{{ $account_id }}')">Revert To Original Banner
            </flux:button>
        </div>
    </div>
</div>
