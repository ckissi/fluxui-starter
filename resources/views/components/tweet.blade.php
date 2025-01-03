<div class="animate-in zoom-in duration-200">
    <div
        class="ring-1 rounded-lg flex flex-col space-y-2 p-4 break-inside-avoid mb-6 bg-white hover:ring-2 ring-gray-300 hover:ring-sky-400 transform duration-200 hover:shadow-sky-200 hover:shadow-md z-0 relative">
        <div
            class="flex flex-col break-inside-avoid-page break-inside-avoid break-inside-avoid-column overflow-hidden_ z-0 relative">
            <div class="flex justify-between">
                <div class="flex space-x-6">
                    <div class="flex space-x-4 flex-shrink-0 w-52">
                        <img src="/storage/avatars/{{ $tweet->author_id }}.jpg" class="w-10 h-10 rounded-full" />
                        <div>
                            <div class="font-semibold">
                                {{ $tweet->name }}
                            </div>
                            <div class="text-sm">
                                {{ $tweet->nickname }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- right icons -->
                <div></div>
            </div>

            <a href="https://twitter.com/{{ $tweet->nickname }}/status/{{ $tweet->id }}" target="_blank"
                class="whitespace-pre-line break-inside-avoid-page break-inside-avoid break-inside-avoid-column overflow-hidden_">
                <span>{{ $tweet->text }}</span>
            </a>
        </div>
    </div>
</div>
