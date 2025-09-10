@foreach ($data as $item)
    <div class=" w-full flex flex-col rounded-md overflow-hidden bg-white shadow-md shadow-black/20">
        <div class=" relative">
            <a href="{{ route('business', ['slug' => $item->slug]) }}" aria-label="{{$item->judul}}">
                <div class=" w-full aspect-[3/2] bg-white overflow-hidden">
                    <img src="{{$item->banner ? asset('storage/images/article/banner/' . $item->banner) : asset('assets/images/placeholder.webp')}}"
                        class=" w-full h-full object-cover hover:scale-105 duration-500" alt="">
                </div>
            </a>
        </div>
        <div class=" py-4 px-2 text-sm sm:text-base flex flex-grow flex-col gap-1 justify-between">
            <div class="">
                <p class=" text-xs sm:text-sm">Nama Desain :</p>
                <a href="{{ route('business', ['slug' => $item->slug]) }}" aria-label="{{$item->judul}}">
                    <p class=" pl-2 line-clamp-1 font-bold hover:text-byolink-2 duration-300">{{ $item->judul }}</p>
                </a>
            </div>
            <div class=" flex justify-end text-xs sm:text-sm text-neutral-600">
                @foreach ($item->articles->articlecategory->take(2) as $cat)
                    <a href="{{route('category', ['category' => $cat->slug])}}" class=" hover:text-byolink-2 duration-300">{{$cat->category}}</a>
                    @if (! $loop->last)<p class=" pr-1">,</p>@endif
                @endforeach
            </div>
        </div>
    </div>
@endforeach
