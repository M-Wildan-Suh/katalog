@props(['route', 'active', 'dropdown'=> false])
@if ($dropdown)
    <button @click="dropdown = !dropdown" class=" {{ request()->routeIs($active) ? 'bg-byolink-1 text-white' : 'bg-byolink-1/20 text-neutral-600 hover:text-white' }} w-full py-1.5 rounded-md text-center font-black hover:bg-byolink-1 duration-300 relative">
        <div class=" absolute top-1/2 -translate-y-1/2 left-2 w-4 aspect-square">
            {{$svg}}
        </div>
        <p>{{$slot}}</p>
        <div class=" absolute top-1/2 -translate-y-1/2 right-2 w-4 aspect-square">
            {{$svg}}
        </div>
    </button>
@else
    <a href="{{route($route)}}" class=" {{ request()->routeIs($active) ? 'bg-byolink-1 text-white' : 'bg-byolink-1/20 text-neutral-600 hover:text-white' }} w-full py-1.5 rounded-md text-center font-black hover:bg-byolink-1 duration-300 relative">
        <div class=" absolute top-1/2 -translate-y-1/2 left-2 w-4 aspect-square">
            {{$svg}}
        </div>
        <p>{{$slot}}</p>
        <div class=" absolute top-1/2 -translate-y-1/2 right-2 w-4 aspect-square">
            {{$svg}}
        </div>
    </a>
@endif