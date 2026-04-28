<x-app-layout head="Article" title="Admin - Article">
    <div class="sm:pl-12 sm:pr-12 lg:pr-32 duration-300 pt-8 pb-20 sm:pb-8 px-4 space-y-4">
        <div class="w-full p-4 sm:p-8 bg-white rounded-md shadow-md shadow-black/20 flex flex-col gap-6">
            <div class="w-full flex flex-row gap-4 justify-between items-center">
                <div class="flex w-full lg:w-auto gap-3">
                    <div x-data="{ open: false }" class="relative w-full md:w-auto">
                        <button @click="open = !open" type="button"
                            class="flex items-center justify-center gap-2 text-nowrap w-full text-center text-sm sm:text-base md:w-auto px-4 py-2 bg-byolink-1 text-white rounded-md font-semibold border border-byolink-1 hover:border-byolink-3 hover:bg-byolink-3 duration-300">
                            Tambah Article
                            <svg class="w-4 h-4" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.25 7.5 10 12.25 14.75 7.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                            </svg>
                        </button>
                        <div x-show="open" @click.outside="open = false"
                            class="absolute z-20 mt-2 w-full md:w-48 rounded-md border bg-white shadow-lg overflow-hidden">
                            <a href="{{ route('article-page.create', ['type' => 'unique']) }}"
                                class="block px-4 py-2 text-sm text-neutral-700 hover:bg-neutral-100">Unique</a>
                            <a href="{{ route('article-page.create', ['type' => 'spintax']) }}"
                                class="block px-4 py-2 text-sm text-neutral-700 hover:bg-neutral-100">Spintax</a>
                        </div>
                    </div>
                    <a href="{{ route('source-code.index') }}"
                        class="flex items-center justify-center gap-2 text-nowrap w-full text-center text-sm sm:text-base md:w-auto px-4 py-2 bg-white text-byolink-1 rounded-md font-semibold border border-byolink-1 hover:bg-byolink-1 hover:text-white duration-300">
                        Source Code
                    </a>
                    <a href="{{ route('article-page.ai-settings') }}"
                        class="flex items-center justify-center gap-2 text-nowrap w-full text-center text-sm sm:text-base md:w-auto px-4 py-2 bg-white text-byolink-1 rounded-md font-semibold border border-byolink-1 hover:bg-byolink-1 hover:text-white duration-300">
                        Buat Dengan AI
                    </a>
                </div>

                <div class="w-full lg:w-auto flex flex-row font-semibold duration-300">
                    <form action="{{ url()->current() }}" class="w-full">
                        <input type="text" placeholder="Cari Article..." name="search"
                            value="{{ urlencode(request('search')) ?? '' }}"
                            class="w-full text-sm sm:text-base lg:w-auto py-2 px-3 border border-byolink-1 rounded-md overflow-hidden focus-within:border-byolink-3 font-normal">
                    </form>
                </div>
            </div>
            <div x-data="{ status: '{{ $status ?? 'all' }}', category: '{{ $filtercat ?? 'all' }}' }" class="w-full flex flex-row justify-end gap-4 text-sm sm:text-base">
                <div class="grid grid-cols-2 gap-2">
                    <div class="flex items-center gap-2">
                        <p class="flex text-nowrap flex-nowrap">S<span class="hidden sm:block">tatus</span> :</p>
                        <select class="text-neutral-600 border-neutral-600 w-full text-sm border pl-2 px-8 py-0.5 rounded-full"
                            x-model="status" name="status">
                            <option value="all">All</option>
                            <option value="schedule">Schedule</option>
                            <option value="publish">Publish</option>
                            <option value="private">Private</option>
                        </select>
                    </div>
                    <div class="flex items-center gap-2">
                        <p class="flex text-nowrap flex-nowrap">K<span class="hidden sm:block">ategori</span> :</p>
                        <select class="text-neutral-600 border-neutral-600 w-full text-sm border pl-2 px-8 py-0.5 rounded-full"
                            x-model="category" name="category">
                            <option value="all">All</option>
                            @foreach ($category as $item)
                                <option value="{{ $item->id }}">{{ $item->category }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <a :href="`{{ route('article-page.index') }}/status/${status}/category/${category}`">
                    <button
                        class="w-full bg-byolink-1 hover:bg-byolink-3 duration-300 rounded-full text-white px-2 py-0.5 text-sm">Cari</button>
                </a>
            </div>
            <table class="w-full max-w-full text-sm sm:text-base rounded-md">
                <thead>
                    <tr class="h-10 bg-byolink-1 text-white divide-x-2 divide-white">
                        <th class="w-10 px-2 py-1 rounded-tl-md">No</th>
                        <th class="px-1 sm:px-2 py-1 relative">Judul</th>
                        <th class="px-1 sm:px-2 py-1 relative hidden md:table-cell">Kategori</th>
                        <th class="px-1 sm:px-2 py-1 relative hidden md:table-cell">Author</th>
                        <th class="px-1 sm:px-2 py-1 w-[90px] sm:w-[100px] rounded-tr-md">Opsi</th>
                    </tr>
                </thead>
                <tbody id="guardian-container" x-data="tableToggle()">
                    @include('admin.article-page.row')
                </tbody>
                <tr>
                    <td id="loader" colspan="6" class="text-center text-neutral-600 h-10">
                        {{ $data->count() > 20 ? 'Loading...' : 'Semua data telah dimuat' }}
                    </td>
                </tr>
            </table>
            <script>
                function tableToggle() {
                    return {
                        openedIds: [],
                        detail(id) {
                            const index = this.openedIds.indexOf(id);
                            if (index === -1) {
                                this.openedIds.push(id);
                            } else {
                                this.openedIds.splice(index, 1);
                            }
                        }
                    };
                }

                document.addEventListener("DOMContentLoaded", () => {
                    const loader = document.getElementById("loader");
                    const search = "{!! request('search') ? '&search=' . urlencode(request('search')) : '' !!}";
                    let loading = false;
                    let page = 2;

                    function loadMoreData() {
                        if (loading) return;
                        loading = true;
                        loader.textContent = "Loading...";

                        fetch(`?page=${page}${search}`, {
                                headers: {
                                    "X-Requested-With": "XMLHttpRequest"
                                }
                            })
                            .then(response => response.text())
                            .then(html => {
                                setTimeout(() => {
                                    if (html.trim() !== "") {
                                        document.getElementById("guardian-container").insertAdjacentHTML("beforeend", html);
                                        page++;
                                        loader.textContent = "Loading...";
                                        loading = false;
                                    } else {
                                        loader.textContent = "Semua data telah dimuat";
                                        observer.disconnect();
                                    }
                                }, 500);
                            })
                            .catch(() => {
                                loader.textContent = "Gagal memuat data";
                                loading = false;
                            });
                    }

                    const observer = new IntersectionObserver(entries => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                loadMoreData();
                            }
                        });
                    });

                    observer.observe(loader);
                });
            </script>
        </div>
    </div>

    @include('components.admin.component.success')
</x-app-layout>
