{{-- Footer --}}
<div class=" w-full">
    {{ $additional ?? '' }}
    <div id="kontak" class=" w-full bg-byolink-1 pt-6 sm:pt-10 pb-6 divide-y-2 divide-white space-y-6">
        <div class=" w-full px-4 md:px-8 py-4">
            <div class=" w-full max-w-[1080px] mx-auto grid grid-cols-3 gap-4 sm:gap-6 text-white">
                <div class=" col-span-3 md:col-span-1 space-y-6">
                    <div class=" space-y-2">
                        <div class=" w-44 h-10 sm:h-12 flex items-start overflow-hidden">
                            <p class=" text-xl sm:text-3xl font-bold text-white">Catalog</p>
                            {{-- <img src="{{asset('assets/images/logo.png')}}" alt=""> --}}
                        </div>
                        <p class=" text-xs sm:text-sm">Berbagai pilihan desain modern terima beres. Biar kami yang
                            menentukan dari pilihan desain berikut ini.</p>
                    </div>
                    <div class=" text-xs sm:text-sm space-y-4">
                        <div class=" flex flex-row gap-2">
                            <div class=" w-1 rounded-full bg-white"></div>
                            <p class=" font-semibold">Social Media</p>
                        </div>
                        <div class=" flex gap-2">
                            <a href="https://www.youtube.com/@jbiztv" target="__blank">
                                <div
                                    class=" bg-white text-byolink-1 w-8 aspect-square rounded-lg overflow-hidden p-1 hover:scale-105 duration-300">
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
                            </a>
                            <a href="https://www.instagram.com/jasawebsite.biz/" target="__blank">
                                <div
                                    class=" bg-white text-byolink-1 w-8 aspect-square rounded-lg overflow-hidden p-1 hover:scale-105 duration-300">
                                    <svg viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg">
                                        <path fill="none" d="M0 0h256v256H0z"></path>
                                        <circle cx="128" cy="128" r="32" fill="currentColor"
                                            class="fill-000000"></circle>
                                        <path
                                            d="M172 28H84a56 56 0 0 0-56 56v88a56 56 0 0 0 56 56h88a56 56 0 0 0 56-56V84a56 56 0 0 0-56-56Zm-44 148a48 48 0 1 1 48-48 48 48 0 0 1-48 48Zm52-88a12 12 0 1 1 12-12 12 12 0 0 1-12 12Z"
                                            fill="currentColor" class="fill-000000"></path>
                                    </svg>
                                </div>
                            </a>
                            <a href="https://www.tiktok.com/@www.webz.biz" target="__blank">
                                <div
                                    class=" bg-white text-byolink-1 w-8 aspect-square rounded-lg overflow-hidden p-1 hover:scale-105 duration-300">
                                    <svg viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg">
                                        <path fill="none" d="M0 0h256v256H0z"></path>
                                        <path
                                            d="M232 84v40a8 8 0 0 1-8 8 103.2 103.2 0 0 1-48-11.7V156a76 76 0 1 1-89.4-74.8 8 8 0 0 1 6.5 1.7 7.8 7.8 0 0 1 2.9 6.2v41.6a7.9 7.9 0 0 1-4.6 7.2A20 20 0 1 0 120 156V28a8 8 0 0 1 8-8h40a8 8 0 0 1 8 8 48 48 0 0 0 48 48 8 8 0 0 1 8 8Z"
                                            fill="currentColor" class="fill-000000"></path>
                                    </svg>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class=" text-xs sm:text-sm space-y-4">
                    <div class=" flex flex-row gap-2">
                        <div class=" w-1 rounded-full bg-white"></div>
                        <p class=" font-semibold">Navigasi</p>
                    </div>
                    <div class=" text-white flex flex-col gap-2 pl-4">
                        <a href="{{ route('home') }}" class=" list-item hover:underline duration-300">Beranda</a>
                        <a href="{{ route('allcategory') }}" class=" list-item hover:underline duration-300">Desain</a>
                        <a href="{{ route('price.list') }}" class=" list-item hover:underline duration-300">Pirce
                            List</a>
                        <a href="{{ route('guestportfolio') }}"
                            class=" list-item hover:underline duration-300">Portofolio</a>
                        <a href="{{ route('contact') }}" class=" list-item hover:underline duration-300">Tentang
                            Kami</a>
                    </div>
                </div>
                <div class=" text-xs sm:text-sm col-span-2 md:col-span-1 space-y-4">
                    <div class=" flex flex-row gap-2">
                        <div class=" w-1 rounded-full bg-white"></div>
                        <p class=" font-semibold">Kontak Kami</p>
                    </div>
                    <div class=" flex flex-col gap-2">
                        <div class=" flex items-center gap-2">
                            <div class=" min-w-4 w-4 aspect-square text-main">
                                <svg viewBox="0 0 128 128" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-rule="evenodd" fill-rule="evenodd">
                                        <path fill="none" d="M0 0h128v128H0z"></path>
                                        <path
                                            d="M46.114 32.509c-1.241-2.972-2.182-3.085-4.062-3.161a36.272 36.272 0 0 0-2.144-.074c-2.446 0-5.003.715-6.546 2.295-1.88 1.919-6.545 6.396-6.545 15.576 0 9.181 6.695 18.06 7.598 19.303.941 1.24 13.053 20.354 31.86 28.144 14.707 6.095 19.071 5.53 22.418 4.816 4.89-1.053 11.021-4.667 12.564-9.03 1.542-4.365 1.542-8.09 1.09-8.88-.451-.79-1.693-1.24-3.573-2.182-1.88-.941-11.021-5.456-12.751-6.058-1.693-.639-3.31-.413-4.588 1.393-1.806 2.521-3.573 5.08-5.003 6.622-1.128 1.204-2.972 1.355-4.514.715-2.069-.864-7.861-2.898-15.008-9.256-5.53-4.928-9.291-11.06-10.381-12.904-1.091-1.881-.113-2.973.752-3.988.941-1.167 1.843-1.994 2.783-3.086.941-1.091 1.467-1.655 2.069-2.935.64-1.241.188-2.521-.263-3.462-.452-.943-4.213-10.124-5.756-13.848zM63.981 0C28.699 0 0 28.707 0 63.999c0 13.996 4.514 26.977 12.187 37.512L4.212 125.29l24.6-7.862C38.93 124.125 51.004 128 64.019 128 99.301 128 128 99.291 128 64.001 128 28.709 99.301.002 64.019.002h-.037V0z"
                                            fill="currentColor" class="fill-67c15e"></path>
                                    </g>
                                </svg>
                            </div>
                            <a href="https://wa.me/{{ $hp }}" target="__blank">
                                <p class=" hover:underline">
                                    {{ '+62 ' . substr($hp, 3, 3) . '-' . substr($hp, 6, 4) . '-' . substr($hp, 10) }}
                                </p>
                            </a>
                        </div>
                        <div class=" flex items-center gap-2">
                            <div class=" min-w-4 w-4 aspect-square text-main">
                                <svg viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="none" d="M0 0h256v256H0z"></path>
                                    <path
                                        d="m222 158.4-46.9-20a15.6 15.6 0 0 0-15.1 1.3l-25.1 16.7a76.5 76.5 0 0 1-35.2-35L116.3 96a15.9 15.9 0 0 0 1.4-15.1L97.6 34a16.3 16.3 0 0 0-16.7-9.6A56.2 56.2 0 0 0 32 80c0 79.4 64.6 144 144 144a56.2 56.2 0 0 0 55.6-48.9 16.3 16.3 0 0 0-9.6-16.7ZM157.4 47.7a72.6 72.6 0 0 1 50.9 50.9 8 8 0 0 0 7.7 6 7.6 7.6 0 0 0 2.1-.3 7.9 7.9 0 0 0 5.6-9.8 88 88 0 0 0-62.2-62.2 8 8 0 1 0-4.1 15.4ZM149.1 78.6a40.4 40.4 0 0 1 28.3 28.3 7.9 7.9 0 0 0 7.7 6 6.4 6.4 0 0 0 2-.3 7.9 7.9 0 0 0 5.7-9.8 55.8 55.8 0 0 0-39.6-39.6 8 8 0 1 0-4.1 15.4Z"
                                        fill="currentColor" class="fill-000000"></path>
                                </svg>
                            </div>
                            <a href="tel:{{ $hp }}" target="__blank">
                                <p class=" hover:underline">
                                    {{ '+62 ' . substr($hp, 3, 3) . '-' . substr($hp, 6, 4) . '-' . substr($hp, 10) }}
                                </p>
                            </a>
                        </div>
                        <div class=" flex items-center gap-2">
                            <div class=" min-w-4 w-4 aspect-square text-main">
                                <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M24 4c-7.73 0-14 6.27-14 14 0 10.5 14 26 14 26s14-15.5 14-26c0-7.73-6.27-14-14-14zm0 19c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5z"
                                        fill="currentColor" class="fill-000000"></path>
                                    <path d="M0 0h48v48H0z" fill="none"></path>
                                </svg>
                            </div>
                            <a href="https://maps.app.goo.gl/J1eVkmTBPpgw52JH6" target="__blank">
                                <p class=" hover:underline">Komplek Sapta Taruna PU kujangsari blok B1 no 10, KOTA
                                    BANDUNG, BANDUNG KIDUL, JAWA BARAT, ID, 40267</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=" text-center text-white pt-6">
            <p class="text-xs">
                © 2025 catalog.jasawebsite.biz | Developed by
                <span class="hover:underline">
                    <a href="https://jasawebsite.biz" target="_blank">
                        Jasawebsitebiz
                    </a>
                </span>
            </p>
        </div>
    </div>
</div>
<div class=" w-full sticky px-4 bottom-0 z-50 backdrop-blur">
    <div class=" w-full max-w-[1080px] mx-auto">
        <div class=" w-full py-2 grid grid-cols-2 gap-2 sm:gap-4 text-sm sm:text-base">
            <a href="tel:{{$hp}}" class=" w-full" target="__blank">
                <button
                    class="
                 w-full flex items-center justify-center gap-1 sm:gap-1.5 py-2 bg-byolink-2 text-white font-semibold rounded-full hover:scale-95 duration-300">
                    <div class=" w-4 sm:w-5 aspect-square">
                        <svg viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg">
                            <path fill="none" d="M0 0h256v256H0z"></path>
                            <path
                                d="M92.5 124.8a83.6 83.6 0 0 0 39 38.9 8 8 0 0 0 7.9-.6l25-16.7a7.9 7.9 0 0 1 7.6-.7l46.8 20.1a7.9 7.9 0 0 1 4.8 8.3A48 48 0 0 1 176 216 136 136 0 0 1 40 80a48 48 0 0 1 41.9-47.6 7.9 7.9 0 0 1 8.3 4.8l20.1 46.9a8 8 0 0 1-.6 7.5L93 117a8 8 0 0 0-.5 7.8Z"
                                fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="16" class="stroke-000000"></path>
                        </svg>
                    </div>
                    <p>Telephone</p>
                </button>
            </a>
            <a href="https://wa.me/{{ $hp }}?text={{ urlencode('Halo saya Tertarik dengan Paket yang anda sediakan di catalog.jasawebsite.biz') }}"
                class=" w-full" target="__blank">
                <button
                    class="
                 w-full flex items-center justify-center gap-1 sm:gap-1.5 py-2 bg-byolink-2 text-white font-semibold rounded-full hover:scale-95 duration-300">
                    <div class=" w-4 sm:w-5 aspect-square">
                        <svg viewBox="0 0 56.693 56.693" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                            enable-background="new 0 0 56.693 56.693">
                            <path
                                d="M46.38 10.714C41.73 6.057 35.544 3.492 28.954 3.489c-13.579 0-24.63 11.05-24.636 24.633a24.589 24.589 0 0 0 3.289 12.316L4.112 53.204l13.06-3.426a24.614 24.614 0 0 0 11.772 2.999h.01c13.577 0 24.63-11.052 24.635-24.635.002-6.582-2.558-12.772-7.209-17.428zM28.954 48.616h-.009a20.445 20.445 0 0 1-10.421-2.854l-.748-.444-7.75 2.033 2.07-7.555-.488-.775a20.427 20.427 0 0 1-3.13-10.897c.004-11.29 9.19-20.474 20.484-20.474a20.336 20.336 0 0 1 14.476 6.005 20.352 20.352 0 0 1 5.991 14.485c-.004 11.29-9.19 20.476-20.475 20.476z"
                                fill-rule="evenodd" clip-rule="evenodd" fill="currentColor" class="fill-000000">
                            </path>
                            <path
                                d="M40.185 33.281c-.615-.308-3.642-1.797-4.206-2.003-.564-.205-.975-.308-1.385.308-.41.617-1.59 2.003-1.949 2.414-.359.41-.718.462-1.334.154-.615-.308-2.599-.958-4.95-3.055-1.83-1.632-3.065-3.648-3.424-4.264-.36-.617-.038-.95.27-1.257.277-.276.615-.719.923-1.078.308-.36.41-.616.616-1.027.205-.41.102-.77-.052-1.078-.153-.308-1.384-3.338-1.897-4.57-.5-1.2-1.008-1.038-1.385-1.057-.359-.018-.77-.022-1.18-.022s-1.077.154-1.642.77c-.564.616-2.154 2.106-2.154 5.135 0 3.03 2.206 5.957 2.513 6.368.308.41 4.341 6.628 10.516 9.294a35.341 35.341 0 0 0 3.509 1.297c1.474.469 2.816.402 3.877.244 1.183-.177 3.642-1.49 4.155-2.927.513-1.438.513-2.67.359-2.927-.154-.257-.564-.41-1.18-.719z"
                                fill-rule="evenodd" clip-rule="evenodd" fill="currentColor" class="fill-000000">
                            </path>
                        </svg>
                    </div>
                    <p>WhatsApp</p>
                </button>
            </a>
        </div>
    </div>
</div>
