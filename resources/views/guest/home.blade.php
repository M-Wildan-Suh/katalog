<x-layout.guest title="Catalog - Beranda" :category="$category" :home="true">
    <div class=" w-full min-h-[calc(100vh-370px)]">
        <div class="w-full sm:h-screen px-4 sm:px-6 relative overflow-hidden">
            <div
                class=" absolute inset-0 bg-[radial-gradient(at_right_bottom,rgba(255,0,0,0.5)_0%,rgb(233,229,255)_64%)] mix-blend-multiply">
            </div>
            <div style="background-image: url({{ asset('/assets/images/bg-banner.jpg') }})"
                class=" absolute inset-0 opacity-40 bg-center bg-cover"></div>
            <div
                class=" pt-32 pb-20 sm:pt-20 sm:pb-0 grid grid-cols-1 sm:grid-cols-2 gap-10 w-full h-full max-w-[1080px] mx-auto relative">
                <div class="flex flex-col justify-center gap-4">
                    <div style='font-family: "Montserrat", Sans-serif;'
                        class=" w-full text-left text-2xl sm:text-[40px] sm:leading-10 font-bold tracking-tight">
                        <p class=" text-byolink-2">Solusi Website Tipe Simpel</p>
                        <p>Desain Modern, Hasil Profesional</p>
                    </div>
                    <p class=" text-left text-sm sm:text-base text-neutral-600">Berbagai pilihan tipe simpel terima
                        beres. Biar kami yang menentukan dari pilihan desain berikut ini.</p>
                    <div class=" flex">
                        <a href="{{ route('allarticle') }}" class="flex">
                            <button
                                class=" px-6 py-2 flex items-center gap-2 rounded-full text-nowrap text-sm sm:text-base font-semibold bg-byolink-2 text-white hover:bg-byolink-1 duration-300">
                                <p>Eksplor Desain</p>
                                <div class=" w-4 sm:w-5 aspect-square">
                                    <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                        <path fill="currentColor"
                                            d="M256 0C114.6 0 0 114.6 0 256c0 141.4 114.6 256 256 256s256-114.6 256-256C512 114.6 397.4 0 256 0zM358.6 278.6l-112 112c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25L290.8 256L201.4 166.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l112 112C364.9 239.6 368 247.8 368 256S364.9 272.4 358.6 278.6z" />
                                    </svg>
                                </div>
                            </button>
                        </a>
                    </div>
                </div>
                <div class=" w-full flex justify-center items-center">
                    <img src="{{ asset('/assets/images/banner.png') }}"
                        class=" w-full h-full object-contain object-center" alt="">
                </div>
            </div>
        </div>
        <div class=" w-full py-16 sm:py-32 space-y-20 sm:space-y-18 bg-[#F1F3F4]">
            <div class=" w-full px-4 sm:px-6">
                <div class=" w-full max-w-[1080px] mx-auto">
                    <div class=" w-full space-y-6 sm:space-y-8">
                        <div class="w-full flex justify-between items-center">
                            <div style='font-family: "Montserrat", Sans-serif;'
                                class=" w-full flex flex-col sm:gap-2 items-center">
                                {{-- <p class=" text-base sm:text-xl font-bold text-center">Template</p> --}}
                                <p class=" text-2xl sm:text-4xl font-bold text-center">Desain Terbaru Kami</p>
                            </div>
                        </div>
                        <div class=" w-full grid grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6">
                            @include('components.guest.product')
                        </div>
                        <div class=" flex justify-center">
                            <a href="{{ route('allarticle') }}" class="flex">
                                <button
                                    class=" px-6 py-2 flex items-center gap-3 rounded-full text-nowrap text-sm sm:text-base font-semibold bg-byolink-2 text-white hover:bg-byolink-1 duration-300">
                                    <p>Muat Lainnya</p>
                                    <div class=" w-4 sm:w-5 aspect-square">
                                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M22 9a1 1 0 0 0 0 1.42l4.6 4.6H3.06a1 1 0 1 0 0 2h23.52L22 21.59A1 1 0 0 0 22 23a1 1 0 0 0 1.41 0l6.36-6.36a.88.88 0 0 0 0-1.27L23.42 9A1 1 0 0 0 22 9Z"
                                                data-name="Layer 2" fill="currentColor" class="fill-000000"></path>
                                        </svg>
                                    </div>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.guest.footer')
</x-layout.guest>
