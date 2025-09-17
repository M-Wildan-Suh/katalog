@props(['route', 'active'])
<a href="{{$route ?? ''}}" 
    :class="scrolled ? '{{ $active ? 'sm:text-white' : 'sm:hover:text-white sm:hover:-translate-y-1'}}' : '{{ $active ? 'sm:text-black' : 'sm:hover:text-black sm:hover:-translate-y-1'}}'"
    class="{{ $active ? 'text-white' : 'hover:text-white hover:-translate-y-1'}} text-lg font-black py-2 duration-300" aria-label="{{$slot}}">{{$slot}}</a>