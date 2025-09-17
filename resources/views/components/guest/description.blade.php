@props(['data' => null, 'template' => null])
<div class=" w-full max-w-[600px] mx-auto">
    <div style="background-color: {{ $template->desc_main_color ?? 'white' }}; color: {{ $template->desc_text_color }}"
        class=" w-full rounded-md shadow-md py-4 space-y-2 sm:space-y-4">
        <div class="pt-4 px-4">
            <div class=" text-sm sm:text-lg font-bold">Nama Desain :</div>
            <div class=" flex items-center justify-between gap-2">
                <p class="text-lg sm:text-3xl font-bold capitalize">{{ $data->judul }}</p>
                @if ($data->articles->price)
                    <p class=" text-nowrap text-xs sm:text-base">IDR {{ number_format($data->articles->price, 0, ',', '.') }}
                    </p>
                @endif
            </div>
        </div>
        @if ($data->articles->link_domain)
            <div class=" px-4 w-full">
                <a href="https://{{ preg_replace('/^https?:\/\//', '', $data->articles->link_domain) }}" target="_blank">
                    <button style="background-color: {{ $template->desc_second_color ?? '#1d588d' }}"
                        class=" flex items-center gap-1 px-2 sm:px-3 py-1 text-xs sm:text-sm text-white rounded-md">
                        <p>Lihat Desain</p>
                        <svg class=" w-4" class="feather feather-external-link" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6" />
                            <polyline points="15 3 21 3 21 9" />
                            <line x1="10" x2="21" y1="14" y2="3" />
                        </svg>
                    </button>
                </a>
            </div>
        @endif
        @php
            function hexToRgba($hex, $opacity = 0.6)
            {
                $hex = str_replace('#', '', $hex);
                $r = hexdec(substr($hex, 0, 2));
                $g = hexdec(substr($hex, 2, 2));
                $b = hexdec(substr($hex, 4, 2));
                return "rgba($r, $g, $b, $opacity)";
            }
        @endphp
        <div class=" px-4 article">
            {!! $data->article == '' ? '' : $data->article !!}
        </div>
        <div style="background-color: {{$template->desc_second_color}}; border-color: {{$template->desc_text_color}}" class=" text-white text-sm sm:text-base p-4 flex flex-col border-t-2 border-b-2 gap-1">
            <p><b>Apa yang didapatkan :</b></p>
            <p>- Website terima beres</p>
            <p>- Bisa request warna yg diinginkan</p>
        </div>
        <div class=" px-4 flex flex-wrap gap-2">
            <p class=" text-sm sm:text-base">Category :</p>
            @foreach ($data->articles->articlecategory as $item)
                <a href="{{ route('category', ['category' => $item->slug]) }}">
                    <button style="background-color: {{ $template->desc_second_color ?? '#1d588d' }}"
                        class=" px-2 sm:px-3 py-1 text-xs sm:text-sm text-white rounded-md">{{ $item->category }}</button>
                </a>
            @endforeach
        </div>
        <div class=" px-4 flex flex-wrap gap-2">
            <p class=" text-sm sm:text-base">Tag :</p>
            @foreach ($data->articles->articletag as $item)
                <a href="{{ route('tag', ['tag' => $item->slug]) }}">
                    <button style="background-color: {{ $template->desc_second_color ?? '#1d588d' }}"
                        class=" px-2 sm:px-3 py-1 text-xs sm:text-sm text-white rounded-md lowercase">#{{ $item->tag }}</button>
                </a>
            @endforeach
        </div>
        <style>
            .article div {
                width: 100% !important;
                max-width: 100% !important;
                height: auto !important;
            }

            .article strong,
            .article span,
            .article p,
            .article h1,
            .article h2,
            .article h3,
            .article h4,
            .article h5,
            .article h6 {
                color: inherit !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .article a {
                font-weight: 700;
                color: {{ $template->desc_second_color ?? '#1d588d' }};
            }

            .article font {
                color: inherit;
            }

            .article ol {
                color: inherit !important;
                padding-left: 16px;
                list-style-type: decimal;
            }

            .article ul {
                color: inherit !important;
                padding-left: 16px;
                list-style-type: disc;
            }

            .article span {
                font-size: inherit !important;
                color: inherit !important;
            }

            .article p {
                font-size: 0.875rem !important;
                line-height: 1.25rem !important;
            }

            .article li {
                font-size: 0.875rem !important;
                line-height: 1.25rem !important;
            }

            .article h1 {
                font-size: 1.875rem !important;
                line-height: 2.25rem !important;
            }

            .article h2 {
                font-size: 1.5rem !important;
                line-height: 2rem !important;
            }

            .article h3 {
                font-size: 1rem !important;
                line-height: 1.5rem !important;
            }

            .article h4 {
                font-size: 1rem !important;
                line-height: 1.5rem !important;
            }

            .article h5 {
                font-size: 0.75rem !important;
                line-height: 1.25rem !important;
            }

            .article h6 {
                font-size: 0.5rem !important;
                line-height: 0.75rem !important;
            }

            @media screen and (min-width: 640px) {
                .article p {
                    font-size: 1rem !important;
                    line-height: 1.5rem !important;
                }

                .article li {
                    font-size: 1rem !important;
                    line-height: 1.5rem !important;
                }

                .article h3 {
                    font-size: 1.25rem !important;
                    line-height: 1.75rem !important;
                }
            }
        </style>
    </div>
</div>
