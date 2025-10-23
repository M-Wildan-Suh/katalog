<x-layout.guest title="Catalog - Price List" :category="$category">
    <div class=" w-full bg-[#F1F3F4] min-h-[calc(100vh-370px)] px-4 sm:px-6">
        <div class=" w-full py-16 sm:py-32 space-y-20 sm:space-y-18">
            <div class=" w-full px-4 sm:px-6">
                <div class=" w-full max-w-[1080px] mx-auto">
                    <div class=" space-y-6 sm:space-y-8">
                        <div class="w-full flex justify-between items-center">
                            <div style='font-family: "Montserrat", Sans-serif;'
                                class=" w-full flex flex-col sm:gap-2 items-center">
                                <p class=" text-2xl sm:text-4xl font-bold text-center">Paket Tipe Simpel</p>
                                <p class=" text-center text-sm sm:text-base">
                                    <span class=" sm:text-nowrap">Paket terima beres tanpa harus pusing memikirkan cara
                                        edit konten dan materi website.</span>
                                    <span class=" sm:text-nowrap">Untuk design web diserahkan kepada
                                        web designer kami.</span>
                                </p>
                            </div>
                        </div>
                        <div class=" grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                            @foreach ($plans as $plan)
                                <div
                                    class="w-full border hover:shadow-md bg-white hover:shadow-black/20 duration-300 flex flex-col justify-between rounded-md px-4 py-8 gap-4">
                                    <div class="space-y-4 sm:space-y-6">
                                        <p class="text-xl font-bold">{{ $plan['title'] }}</p>
                                        <p class="text-2xl font-bold text-byolink-2">{{ $plan['price'] }}</p>
                                        <div class="divide-y text-sm text-neutral-600">
                                            @foreach ($plan['features'] as $feature)
                                                <div class=" flex justify-between items-center">
                                                    <div class="flex items-center gap-2 py-2">
                                                        <div class="w-4 aspect-square text-byolink-2">
                                                            <svg viewBox="0 0 512 512"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path fill="currentColor" d="M480 128c0 8.188-3.125 16.38-9.375 22.62l-256 256C208.4 412.9 200.2 416
                                                                192 416s-16.38-3.125-22.62-9.375l-128-128C35.13 272.4 32
                                                                264.2 32 256c0-18.28 14.95-32 32-32c8.188 0
                                                                16.38 3.125 22.62 9.375L192 338.8l233.4-233.4C431.6
                                                                99.13 439.8 96 448 96C465.1 96 480 109.7 480 128z" />
                                                            </svg>
                                                        </div>
                                                        <p>{{ $feature['title'] }}</p>
                                                    </div>
                                                    @if ($feature['video'])
                                                        <div x-data="{ video: false }">
                                                            <button
                                                                @click="video = true; $nextTick(() => $refs.videoplayer.play());"
                                                                class=" w-4 aspect-square">
                                                                <svg class=" w-full h-full" viewBox="0 0 24 24"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill="currentColor"
                                                                        d="M19,14 L19,19 C19,20.1045695 18.1045695,21 17,21 L5,21 C3.8954305,21 3,20.1045695 3,19 L3,7 C3,5.8954305 3.8954305,5 5,5 L10,5 L10,7 L5,7 L5,19 L17,19 L17,14 L19,14 Z M18.9971001,6.41421356 L11.7042068,13.7071068 L10.2899933,12.2928932 L17.5828865,5 L12.9971001,5 L12.9971001,3 L20.9971001,3 L20.9971001,11 L18.9971001,11 L18.9971001,6.41421356 Z"
                                                                        fill-rule="evenodd" />
                                                                </svg>
                                                            </button>
                                                            <div x-show="video"
                                                                class="fixed inset-0 p-4 bg-black bg-opacity-50 flex justify-center items-center z-50">
                                                                <div
                                                                    class="w-full max-w-[520px] bg-white pb-4 rounded-md flex flex-col gap-4 relative overflow-hidden">
                                                                    <button @click=" $refs.videoplayer.pause(); $refs.videoplayer.currentTime = 0; video = false; "
                                                                        class=" absolute top-6 right-6 w-6 h-6 text-white hover:text-black duration-300">
                                                                        <svg viewBox="0 0 512 512" xml:space="preserve"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            enable-background="new 0 0 512 512">
                                                                            <path
                                                                                d="M437.5 386.6 306.9 256l130.6-130.6c14.1-14.1 14.1-36.8 0-50.9-14.1-14.1-36.8-14.1-50.9 0L256 205.1 125.4 74.5c-14.1-14.1-36.8-14.1-50.9 0-14.1 14.1-14.1 36.8 0 50.9L205.1 256 74.5 386.6c-14.1 14.1-14.1 36.8 0 50.9 14.1 14.1 36.8 14.1 50.9 0L256 306.9l130.6 130.6c14.1 14.1 36.8 14.1 50.9 0 14-14.1 14-36.9 0-50.9z"
                                                                                fill="currentColor" class="fill-000000">
                                                                            </path>
                                                                        </svg>
                                                                    </button>
                                                                    <div class=" pt-6 pb-3 pr-12 bg-byolink-2 text-white">
                                                                        <h2 class=" px-4 text-xl font-bold">Video
                                                                            Penjelasan {{$feature['title']}}</h2>
                                                                    </div>
                                                                    <div class=" flex justify-center px-4">
                                                                        <div
                                                                            class=" w-full aspect-video bg-black rounded-md overflow-hidden">
                                                                            <video x-ref="videoplayer" class="w-full h-full" controls>
                                                                                <source
                                                                                    src="{{ asset('/assets/videos/pricelist/' . $feature['video']) }}"
                                                                                    type="video/mp4">
                                                                                Browser kamu tidak mendukung video tag.
                                                                            </video>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="w-full flex flex-col items-center gap-4 font-medium">
                                        <div x-data="{ dropdown: false }" class=" w-full space-y-2">
                                            <button @click="dropdown = !dropdown"
                                                class=" w-full flex items-center gap-2 justify-center text-sm text-byolink-2">
                                                <div class=" flex">
                                                    <div class=" w-4 h-4 -rotate-90 duration-300">
                                                        <svg class=" w-full h-full feather feather-chevron-down"
                                                            fill="none" stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <polyline points="6 9 12 15 18 9" />
                                                        </svg>
                                                    </div>
                                                    <div class=" w-4 h-4 -rotate-90 duration-300 -ml-2">
                                                        <svg class=" w-full h-full feather feather-chevron-down"
                                                            fill="none" stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <polyline points="6 9 12 15 18 9" />
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class=" w-4 aspect-square">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                                                        <path fill="currentColor"
                                                            d="M128 128C92.7 128 64 156.7 64 192L64 448C64 483.3 92.7 512 128 512L384 512C419.3 512 448 483.3 448 448L448 192C448 156.7 419.3 128 384 128L128 128zM496 400L569.5 458.8C573.7 462.2 578.9 464 584.3 464C597.4 464 608 453.4 608 440.3L608 199.7C608 186.6 597.4 176 584.3 176C578.9 176 573.7 177.8 569.5 181.2L496 240L496 400z" />
                                                    </svg>
                                                </div>
                                                <p class=" text-nowrap">Video Penjelasan</p>
                                                <div class=" flex">
                                                    <div class=" w-4 h-4 rotate-90 duration-300 -mr-2">
                                                        <svg class=" w-full h-full feather feather-chevron-down"
                                                            fill="none" stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <polyline points="6 9 12 15 18 9" />
                                                        </svg>
                                                    </div>
                                                    <div class=" w-4 h-4 rotate-90 duration-300">
                                                        <svg class=" w-full h-full feather feather-chevron-down"
                                                            fill="none" stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <polyline points="6 9 12 15 18 9" />
                                                        </svg>
                                                    </div>
                                                </div>
                                                {{-- <div :class="dropdown ? ' rotate-180' : ''"
                                                    class=" w-4 h-4 duration-300">
                                                    <svg class=" w-full h-full feather feather-chevron-down"
                                                        fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <polyline points="6 9 12 15 18 9" />
                                                    </svg>
                                                </div> --}}
                                            </button>
                                            @if ($plan['video'])
                                                <div x-show="dropdown"
                                                    x-effect="
                                                        if (dropdown) {
                                                            $nextTick(() => {
                                                                const video = $el.querySelector('video');
                                                                if (video) video.play();
                                                            });
                                                        } else {
                                                            const video = $el.querySelector('video');
                                                            if (video) {
                                                                video.pause();
                                                                video.currentTime = 0;
                                                            }
                                                        }
                                                    "
                                                    class=" w-full aspect-[9/16] rounded-md bg-black overflow-hidden">
                                                    <video class="w-full h-full" controls>
                                                        <source
                                                            src="{{ asset('/assets/videos/pricelist/' . $plan['video']) }}"
                                                            type="video/mp4">
                                                        Browser kamu tidak mendukung video tag.
                                                    </video>
                                                </div>
                                            @else
                                                <div x-show="dropdown" class=" text-sm text-center text-neutral-600">
                                                    Video belum tersedia</div>
                                            @endif
                                        </div>

                                        <a class=" flex w-full"
                                            href="https://wa.me/{{ $hp }}?text={{ urlencode('Halo Saya dapat info dari catalog.jasawebsite.biz, dan tertarik dengan Paket Tipe Simpel ' . $plan['title']) }}"
                                            target="__blank">
                                            <button
                                                class="w-full py-1 sm:py-1.5 gap-1 flex items-center justify-center rounded-full text-xs sm:text-sm font-semibold border border-neutral-600 text-neutral-600 hover:text-white hover:bg-byolink-1 duration-300">
                                                <div class="w-4 aspect-square">
                                                    <svg viewBox="0 0 56.693 56.693" xml:space="preserve"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        enable-background="new 0 0 56.693 56.693">
                                                        <path
                                                            d="M46.38 10.714C41.73 6.057 35.544 3.492 28.954 3.489c-13.579 0-24.63 11.05-24.636 24.633a24.589 24.589 0 0 0 3.289 12.316L4.112 53.204l13.06-3.426a24.614 24.614 0 0 0 11.772 2.999h.01c13.577 0 24.63-11.052 24.635-24.635.002-6.582-2.558-12.772-7.209-17.428zM28.954 48.616h-.009a20.445 20.445 0 0 1-10.421-2.854l-.748-.444-7.75 2.033 2.07-7.555-.488-.775a20.427 20.427 0 0 1-3.13-10.897c.004-11.29 9.19-20.474 20.484-20.474a20.336 20.336 0 0 1 14.476 6.005 20.352 20.352 0 0 1 5.991 14.485c-.004 11.29-9.19 20.476-20.475 20.476z"
                                                            fill-rule="evenodd" clip-rule="evenodd"
                                                            fill="currentColor" class="fill-000000"></path>
                                                        <path
                                                            d="M40.185 33.281c-.615-.308-3.642-1.797-4.206-2.003-.564-.205-.975-.308-1.385.308-.41.617-1.59 2.003-1.949 2.414-.359.41-.718.462-1.334.154-.615-.308-2.599-.958-4.95-3.055-1.83-1.632-3.065-3.648-3.424-4.264-.36-.617-.038-.95.27-1.257.277-.276.615-.719.923-1.078.308-.36.41-.616.616-1.027.205-.41.102-.77-.052-1.078-.153-.308-1.384-3.338-1.897-4.57-.5-1.2-1.008-1.038-1.385-1.057-.359-.018-.77-.022-1.18-.022s-1.077.154-1.642.77c-.564.616-2.154 2.106-2.154 5.135 0 3.03 2.206 5.957 2.513 6.368.308.41 4.341 6.628 10.516 9.294a35.341 35.341 0 0 0 3.509 1.297c1.474.469 2.816.402 3.877.244 1.183-.177 3.642-1.49 4.155-2.927.513-1.438.513-2.67.359-2.927-.154-.257-.564-.41-1.18-.719z"
                                                            fill-rule="evenodd" clip-rule="evenodd"
                                                            fill="currentColor" class="fill-000000"></path>
                                                    </svg>
                                                </div>
                                                <p>Konsultasi Sekarang</p>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const videos = document.querySelectorAll('video');

                                videos.forEach(video => {
                                    video.addEventListener('play', function() {
                                        videos.forEach(other => {
                                            if (other !== video) {
                                                other.pause();
                                            }
                                        });
                                    });
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.guest.footer')
</x-layout.guest>
