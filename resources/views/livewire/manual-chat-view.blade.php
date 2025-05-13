<div class="z-0" wire:poll.3s="refreshData">
    @inject('carbon', 'Carbon\carbon')

    <div id="room">
        <div>
            @forelse ($pesan as $row)
                @if ($row->user_id == $userId)
                    <div class="w-full flex mt-1 flex-col items-end">
                        <div class="w-fit h-fit bg-primary-600 text-white rounded-l-md rounded-br-md overflow-hidden">
                            <div class="bg-primary-700 w-full px-2 py-[1px]">
                                <p class="block text-xs">{{ $row->user->nama }}</p>
                            </div>
                            {{-- <div class="px-2 w-full flex flex-col items-end justify-end">
                            @if (!empty($row->foto))
                                <img src="{{ asset($row->foto) }}" alt="Foto Chat"
                                    class="w-32 lg:w-40 h-auto rounded-lg mt-1">
                            @endif
                            @if (!empty($row->foto && !empty($row->file)))
                                <div class="mb-1"></div>
                            @endif
                            @if (!empty($row->file))
                                <a href="{{ asset($row->file) }}" download
                                    class="w-fit flex gap-2 bg-primary-700 text-white rounded-md text-xs py-1 px-2">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor
                                        " viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-5h7.586l-.293.293a1 1 0 0 0 1.414 1.414l2-2a1 1 0 0 0 0-1.414l-2-2a1 1 0 0 0-1.414 1.414l.293.293H4V9h5a2 2 0 0 0 2-2Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>Download File</span>
                                </a>
                            @endif
                        </div> --}}
                            <div class="px-2 py-1">
                                <p class="text-sm">{{ $row->pesan }}</p>
                            </div>
                        </div>
                        <div class="block -mt-0.5 text-[11px]">{{ $carbon::parse($row->created_at)->diffForHumans() }}
                        </div>
                    </div>
                @else
                    <div class="w-full flex justify-start mt-1 flex-col">
                        <div class="w-fit h-fit bg-gray-600 text-white rounded-r-md rounded-bl-md overflow-hidden">
                            <div class="bg-gray-700 w-full px-2 py-[1px]">
                                <p class="block text-xs">{{ $row->user->nama }}</p>
                            </div>
                            {{-- <div class="px-2 w-full flex flex-col items-start justify-start">
                            @if (!empty($row->foto))
                                <img src="{{ asset($row->foto) }}" alt="Foto Chat"
                                    class="w-32 lg:w-40 h-auto rounded-lg mt-1">
                            @endif
                            @if (!empty($row->foto && !empty($row->file)))
                                <div class="mb-1"></div>
                            @endif
                            @if (!empty($row->file))
                                <a href="{{ asset($row->file) }}" download
                                    class="w-fit flex gap-2 bg-gray-700 text-white rounded-md text-xs py-1 px-2">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-5h7.586l-.293.293a1 1 0 0 0 1.414 1.414l2-2a1 1 0 0 0 0-1.414l-2-2a1 1 0 0 0-1.414 1.414l.293.293H4V9h5a2 2 0 0 0 2-2Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>Download File</span>
                                </a>
                            @endif
                        </div> --}}
                            <div class="px-2 py-1">
                                <p class="text-sm">{{ $row->pesan }}</p>
                            </div>
                        </div>
                        <div class="block -mt-0.5 text-[11px]">{{ $carbon::parse($row->created_at)->diffForHumans() }}
                        </div>
                    </div>
                @endif
            @empty
                <p class="text-center text-gray-600">Belum ada pesan</p>
            @endforelse
        </div>

        <form method="POST" wire:submit="kirimPesan">
            <div class="w-full fixed bottom-0 left-0 right-0 pb-0.5 md:pl-8 lg:pl-12">
                <div class="w-fit mx-auto rounded-md bg-white shadow p-3 md:mb-3 left-5 right-5 flex gap-2">
                    <div class="flex gap-2 items-center">
                        <input type="text" wire:model="pesanBaru"
                            class="w-64 rounded py-0.5 px-3 focus:outline-none focus:ring-2 focus:ring-primary-200 focus:border-primary-500">
                        <button type="submit" class="flex flex-col gap-0 text-xs">
                            <svg class="w-5 h-5 text-gray-800 rotate-90" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M12 2a1 1 0 0 1 .932.638l7 18a1 1 0 0 1-1.326 1.281L13 19.517V13a1 1 0 1 0-2 0v6.517l-5.606 2.402a1 1 0 0 1-1.326-1.281l7-18A1 1 0 0 1 12 2Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>


</div>

@script
    <script>
        setInterval(function() {
            window.scrollTo({
                top: document.body.scrollHeight,
                behavior: 'smooth'
            });
        }, 2000);
    </script>
@endscript
