@props(['route', 'active'])
<a href="{{$route ?? ''}}"
    class="{{ $active ? 'text-black' : 'hover:text-black hover:-translate-y-1'}} font-montserrat text-sm font-bold text-center py-2 duration-300 uppercase" aria-label="{{$slot}}">{{$slot}}</a>