<x-app-layout head="Banner" title="Admin - Banner">
    <div class="sm:pl-12 sm:pr-12 lg:pr-32 duration-300 pt-8 pb-20 sm:pb-8 px-4 space-y-4">
        <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="w-full p-4 sm:p-8 bg-white rounded-md shadow-md shadow-black/20 flex flex-col gap-6">
                <div class=" w-full grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class=" space-y-2">
                        <x-admin.component.textinput title="Judul" placeholder="Masukkan Judul..." :value="old('title', $data->title ?? null)"
                            name="title" />
                        <x-admin.component.textinput title="Sub Judul" placeholder="Masukkan Sub Judul..." :value="old('subtitle', $data->subtitle ?? null)"
                            name="subtitle" />
                    </div>
                    <x-admin.component.textareainput title="Keterangan" placeholder="Masukkan Keterangan..." :value="old('description', $data->description ?? null)"
                            name="description" />
                </div>
                <div class=" w-full grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class=" w-full flex flex-col max-w-full gap-2 text-sm sm:text-base font-medium">
                        <label>Banner</label>
                        <div class=" flex w-full aspect-[7/5] rounded-md overflow-hidden">
                            <x-admin.component.imageinput title="Nama/Tipe" placeholder="Masukkan nama/tipe web..."
                                value="{{ $data->banner ? asset('storage/images/banner/'.$data->banner) : null}}" name="banner" />
                        </div>
                    </div>
                    <div class=" w-full flex flex-col max-w-full gap-2 text-sm sm:text-base font-medium">
                        <label>Overlay</label>
                        <div class=" flex w-full aspect-[7/5] rounded-md overflow-hidden">
                            <x-admin.component.imageinput title="Nama/Tipe" placeholder="Masukkan nama/tipe web..."
                                value="{{ $data->overlay ? asset('storage/images/banner/'.$data->overlay) : null}}" name="overlay" />
                        </div>
                    </div>
                </div>
                <x-admin.component.submitbutton title="Save" />
            </div>
        </form>
    </div>

    @include('components.admin.component.validationerror')
</x-app-layout>
