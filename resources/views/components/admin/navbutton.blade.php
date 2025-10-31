@props(['route', 'active', 'dropdown' => false])
@if ($dropdown)
    <button @click="dropdown = !dropdown; if (dropdown) open = true" 
        :class="dropdown ? 'border-byolink-1 bg-byolink-1/80 text-white border-r-4 rounded-tl-md' : '{{ request()->routeIs($active) ? 'border-byolink-1 bg-byolink-1/80 text-white border-r-4' : 'text-neutral-500 hover:border-black hover:text-black hover:bg-neutral-100 hover:border-r-4' }} rounded-l-md'"
        class=" w-full flex flex-row gap-2 items-center p-3  font-semibold duration-300">
        {{$slot}}
    </button>
@else
    <a href="{{route($route)}}" class="{{ request()->routeIs($active) ? 'border-byolink-1 bg-byolink-1/80 text-white border-r-4' : 'text-neutral-500 hover:border-black hover:text-black hover:bg-neutral-100 hover:border-r-4' }} w-full flex flex-row gap-2 items-center p-3 rounded-l-md  font-semibold duration-300">
        {{$slot}}
    </a>
@endif