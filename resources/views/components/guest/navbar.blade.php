{{-- Navigation --}}
<div class="" x-data="{ open: false, article: false }">
    <div class=" fixed top-0 left-0 grid grid-col-3 w-full bg-white px-4 md:px-8 py-4 z-40 shadow-md shadow-black/10">
        <div class=" w-full max-w-[1080px] mx-auto flex items-center gap-10 justify-between">
            <a href="{{ route('home') }}">
                <div class=" h-10 sm:h-12 flex items-center overflow-hidden">
                    {{-- <p class=" text-3xl sm:text-4xl font-bold">Bizlink</p> --}}
                    <img src="{{ asset('assets/images/logo-jbiz.png') }}" class=" w-full h-full object-contain"
                        alt="">
                </div>
            </a>
            <div class=" hidden md:flex flex-row gap-6 items-center text-neutral-400">
                <x-guest.nav-button route="{{ route('home') }}"
                    active="{{ request()->routeIs('home') }}">Beranda</x-guest.nav-button>
                <div class=" group relative">
                    <x-guest.nav-button route="{{ route('allcategory') }}"
                    active="{{ request()->routeIs('allcategory', 'allarticle', 'pageallarticle', 'author', 'pageauthor', 'category', 'pagecategory', 'tag', 'pagetag') }}">Tipe Desain</x-guest.nav-button>
                    <div class=" hidden group-hover:block absolute top-full left-0 bg-white min-w-40 py-2 rounded-md shadow-md shadow-black/20 text-sm">
                        <div class=" max-h-36 overflow-auto flex flex-col gap-1">
                            <a href="{{route('allarticle')}}" class=" w-full  text-nowrap px-4 hover:bg-neutral-100 duration-300 py-1">Artikel Terbaru</a>
                            @foreach ($category as $item)
                                <a href="{{route('category', ['category' => $item->slug])}}" class=" w-full  text-nowrap px-4 hover:bg-neutral-100 duration-300 py-1">{{$item->category}}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
>>>>>>> 984ce7a13b0dff010d69a1468ef89a672c147780
                <x-guest.nav-button route="{{ request()->routeIs('business') ? route('home') : '' }}#kontak"
                    active="">Kontak</x-guest.nav-button>
                {{-- @if (Route::has('login'))
                    @auth
                        <form method="POST" class="" action="{{ route('logout') }}">
                            @csrf
                            <button class=" py-1.5 px-5 bg-red-600 rounded-md font-semibold text-white hover:bg-red-900 duration-300">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class=" md:mr-0">
                            <button class=" py-1.5 px-5 bg-byolink-2 rounded-md font-semibold text-white hover:bg-black duration-300">Login</button>
                        </a>
                    @endauth
                @endif --}}
            </div>
            <div class=" hidden md:block flex-grow">
                <form action="{{ route('allarticle') }}" class="w-full flex justify-end" method="get">
                    <div class=" flex items-center justify-between w-full max-w-[420px] h-10">
                        <input type="text" name="search" value="{{ request('search') }}"
                            class=" min-w-0 sm:flex-grow h-10 text-sm px-4 sm:px-6 border-r-0 rounded-l-full focus:border-byolink-1 focus:ring-0"
                            placeholder="Cari Tipe Desain....">
                        <button aria-label="Cari"
                            class=" px-4 sm:px-6 bg-byolink-2 hover:bg-black rounded-r-full text-white duration-300 h-10">
                            <div class=" w-[18px] aspect-square overflow-hidden">
                                <svg aria-hidden="true" class="e-font-icon-svg e-fas-search" viewBox="0 0 512 512"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill="currentColor"
                                        d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z">
                                    </path>
                                </svg>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
            <div class=" h-8 sm:h-10 block sm:hidden">
                <button @click="open = !open" class="w-8 h-8 p-2 bg-byolink-2 rounded-md text-white flex flex-col justify-between items-center relative">
                    <span :class="open ? 'w-0 translate-y-2.5' : 'w-full'" class=" h-0.5 bg-white rounded-full duration-300"></span>
                    <span :class="open ? 'w-0' : 'w-full'" class=" h-0.5 bg-white rounded-full duration-300"></span>
                    <span :class="open ? 'w-0 -translate-y-2.5' : 'w-full'" class=" h-0.5 bg-white rounded-full duration-300"></span>
                    <span :class="open ? 'w-5' : 'w-0'" class=" absolute h-0.5 bg-white rounded-full duration-300 left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 rotate-45"></span>
                    <span :class="open ? 'w-5' : 'w-0'" class=" absolute h-0.5 bg-white rounded-full duration-300 left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 -rotate-45"></span>
                </button>
            </div>
        </div>
    </div>
    <div :class="{ ' top-[70px] sm:top-20': open, '-translate-y-full top-0': !open }"
        class=" fixed flex md:hidden flex-col bg-byolink-1 w-full left-0 justify-center gap-4 font-semibold text-neutral-600 pt-2 px-4 pb-4 duration-300 z-30">
        <x-guest.nav-button route="{{ route('home') }}"
            active="{{ request()->routeIs('home') }}">Beranda</x-guest.nav-button>
        <x-guest.nav-button route="{{ route('allcategory') }}"
            active="{{ request()->routeIs('allcategory', 'allarticle', 'pageallarticle', 'author', 'pageauthor', 'category', 'pagecategory', 'tag', 'pagetag') }}">Tipe Desain</x-guest.nav-button>
        <x-guest.nav-button route="{{ request()->routeIs('business') ? route('home') : '' }}#kontak"
            active="">Kontak</x-guest.nav-button>
        <form action="{{ route('allarticle') }}" method="get">
            <div class=" flex items-center justify-between h-10">
>>>>>>> 984ce7a13b0dff010d69a1468ef89a672c147780
                <input type="text" name="search" value="{{ request('search') }}"
                    class="flex-grow h-10 text-sm px-4 sm:px-6 border-r-0 rounded-l-full focus:border-byolink-1 focus:ring-0"
                    placeholder="Cari Tipe Desain....">
                <button class=" px-6 bg-byolink-1 hover:bg-byolink-3 rounded-r-full text-white duration-300 h-10"
                    aria-label="cari">
                    <div class=" w-[18px] aspect-square overflow-hidden">
                        <svg aria-hidden="true" class="e-font-icon-svg e-fas-search" viewBox="0 0 512 512"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill="currentColor"
                                d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z">
                            </path>
                        </svg>
                    </div>
                </button>
            </div>
        </form>
        {{-- @if (Route::has('login'))
            @auth
                <x-guest.nav-button route="{{route('profile.edit')}}" active="{{request()->routeIs('profile.edit')}}">Profile</x-guest.nav-button>
                <form method="POST" class=" flex w-full" action="{{ route('logout') }}">
                    @csrf
                    <button class=" w-full py-2 bg-red-600 rounded-md font-semibold text-white hover:bg-red-900 duration-300">
                        Logout
                    </a>
                </form>
            @else
                <a href="{{ route('login') }}" class="md:mr-0">
                    <button class=" w-full py-2 px-4 bg-byolink-2 rounded-md font-semibold text-white hover:bg-byolink-3 duration-300">Login</button>
                </a>
            @endauth
        @endif --}}
    </div>
    {{-- <div x-show="article" class="fixed inset-0 p-4 bg-black/50 flex justify-center items-center z-50">
        <div @click.outside="article = false"
            class=" w-full max-w-96 max-h-full bg-white pb-6 rounded-md flex flex-col gap-4 relative overflow-hidden">
            <div class=" pt-6 pb-3 border-b border-neutral-600">
                <h2 class=" px-6 text-lg sm:text-2xl text-center font-bold">Pilih Tipe Desain</h2>
            </div>
            <div class="flex text-sm sm:text-base flex-col gap-2 overflow-auto">
                <a href="{{ route('allarticle') }}"
                    class=" w-full text-center text-nowrap px-4 hover:bg-neutral-100 duration-300 py-1">Desain
                    Terbaru</a>
                @foreach ($category as $item)
                    <a href="{{ route('category', ['category' => $item->slug]) }}"
                        class=" w-full text-center text-nowrap px-4 hover:bg-neutral-100 duration-300 py-1">{{ $item->category }}</a>
                @endforeach
            </div>
        </div>
    </div> --}}
</div>
