@props(['project'])
<ul class="w-full mt-auto text-xs">
    {{-- <li class="flex items-center gap-3 py-1">
                <p class="text-secondary flex min-w-0 items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-star size-[1.1em] shrink-0 opacity-75">
                        <polygon
                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                        </polygon>
                    </svg><span class="flex-1 truncate">Stars</span>
                </p>
                <hr class="flex-1 min-w-2" />
                <span class="font-semibold shrink-0">7,861</span>
            </li> --}}
    <li class="flex items-center gap-3 py-1">
        <p class="text-secondary flex min-w-0 items-center gap-1.5">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-users-round size-[1.1em] shrink-0 opacity-75">
                <path d="M18 21a8 8 0 0 0-16 0" />
                <circle cx="10" cy="8" r="5" />
                <path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3" />
            </svg><span class="flex-1 truncate">Visitors per month</span>
        </p>
        <hr class="flex-1 min-w-2" />
        <span class="font-semibold shrink-0">{{ number_format($project->visitors, 0, '.', ',') }}</span>
    </li>

    <li class="flex items-center gap-3 py-1">
        <p class="text-secondary flex min-w-0 items-center gap-1.5">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-files size-[1.1em] shrink-0 opacity-75">
                <path d="M20 7h-3a2 2 0 0 1-2-2V2" />
                <path d="M9 18a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h7l4 4v10a2 2 0 0 1-2 2Z" />
                <path d="M3 7.6v12.8A1.6 1.6 0 0 0 4.6 22h9.8" />
            </svg><span class="flex-1 truncate">Pageviews per month</span>
        </p>
        <hr class="flex-1 min-w-2" />
        <span class="font-semibold shrink-0">{{ number_format($project->pageviews, 0, '.', ',') }}</span>
    </li>

    <li class="flex items-center gap-3 py-1">
        <p class="text-secondary flex min-w-0 items-center gap-1.5">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-map-pin-house size-[1.1em] shrink-0 opacity-75">
                <path
                    d="M15 22a1 1 0 0 1-1-1v-4a1 1 0 0 1 .445-.832l3-2a1 1 0 0 1 1.11 0l3 2A1 1 0 0 1 22 17v4a1 1 0 0 1-1 1z" />
                <path d="M18 10a8 8 0 0 0-16 0c0 4.993 5.539 10.193 7.399 11.799a1 1 0 0 0 .601.2" />
                <path d="M18 22v-3" />
                <circle cx="10" cy="10" r="3" />
            </svg><span class="flex-1 truncate">Placements</span>
        </p>
        <hr class="flex-1 min-w-2" />
        <span class="font-semibold shrink-0">{{ $project->placements_cnt }}</span>
    </li>

    <li class="flex items-center gap-3 py-1">
        <p class="text-secondary flex min-w-0 items-center gap-1.5">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-circle-dollar-sign size-[1.1em] shrink-0 opacity-75">
                <circle cx="12" cy="12" r="10" />
                <path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8" />
                <path d="M12 18V6" />
            </svg>
            <span class="flex-1 truncate">Price from</span>
        </p>
        <hr class="flex-1 border-gray-300 border-dashed min-w-2" />
        <span class="font-semibold shrink-0">{{ number_format($project->price_from, 2, '.', ',') }}
            {{ $project->currency }}</span>
    </li>

    <li class="flex items-center gap-3 py-1">
        <p class="text-secondary flex min-w-0 items-center gap-1.5">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-badge-check size-[1.1em] shrink-0 opacity-75">
                <path
                    d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z" />
                <path d="m9 12 2 2 4-4" />
            </svg>
            <span class="flex-1 truncate">Traffic Verified</span>
        </p>
        <hr class="flex-1 min-w-2" />
        <div class="shrink-0 "><span class="font-semibold text-green-600">Yes</span> (1 day ago)</div>
    </li>
</ul>
