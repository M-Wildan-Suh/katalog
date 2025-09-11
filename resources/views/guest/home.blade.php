
<x-layout.guest title="WebMandiri" :category="$category">
    <div class=" w-full min-h-[calc(100vh-370px)]">
        <div class=" w-full py-6 sm:py-10 px-4 sm:px-6 space-y-8 sm:space-y-12">
            <div class=" w-full max-w-[1080px] mx-auto">
                <div style="background-image: url('https://katalog.jasawebsite.biz/wp-content/uploads/2024/07/kataloog-bg.jpg')" class=" bg-center bg-cover w-full p-6 sm:p-10 pb-0 sm:pb-10 rounded-md overflow-hidden relative">
                    <div class=" absolute inset-0 bg-byolink-1 mix-blend-multiply"></div>
                    <div class=" grid grid-cols-1 sm:grid-cols-2 w-full h-full relative">
                        <div class=" flex flex-col justify-center text-center sm:text-left gap-2 sm:gap-4 w-full h-full text-white relative">
                            <div class=" space-y-0 sm:space-y-4">
                                <p class=" text-2xl sm:text-5xl font-bold">WebMandiri</p>
                                <p class=" text-lg sm:text-4xl font-bold">Template Desain Website</p>
                            </div>
                            <p class=" text-xs sm:text-base">Pilih desain kesukaanmu yg bisa kamu edit mandiri dipandu dengan video tutorial yang kami siapkan. Dengan fasilitasi login ke halaman admin.
                            </p>
                        </div>
                        <div class="">
                            <img src="{{ asset('/assets/images/banner.png') }}" class=" w-full h-full" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class=" w-full max-w-[1080px] mx-auto">
                <div class=" space-y-4">
                    <div class="w-full flex justify-between items-center">
                        <div class=" w-full flex items-center gap-2 sm:gap-4">
                            <div class=" w-1 sm:w-1.5 h-7 sm:h-10 bg-byolink-2 rounded-full"></div>
                            <p class=" text-xl sm:text-3xl font-bold text-center">Kategori Desain</p>
                        </div>
                        <a href="{{route('allcategory')}}">
                            <button class=" px-4 py-2 flex items-center gap-1 rounded-full text-nowrap text-xs font-semibold bg-byolink-2 text-white hover:bg-byolink-3 duration-300">
                                <p class="hidden sm:block">Lihat Lainnya</p>
                                <div class=" w-3 aspect-square">
                                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><path d="M22 9a1 1 0 0 0 0 1.42l4.6 4.6H3.06a1 1 0 1 0 0 2h23.52L22 21.59A1 1 0 0 0 22 23a1 1 0 0 0 1.41 0l6.36-6.36a.88.88 0 0 0 0-1.27L23.42 9A1 1 0 0 0 22 9Z" data-name="Layer 2" fill="currentColor" class="fill-000000"></path></svg>
                                </div>
                            </button>
                        </a>
                    </div>
                    <div class=" w-full grid grid-cols-1 sm:grid-cols-3 gap-6 ">
                        @foreach ($category->take(3) as $item)
                            <a href="{{route('category', ['category' => $item->slug])}}" class=" flex">
                                <div class=" group flex flex-col items-center w-full bg-neutral-50 hover:bg-white duration-300 shadow-md shadow-black/20 rounded-md overflow-hidden pt-6 px-6">
                                    <p class="text-2xl text-black font-bold hover:underline duration-300"> {{$item->category}}</p>
                                    <div class=" flex w-full aspect-[11/6] border-2 rounded-md border-white bg-white translate-y-[20%] group-hover:translate-y-[10%] duration-500 overflow-hidden">
                                        <img class=" duration-500 inset-0 object-cover w-full h-full" src="{{asset('storage/images/article/banner/'.$item->thumbnail)}}" alt="">
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class=" w-full max-w-[1080px] mx-auto">
                <div class=" w-full space-y-4 sm:space-y-6">
                    <div class=" w-full flex justify-between items-center">
                        <div class=" w-full flex items-center gap-2 sm:gap-4">
                            <div class=" w-1 sm:w-1.5 h-7 sm:h-10 bg-byolink-2 rounded-full"></div>
                            <p class=" text-xl sm:text-3xl font-bold text-center">Piilihan Desain Terbaru</p>
                        </div>
                        <a href="{{route('allarticle')}}">
                            <button class=" px-4 py-2 flex items-center gap-1 rounded-full text-nowrap text-xs font-semibold bg-byolink-2 text-white hover:bg-byolink-3 duration-300">
                                <p class=" hidden sm:block">Lihat Lainnya</p>
                                <div class=" w-3 aspect-square">
                                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><path d="M22 9a1 1 0 0 0 0 1.42l4.6 4.6H3.06a1 1 0 1 0 0 2h23.52L22 21.59A1 1 0 0 0 22 23a1 1 0 0 0 1.41 0l6.36-6.36a.88.88 0 0 0 0-1.27L23.42 9A1 1 0 0 0 22 9Z" data-name="Layer 2" fill="currentColor" class="fill-000000"></path></svg>
                                </div>
                            </button>
                        </a>
                    </div>
                    <div class=" w-full grid grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6">
                        @include('components.guest.product')
                    </div>
                    <div class=" w-full">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.guest.footer')
</x-layout.guest>