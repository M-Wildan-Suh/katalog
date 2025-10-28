<x-app-layout head="Edit Package" title="Admin - Edit Package">
    <div class="sm:pl-12 sm:pr-12 lg:pr-32 duration-300 pt-8 pb-20 sm:pb-8 px-4 space-y-4">
        <form action="{{ route('package.update', ['package' => $package->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="w-full p-4 sm:p-8 bg-white rounded-md shadow-md shadow-black/20 flex flex-col gap-6">
                <x-admin.component.textinput title="Nama Paket" placeholder="Masukkan nama paket..." :value="old('title', $package->title)"
                    name="title" />
                <x-admin.component.priceinput title="Harga" placeholder="Masukkan harga..." :value="old('price', $package->price)"
                    name="price" />
                <div x-data="{
                    items: {{ json_encode($package->packageitem ?? [['title' => '', 'video' => '']]) }}
                    }" 
                    class="w-full">
                    <div class="flex flex-col gap-2 text-sm sm:text-base font-medium">
                        <p>List Item Paket</p>

                        <template x-for="(item, index) in items" :key="index">
                            <div class="w-full grid grid-cols-1 sm:grid-cols-2 gap-2 sm:gap-4 relative rounded-md">
                                <!-- Nama Item -->
                                <input type="text" :name="`listpackage[${index}][title]`" x-model="item.title"
                                    placeholder="Masukkan Nama Item..."
                                    class="text-sm sm:text-base font-normal rounded-md border border-byolink-1 focus:ring-byolink-3 focus:border-byolink-3 bg-neutral-100">

                                <!-- Link Video -->
                                <div
                                    class="flex flex-row w-full border border-transparent focus-within:border-byolink-3 focus-within:ring-1 focus-within:ring-byolink-3 rounded-md">
                                    <label
                                        class="py-2 px-3 border border-byolink-1 bg-byolink-1 text-white rounded-l-md">
                                        Url
                                    </label>
                                    <input type="text" :name="`listpackage[${index}][video]`" x-model="item.video"
                                        placeholder="Masukkan link video..."
                                        class="flex-grow min-w-0 text-sm sm:text-base font-normal rounded-r-md border border-byolink-1 focus:ring-0 focus:border-none bg-neutral-100">
                                </div>

                                <!-- Tombol Hapus -->
                                <button type="button" @click="items.splice(index, 1)"
                                    class="absolute top-1/2 right-0 translate-x-1/2 -translate-y-1/2 bg-red-600 hover:bg-red-800 text-white rounded-full p-2 w-7 h-7 flex items-center justify-center shadow">
                                    <svg viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                                        enable-background="new 0 0 512 512">
                                        <path
                                            d="M437.5 386.6 306.9 256l130.6-130.6c14.1-14.1 14.1-36.8 0-50.9-14.1-14.1-36.8-14.1-50.9 0L256 205.1 125.4 74.5c-14.1-14.1-36.8-14.1-50.9 0-14.1 14.1-14.1 36.8 0 50.9L205.1 256 74.5 386.6c-14.1 14.1-14.1 36.8 0 50.9 14.1 14.1 36.8 14.1 50.9 0L256 306.9l130.6 130.6c14.1 14.1 36.8 14.1 50.9 0 14-14.1 14-36.9 0-50.9z"
                                            fill="currentColor" class="fill-000000"></path>
                                    </svg>
                                </button>
                            </div>
                        </template>

                        <!-- Tombol Tambah Item -->
                        <button type="button" @click="items.push({ title: '', video: '' })"
                            class="text-sm hover:underline mt-2 self-start">
                            + Tambah Item
                        </button>
                    </div>
                </div>
                <x-admin.component.linkinput title="Video (Link Youtube) (Optional)" placeholder="Masukkan link..."
                    value="{{ old('video', $package->video) }}" name="video" link="Url" />
                <x-admin.component.submitbutton title="Save" />
            </div>
        </form>
    </div>

    @include('components.admin.component.validationerror')
</x-app-layout>
