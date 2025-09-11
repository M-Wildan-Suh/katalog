<div class="">
    <div class=" md:sticky top-24 space-y-4 sm:space-y-6">
        <div class=" w-full flex items-center gap-2 sm:gap-4 h-7 sm:h-10">
            <div class=" w-1 h-7 bg-byolink-2 rounded-full"></div>
            <p class=" text-xl font-bold text-center">Desain Populer Pilihan</p>
        </div>
        <div class=" grid grid-cols-1 sm:grid-cols-2 md:grid-cols-1 gap-4 sm:gap-6">
            @foreach ($trend as $item)
                <div class=" grid grid-cols-5 sm:grid-cols-4 gap-2">
                    <a href="{{ route('business', ['slug' => $item->slug]) }}" aria-label="{{$item->judul}}">
                        <div class=" w-full aspect-square rounded-md bg-white overflow-hidden">
                            <img src="{{$item->banner ? asset('storage/images/article/banner/' . $item->banner) : asset('assets/images/placeholder.webp')}}"
                                class=" w-full h-full object-cover" alt="">
                        </div>
                    </a>
                    <div class=" col-span-4 sm:col-span-3 flex flex-col justify-between">
                        <a href="{{ route('business', ['slug' => $item->slug]) }}" aria-label="{{$item->judul}}">
                            <p class=" line-clamp-2 text-sm h-10">{{$item->judul}}</p>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>