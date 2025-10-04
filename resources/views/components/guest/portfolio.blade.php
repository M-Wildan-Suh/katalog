@foreach ($data as $item)
    <div class=" w-full flex flex-col rounded-md overflow-hidden border bg-white sm:shadow-md sm:shadow-black/20 duration-300">
        <div class=" relative sm:pt-4 sm:px-4">
            <div class=" w-full aspect-[5/2] bg-white overflow-hidden sm:rounded-md">
                <img src="{{ $item->image ? asset('storage/images/portfolio/' . $item->image) : asset('assets/images/placeholder.webp') }}"
                    class=" w-full h-full object-contain hover:scale-105 duration-500" alt="">
            </div>
        </div>
        <div class=" pt-4 pb-2 sm:pb-4 px-2 sm:px-4 text-xs sm:text-sm flex flex-grow flex-col gap-4 justify-between">
            <div class="">
                <p class=" line-clamp-1 font-semiboldgue text-center hover:text-byolink-2 duration-300">{{ $item->title }}</p>
            </div>
        </div>
    </div>
@endforeach
