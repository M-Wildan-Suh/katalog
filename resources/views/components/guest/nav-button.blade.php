@props(['route', 'active'])
<a href="{{$route ?? ''}}"
    class="{{ $active ? 'text-black' : 'hover:text-black hover:-translate-y-1'}} font-montserrat text-sm font-bold uppercase py-2 duration-300" aria-label="{{$slot}}">{{$slot}}</a>
