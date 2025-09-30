@props(['data' => null])
<div class=" w-full max-w-[600px] mx-auto space-y-4">
    <div class=" bg-white w-auto p-4 text-base sm:text-xl font-bold rounded-md shadow-md">Video Penjelasan Tipe Simple
    </div>
    <div class=" w-full bg-white aspect-video rounded-md overflow-hidden">
        <iframe class="w-full h-full" src="{{$data->articles->youtube}}" title="YouTube video player" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    </div>
</div>