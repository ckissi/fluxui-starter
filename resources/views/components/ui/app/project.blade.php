@props(['project'])
<div class="w-full">
    <a class="relative flex flex-col items-start w-full gap-4 p-5 border rounded-lg fade-in bg-card overflow-clip"
        href="/sideproject/{{ $project->id }}" style="order: 1;">
        <div class="flex items-center w-full gap-x-3 gap-y-2">
            <div class="flex items-center gap-2">
                <div class="flex items-center justify-center p-1 border rounded-md bg-background shrink-0">
                    <img alt="Favicon" loading="lazy" class="w-6 h-6 rounded-full aspect-square"
                        src="{{ $project->icon }}" />
                </div>
                <h3 class="text-xl font-semibold leading-snug tracking-tight truncate font-display">
                    {{ $project->title }}
                </h3>
                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="w-4 h-4">
                    <path d="M15 3h6v6" />
                    <path d="M10 14 21 3" />
                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6" />
                </svg> --}}
            </div>


            <div class="flex flex-row items-center ml-auto flex-nowrap place-content-start gap-x-2 gap-y-1">
                <flux:tooltip content="Popular">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="text-yellow-500 lucide lucide-sparkles" data-state="closed">
                        <path
                            d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z">
                        </path>
                        <path d="M20 3v4"></path>
                        <path d="M22 5h-4"></path>
                        <path d="M4 17v2"></path>
                        <path d="M5 18H3"></path>
                    </svg>
                </flux:tooltip>
                <flux:tooltip content="Traffic verified">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="text-green-600 lucide lucide-badge-check">
                        <path
                            d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z" />
                        <path d="m9 12 2 2 4-4" />
                    </svg>
                </flux:tooltip>
            </div>
        </div>
        <p class="text-secondary line-clamp-2 text-pretty text-sm/normal">
            <span class="ais-Highlight"><span
                    class="ais-Highlight-nonHighlighted">{{ $project->description }}</span></span>
        </p>
        <div class="w-full -mt-4"></div>
        <div class="w-full -mt-4"></div>
        <x-ui.app.project-details :project="$project" />
    </a>
</div>
