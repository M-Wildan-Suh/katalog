<div class=" w-full flex flex-col rounded-md overflow-hidden border bg-white shadow-md shadow-black/20">
    <div class=" relative sm:pt-4 sm:px-4">
        <a href="{{ route('business', ['slug' => $item->slug]) }}" aria-label="{{$item->judul}}">
            <div class=" w-full aspect-[5/4] bg-white overflow-hidden sm:rounded-md">
                <img src="{{$item->banner ? asset('storage/images/article/banner/' . $item->banner) : asset('assets/images/placeholder.webp')}}"
                    class=" w-full h-full object-cover hover:scale-105 duration-500" alt="">
            </div>
        </a>
    </div>
    <div class=" pt-2 pb-2 sm:pb-4 px-2 sm:px-4 text-sm sm:text-base flex flex-grow flex-col gap-1 justify-between">
        <div class="">
            <a href="{{ route('business', ['slug' => $item->slug]) }}" aria-label="{{$item->judul}}">
                <p class=" line-clamp-1 font-bold hover:text-byolink-2 duration-300">{{ $item->judul }}</p>
            </a>
        </div>
        <div class="flex text-xs sm:text-sm text-neutral-600">
            @foreach ($item->articles->articlecategory->take(2) as $cat)
                <a href="{{ route('category', ['category' => $cat->slug]) }}"
                   class="{{ $loop->iteration === 2 ? 'truncate' : '' }} hover:text-byolink-2 duration-300">
                    {{ $cat->category }}
                </a>
                @if(! $loop->last)<p class=" pr-1">,</p>@endif
            @endforeach
        </div>
        <a href="{{ route('business', ['slug' => $item->slug]) }}" aria-label="{{$item->judul}}" class=" pt-1">
            <button class=" w-full py-1 sm:py-1.5 gap-1 flex justify-center rounded-full text-xs sm:text-base font-semibold bg-byolink-2 text-white hover:bg-byolink-1 duration-300">
                Lihat Desain<span class=" hidden sm:block"> Template</span>
            </button>
        </a>
    </div>
</div>