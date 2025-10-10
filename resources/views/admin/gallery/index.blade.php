<x-app-layout head="Kategori" title="Admin - Kategori">
    <div class="sm:pl-12 sm:pr-12 lg:pr-32 duration-300 pt-8 pb-20 sm:pb-8 px-4 space-y-4">
        <div class="w-full p-4 sm:p-8 bg-white rounded-md shadow-md shadow-black/20 flex flex-col gap-6">
            <div class="w-full flex flex-col md:flex-row gap-4 justify-between items-center">
                <div class=" w-full md:w-auto flex gap-2">
                    <div x-data="{ addmodal: false }" class="flex">
                        <button @click="addmodal = true"
                            class=" text-nowrap w-full text-center text-sm sm:text-base md:w-auto px-4 py-2 bg-byolink-1 text-white rounded-md font-semibold border border-byolink-1 hover:border-byolink-3 hover:bg-byolink-3 duration-300">
                            Tambah Gallery
                        </button>
                        <div x-show="addmodal"
                        class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
                            <div
                                class="w-full max-w-[720px] bg-white pb-6 rounded-md flex flex-col gap-4 relative overflow-hidden border-2 border-byolink-1">
                                <button @click="addmodal = false"
                                    class=" absolute top-6 right-6 w-6 h-6 text-white hover:text-red-500 duration-300">
                                    <svg viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                                        enable-background="new 0 0 512 512">
                                        <path
                                            d="M437.5 386.6 306.9 256l130.6-130.6c14.1-14.1 14.1-36.8 0-50.9-14.1-14.1-36.8-14.1-50.9 0L256 205.1 125.4 74.5c-14.1-14.1-36.8-14.1-50.9 0-14.1 14.1-14.1 36.8 0 50.9L205.1 256 74.5 386.6c-14.1 14.1-14.1 36.8 0 50.9 14.1 14.1 36.8 14.1 50.9 0L256 306.9l130.6 130.6c14.1 14.1 36.8 14.1 50.9 0 14-14.1 14-36.9 0-50.9z"
                                            fill="currentColor" class="fill-000000"></path>
                                    </svg>
                                </button>
                                <div class=" pt-6 pb-3 bg-byolink-1 text-white">
                                    <h2 class=" px-6 text-2xl font-bold">Tambah Gallery</h2>
                                </div>
                                <form action="{{ route('gallery.store')}}" method="POST" enctype="multipart/form-data"
                                    class="inline">
                                    @csrf
                                    <div class="space-y-4 px-6 text-black">
                                        <div class=" max-h-52 aspect-[4/3] mx-auto rounded-xl overflow-hidden">
                                            <x-admin.component.imageinput title="Nama/Tipe" placeholder="Masukkan nama/tipe web..." :value="''" name="image" />
                                        </div>
                                        <x-admin.component.submitbutton title="Tambah Gallery" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Search -->
                <div class=" w-full md:w-auto flex flex-row font-semibold duration-300">
                    <form action="{{route('category.index')}}" class=" w-full">
                        <input type="text" placeholder="Cari Kategori..." name="search" value="{{urlencode(request('search')) ?? ''}}"
                            class=" w-full text-sm sm:text-base md:w-auto py-2 px-3 border border-byolink-1 rounded-md overflow-hidden focus-within:border-byolink-3 font-normal">
                    </form>
                </div>
            </div>
            <div class=" w-full grid grid-cols-2 sm:grid-cols-4 gap-4">
                @foreach ($data as $item)
                    <div class=" w-full aspect-[4/3] rounded-xl overflow-hidden relative bg-black group">
                        <div class=" absolute top-0 left-0 sm:-translate-y-full sm:group-hover:translate-y-0 duration-300 flex justify-end gap-4 w-full text-white bg-black/40 backdrop-blur-sm py-2 px-4">
                            <div class=" w-5 h-5">
                                <form action="{{route('gallery.update', ['gallery' => $item->id])}}" method="POST" enctype="multipart/form-data"
                                    class="inline">
                                    @csrf
                                    @method('put')
                                    <label for="image-{{$item->id}}"" class="w-5 h-5 hover:text-green-500 duration-300">
                                        <svg fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M3 17.75A3.25 3.25 0 0 0 6.25 21h4.915l.356-1.423c.162-.648.497-1.24.97-1.712l5.902-5.903a3.279 3.279 0 0 1 2.607-.95V6.25A3.25 3.25 0 0 0 17.75 3H11v4.75A3.25 3.25 0 0 1 7.75 11H3v6.75ZM9.5 3.44 3.44 9.5h4.31A1.75 1.75 0 0 0 9.5 7.75V3.44Zm9.6 9.23-5.903 5.902a2.686 2.686 0 0 0-.706 1.247l-.458 1.831a1.087 1.087 0 0 0 1.319 1.318l1.83-.457a2.685 2.685 0 0 0 1.248-.707l5.902-5.902A2.286 2.286 0 0 0 19.1 12.67Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </label>
                                    <input accept="image/*" type="file" class="hidden"  name="image" id="image-{{$item->id}}" oninput="this.form.submit()" />
                                </form>
                            </div>
                            <div class=" w-5 h-5">
                                <form action="{{route('gallery.destroy', ['gallery' => $item->id])}}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class=" w-4 sm:w-5 aspect-square hover:text-red-500 duration-300">
                                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M19.5 8.99h-15a.5.5 0 0 0-.5.5v12.5a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9.49a.5.5 0 0 0-.5-.5Zm-9.25 11.5a.75.75 0 0 1-1.5 0v-8.625a.75.75 0 0 1 1.5 0Zm5 0a.75.75 0 0 1-1.5 0v-8.625a.75.75 0 0 1 1.5 0ZM20.922 4.851a11.806 11.806 0 0 0-4.12-1.07 4.945 4.945 0 0 0-9.607 0A12.157 12.157 0 0 0 3.18 4.805 1.943 1.943 0 0 0 2 6.476 1 1 0 0 0 3 7.49h18a1 1 0 0 0 1-.985 1.874 1.874 0 0 0-1.078-1.654ZM11.976 2.01A2.886 2.886 0 0 1 14.6 3.579a44.676 44.676 0 0 0-5.2 0 2.834 2.834 0 0 1 2.576-1.569Z"
                                                fill="currentColor" class="fill-000000"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <img src="{{asset('/storage/images/gallery/'.$item->image)}}" class=" w-full h-full object-cover object-center" alt="">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('components.admin.component.validationerror')
</x-app-layout>
