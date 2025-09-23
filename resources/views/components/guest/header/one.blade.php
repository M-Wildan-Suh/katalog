<div class=" pt-4 w-full max-w-[600px] mx-auto">
    <div class=" w-full bg-white aspect-[3/2] sm:rounded-md overflow-hidden relative">
        <div class=" absolute inset-0 ">
            <img src="{{$data->banner ? asset('storage/images/article/banner/'. $data->banner) : asset('assets/images/placeholder.webp')}}" class=" w-full h-full object-cover" alt="">
        </div>
        <div style="box-shadow: 0px -178px 115px -74px rgba(0,0,0,0.75) inset;" class=" w-full h-full flex items-end relative">
        </div>
    </div>
</div>