<x-layout.guest title="Catalog" :category="$category" :home="true">
    <div class=" w-full min-h-[calc(100vh-370px)]">
        <div class="w-full sm:h-screen px-4 sm:px-6 relative overflow-hidden">
            <div class=" absolute inset-0 bg-[linear-gradient(190deg,#DADEE2_0%,#C7CFD8_100%)] mix-blend-multiply"></div>
            <div style="background-image: url({{asset('/assets/images/bgbanner.jpg')}})" class=" absolute inset-0 opacity-40 bg-cover"></div>
            <div class=" pt-32 sm:pt-20 flex flex-col justify-end w-full h-full max-w-[960px] mx-auto relative">
                <div class="space-y-4">
                    <div style='font-family: "Montserrat", Sans-serif;' class=" w-full text-center text-2xl sm:text-5xl font-bold tracking-tight">
                        <p>Solusi Website All-in-One</p>
                        <p>Desain Modern, Hasil Optimal</p>
                    </div>
                    <p class=" text-center text-sm sm:text-base text-neutral-600">Punya usaha tapi belum punya website? Tinggal pilih desain favoritmu, bisa di edit mandiri dipandu dengan video tutorial yang kami siapkan</p>
                    <div class=" flex justify-center">
                        <a href="{{route('allarticle')}}" class="flex">
                            <button class=" px-6 py-2 flex items-center gap-1 rounded-full text-nowrap text-sm sm:text-base font-semibold bg-byolink-2 text-white hover:bg-byolink-1 duration-300">
                                Lihat Desain Template
                            </button>
                        </a>
                    </div>
                    <div class=" w-full h-56 sm:h-80 flex justify-center items-end">
                        <img src="{{asset('/assets/images/banner.png')}}" class=" w-full h-full object-contain object-bottom" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class=" w-full py-12 sm:py-20 px-4 sm:px-6 space-y-12 sm:space-y-24">
            <div class=" w-full max-w-[1080px] mx-auto">
                <div class=" space-y-6 sm:space-y-8">
                    <div class="w-full flex justify-between items-center">
                        <div style='font-family: "Montserrat", Sans-serif;' class=" w-full flex flex-col sm:gap-2 items-center">
                            <p class=" text-base sm:text-xl font-bold text-center">Template</p>
                            <p class=" text-2xl sm:text-4xl font-bold text-center">Kategori Desain</p>
                        </div>
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
                    <div class=" flex justify-center">
                        <a href="{{route('allcategory')}}" class="flex">
                            <button class=" px-6 py-2 flex items-center gap-3 rounded-full text-nowrap text-sm sm:text-base font-semibold bg-byolink-2 text-white hover:bg-byolink-1 duration-300">
                                <p>Muat Lainnya</p>
                                <div class=" w-4 sm:w-5 aspect-square">
                                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><path d="M22 9a1 1 0 0 0 0 1.42l4.6 4.6H3.06a1 1 0 1 0 0 2h23.52L22 21.59A1 1 0 0 0 22 23a1 1 0 0 0 1.41 0l6.36-6.36a.88.88 0 0 0 0-1.27L23.42 9A1 1 0 0 0 22 9Z" data-name="Layer 2" fill="currentColor" class="fill-000000"></path></svg>
                                </div>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class=" w-full max-w-[1080px] mx-auto">
                <div class=" w-full space-y-6 sm:space-y-8">
                    <div class="w-full flex justify-between items-center">
                        <div style='font-family: "Montserrat", Sans-serif;' class=" w-full flex flex-col sm:gap-2 items-center">
                            <p class=" text-base sm:text-xl font-bold text-center">Template</p>
                            <p class=" text-2xl sm:text-4xl font-bold text-center">Pilihan Desain Terbaru</p>
                        </div>
                    </div>
                    <div class=" w-full grid grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6">
                        @include('components.guest.product')
                    </div>
                    <div class=" flex justify-center">
                        <a href="{{route('allarticle')}}" class="flex">
                            <button class=" px-6 py-2 flex items-center gap-3 rounded-full text-nowrap text-sm sm:text-base font-semibold bg-byolink-2 text-white hover:bg-byolink-1 duration-300">
                                <p>Muat Lainnya</p>
                                <div class=" w-4 sm:w-5 aspect-square">
                                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><path d="M22 9a1 1 0 0 0 0 1.42l4.6 4.6H3.06a1 1 0 1 0 0 2h23.52L22 21.59A1 1 0 0 0 22 23a1 1 0 0 0 1.41 0l6.36-6.36a.88.88 0 0 0 0-1.27L23.42 9A1 1 0 0 0 22 9Z" data-name="Layer 2" fill="currentColor" class="fill-000000"></path></svg>
                                </div>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.guest.footer')
</x-layout.guest>