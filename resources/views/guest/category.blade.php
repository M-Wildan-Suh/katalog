<x-layout.guest title="WebMandiri - Kategori" :category="$category">
    <div class=" w-full min-h-[calc(100vh-370px)]">
        <div class=" w-full py-8 sm:py-12 px-4 sm:px-6 space-y-12 sm:space-y-24">
            <div class=" w-full max-w-[1080px] mx-auto">
                <div class=" w-full space-y-6 sm:space-y-8">
                    <div class="w-full flex justify-between items-center">
                        <div style='font-family: "Montserrat", Sans-serif;' class=" w-full flex flex-col items-center sm:gap-4">
                            {{-- <p class=" text-base sm:text-xl font-bold text-center">List</p> --}}
                            <p class=" text-xl sm:text-3xl font-bold text-center">Kategori Web Tipe Simpel</p>
                            <p class=" text-center text-sm sm:text-base">
                                Berbagai kategori desain profesional untuk kebutuhan website bisnis, toko online, hingga jasa. 
                            </p>
                        </div>
                    </div>
                    <div class=" w-full rounded-md overflow-hidden grid grid-cols-2 sm:grid-cols-4 gap-4">
                        @foreach ($category as $item)
                            <a href="{{ route('category', ['category' => $item->slug]) }}">
                                <button class=" w-full py-3 flex justify-center items-center gap-2 rounded-md text-nowrap text-xs sm:text-base font-semibold bg-[#f1f3f4] border border-neutral-400 hover:bg-byolink-2 hover:text-white duration-300">
                                    <div class=" min-w-4 w-4 aspect-square">
                                        <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M256 0C114.6 0 0 114.6 0 256c0 141.4 114.6 256 256 256s256-114.6 256-256C512 114.6 397.4 0 256 0zM358.6 278.6l-112 112c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25L290.8 256L201.4 166.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l112 112C364.9 239.6 368 247.8 368 256S364.9 272.4 358.6 278.6z"/></svg>
                                    </div>
                                    <p class=" line-clamp-1">{{$item->category}}</p>
                                </button>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.guest.footer')
</x-layout.guest>