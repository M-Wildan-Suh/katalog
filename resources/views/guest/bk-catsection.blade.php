
@foreach ($catsection as $cat)
<div class=" w-full max-w-[1080px] mx-auto">
    <div class=" md:col-span-3 w-full space-y-6 sm:space-y-8">
        <div class="w-full flex justify-between items-center">
            <div style='font-family: "Montserrat", Sans-serif;' class=" w-full flex flex-col items-center sm:gap-4">
                <p class=" text-base sm:text-xl font-bold text-center">Kategori</p>
                <p class=" text-xl sm:text-3xl font-bold text-center">{{$cat->category}}</p>
            </div>
        </div>
        @php
            $data = $cat->articles->take(3)
        @endphp
        <div class=" w-full grid grid-cols-2 md:grid-cols-3 gap-4">
            @include('components.guest.product')
        </div>
        <div class=" flex justify-center">
            <a href="{{ route('category', ['category' => $cat->slug]) }}" class="flex">
                <button class=" px-6 py-2 flex items-center gap-3 rounded-full text-nowrap text-sm sm:text-base font-semibold bg-byolink-2 text-white hover:bg-byolink-1 duration-300">
                    <p>Muat Lainnya</p>
                    <div class=" w-4 sm:w-5 aspect-square">
                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><path d="M22 9a1 1 0 0 0 0 1.42l4.6 4.6H3.06a1 1 0 1 0 0 2h23.52L22 21.59A1 1 0 0 0 22 23a1 1 0 0 0 1.41 0l6.36-6.36a.88.88 0 0 0 0-1.27L23.42 9A1 1 0 0 0 22 9Z" data-name="Layer 2" fill="currentColor" class="fill-000000"></path></svg>
                    </div>
                </button>
            </a>
        </div>
    </div>
</div>
@endforeach