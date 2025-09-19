<div class=" w-full flex flex-col rounded-md overflow-hidden bg-white border shadow-md shadow-black/20">
    <div class=" relative pt-1 sm:pt-2 px-1 sm:px-2">
        <a href="{{ route('business', ['slug' => $item->slug]) }}" aria-label="{{$item->judul}}">
            <div class=" w-full aspect-[5/4] bg-white overflow-hidden rounded-md">
                <img src="{{$item->banner ? asset('storage/images/article/banner/' . $item->banner) : asset('assets/images/placeholder.webp')}}"
                    class=" w-full h-full object-cover hover:scale-105 duration-500" alt="">
            </div>
        </a>
    </div>
    <div class=" py-1 sm:py-2 px-1 sm:px-2 text-sm sm:text-base flex flex-grow flex-col sm:gap-1 justify-between">
        <div class="">
            <a href="{{ route('business', ['slug' => $item->slug]) }}" aria-label="{{$item->judul}}">
                <p class=" line-clamp-1 font-bold hover:text-byolink-2 duration-300">{{ $item->judul }}</p>
            </a>
        </div>
        <div class=" pt-1 sm:pt-0 flex text-xs sm:text-sm text-neutral-600">
            @foreach ($item->articles->articlecategory->take(2) as $cat)
                <a href="{{ route('category', ['category' => $cat->slug]) }}"
                   class="{{ $loop->iteration === 2 ? 'truncate' : '' }} hover:text-byolink-2 duration-300">
                    {{ $cat->category }}
                </a>
                @if(! $loop->last)<p class=" pr-1">,</p>@endif
            @endforeach
        </div>
    </div>
</div>