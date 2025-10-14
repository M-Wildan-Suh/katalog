<x-layout.guest title="Catalog - Tentang Kami" :category="$category">
    <div class=" w-full bg-[#F1F3F4] min-h-[calc(100vh-370px)]">
        <div class="px-4 sm:px-6 py-16 sm:py-24 space-y-16 sm:space-y-24">
            <div class=" w-full max-w-[1080px] mx-auto">
                <div class=" w-full space-y-6 sm:space-y-8">
                    <div class="w-full flex justify-between items-center">
                        <div style='font-family: "Montserrat", Sans-serif;'
                            class=" w-full flex flex-col items-center gap-2 sm:gap-4">
                            {{-- <p class=" text-base sm:text-xl font-bold text-center">Template</p> --}}
                            <p class=" text-xl sm:text-3xl font-bold text-center">Tentang Kami</p>
                            {{-- <p class=" text-center text-sm sm:text-base">
                                Berbagai pilihan template website siap simpel untuk beragam jenis usaha. Mulai dari bisnis, jasa, toko online, hingga perusahaan. Pilih template favorit Anda, layout dan sebagainya diserahkan ke tim profesional kami.
                            </p> --}}
                        </div>
                    </div>
                    <div class=" w-full grid grid-cols-1 sm:grid-cols-4 gap-4">
                        @foreach ($data as $item)
                            <div style="box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);" class=" w-full aspect-[4/3] bg-black rounded-xl overflow-hidden">
                                <img src="{{asset('/storage/images/gallery/'. $item->image)}}" class=" w-full h-full object-cover object-center hover:scale-105 duration-300" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class=" w-full max-w-[1080px] mx-auto grid grid-cols-1 md:grid-cols-2 gap-16">
                <div class=" w-full aspect-square order-2 md:order-1 rounded-xl overflow-hidden">
                    <iframe loading="lazy" class=" w-full h-full"
                        src="https://maps.google.com/maps?q=Jasawebsite.biz&amp;t=m&amp;z=18&amp;output=embed&amp;iwloc=near"
                        title="Jasawebsite.biz" aria-label="Jasawebsite.biz"></iframe>
                </div>
                <div class="flex flex-col justify-center gap-10 order-1 md:order-2">
                    <div style='font-family: "Montserrat", Sans-serif;'
                        class=" w-full text-left text-xl sm:text-3xl sm:leading-10 font-bold tracking-tight space-y-2">
                        <p>Kontak Kami</p>
                        <div class=" text-sm font-normal tracking-normal leading-7">
                            <p class=" sm:text-nowrap font-bold">Saatnya Punya Website Profesional Tanpa Ribet!</p>
                            <p class=" sm:text-nowrap">Yuk hubungi kami sekarang.</p>
                            <p class="">Solusi website simpel tanpa harus pusing mikirin
                                konten & desain.</p>
                        </div>
                    </div>
                    <div class=" w-full grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                        <div class=" space-y-4">
                            <p class=" text-lg font-semibold uppercase">Alamat</p>
                            <p class=" text-sm leading-7">Komplek Sapta Taruna PU kujangsari blok B1 no 10, KOTA BANDUNG,
                                BANDUNG KIDUL, JAWA BARAT, ID, 40267</p>
                        </div>
                        <div class=" space-y-4">
                            <div class=" flex flex-col">
                                <p class=" text-lg font-semibold uppercase">Contact Us</p>
                            </div>
                            <div class=" flex flex-col">
                                <p>Telepon : +62 851-7331-5798</p>
                                <p>Whatsapp : +62 851-7331-5798</p>
                                {{-- <p>Email : info@catalog.jasawebsite.biz</p> --}}
                            </div>
                        </div>
                        <div class=" space-y-4">
                            <p class=" text-lg font-semibold uppercase">Follow Us</p>
                            <div class=" flex flex-wrap gap-1 sm:gap-2">
                                <a href="https://www.youtube.com/@jbiztv" target="__blank">
                                    <button
                                        class=" w-full p-2 aspect-square flex items-center justify-center bg-white hover:bg-green-200 hover:text-green-600 duration-300 rounded-md">
                                        <div class=" w-7 h-7">
                                            <svg height="100%"
                                                style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;"
                                                version="1.1" viewBox="0 0 512 512" width="100%" xml:space="preserve"
                                                xmlns="http://www.w3.org/2000/svg" xmlns:serif="http://www.serif.com/"
                                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <path fill="currentColor"
                                                    d="M501.303,132.765c-5.887,-22.03 -23.235,-39.377 -45.265,-45.265c-39.932,-10.7 -200.038,-10.7 -200.038,-10.7c0,0 -160.107,0 -200.039,10.7c-22.026,5.888 -39.377,23.235 -45.264,45.265c-10.697,39.928 -10.697,123.238 -10.697,123.238c0,0 0,83.308 10.697,123.232c5.887,22.03 23.238,39.382 45.264,45.269c39.932,10.696 200.039,10.696 200.039,10.696c0,0 160.106,0 200.038,-10.696c22.03,-5.887 39.378,-23.239 45.265,-45.269c10.696,-39.924 10.696,-123.232 10.696,-123.232c0,0 0,-83.31 -10.696,-123.238Zm-296.506,200.039l0,-153.603l133.019,76.802l-133.019,76.801Z"
                                                    style="fill-rule:nonzero;" />
                                            </svg>
                                        </div>
                                    </button>
                                </a>
                                <a href="https://www.instagram.com/jasawebsite.biz/" target="__blank">
                                    <button
                                        class=" w-full p-2 aspect-square flex items-center justify-center bg-white hover:bg-green-200 hover:text-green-600 duration-300 rounded-md">
                                        <div class=" w-7 h-7">
                                            <svg viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg">
                                                <path fill="none" d="M0 0h256v256H0z"></path>
                                                <circle cx="128" cy="128" r="32" fill="currentColor"
                                                    class="fill-000000"></circle>
                                                <path
                                                    d="M172 28H84a56 56 0 0 0-56 56v88a56 56 0 0 0 56 56h88a56 56 0 0 0 56-56V84a56 56 0 0 0-56-56Zm-44 148a48 48 0 1 1 48-48 48 48 0 0 1-48 48Zm52-88a12 12 0 1 1 12-12 12 12 0 0 1-12 12Z"
                                                    fill="currentColor" class="fill-000000"></path>
                                            </svg>
                                        </div>
                                    </button>
                                </a>
                                <a href="https://www.tiktok.com/@www.webz.biz" target="__blank">
                                    <button
                                        class=" w-full p-2 aspect-square flex items-center justify-center bg-white hover:bg-green-200 hover:text-green-600 duration-300 rounded-md">
                                        <div class=" w-7 h-7">
                                            <svg viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg">
                                                <path fill="none" d="M0 0h256v256H0z"></path>
                                                <path
                                                    d="M232 84v40a8 8 0 0 1-8 8 103.2 103.2 0 0 1-48-11.7V156a76 76 0 1 1-89.4-74.8 8 8 0 0 1 6.5 1.7 7.8 7.8 0 0 1 2.9 6.2v41.6a7.9 7.9 0 0 1-4.6 7.2A20 20 0 1 0 120 156V28a8 8 0 0 1 8-8h40a8 8 0 0 1 8 8 48 48 0 0 0 48 48 8 8 0 0 1 8 8Z"
                                                    fill="currentColor" class="fill-000000"></path>
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
    </div>
    @include('components.guest.footer')
</x-layout.guest>
