<x-app-layout head="Gallery" title="Admin - Gallery">
    <div class="sm:pl-12 sm:pr-12 lg:pr-32 duration-300 pt-8 pb-20 sm:pb-8 px-4 space-y-4">
        <div x-data="{ order: [], edit: false, deletemodal: false, tooltip: false, count: {{ $data->count() }} }"
            class="w-full p-4 sm:p-8 bg-white rounded-md shadow-md shadow-black/20 flex flex-col gap-6">
            <div class="w-full flex gap-4 justify-between items-center">
                <div class=" w-auto flex gap-2">
                    <div x-data="{ addmodal: false, alert: false }" class="flex relative">
                        <button @click="count == 12 ? (alert = true, setTimeout(() => alert = false, 2000)) : (addmodal = true)"
                            class=" text-nowrap w-full text-center text-sm sm:text-base md:w-auto px-4 py-2 bg-byolink-1 text-white rounded-md font-semibold border border-byolink-1 hover:border-byolink-3 hover:bg-byolink-3 duration-300">
                            Tambah Gallery
                        </button>
                        <div x-show="alert"
                            class="absolute -top-8 left-0 sm:left-1/2 sm:-translate-x-1/2 bg-black text-white text-xs sm:text-sm px-2 py-1 rounded-md shadow-md text-nowrap">
                            Data sudah mencapai sebanyak 12 data
                        </div>
                        <div x-show="addmodal"
                            class="fixed inset-0 p-4 bg-black bg-opacity-50 flex justify-center items-center z-50">
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
                                <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data"
                                    class="inline">
                                    @csrf
                                    <div class="space-y-4 px-6 text-black">
                                        <div x-data="imageGallery()" class="flex flex-col gap-2">
                                            <label class=" text-sm sm:text-base font-semibold" for="image">Galeri
                                                (Max 12)</label>
                                            <input type="file" class="hidden" id="image" name="image[]" multiple
                                                @change="previewImages($event)" accept="image/*">

                                            <!-- Pratinjau Gambar -->
                                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                                <!-- Loop Gambar -->
                                                <template x-for="(image, index) in images" :key="index">
                                                    <div
                                                        class="w-full aspect-[4/3] flex items-center rounded-md relative overflow-hidden">
                                                        <img :src="image" class="w-full h-full object-cover"
                                                            alt="Gallery Image Preview">
                                                        <!-- Tombol Hapus Gambar -->
                                                        <button type="button" @click="removeImage(index)"
                                                            class="absolute inset-0 text-transparent hover:bg-black/60 hover:text-white/50 transition duration-300 p-[35%]">
                                                            <svg viewBox="0 0 24 24" class="w-full h-full"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M19.5 8.99h-15a.5.5 0 0 0-.5.5v12.5a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9.49a.5.5 0 0 0-.5-.5Zm-9.25 11.5a.75.75 0 0 1-1.5 0v-8.625a.75.75 0 0 1 1.5 0Zm5 0a.75.75 0 0 1-1.5 0v-8.625a.75.75 0 0 1 1.5 0ZM20.922 4.851a11.806 11.806 0 0 0-4.12-1.07 4.945 4.945 0 0 0-9.607 0A12.157 12.157 0 0 0 3.18 4.805 1.943 1.943 0 0 0 2 6.476 1 1 0 0 0 3 7.49h18a1 1 0 0 0 1-.985 1.874 1.874 0 0 0-1.078-1.654ZM11.976 2.01A2.886 2.886 0 0 1 14.6 3.579a44.676 44.676 0 0 0-5.2 0 2.834 2.834 0 0 1 2.576-1.569Z"
                                                                    fill="currentColor" class="fill-000000"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </template>

                                                <!-- Tambahkan Gambar (Placeholder jika kurang dari 6 gambar) -->
                                                <template x-if="images.length < max">
                                                    <label for="image"
                                                        class="w-full aspect-[4/3] border bg-neutral-100 border-byolink-1 rounded-md relative border-dashed overflow-hidden cursor-pointer">
                                                        <div
                                                            class="w-full text-byolink-1 h-full absolute top-0 left-0 flex justify-center items-center p-[25%] hover:bg-byolink-3 hover:text-white/50 duration-300">
                                                            <svg viewBox="0 0 24 24" class="w-full h-full"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="m9 13 3-4 3 4.5V12h4V5c0-1.103-.897-2-2-2H4c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h8v-4H5l3-4 1 2z"
                                                                    fill="currentColor" class="fill-000000"></path>
                                                                <path d="M19 14h-2v3h-3v2h3v3h2v-3h3v-2h-3z"
                                                                    fill="currentColor" class="fill-000000"></path>
                                                            </svg>
                                                        </div>
                                                    </label>
                                                </template>
                                            </div>
                                        </div>

                                        <script>
                                            function imageGallery() {
                                                return {
                                                    images: [],
                                                    files: [],
                                                    max: {{12 - $data->count()}},

                                                    previewImages(event) {
                                                        const input = event.target;
                                                        const selected = Array.from(input.files).slice(0, this.max - this.files.length);

                                                        selected.forEach(file => {
                                                            const exists = this.files.some(f => f.name === file.name && f.size === file.size && f
                                                                .lastModified === file.lastModified);
                                                            if (exists) return;

                                                            this.files.push(file);
                                                            this.images.push(URL.createObjectURL(file));
                                                        });

                                                        const dt = new DataTransfer();
                                                        this.files.forEach(f => dt.items.add(f));
                                                        input.files = dt.files;
                                                    },

                                                    removeImage(index) {
                                                        try {
                                                            URL.revokeObjectURL(this.images[index]);
                                                        } catch (e) {}

                                                        this.images.splice(index, 1);
                                                        this.files.splice(index, 1);

                                                        // sync input.files
                                                        const input = document.getElementById('image');
                                                        const dt = new DataTransfer();
                                                        this.files.forEach(f => dt.items.add(f));
                                                        input.files = dt.files;
                                                    },
                                                }
                                            }
                                        </script>
                                        <x-admin.component.submitbutton title="Tambah Gallery" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="group relative">
                    <button class=" w-6 h-6">
                        <svg enable-background="new 0 0 32 32" id="Glyph" version="1.1" viewBox="0 0 32 32"
                            xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink">
                            <path fill="currentColor"
                                d="M13,16c0,1.654,1.346,3,3,3s3-1.346,3-3s-1.346-3-3-3S13,14.346,13,16z"
                                id="XMLID_294_" />
                            <path fill="currentColor"
                                d="M13,26c0,1.654,1.346,3,3,3s3-1.346,3-3s-1.346-3-3-3S13,24.346,13,26z"
                                id="XMLID_295_" />
                            <path fill="currentColor"
                                d="M13,6c0,1.654,1.346,3,3,3s3-1.346,3-3s-1.346-3-3-3S13,4.346,13,6z" id="XMLID_297_" />
                        </svg>
                    </button>
                    <div :class="edit || deletemodal || tooltip ? 'flex' : 'hidden group-hover:flex'"
                        class=" flex-col text-neutral-600 absolute top-0 right-full bg-white py-2 text-sm sm:text-base rounded-md shadow-md shadow-black/20">
                        <div x-show="tooltip"
                            class="absolute -top-8 left-1/2 -translate-x-1/2 bg-black text-white text-xs sm:text-sm px-2 py-1 rounded-md shadow-md text-nowrap">
                            Anda belum memilih data
                        </div>
                        {{-- Delete All --}}
                        <button
                            @click="if(order == '') { tooltip = true; setTimeout(() => tooltip = false, 2000); } else { deletemodal = true }"
                            class=" text-nowrap px-4 hover:bg-neutral-200">Hapus Data</button>
                        <div x-show="deletemodal"
                            class="fixed inset-0 p-4 bg-black bg-opacity-50 flex justify-center items-center z-50">
                            <div
                                class="w-full max-w-[720px] bg-white pb-6 rounded-md flex flex-col gap-4 relative overflow-hidden border-2 border-byolink-1">
                                <button @click="deletemodal = false"
                                    class=" absolute top-6 right-6 w-6 h-6 text-white hover:text-red-500 duration-300">
                                    <svg viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                                        enable-background="new 0 0 512 512">
                                        <path
                                            d="M437.5 386.6 306.9 256l130.6-130.6c14.1-14.1 14.1-36.8 0-50.9-14.1-14.1-36.8-14.1-50.9 0L256 205.1 125.4 74.5c-14.1-14.1-36.8-14.1-50.9 0-14.1 14.1-14.1 36.8 0 50.9L205.1 256 74.5 386.6c-14.1 14.1-14.1 36.8 0 50.9 14.1 14.1 36.8 14.1 50.9 0L256 306.9l130.6 130.6c14.1 14.1 36.8 14.1 50.9 0 14-14.1 14-36.9 0-50.9z"
                                            fill="currentColor" class="fill-000000"></path>
                                    </svg>
                                </button>
                                <div class=" pt-6 pb-3 bg-byolink-1 text-white">
                                    <h2 class=" px-6 text-2xl font-bold">Hapus data yang dipilih</h2>
                                </div>
                                <p class="px-6 text-base">Anda akan menghapus semua data yang sudah dipilih!
                                </p>
                                <div class="flex justify-end space-x-4 px-6">
                                    <form action="{{ route('gallery.destroy.all') }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="order_id" x-model="order">
                                        <button type="submit"
                                            class="px-4 py-3 text-sm sm:text-base rounded-md bg-red-500 text-white font-semibold hover:bg-red-800 duration-300">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" w-full grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                @foreach ($data as $item)
                    <div class=" w-full aspect-[4/3] rounded-xl overflow-hidden relative bg-black group">
                        <div
                            class=" absolute top-0 left-0 duration-300 flex items-center justify-between gap-2 sm:gap-4 w-full text-white bg-black/40 backdrop-blur-sm  py-1 sm:py-2 px-2 sm:px-4">
                            <input type="checkbox" name="order_id[]" x-model="order" value="{{ $item->id }}"
                                id=""
                                class=" rounded-full text-green-500 border-0 focus:ring-0 focus:border-0 focus:outline-none focus:ring-offset-0">
                            <div class=" flex gap-2 sm:gap-4">
                                <div class=" w-5 h-5">
                                    <form action="{{ route('gallery.update', ['gallery' => $item->id]) }}"
                                        method="POST" enctype="multipart/form-data" class="inline">
                                        @csrf
                                        @method('put')
                                        <label for="image-{{ $item->id }}"
                                            class="w-5 h-5 hover:text-green-500 duration-300">
                                            <svg fill="none" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M3 17.75A3.25 3.25 0 0 0 6.25 21h4.915l.356-1.423c.162-.648.497-1.24.97-1.712l5.902-5.903a3.279 3.279 0 0 1 2.607-.95V6.25A3.25 3.25 0 0 0 17.75 3H11v4.75A3.25 3.25 0 0 1 7.75 11H3v6.75ZM9.5 3.44 3.44 9.5h4.31A1.75 1.75 0 0 0 9.5 7.75V3.44Zm9.6 9.23-5.903 5.902a2.686 2.686 0 0 0-.706 1.247l-.458 1.831a1.087 1.087 0 0 0 1.319 1.318l1.83-.457a2.685 2.685 0 0 0 1.248-.707l5.902-5.902A2.286 2.286 0 0 0 19.1 12.67Z"
                                                    fill="currentColor"></path>
                                            </svg>
                                        </label>
                                        <input accept="image/*" type="file" class="hidden" name="image"
                                            id="image-{{ $item->id }}" oninput="this.form.submit()" />
                                    </form>
                                </div>
                                <div class=" w-5 h-5">
                                    <form action="{{ route('gallery.destroy', ['gallery' => $item->id]) }}"
                                        method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class=" w-4 sm:w-5 aspect-square hover:text-red-500 duration-300">
                                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M19.5 8.99h-15a.5.5 0 0 0-.5.5v12.5a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9.49a.5.5 0 0 0-.5-.5Zm-9.25 11.5a.75.75 0 0 1-1.5 0v-8.625a.75.75 0 0 1 1.5 0Zm5 0a.75.75 0 0 1-1.5 0v-8.625a.75.75 0 0 1 1.5 0ZM20.922 4.851a11.806 11.806 0 0 0-4.12-1.07 4.945 4.945 0 0 0-9.607 0A12.157 12.157 0 0 0 3.18 4.805 1.943 1.943 0 0 0 2 6.476 1 1 0 0 0 3 7.49h18a1 1 0 0 0 1-.985 1.874 1.874 0 0 0-1.078-1.654ZM11.976 2.01A2.886 2.886 0 0 1 14.6 3.579a44.676 44.676 0 0 0-5.2 0 2.834 2.834 0 0 1 2.576-1.569Z"
                                                    fill="currentColor" class="fill-000000"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <img src="{{ asset('/storage/images/gallery/' . $item->image) }}"
                            class=" w-full h-full object-cover object-center" alt="">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('components.admin.component.validationerror')
</x-app-layout>
