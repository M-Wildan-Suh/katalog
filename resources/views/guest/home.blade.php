<x-layout.guest title="Catalog" :category="$category" :home="true">
    <div class=" w-full min-h-[calc(100vh-370px)]">
        <div class="w-full sm:h-screen px-4 sm:px-6 relative overflow-hidden">
            <div class=" absolute inset-0 bg-[radial-gradient(at_right_bottom,rgba(255,0,0,0.5)_0%,rgb(233,229,255)_64%)] mix-blend-multiply"></div>
            <div style="background-image: url({{asset('/assets/images/bg-banner.jpg')}})" class=" absolute inset-0 opacity-40 bg-center bg-cover"></div>
            <div class=" pt-32 pb-20 sm:pt-20 sm:pb-0 grid grid-cols-1 sm:grid-cols-2 gap-10 w-full h-full max-w-[1080px] mx-auto relative">
                <div class="flex flex-col justify-center gap-4">
                    <div style='font-family: "Montserrat", Sans-serif;' class=" w-full text-left text-2xl sm:text-[40px] sm:leading-10 font-bold tracking-tight">
                        <p class=" text-byolink-2">Solusi Website Tipe Simple</p>
                        <p>Desain Modern, Hasil Optimal</p>
                    </div>
                    <p class=" text-left text-sm sm:text-base text-neutral-600">Berbagai pilihan desain modern terima beres. Biar kami yang menentukan dari pilihan desain berikut ini.</p>
                    <div class=" flex">
                        <a href="{{route('allarticle')}}" class="flex">
                            <button class=" px-6 py-2 flex items-center gap-2 rounded-full text-nowrap text-sm sm:text-base font-semibold bg-byolink-2 text-white hover:bg-byolink-1 duration-300">
                                <p>Eksplor Desain</p>
                                <div class=" w-4 sm:w-5 aspect-square">
                                    <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M256 0C114.6 0 0 114.6 0 256c0 141.4 114.6 256 256 256s256-114.6 256-256C512 114.6 397.4 0 256 0zM358.6 278.6l-112 112c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25L290.8 256L201.4 166.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l112 112C364.9 239.6 368 247.8 368 256S364.9 272.4 358.6 278.6z"/></svg>
                                </div>
                            </button>
                        </a>
                    </div>
                </div>
                <div class=" w-full flex justify-center items-center">
                    <img src="{{asset('/assets/images/banner.png')}}" class=" w-full h-full object-contain object-center" alt="">
                </div>
            </div>
        </div>
        <div class=" w-full py-12 sm:py-20 px-4 sm:px-6 space-y-12 sm:space-y-24">
            <div class=" w-full max-w-[1080px] mx-auto">
                <div class=" space-y-6 sm:space-y-8">
                    <div class="w-full flex justify-between items-center">
                        <div style='font-family: "Montserrat", Sans-serif;' class=" w-full flex flex-col sm:gap-2 items-center">
                            <p class=" text-2xl sm:text-4xl font-bold text-center">Keunggulan Website Kami</p>
                        </div>
                    </div>
                    <div class=" w-full grid grid-cols-1 sm:grid-cols-3 gap-6 ">
                        <div class=" w-full p-4 rounded-md overflow-hidden bg-white border shadow-md shadow-black/20">
                            <div class=" space-y-2 sm:space-y-4">
                                <div class=" w-6 sm:w-12 aspect-square text-byolink-2">
                                    <svg viewBox="0 0 576 512" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M568.2 336.3c-13.12-17.81-38.14-21.66-55.93-8.469l-119.7 88.17h-120.6c-8.748 0-15.1-7.25-15.1-15.99c0-8.75 7.25-16 15.1-16h78.25c15.1 0 30.75-10.88 33.37-26.62c3.25-20-12.12-37.38-31.62-37.38H191.1c-26.1 0-53.12 9.25-74.12 26.25l-46.5 37.74L15.1 383.1C7.251 383.1 0 391.3 0 400v95.98C0 504.8 7.251 512 15.1 512h346.1c22.03 0 43.92-7.188 61.7-20.27l135.1-99.52C577.5 379.1 581.3 354.1 568.2 336.3zM160 176h64v64C224 248.8 231.2 256 240 256h64C312.8 256 320 248.8 320 240v-64h64c8.836 0 16-7.164 16-16V96c0-8.838-7.164-16-16-16h-64v-64C320 7.162 312.8 0 304 0h-64C231.2 0 224 7.162 224 16v64H160C151.2 80 144 87.16 144 96v64C144 168.8 151.2 176 160 176z"/></svg>
                                </div>
                                <h2 class=" text-xl sm:text-2xl font-bold">Terima Beres</h2>
                                <p class=" text-xs sm:text-sm text-neutral-600">Website langsung siap pakai, tanpa ribet mengurus detail teknis.</p>
                            </div>
                        </div>
                        <div class=" w-full p-4 rounded-md overflow-hidden bg-white border shadow-md shadow-black/20">
                            <div class=" space-y-2 sm:space-y-4">
                                <div class=" w-6 sm:w-12 aspect-square text-byolink-2">
                                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title/><path fill="currentColor" d="M21.458,16.5a4,4,0,0,0-4-4h-.5V12a1,1,0,0,0-1-1h-12a1,1,0,0,0-1,1v9.5a2.5,2.5,0,0,0,2.5,2.5h9a2.5,2.5,0,0,0,2.5-2.5v-1h.5A4,4,0,0,0,21.458,16.5Zm-4,2h-.25a.249.249,0,0,1-.25-.25v-3.5a.25.25,0,0,1,.25-.25h.25a2,2,0,0,1,0,4Z"/><path fill="currentColor" d="M5.649,2.865a.25.25,0,0,0,.016-.43L3.3.905a.5.5,0,0,0-.75.511l.422,2.53a.25.25,0,0,0,.137.184.253.253,0,0,0,.229,0Z"/><path fill="currentColor" d="M3.646,5.094a.25.25,0,0,0-.1.335l2.22,4.3a.5.5,0,0,0,.444.27h3a.5.5,0,0,0,.439-.741l-3.026-5.5a.25.25,0,0,0-.339-.1Z"/><path fill="currentColor" d="M13.538,7.293l-.006,0a3.528,3.528,0,0,1-.636-.349.252.252,0,0,0-.361.084L11.293,9.257A.5.5,0,0,0,11.73,10h1.832a.5.5,0,0,0,.468-.323L14.7,7.893a.25.25,0,0,0-.2-.337,3.526,3.526,0,0,1-.68-.156C13.727,7.369,13.633,7.333,13.538,7.293Z"/><path fill="currentColor" d="M17.017,2.815a3.68,3.68,0,0,0-2.811-2.8.5.5,0,0,0-.535.761c.529.806.21,1.282-.353,1.994a3.643,3.643,0,0,0-.542.819,2.038,2.038,0,0,0,1.151,2.784,2.046,2.046,0,0,0,2.245-.258A3.363,3.363,0,0,0,17.017,2.815Z"/></svg>
                                </div>
                                <h2 class=" text-xl sm:text-2xl font-bold">Desain Modern</h2>
                                <p class=" text-xs sm:text-sm text-neutral-600">Tampilan mengikuti tren terbaru, responsif, dan mudah diakses di semua perangkat.</p>
                            </div>
                        </div>
                        <div class=" w-full p-4 rounded-md overflow-hidden bg-white border shadow-md shadow-black/20">
                            <div class=" space-y-2 sm:space-y-4">
                                <div class=" w-6 sm:w-12 aspect-square text-byolink-2">
                                    <svg data-name="Слой 1" id="Слой_1" viewBox="0 0 128 128" xmlns="http://www.w3.org/2000/svg"><title/><rect fill="currentColor" height="8" width="15.49" x="7.55" y="52.45"/><rect fill="currentColor" height="8" width="15.49" x="104.96" y="52.45"/><rect fill="currentColor" height="15.95" transform="translate(-6.82 27.13) rotate(-45)" width="8" x="25.35" y="13.82"/><rect fill="currentColor" height="15.49" width="8" x="60"/><rect fill="currentColor" height="8" transform="translate(13.48 76.14) rotate(-45)" width="15.95" x="90.68" y="17.8"/><rect fill="currentColor" height="8" transform="translate(-55.82 47.43) rotate(-45)" width="15.95" x="21.37" y="87.1"/><rect fill="currentColor" height="15.95" transform="translate(-35.52 96.44) rotate(-45)" width="8" x="94.65" y="83.13"/><path fill="currentColor" d="M47.09,111.09a16.91,16.91,0,1,0,33.82,0V100H47.09Z"/><path fill="currentColor" d="M80.91,95.89a19.15,19.15,0,0,1,6.24-14.31,34.76,34.76,0,1,0-46.4-.08,19.34,19.34,0,0,1,6.34,14.39V96H80.91Z"/></svg>
                                </div>
                                <h2 class=" text-xl sm:text-2xl font-bold">Tampilan Menarik</h2>
                                <p class=" text-xs sm:text-sm text-neutral-600">Visual yang profesional dan estetik, membuat pengunjung betah dan percaya pada bisnis Anda.</p>
                            </div>
                        </div>
                        {{-- @foreach ($category->take(3) as $item)
                            <a href="{{route('category', ['category' => $item->slug])}}" class=" flex">
                                <div class=" group flex flex-col items-center w-full bg-neutral-50 hover:bg-white duration-300 shadow-md shadow-black/20 rounded-md overflow-hidden pt-6 px-6">
                                    <p class="text-2xl text-black font-bold hover:underline duration-300"> {{$item->category}}</p>
                                    <div class=" flex w-full aspect-[11/6] border-2 rounded-md border-white bg-white translate-y-[20%] group-hover:translate-y-[10%] duration-500 overflow-hidden">
                                        <img class=" duration-500 inset-0 object-cover w-full h-full" src="{{asset('storage/images/article/banner/'.$item->thumbnail)}}" alt="">
                                    </div>
                                </div>
                            </a>
                        @endforeach --}}
                    </div>
                    <div class=" flex justify-center">
                        <a href="{{route('allcategory')}}" class="flex">
                            <button class=" px-6 py-2 flex items-center gap-3 rounded-full text-nowrap text-sm sm:text-base font-semibold bg-byolink-2 text-white hover:bg-byolink-1 duration-300">
                                <p>List Kategori</p>
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
                            {{-- <p class=" text-base sm:text-xl font-bold text-center">Template</p> --}}
                            <p class=" text-2xl sm:text-4xl font-bold text-center">Desain Terbaru Kami</p>
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