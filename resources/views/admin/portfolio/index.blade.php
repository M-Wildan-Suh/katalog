<x-app-layout head="Portofolio" title="Admin - Portofolio">
    <div class="sm:pl-12 sm:pr-12 lg:pr-32 duration-300 pt-8 pb-20 sm:pb-8 px-4 space-y-4">
        <div class="w-full p-4 sm:p-8 bg-white rounded-md shadow-md shadow-black/20 flex flex-col gap-6">
            <div class="w-full flex flex-col md:flex-row gap-4 justify-between items-center">
                <div class=" w-full md:w-auto flex gap-2">
                    <div x-data="{ addmodal: false }" class="flex">
                        <button @click="addmodal = true"
                            class=" text-nowrap w-full text-center text-sm sm:text-base md:w-auto px-4 py-2 bg-byolink-1 text-white rounded-md font-semibold border border-byolink-1 hover:border-byolink-3 hover:bg-byolink-3 duration-300">
                            Tambah Portofolio
                        </button>
                        <div x-show="addmodal"
                        class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center p-4 z-50">
                            <div
                                class="w-full max-w-[720px] max-h-full bg-white pb-6 rounded-md flex flex-col gap-4 relative overflow-hidden border-2 border-byolink-1">
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
                                    <h2 class=" px-6 text-2xl font-bold">Tambah Portofolio</h2>
                                </div>
                                <form action="{{ route('portfolio.store')}}" method="POST" enctype="multipart/form-data"
                                    class="inline overflow-auto max-h-full">
                                    @csrf
                                    <div class="space-y-4 px-6">
                                        <div class=" w-full">
                                            <div class=" w-full flex flex-col max-w-full gap-2 text-sm sm:text-base font-medium">
                                                <label>Thumbnail</label>
                                                <div class="w-full h-52 sm:h-60 flex items-center justify-center">
                                                    <div class=" aspect-[3/2] max-h-full max-w-full rounded-md overflow-hidden shadow-md shadow-black/20 ">
                                                        <x-admin.component.imageinput title="Nama/Tipe" placeholder="Masukkan nama/tipe web..." :value="''" name="image" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <x-admin.component.textinput title="Nama" placeholder="Masukkan Nama"
                                            :value="old('title')" name="title" />
                                        {{-- <x-admin.component.linkinput tiftle="Url Portofolio" placeholder="Masukkan link..." :value="old('url')" name="url" link="Url" /> --}}
                                        <x-admin.component.submitbutton title="Tambah Portofolio" />
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
            <table class="w-full text-sm sm:text-base rounded-md overflow-hidden">
                <thead>
                    <tr class="h-10 bg-byolink-1 text-white divide-x-2 divide-white">
                        <th class=" px-2 py-1 rounded-tl-md w-10">No</th>
                        <th class=" px-1 sm:px-2 py-1">Nama</th>
                        {{-- <th class=" px-1 sm:px-2 py-1">Url</th> --}}
                        <th class=" px-1 sm:px-2 py-1 w-[90px] sm:w-[100px] rounded-tr-md">Opsi</th>
                    </tr>
                </thead>
                <tbody id="guardian-container">
                    @include('admin.portfolio.row')
                </tbody>
                <tr>
                    <td id="loader" colspan="6" class=" text-center text-neutral-600 h-10">
                        {{$data->count() > 20 ? 'Loading...' : 'Semua data telah dimuat'}}
                    </td>
                </tr>
            </table>
            <script>
                let page = 2;
                let loading = false;
            
                window.addEventListener('scroll', () => {
                    if (loading) return;
            
                    const loader = document.getElementById('loader');

                    const search = "{!! request('search') ? '&search=' . urlencode(request('search')) : '' !!}";
            
                    // Scroll benar-benar mentok
                    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                        loading = true;
                        loader.textContent = 'Loading...';
            
                        fetch(`?page=${page}${search}`, {
                            headers: { 'X-Requested-With': 'XMLHttpRequest' }
                        })
                        .then(response => response.text())
                        .then(html => {
                            // Tambahkan delay 1 detik sebelum tampilkan data
                            setTimeout(() => {
                                if (html.trim() !== '') {
                                    document.getElementById('guardian-container').insertAdjacentHTML('beforeend', html);
                                    page++;
                                    loading = false;
                                    loader.textContent = 'Loading...';
                                } else {
                                    loader.textContent = 'Semua data telah dimuat';
                                }
                            }, 500); // delay 1 detik
                        })
                        .catch(() => {
                            loader.textContent = 'Gagal memuat data';
                            loading = false;
                        });
                    }
                });
            </script>
        </div>
    </div>
    @include('components.admin.component.validationerror')
</x-app-layout>
