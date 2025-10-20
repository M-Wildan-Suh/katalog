{{-- Navigation --}}
<div class="" x-data="{ open: false, article: false }">
    <div
        x-data="{ scrolled: {{ $home ? 'false' : 'true' }} }" 
        x-init="window.addEventListener('scroll', () => {
                if ({{ $home ? 'true' : 'false' }}) {
                    scrolled = window.scrollY > 50;
                }
            })"
        :class="scrolled ? 'bg-white shadow-md shadow-black/20' : (open ? 'bg-white shadow-md shadow-black/20' : 'bg-transparent')"
        class=" fixed top-0 left-0 grid grid-col-3 w-full px-4 md:px-8 py-4 z-40 duration-500">
        <div class=" w-full max-w-[1080px] mx-auto flex items-center gap-6 justify-between relative">
            <a href="{{ route('home') }}" class=" flex justify-start min-w-10 sm:min-w-12 lg:w-40">
                <div class=" h-10 sm:h-12 flex items-center overflow-hidden">
                    {{-- <p class=" text-3xl sm:text-4xl font-bold">Bizlink</p> --}}
                    <img src="{{ asset('assets/images/logo-jbiz.png') }}" class=" w-full h-full object-contain"
                        alt="">
                </div>
            </a>
            <div
                class=" hidden md:flex flex-row gap-6 items-center text-neutral-600">
                <x-guest.nav-button route="{{ route('home') }}"
                    active="{{ request()->routeIs('home') }}">Beranda</x-guest.nav-button>
                <x-guest.nav-button route="{{ route('allarticle') }}"
                    active="{{ request()->routeIs('allarticle', 'pageallarticle', 'author', 'pageauthor', 'category', 'pagecategory', 'tag', 'pagetag') }}">Desain</x-guest.nav-button>
                <x-guest.nav-button route="{{ route('allcategory') }}"
                    active="{{ request()->routeIs('allcategory') }}">Kategori</x-guest.nav-button>
                {{-- <div class=" flex group">
                    <div class=" w-full absolute max-w-[1080px] hidden group-hover:block top-[calc(100%-8px)] left-0 pt-6 z-30">
                        <div 
                            :class="scrolled ? ' rounded-b-md' : 'rounded-md'"
                            class=" w-full absolute bg-white min-w-40 py-2 shadow-md shadow-black/20 text-sm">
                            <div class=" w-full grid grid-cols-5 gap-1">
                                @foreach ($category->take(19) as $item)
                                <a href="{{route('category', ['category' => $item->slug])}}" class=" w-full  text-nowrap px-4 hover:bg-neutral-100 duration-300 py-1">{{$item->category}}</a>
                                @endforeach
                                <a href="{{ route('allcategory') }}" class=" w-full  text-nowrap px-4 hover:bg-neutral-100 duration-300 py-1">Lihat Semua Tipe</a>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <x-guest.nav-button route="{{ route('price.list') }}"
                    active="{{ request()->routeIs('price.list') }}">Price List</x-guest.nav-button>
                <x-guest.nav-button route="{{ route('guestportfolio') }}"
                    active="{{ request()->routeIs('guestportfolio') }}">Portofolio</x-guest.nav-button>
                <x-guest.nav-button route="{{ route('contact') }}"
                    active="{{ request()->routeIs('contact') }}">Tentang Kami</x-guest.nav-button>
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
            <div class=" hidden md:block">
                <form action="{{ route('allarticle') }}" class="w-full flex justify-end" method="get">
                    <div class=" flex items-center justify-between w-full max-w-40 h-10 group rounded-full border border-neutral-600">
                        <button aria-label="Cari"
                            class=" pl-4 rounded-l-full duration-300 h-10">
                            <div class=" w-[18px] aspect-square overflow-hidden text-neutral-600">
                                <svg id="Layer_1" style="enable-background:new 0 0 64 64;" version="1.1" viewBox="0 0 64 64" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g id="Icon-Search" transform="translate(30.000000, 230.000000)"><path fill="currentColor" d="M-2.3-182.9c-10.7,0-19.5-8.7-19.5-19.5c0-10.7,8.7-19.5,19.5-19.5s19.5,8.7,19.5,19.5     C17.1-191.6,8.4-182.9-2.3-182.9L-2.3-182.9z M-2.3-219c-9.2,0-16.7,7.5-16.7,16.7c0,9.2,7.5,16.7,16.7,16.7s16.7-7.5,16.7-16.7     C14.3-211.5,6.8-219-2.3-219L-2.3-219z" id="Fill-1"/><polyline fill="currentColor" id="Fill-2" points="23.7,-174.2 10.1,-187.7 12.3,-189.9 25.8,-176.3 23.7,-174.2    "/></g></g></svg>
                            </div>
                        </button>
                        <input type="text" name="search" value="{{ request('search') }}"
                            class=" bg-transparent text-black min-w-0 sm:flex-grow h-10 text-sm px-4 border-0 border-transparent focus:ring-0"
                            placeholder="Cari Desain....">
                        {{-- <button aria-label="Cari"
                            class=" px-4 sm:px-6 bg-byolink-2 hover:bg-black rounded-r-full text-white duration-300 h-10">
                            <div class=" w-[18px] aspect-square overflow-hidden">
                                <svg aria-hidden="true" class="e-font-icon-svg e-fas-search" viewBox="0 0 512 512"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill="currentColor"
                                        d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z">
                                    </path>
                                </svg>
                            </div>
                        </button> --}}
                    </div>
                </form>
            </div>
            <div class=" h-8 md:h-10 block md:hidden">
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
    <div x-data="{ scrolled: true }"
        :class="{ ' top-[70px] sm:top-20': open, '-translate-y-full top-0': !open }"
        class=" fixed flex md:hidden flex-col bg-white w-full left-0 justify-center gap-4 font-semibold text-neutral-600 pt-2 px-4 pb-4 duration-300 z-30">
        <x-guest.nav-button route="{{ route('home') }}"
            active="{{ request()->routeIs('home') }}">Beranda</x-guest.nav-button>
        <x-guest.nav-button route="{{ route('allarticle') }}"
            active="{{ request()->routeIs('allarticle', 'pageallarticle', 'author', 'pageauthor', 'category', 'pagecategory', 'tag', 'pagetag') }}">Desain</x-guest.nav-button>
        <x-guest.nav-button route="{{ route('allcategory') }}"
            active="{{ request()->routeIs('allcategory') }}">Kategori</x-guest.nav-button>
        <x-guest.nav-button route="{{ route('price.list') }}"
            active="{{ request()->routeIs('price.list') }}">Price List</x-guest.nav-button>
        <x-guest.nav-button route="{{ route('guestportfolio') }}"
            active="{{ request()->routeIs('guestportfolio') }}">Portofolio</x-guest.nav-button>
        <x-guest.nav-button route="{{ route('contact') }}"
            active="{{ request()->routeIs('contact') }}">Tentang Kami</x-guest.nav-button>
        <form action="{{ route('allarticle') }}" method="get">
            <div class=" flex items-center justify-between h-10">
                <input type="text" name="search" value="{{ request('search') }}"
                    class="flex-grow h-10 text-sm px-4 sm:px-6 border-r-0 rounded-l-full focus:border-byolink-1 focus:ring-0"
                    placeholder="Cari Tipe Desain....">
                <button class=" px-6 bg-byolink-2 hover:bg-byolink-1 rounded-r-full text-white duration-300 h-10"
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
