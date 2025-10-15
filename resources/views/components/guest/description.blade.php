@props(['data' => null])
<div class=" w-full max-w-[600px] mx-auto">
    <div class=" w-full rounded-md bg-white text-black shadow-md py-4 space-y-2 sm:space-y-4">
        <div class="pt-4 px-4 space-y-4">
            <div class=" text-sm text-neutral-600">Nama Desain</div>
            <div class=" flex items-center justify-between gap-2">
                <p class=" text-2xl font-bold capitalize">{{ $data->judul }}</p>
                @if ($data->articles->price)
                    <p class=" text-nowrap text-xs sm:text-base">IDR {{ number_format($data->articles->price, 0, ',', '.') }}
                    </p>
                @endif
            </div>
        </div>
        @if ($data->articles->link_domain)
            <div class=" px-4 w-full">
                <a href="https://{{ preg_replace('/^https?:\/\//', '', $data->articles->link_domain) }}" target="_blank">
                    <button class=" flex items-center bg-byolink-2 gap-1 py-2 px-6 text-sm sm:text-base font-medium text-white rounded-full">
                        <div class=" w-4 aspect-square">
                            <svg enable-background="new 0 0 32 32" id="Editable-line" version="1.1" viewBox="0 0 32 32" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="  M16,7C9.934,7,4.798,10.776,3,16c1.798,5.224,6.934,9,13,9s11.202-3.776,13-9C27.202,10.776,22.066,7,16,7z" fill="none" id="XMLID_10_" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/><circle cx="16" cy="16" fill="none" id="XMLID_12_" r="5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/></svg>
                        </div>
                        <p>Live Preview</p>
                    </button>
                </a>
            </div>
        @endif
        <div class=" px-4 article text-[#7A7A7A]">
            {!! $data->article == '' ? '' : $data->article !!}
        </div>
        <div class=" w-full px-4">
            <div class=" text-black text-sm sm:text-base p-4 flex flex-col rounded-md bg-[#E1E1E2] gap-2">
                <p class=" text-lg sm:text-xl"><b>Kenapa Pilih Website Simpel ?</b></p>
                <div class="">
                    <p>- Website Terima Beres</p>
                    <p>- Bisa Request Warna</p>
                    <p>- Website Cepat Jadi</p>
                    <p>- Website Hemat Biaya</p>
                </div>
            </div>
        </div>
        <div class=" px-4 flex items-center flex-wrap gap-2">
            <p class=" text-sm sm:text-base text-[#7A7A7A]">Category :</p>
            @foreach ($data->articles->articlecategory as $item)
                <a href="{{ route('category', ['category' => $item->slug]) }}">
                    <button class=" bg-byolink-2 px-3 sm:px-4 py-2 text-xs sm:text-sm text-white rounded-full">{{ $item->category }}</button>
                </a>
            @endforeach
        </div>
        <div class=" px-4 flex items-center flex-wrap gap-2">
            <p class=" text-sm sm:text-base text-[#7A7A7A]">Tag :</p>
            @foreach ($data->articles->articletag as $item)
                <a href="{{ route('tag', ['tag' => $item->slug]) }}">
                    <button class=" bg-[#E1E1E2] text-[#3D3D3D] hover:bg-byolink-2 hover:text-white duration-300 px-3 sm:px-4 py-2 text-xs sm:text-sm rounded-full lowercase">#{{ $item->tag }}</button>
                </a>
            @endforeach
        </div>
        <style>
            .article div {
                width: 100% !important;
                max-width: 100% !important;
                height: auto !important;
                color: inherit !important;
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
                color: #de0301;
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
