<x-layout.guest title="Catalog - Kategori" :category="$category">
    <div class=" w-full min-h-[calc(100vh-370px)]">
        <div class=" w-full py-6 sm:py-10 px-4 sm:px-6 space-y-8 sm:space-y-12">
            <div class=" w-full max-w-[1080px] mx-auto">
                <div class=" w-full space-y-4 sm:space-y-6">
                    <div class=" w-full flex items-center gap-4 mb-10">
                        <div class=" w-1.5 h-10 bg-byolink-2 rounded-full"></div>
                        <p class=" text-3xl font-bold text-center">Semua Kategori</p>
                    </div>
                    <div class=" w-full rounded-md overflow-hidden grid grid-cols-3 sm:grid-cols-5 gap-4">
                        @foreach ($category as $item)
                            <a href="{{ route('category', ['category' => $item->slug]) }}">
                                <button class=" w-full px-4 py-2 flex justify-between items-center gap-1 border rounded-full text-nowrap text-sm sm:text-base text-neutral-600 border-neutral-600 hover:text-byolink-2 hover:border-byolink-2 duration-300">
                                    <p>{{$item->category}}</p>
                                    <div class=" w-3 aspect-square">
                                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><path d="M22 9a1 1 0 0 0 0 1.42l4.6 4.6H3.06a1 1 0 1 0 0 2h23.52L22 21.59A1 1 0 0 0 22 23a1 1 0 0 0 1.41 0l6.36-6.36a.88.88 0 0 0 0-1.27L23.42 9A1 1 0 0 0 22 9Z" data-name="Layer 2" fill="currentColor" class="fill-000000"></path></svg>
                                    </div>
                                </button>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            @foreach ($catsection as $cat)
                <div class=" w-full px-4 sm:px-6">
                    <div class=" w-full max-w-[1080px] mx-auto">
                        <div class=" md:col-span-3 w-full space-y-4 sm:space-y-6">
                            <div class=" w-full flex justify-between items-center">
                                <div class=" w-full flex items-center gap-2 sm:gap-4">
                                    <div class=" w-1 sm:w-1.5 h-7 sm:h-10 bg-byolink-2 rounded-full"></div>
                                    <p class=" text-xl sm:text-3xl font-bold text-center">Ketegori : {{$cat->category}}</p>
                                </div>
                                <a href="{{ route('category', ['category' => $cat->slug]) }}">
                                    <button class=" px-4 py-2 flex items-center gap-1 border rounded-full text-nowrap text-xs text-neutral-600 border-neutral-600 hover:text-byolink-2 hover:border-byolink-2 duration-300">
                                        <p class=" hidden sm:block">Lihat Lainnya</p>
                                        <div class=" w-3 aspect-square">
                                            <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><path d="M22 9a1 1 0 0 0 0 1.42l4.6 4.6H3.06a1 1 0 1 0 0 2h23.52L22 21.59A1 1 0 0 0 22 23a1 1 0 0 0 1.41 0l6.36-6.36a.88.88 0 0 0 0-1.27L23.42 9A1 1 0 0 0 22 9Z" data-name="Layer 2" fill="currentColor" class="fill-000000"></path></svg>
                                        </div>
                                    </button>
                                </a>
                            </div>
                            @php
                                $data = $cat->articles->take(4)
                            @endphp
                            <div class=" w-full grid grid-cols-2 md:grid-cols-4 gap-4">
                                @include('components.guest.product')
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @include('components.guest.footer')
</x-layout.guest>