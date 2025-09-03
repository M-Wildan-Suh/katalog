@foreach ($data as $item)
    <div class=" w-full flex flex-col rounded-md overflow-hidden shadow-md shadow-black/20">
        <div class=" relative">
            <a href="{{ route('business', ['slug' => $item->slug]) }}" aria-label="{{$item->judul}}">
                <div class=" w-full aspect-[3/2] bg-white overflow-hidden">
                    <img src="{{$item->banner ? asset('storage/images/article/banner/' . $item->banner) : asset('assets/images/placeholder.webp')}}"
                        class=" w-full h-full object-cover" alt="">
                </div>
            </a>
        </div>
        <div class=" py-4 px-2 text-sm flex flex-grow flex-col gap-2 justify-between">
            <a href="{{ route('business', ['slug' => $item->slug]) }}" aria-label="{{$item->judul}}">
                <p class=" line-clamp-2 font-bold hover:text-blue-600 duration-300">{{ $item->judul }}</p>
            </a>
        </div>
    </div>
@endforeach
