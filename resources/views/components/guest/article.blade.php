<div style="box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);" class=" w-full flex flex-col rounded-xl overflow-hidden bg-white">
    <div class=" relative sm:pt-4 sm:px-4">
        <a href="{{ $item->detail_url }}" aria-label="{{$item->judul}}">
            <div class=" w-full aspect-[5/4] bg-white overflow-hidden sm:rounded-xl">
                <img src="{{$item->banner ? asset('storage/images/article/banner/' . $item->banner) : asset('assets/images/placeholder.webp')}}"
                    class=" w-full h-full object-cover hover:scale-105 duration-500" alt="">
            </div>
        </a>
    </div>
    <div class=" pt-2 pb-2 sm:pb-4 px-2 sm:px-4 text-xs sm:text-sm flex flex-grow flex-col gap-1 justify-between">
        <div class="">
            <a href="{{ $item->detail_url }}" aria-label="{{$item->judul}}">
                <p class=" line-clamp-1 font-bold hover:text-byolink-2 duration-300">{{ $item->judul }}</p>
            </a>
        </div>
        <div class="flex text-[10px] sm:text-xs text-neutral-600">
            @foreach ($item->articles->articlecategory->take(2) as $cat)
                <a href="{{ route('category', ['category' => $cat->slug]) }}"
                   class="{{ $loop->iteration === 2 ? 'truncate' : '' }} hover:text-byolink-2 duration-300">
                    {{ $cat->category }}
                </a>
                @if(! $loop->last)<p class=" pr-1">,</p>@endif
            @endforeach
        </div>
        <a href="{{ $item->detail_url }}" aria-label="{{$item->judul}}" class=" pt-1">
            <button class=" w-full py-1 sm:py-1.5 gap-1 flex items-center justify-center rounded-full text-xs sm:text-sm font-semibold border border-neutral-600 text-neutral-600 hover:text-white hover:bg-byolink-1 duration-300">
                <div class=" w-4 sm:w-5 aspect-square">
                    <svg enable-background="new 0 0 32 32" id="Editable-line" version="1.1" viewBox="0 0 32 32" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="  M16,7C9.934,7,4.798,10.776,3,16c1.798,5.224,6.934,9,13,9s11.202-3.776,13-9C27.202,10.776,22.066,7,16,7z" fill="none" id="XMLID_10_" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/><circle cx="16" cy="16" fill="none" id="XMLID_12_" r="5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/></svg>
                </div>
                <p>Lihat Artikel</p>
            </button>
        </a>
    </div>
</div>
