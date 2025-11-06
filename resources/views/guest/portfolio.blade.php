<x-layout.guest title="Catalog - Portofolio" :category="$category">
    <div class=" w-full min-h-[calc(100vh-370px)] bg-[#F1F3F4]">
        <div class=" w-full py-16 sm:py-24 px-4 sm:px-6 space-y-12 sm:space-y-24">
            <div class=" w-full max-w-[1080px] mx-auto">
                <div class=" w-full space-y-6 sm:space-y-12">
                    <div class="w-full flex justify-between items-center">
                        <div style='font-family: "Montserrat", Sans-serif;'
                            class=" w-full flex flex-col items-center gap-2 sm:gap-4">
                            {{-- <p class=" text-base sm:text-xl font-bold text-center">Template</p> --}}
                            <p class=" text-xl sm:text-3xl font-bold text-center">Portofolio</p>
                            <p class=" text-center text-sm sm:text-base">
                                Berikut ini beberapa Portofolio dari masing-masing Tipe Desain Simple
                            </p>
                        </div>
                    </div>
                    <div class=" w-full grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                        <div
                            class=" w-full p-4 sm:p-6 bg-white rounded-xl shadow-md shadow-black/20 flex flex-col justify-between gap-6">
                            <div class=" space-y-4">
                                <p class=" text-lg sm:text-2xl font-bold">Simpel Pemula</p>
                                <ul class="list-disc pl-6 text-sm sm:text-base space-y-1">
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://bnetfit.sites.id">bnetfit.sites.id</a></li>
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://handayani.sites.id">handayani.sites.id</a></li>
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://cendanabotanictrail.sites.id">cendanabotanictrail.sites.id</a>
                                    </li>
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://bsdbresidence.sites.id">bsdbresidence.sites.id</a></li>
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://cendanaessence.sites.id">cendanaessence.sites.id</a></li>
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://paramountpetals.sites.id">paramountpetals.sites.id</a></li>
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://gianwatertech.sites.id">gianwatertech.sites.id</a></li>
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://kontraktorbaja.sites.id">kontraktorbaja.sites.id</a></li>
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://lovefloristsurabaya.sites.id">lovefloristsurabaya.sites.id</a>
                                    </li>
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://multiadhiperkasarental.sites.id">multiadhiperkasarental.sites.id</a>
                                    </li>
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://aradatex.sites.id">aradatex.sites.id</a></li>
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://autoxpresstasik.sites.id">autoxpresstasik.sites.id</a></li>
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://jasakolamkoi.sites.id">jasakolamkoi.sites.id</a></li>
                                </ul>
                            </div>
                            <div class=" space-y-4">
                                <a data-fancybox="gallery" aria-label="Gallery"
                                    href="{{ asset('/assets/images/price-list.png') }}" class="flex w-full">
                                    <button
                                        class="bg-byolink-2 flex font-semibold items-center justify-center text-sm gap-0.5 sm:gap-1.5 py-2 px-4 text-white rounded-full hover:scale-95 duration-300">
                                        <div class="w-4 aspect-square">
                                            <svg class=" w-full h-full" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill="currentColor"
                                                    d="M16 2H8C4.691 2 2 4.691 2 8v13a1 1 0 0 0 1 1h13c3.309 0 6-2.691 6-6V8c0-3.309-2.691-6-6-6zm-2 13H7v-2h7v2zm3-4H7V9h10v2z" />
                                            </svg>
                                        </div>
                                        <p>Lihat Detail</p>
                                    </button>
                                </a>
                                <a class=" flex w-full"
                                    href="https://wa.me/{{ $hp }}?text={{ urlencode('Halo Saya dapat info dari catalog.jasawebsite.biz, dan tertarik dengan Paket Tipe Simpel Pemula') }}"
                                    target="__blank">
                                    <button
                                        class="bg-byolink-2 flex font-semibold items-center justify-center text-sm gap-0.5 sm:gap-1.5 py-2 px-4 text-white rounded-full hover:scale-95 duration-300">
                                        <div class="w-4 aspect-square">
                                            <svg viewBox="0 0 56.693 56.693" xml:space="preserve"
                                                xmlns="http://www.w3.org/2000/svg"
                                                enable-background="new 0 0 56.693 56.693">
                                                <path
                                                    d="M46.38 10.714C41.73 6.057 35.544 3.492 28.954 3.489c-13.579 0-24.63 11.05-24.636 24.633a24.589 24.589 0 0 0 3.289 12.316L4.112 53.204l13.06-3.426a24.614 24.614 0 0 0 11.772 2.999h.01c13.577 0 24.63-11.052 24.635-24.635.002-6.582-2.558-12.772-7.209-17.428zM28.954 48.616h-.009a20.445 20.445 0 0 1-10.421-2.854l-.748-.444-7.75 2.033 2.07-7.555-.488-.775a20.427 20.427 0 0 1-3.13-10.897c.004-11.29 9.19-20.474 20.484-20.474a20.336 20.336 0 0 1 14.476 6.005 20.352 20.352 0 0 1 5.991 14.485c-.004 11.29-9.19 20.476-20.475 20.476z"
                                                    fill-rule="evenodd" clip-rule="evenodd" fill="currentColor"
                                                    class="fill-000000"></path>
                                                <path
                                                    d="M40.185 33.281c-.615-.308-3.642-1.797-4.206-2.003-.564-.205-.975-.308-1.385.308-.41.617-1.59 2.003-1.949 2.414-.359.41-.718.462-1.334.154-.615-.308-2.599-.958-4.95-3.055-1.83-1.632-3.065-3.648-3.424-4.264-.36-.617-.038-.95.27-1.257.277-.276.615-.719.923-1.078.308-.36.41-.616.616-1.027.205-.41.102-.77-.052-1.078-.153-.308-1.384-3.338-1.897-4.57-.5-1.2-1.008-1.038-1.385-1.057-.359-.018-.77-.022-1.18-.022s-1.077.154-1.642.77c-.564.616-2.154 2.106-2.154 5.135 0 3.03 2.206 5.957 2.513 6.368.308.41 4.341 6.628 10.516 9.294a35.341 35.341 0 0 0 3.509 1.297c1.474.469 2.816.402 3.877.244 1.183-.177 3.642-1.49 4.155-2.927.513-1.438.513-2.67.359-2.927-.154-.257-.564-.41-1.18-.719z"
                                                    fill-rule="evenodd" clip-rule="evenodd" fill="currentColor"
                                                    class="fill-000000"></path>
                                            </svg>
                                        </div>
                                        <p>Pesan Paket Sekarang</p>
                                    </button>
                                </a>
                                <p class=" text-sm sm:text-base">*Website simple 1 halaman dengan domain .sites.id</p>
                            </div>
                        </div>
                        <div
                            class=" w-full p-4 sm:p-6 bg-white rounded-xl shadow-md shadow-black/20 flex flex-col justify-between gap-6">
                            <div class=" space-y-4">
                                <p class=" text-lg sm:text-2xl font-bold">Simpel Medium</p>
                                <ul class="list-disc pl-6 text-sm sm:text-base space-y-1">
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://jualakibandung.com">jualakibandung.com</a></li>
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://floraljoyyy.com">floraljoyyy.com</a></li>
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://jasakolamkoi.com">jasakolamkoi.com</a></li>
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://mentariteknikservice.com">mentariteknikservice.com</a></li>
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://sedotwcserangbanten.com">sedotwcserangbanten.com</a></li>
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://gesitrentalmobil.com">gesitrentalmobil.com</a></li>
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://wisataadventure.com">wisataadventure.com</a></li>
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://dokterflorist.com">dokterflorist.com</a></li>
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://barokahgordenbandung.com">barokahgordenbandung.com</a></li>
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://promotoyotabandungofficial.com">promotoyotabandungofficial.com</a>
                                    </li>
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://autoxpresstasik.com">autoxpresstasik.com</a></li>
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://mealblend.spencersbdg.com">mealblend.spencersbdg.com</a></li>
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://sanitexindonesia.com">sanitexindonesia.com</a></li>
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://hondabandungstudio.com">hondabandungstudio.com</a></li>
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://eldoradohybrid.com">eldoradohybrid.com</a></li>
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://sultanjayarollingdoor.com">sultanjayarollingdoor.com</a></li>
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://outboundbandungvacation.com">outboundbandungvacation.com</a>
                                    </li>
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://fansttourtravel.com">fansttourtravel.com</a></li>
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://sinarkaryabaja.com">sinarkaryabaja.com</a></li>
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://gianwatertech.com">gianwatertech.com</a></li>
                                </ul>
                            </div>
                            <div class=" space-y-4">
                                <a data-fancybox="gallery" aria-label="Gallery"
                                    href="{{ asset('/assets/images/price-list.png') }}" class="flex w-full">
                                    <button
                                        class="bg-byolink-2 flex font-semibold items-center justify-center text-sm gap-0.5 sm:gap-1.5 py-2 px-4 text-white rounded-full hover:scale-95 duration-300">
                                        <div class="w-4 aspect-square">
                                            <svg class=" w-full h-full" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill="currentColor"
                                                    d="M16 2H8C4.691 2 2 4.691 2 8v13a1 1 0 0 0 1 1h13c3.309 0 6-2.691 6-6V8c0-3.309-2.691-6-6-6zm-2 13H7v-2h7v2zm3-4H7V9h10v2z" />
                                            </svg>
                                        </div>
                                        <p>Lihat Detail</p>
                                    </button>
                                </a>
                                <a class=" flex w-full"
                                    href="https://wa.me/{{ $hp }}?text={{ urlencode('Halo Saya dapat info dari catalog.jasawebsite.biz, dan tertarik dengan Paket Tipe Simpel Medium') }}"
                                    target="__blank">
                                    <button
                                        class="bg-byolink-2 flex font-semibold items-center justify-center text-sm gap-0.5 sm:gap-1.5 py-2 px-4 text-white rounded-full hover:scale-95 duration-300">
                                        <div class="w-4 aspect-square">
                                            <svg viewBox="0 0 56.693 56.693" xml:space="preserve"
                                                xmlns="http://www.w3.org/2000/svg"
                                                enable-background="new 0 0 56.693 56.693">
                                                <path
                                                    d="M46.38 10.714C41.73 6.057 35.544 3.492 28.954 3.489c-13.579 0-24.63 11.05-24.636 24.633a24.589 24.589 0 0 0 3.289 12.316L4.112 53.204l13.06-3.426a24.614 24.614 0 0 0 11.772 2.999h.01c13.577 0 24.63-11.052 24.635-24.635.002-6.582-2.558-12.772-7.209-17.428zM28.954 48.616h-.009a20.445 20.445 0 0 1-10.421-2.854l-.748-.444-7.75 2.033 2.07-7.555-.488-.775a20.427 20.427 0 0 1-3.13-10.897c.004-11.29 9.19-20.474 20.484-20.474a20.336 20.336 0 0 1 14.476 6.005 20.352 20.352 0 0 1 5.991 14.485c-.004 11.29-9.19 20.476-20.475 20.476z"
                                                    fill-rule="evenodd" clip-rule="evenodd" fill="currentColor"
                                                    class="fill-000000"></path>
                                                <path
                                                    d="M40.185 33.281c-.615-.308-3.642-1.797-4.206-2.003-.564-.205-.975-.308-1.385.308-.41.617-1.59 2.003-1.949 2.414-.359.41-.718.462-1.334.154-.615-.308-2.599-.958-4.95-3.055-1.83-1.632-3.065-3.648-3.424-4.264-.36-.617-.038-.95.27-1.257.277-.276.615-.719.923-1.078.308-.36.41-.616.616-1.027.205-.41.102-.77-.052-1.078-.153-.308-1.384-3.338-1.897-4.57-.5-1.2-1.008-1.038-1.385-1.057-.359-.018-.77-.022-1.18-.022s-1.077.154-1.642.77c-.564.616-2.154 2.106-2.154 5.135 0 3.03 2.206 5.957 2.513 6.368.308.41 4.341 6.628 10.516 9.294a35.341 35.341 0 0 0 3.509 1.297c1.474.469 2.816.402 3.877.244 1.183-.177 3.642-1.49 4.155-2.927.513-1.438.513-2.67.359-2.927-.154-.257-.564-.41-1.18-.719z"
                                                    fill-rule="evenodd" clip-rule="evenodd" fill="currentColor"
                                                    class="fill-000000"></path>
                                            </svg>
                                        </div>
                                        <p>Pesan Paket Sekarang</p>
                                    </button>
                                </a>
                                <p class=" text-sm sm:text-base">*Website simple 1 halaman dengan domain .com</p>
                            </div>
                        </div>
                        <div
                            class=" w-full p-4 sm:p-6 bg-white rounded-xl shadow-md shadow-black/20 flex flex-col justify-between gap-6">
                            <div class=" space-y-4">
                                <p class=" text-lg sm:text-2xl font-bold">Simpel Bisnis</p>
                                <ul class="list-disc pl-6 text-sm sm:text-base space-y-1">
                                    <li class=" text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://mini-indonesian.com">mini-indonesian.com</a></li>
                                    <li class=" text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://damayantisofa.com">damayantisofa.com</a></li>
                                    <li class=" text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://pratamakreasindo.com">pratamakreasindo.com</a></li>
                                    <li class=" text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://akriliksign.com">akriliksign.com</a></li>
                                    <li class=" text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://murayengineering.com">murayengineering.com</a></li>
                                    <li class=" text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://bandungcanopy.com">bandungcanopy.com</a></li>
                                    <li class=" text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://terraadventurebandung.com">terraadventurebandung.com</a></li>
                                    <li class=" text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://captaineventprojects.com">captaineventprojects.com</a></li>
                                    <li class=" text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://masterpipakonstruksi.com">masterpipakonstruksi.com</a></li>
                                    <li class=" text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://anugrahjayaservice.com">anugrahjayaservice.com</a></li>
                                    <li class=" text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://anugrahhandpallet.com">anugrahhandpallet.com</a></li>
                                    <li class=" text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://bradakonveksi.com">bradakonveksi.com</a></li>
                                    <li class=" text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://wartegnwputrabahari.com">wartegnwputrabahari.com</a></li>
                                </ul>
                            </div>
                            <div class=" space-y-4">
                                <a data-fancybox="gallery" aria-label="Gallery"
                                    href="{{ asset('/assets/images/price-list.png') }}" class="flex w-full">
                                    <button
                                        class="bg-byolink-2 flex font-semibold items-center justify-center text-sm gap-0.5 sm:gap-1.5 py-2 px-4 text-white rounded-full hover:scale-95 duration-300">
                                        <div class="w-4 aspect-square">
                                            <svg class=" w-full h-full" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill="currentColor"
                                                    d="M16 2H8C4.691 2 2 4.691 2 8v13a1 1 0 0 0 1 1h13c3.309 0 6-2.691 6-6V8c0-3.309-2.691-6-6-6zm-2 13H7v-2h7v2zm3-4H7V9h10v2z" />
                                            </svg>
                                        </div>
                                        <p>Lihat Detail</p>
                                    </button>
                                </a>
                                <a class=" flex w-full"
                                    href="https://wa.me/{{ $hp }}?text={{ urlencode('Halo Saya dapat info dari catalog.jasawebsite.biz, dan tertarik dengan Paket Tipe Simpel Bisnis') }}"
                                    target="__blank">
                                    <button
                                        class="bg-byolink-2 flex font-semibold items-center justify-center text-sm gap-0.5 sm:gap-1.5 py-2 px-4 text-white rounded-full hover:scale-95 duration-300">
                                        <div class="w-4 aspect-square">
                                            <svg viewBox="0 0 56.693 56.693" xml:space="preserve"
                                                xmlns="http://www.w3.org/2000/svg"
                                                enable-background="new 0 0 56.693 56.693">
                                                <path
                                                    d="M46.38 10.714C41.73 6.057 35.544 3.492 28.954 3.489c-13.579 0-24.63 11.05-24.636 24.633a24.589 24.589 0 0 0 3.289 12.316L4.112 53.204l13.06-3.426a24.614 24.614 0 0 0 11.772 2.999h.01c13.577 0 24.63-11.052 24.635-24.635.002-6.582-2.558-12.772-7.209-17.428zM28.954 48.616h-.009a20.445 20.445 0 0 1-10.421-2.854l-.748-.444-7.75 2.033 2.07-7.555-.488-.775a20.427 20.427 0 0 1-3.13-10.897c.004-11.29 9.19-20.474 20.484-20.474a20.336 20.336 0 0 1 14.476 6.005 20.352 20.352 0 0 1 5.991 14.485c-.004 11.29-9.19 20.476-20.475 20.476z"
                                                    fill-rule="evenodd" clip-rule="evenodd" fill="currentColor"
                                                    class="fill-000000"></path>
                                                <path
                                                    d="M40.185 33.281c-.615-.308-3.642-1.797-4.206-2.003-.564-.205-.975-.308-1.385.308-.41.617-1.59 2.003-1.949 2.414-.359.41-.718.462-1.334.154-.615-.308-2.599-.958-4.95-3.055-1.83-1.632-3.065-3.648-3.424-4.264-.36-.617-.038-.95.27-1.257.277-.276.615-.719.923-1.078.308-.36.41-.616.616-1.027.205-.41.102-.77-.052-1.078-.153-.308-1.384-3.338-1.897-4.57-.5-1.2-1.008-1.038-1.385-1.057-.359-.018-.77-.022-1.18-.022s-1.077.154-1.642.77c-.564.616-2.154 2.106-2.154 5.135 0 3.03 2.206 5.957 2.513 6.368.308.41 4.341 6.628 10.516 9.294a35.341 35.341 0 0 0 3.509 1.297c1.474.469 2.816.402 3.877.244 1.183-.177 3.642-1.49 4.155-2.927.513-1.438.513-2.67.359-2.927-.154-.257-.564-.41-1.18-.719z"
                                                    fill-rule="evenodd" clip-rule="evenodd" fill="currentColor"
                                                    class="fill-000000"></path>
                                            </svg>
                                        </div>
                                        <p>Pesan Paket Sekarang</p>
                                    </button>
                                </a>
                                <p class=" text-sm sm:text-base">*Website simple 5 halaman dengan domain .com</p>
                            </div>
                        </div>
                        <div
                            class=" w-full p-4 sm:p-6 bg-white rounded-xl shadow-md shadow-black/20 flex flex-col justify-between gap-6">
                            <div class=" space-y-4">
                                <p class=" text-lg sm:text-2xl font-bold">Simpel Bisnis Plus</p>
                                <ul class="list-disc pl-6 text-sm sm:text-base space-y-1">
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://tokokaranganbungabandung.com">tokokaranganbungabandung.com</a>
                                    </li>
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://souvenirpromosimurah.com">souvenirpromosimurah.com</a></li>
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://cateringbandung.sites.id">cateringbandung.sites.id</a></li>
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://pustakahukum.com">pustakahukum.com</a></li>
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://snackbox.co.id">snackbox.co.id</a></li>
                                    <li class="text-neutral-600 hover:text-byolink-2 font-bold duration-300"><a
                                            href="https://gojes.sites.id">gojes.sites.id</a></li>
                                </ul>
                            </div>
                            <div class=" space-y-4">
                                <a data-fancybox="gallery" aria-label="Gallery"
                                    href="{{ asset('/assets/images/price-list.png') }}" class="flex w-full">
                                    <button
                                        class="bg-byolink-2 flex font-semibold items-center justify-center text-sm gap-0.5 sm:gap-1.5 py-2 px-4 text-white rounded-full hover:scale-95 duration-300">
                                        <div class="w-4 aspect-square">
                                            <svg class=" w-full h-full" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill="currentColor"
                                                    d="M16 2H8C4.691 2 2 4.691 2 8v13a1 1 0 0 0 1 1h13c3.309 0 6-2.691 6-6V8c0-3.309-2.691-6-6-6zm-2 13H7v-2h7v2zm3-4H7V9h10v2z" />
                                            </svg>
                                        </div>
                                        <p>Lihat Detail</p>
                                    </button>
                                </a>
                                <a class=" flex w-full"
                                    href="https://wa.me/{{ $hp }}?text={{ urlencode('Halo Saya dapat info dari catalog.jasawebsite.biz, dan tertarik dengan Paket Tipe Simpel Bisnis Plus') }}"
                                    target="__blank">
                                    <button
                                        class="bg-byolink-2 flex font-semibold items-center justify-center text-sm gap-0.5 sm:gap-1.5 py-2 px-4 text-white rounded-full hover:scale-95 duration-300">
                                        <div class="w-4 aspect-square">
                                            <svg viewBox="0 0 56.693 56.693" xml:space="preserve"
                                                xmlns="http://www.w3.org/2000/svg"
                                                enable-background="new 0 0 56.693 56.693">
                                                <path
                                                    d="M46.38 10.714C41.73 6.057 35.544 3.492 28.954 3.489c-13.579 0-24.63 11.05-24.636 24.633a24.589 24.589 0 0 0 3.289 12.316L4.112 53.204l13.06-3.426a24.614 24.614 0 0 0 11.772 2.999h.01c13.577 0 24.63-11.052 24.635-24.635.002-6.582-2.558-12.772-7.209-17.428zM28.954 48.616h-.009a20.445 20.445 0 0 1-10.421-2.854l-.748-.444-7.75 2.033 2.07-7.555-.488-.775a20.427 20.427 0 0 1-3.13-10.897c.004-11.29 9.19-20.474 20.484-20.474a20.336 20.336 0 0 1 14.476 6.005 20.352 20.352 0 0 1 5.991 14.485c-.004 11.29-9.19 20.476-20.475 20.476z"
                                                    fill-rule="evenodd" clip-rule="evenodd" fill="currentColor"
                                                    class="fill-000000"></path>
                                                <path
                                                    d="M40.185 33.281c-.615-.308-3.642-1.797-4.206-2.003-.564-.205-.975-.308-1.385.308-.41.617-1.59 2.003-1.949 2.414-.359.41-.718.462-1.334.154-.615-.308-2.599-.958-4.95-3.055-1.83-1.632-3.065-3.648-3.424-4.264-.36-.617-.038-.95.27-1.257.277-.276.615-.719.923-1.078.308-.36.41-.616.616-1.027.205-.41.102-.77-.052-1.078-.153-.308-1.384-3.338-1.897-4.57-.5-1.2-1.008-1.038-1.385-1.057-.359-.018-.77-.022-1.18-.022s-1.077.154-1.642.77c-.564.616-2.154 2.106-2.154 5.135 0 3.03 2.206 5.957 2.513 6.368.308.41 4.341 6.628 10.516 9.294a35.341 35.341 0 0 0 3.509 1.297c1.474.469 2.816.402 3.877.244 1.183-.177 3.642-1.49 4.155-2.927.513-1.438.513-2.67.359-2.927-.154-.257-.564-.41-1.18-.719z"
                                                    fill-rule="evenodd" clip-rule="evenodd" fill="currentColor"
                                                    class="fill-000000"></path>
                                            </svg>
                                        </div>
                                        <p>Pesan Paket Sekarang</p>
                                    </button>
                                </a>
                                <p class=" text-sm sm:text-base">*Website simple 5 halaman dengan fitur Menarik</p>
                            </div>
                        </div>
                    </div>
                    {{-- <div id="desain" class=" w-full grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
                        @include('components.guest.portfolio')
                    </div> --}}
                    {{-- <div id="loader" class=" w-full flex justify-center">
                        <div id="animation" class=" animate-spin w-12 h-12 text-byolink-1">
                            <svg fill="none" class=" w-full h-full" viewBox="0 0 48 48"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M4 24C4 35.0457 12.9543 44 24 44C35.0457 44 44 35.0457 44 24C44 12.9543 35.0457 4 24 4"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="4" />
                            </svg>
                        </div>
                    </div>
                    <script>
                        let page = 2;
                        let loading = false;

                        document.addEventListener("DOMContentLoaded", () => {
                            const loader = document.getElementById("loader");
                            const animation = document.getElementById("animation");

                            function loadMoreData() {
                                if (loading) return;
                                loading = true;
                                showLoader();

                                fetch(`?page=${page}`, {
                                        headers: {
                                            "X-Requested-With": "XMLHttpRequest"
                                        }
                                    })
                                    .then(response => response.text())
                                    .then(html => {
                                        if (html.trim() !== "") {
                                            const desain = document.getElementById("desain");
                                            desain.insertAdjacentHTML("beforeend", html);

                                            // pastikan loader tetap di bawah grid
                                            desain.parentNode.appendChild(loader);

                                            page++;
                                            loading = false;
                                            hideLoader();
                                        } else {
                                            observer.disconnect(); // stop kalau sudah habis
                                            hideLoader();
                                            loading = false;
                                        }
                                    })
                                    .catch(() => {
                                        loading = false;
                                        hideLoader();
                                    });
                            }

                            const observer = new IntersectionObserver(entries => {
                                entries.forEach(entry => {
                                    if (entry.isIntersecting) {
                                        loadMoreData();
                                    }
                                });
                            });

                            observer.observe(loader);
                        });

                        function showLoader() {
                            document.getElementById("animation").classList.remove("hidden");
                        }

                        function hideLoader() {
                            document.getElementById("animation").classList.add("hidden");
                        }
                    </script> --}}
                </div>
            </div>
            <div class=" w-full max-w-[1080px] mx-auto">
                <div class=" w-full space-y-6 sm:space-y-8">
                    <div class="w-full flex justify-between items-center">
                        <div style='font-family: "Montserrat", Sans-serif;'
                            class=" w-full flex flex-col items-center gap-2 sm:gap-4">
                            {{-- <p class=" text-base sm:text-xl font-bold text-center">Template</p> --}}
                            <p class=" text-xl sm:text-3xl font-bold text-center">Klien Kami</p>
                            {{-- <p class=" text-center text-sm sm:text-base">
                                Berbagai pilihan template website siap simpel untuk beragam jenis usaha. Mulai dari bisnis, jasa, toko online, hingga perusahaan. Pilih template favorit Anda, layout dan sebagainya diserahkan ke tim profesional kami.
                            </p> --}}
                        </div>
                    </div>
                    <div id="desain" class=" w-full grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
                        @include('components.guest.portfolio')
                    </div>
                    <div id="loader" class=" w-full flex justify-center">
                        <div id="animation" class=" animate-spin w-12 h-12 text-byolink-1">
                            <svg fill="none" class=" w-full h-full" viewBox="0 0 48 48"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M4 24C4 35.0457 12.9543 44 24 44C35.0457 44 44 35.0457 44 24C44 12.9543 35.0457 4 24 4"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="4" />
                            </svg>
                        </div>
                    </div>
                    <script>
                        let page = 2;
                        let loading = false;

                        document.addEventListener("DOMContentLoaded", () => {
                            const loader = document.getElementById("loader");
                            const animation = document.getElementById("animation");

                            function loadMoreData() {
                                if (loading) return;
                                loading = true;
                                showLoader();

                                fetch(`?page=${page}`, {
                                        headers: {
                                            "X-Requested-With": "XMLHttpRequest"
                                        }
                                    })
                                    .then(response => response.text())
                                    .then(html => {
                                        if (html.trim() !== "") {
                                            const desain = document.getElementById("desain");
                                            desain.insertAdjacentHTML("beforeend", html);

                                            // pastikan loader tetap di bawah grid
                                            desain.parentNode.appendChild(loader);

                                            page++;
                                            loading = false;
                                            hideLoader();
                                        } else {
                                            observer.disconnect(); // stop kalau sudah habis
                                            hideLoader();
                                            loading = false;
                                        }
                                    })
                                    .catch(() => {
                                        loading = false;
                                        hideLoader();
                                    });
                            }

                            const observer = new IntersectionObserver(entries => {
                                entries.forEach(entry => {
                                    if (entry.isIntersecting) {
                                        loadMoreData();
                                    }
                                });
                            });

                            observer.observe(loader);
                        });

                        function showLoader() {
                            document.getElementById("animation").classList.remove("hidden");
                        }

                        function hideLoader() {
                            document.getElementById("animation").classList.add("hidden");
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Fancybox.bind("[data-fancybox]", {
                Navigation: false,
                Panzoom: { touch: false },
                groupAll: false, // tidak mengelompokkan gambar menjadi satu galeri
                dragToClose: false, // mencegah geser untuk menutup
                Thumbs: false,
                Carousel: {
                    Navigation: false, // hilangkan tombol next/prev
                    Panzoom: {
                        touch: false, // nonaktifkan geser antar gambar
                    },
                },
            });
        });
    </script>
    @include('components.guest.footer')
</x-layout.guest>
