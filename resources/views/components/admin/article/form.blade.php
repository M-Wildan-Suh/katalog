@props([
    'link' => null,
    'head' => null,
    'form' => null,
    'title' => null,
    'spintax' => null,
    'indexRoute' => 'article.index',
    'indexLabel' => 'Article',
])
<x-app-layout :head="$head" :title="$title">
    <div class="sm:pl-12 sm:pr-12 lg:pr-32 duration-300 pt-8 pb-20 sm:pb-8 px-4 space-y-6">
        <div class=" w-full sm:py-4 p-4 sm:p-6 bg-white rounded-md shadow-md shadow-black/20">
            <div class=" flex items-center justify-between">
                <div class=" flex items-center gap-2 text-sm sm:text-base">
                    <a href="{{route($indexRoute)}}" class=" text-byolink-1 hover:text-byolink-3 duration-300">{{$indexLabel}}</a>
                    <p class=" text-neutral-600">/</p>
                    <p class=" text-neutral-600">{{$head}}</p>
                </div>
                <div class=" flex gap-4">
                    @if ($spintax)
                        <a href="{{$spintax}}" class=" flex gap-1 text-sm sm:text-base text-byolink-1 hover:text-byolink-3 duration-300" target="__blank">List <span class=" hidden sm:block">Artikel</span></a>
                    @endif
                    @if ($link)
                        <a href="{{$link}}" class=" flex gap-1 text-sm sm:text-base text-byolink-1 hover:text-byolink-3 duration-300" target="__blank">Lihat <span class=" hidden sm:block">Artikel</span></a>
                    @endif
                </div>
            </div>
        </div>
        <div class=" w-full p-4 sm:p-6 bg-white rounded-md shadow-md shadow-black/20">
            <form action="{{$form}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div x-data="{tab : 'content'}" class="space-y-4 sm:space-y-6">
                    <div class=" bg-white sticky top-20 py-4 w-full grid grid-cols-2 gap-4 text-sm sm:text-base z-30">
                        <button @click="tab ='content'" type="button" :class="tab === 'content' ? 'bg-byolink-1' : ' bg-byolink-2 hover:bg-black'" class=" w-full py-2 text-white rounded-md duration-300 font-bold">Konten</button>
                        <button @click="tab ='image'" type="button" :class="tab === 'image' ? 'bg-byolink-1' : ' bg-byolink-2 hover:bg-black'" class=" w-full py-2 text-white rounded-md duration-300 font-bold">Image</button>
                    </div>
                    <div x-show="tab === 'content'" class=" space-y-4 sm:space-y-6">
                        {{$slot}}
                    </div>
                    <div x-show="tab === 'image'" class=" space-y-4 sm:space-y-6">
                        {{$additional ?? ''}}
                    </div>
                    <div x-show="tab === 'template'" class=" space-y-4 sm:space-y-6">
                        {{$template ?? ''}}
                    </div>
                    <x-admin.component.submitbutton title="Save" />
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
