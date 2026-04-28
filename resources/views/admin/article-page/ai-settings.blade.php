<x-app-layout head="AI Article Setting" title="Admin - AI Article Setting">
    <div class="sm:pl-12 sm:pr-12 lg:pr-32 duration-300 pt-8 pb-20 sm:pb-8 px-4 space-y-6">
        <div class="w-full sm:py-4 p-4 sm:p-6 bg-white rounded-md shadow-md shadow-black/20">
            <div class="flex items-center justify-between gap-4">
                <div class="flex items-center gap-2 text-sm sm:text-base">
                    <a href="{{ route('article-page.index') }}" class="text-byolink-1 hover:text-byolink-3 duration-300">Article</a>
                    <p class="text-neutral-600">/</p>
                    <p class="text-neutral-600">AI Setting</p>
                </div>
                <a href="{{ route('article-page.index') }}"
                    class="text-sm sm:text-base text-byolink-1 hover:text-byolink-3 duration-300">Kembali</a>
            </div>
        </div>

        <div class="w-full p-4 sm:p-6 bg-white rounded-md shadow-md shadow-black/20 space-y-6">
            <div class="space-y-2">
                <h2 class="text-lg sm:text-2xl font-bold text-neutral-800">Generator Artikel AI</h2>
                <p class="text-sm sm:text-base text-neutral-600">
                    Halaman ini sudah disiapkan untuk alur pembuatan artikel otomatis. Integrasi API AI dan proses simpan
                    otomatis akan kita sambungkan di langkah berikutnya.
                </p>
            </div>

            <form action="{{ route('article-page.ai-settings.submit') }}" method="POST" class="space-y-6"
                x-data="{ articleType: '{{ old('article_type', 'unique') }}' }">
                @csrf

                <div class="space-y-2">
                    <label for="ai_article_theme" class="text-sm sm:text-base font-semibold text-neutral-800">Tema</label>
                    <input
                        id="ai_article_theme"
                        type="text"
                        name="tema"
                        value="{{ old('tema') }}"
                        placeholder="Contoh: Website jasa interior modern"
                        class="w-full text-sm sm:text-base py-2.5 px-3 border border-byolink-1 rounded-md focus:border-byolink-3 focus:outline-none">
                </div>

                <div class="space-y-2">
                    <p class="text-sm sm:text-base font-semibold text-neutral-800">Tipe Article</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <label for="ai_article_type_unique" class="cursor-pointer">
                            <input
                                id="ai_article_type_unique"
                                type="radio"
                                name="article_type"
                                value="unique"
                                class="peer hidden"
                                x-model="articleType"
                                {{ old('article_type', 'unique') === 'unique' ? 'checked' : '' }}>
                            <div class="rounded-md border border-byolink-1 p-4 peer-checked:bg-byolink-1 peer-checked:text-white duration-300">
                                <p class="font-semibold">Unique</p>
                                <p class="text-sm opacity-80">Cocok untuk satu artikel final yang siap direview lebih lanjut.</p>
                            </div>
                        </label>

                        <label for="ai_article_type_spintax" class="cursor-pointer">
                            <input
                                id="ai_article_type_spintax"
                                type="radio"
                                name="article_type"
                                value="spintax"
                                class="peer hidden"
                                x-model="articleType"
                                {{ old('article_type') === 'spintax' ? 'checked' : '' }}>
                            <div class="rounded-md border border-byolink-1 p-4 peer-checked:bg-byolink-1 peer-checked:text-white duration-300">
                                <p class="font-semibold">Spintax</p>
                                <p class="text-sm opacity-80">Disiapkan untuk kebutuhan artikel dengan variasi konten otomatis.</p>
                            </div>
                        </label>
                    </div>
                </div>

                <div x-show="articleType === 'spintax'" x-transition class="space-y-4">
                    <div class="rounded-md border border-byolink-1/20 bg-neutral-50 p-4 space-y-4">
                        <div class="space-y-1">
                            <p class="text-sm sm:text-base font-semibold text-neutral-800">Short Code Spintax</p>
                            <p class="text-sm text-neutral-600">
                                Pilih masing-masing satu short code untuk `barang` dan `lokasi`. Nilai ini akan
                                diberitahukan ke prompt agar AI memakai shortcode tersebut dalam artikel.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label for="source_code_barang" class="text-sm sm:text-base font-semibold text-neutral-800">
                                    Short Code Barang
                                </label>
                                <select
                                    id="source_code_barang"
                                    name="source_code_barang"
                                    class="w-full text-sm sm:text-base py-2.5 px-3 border border-byolink-1 rounded-md focus:border-byolink-3 focus:outline-none">
                                    <option value="">Pilih short code barang</option>
                                    @foreach ($sourceCodes as $sourceCode)
                                        <option value="{{ $sourceCode->id }}" {{ (string) old('source_code_barang') === (string) $sourceCode->id ? 'selected' : '' }}>
                                            {{ $sourceCode->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="space-y-2">
                                <label for="source_code_lokasi" class="text-sm sm:text-base font-semibold text-neutral-800">
                                    Short Code Lokasi
                                </label>
                                <select
                                    id="source_code_lokasi"
                                    name="source_code_lokasi"
                                    class="w-full text-sm sm:text-base py-2.5 px-3 border border-byolink-1 rounded-md focus:border-byolink-3 focus:outline-none">
                                    <option value="">Pilih short code lokasi</option>
                                    @foreach ($sourceCodes as $sourceCode)
                                        <option value="{{ $sourceCode->id }}" {{ (string) old('source_code_lokasi') === (string) $sourceCode->id ? 'selected' : '' }}>
                                            {{ $sourceCode->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-md border border-dashed border-neutral-300 bg-neutral-50 p-4 text-sm text-neutral-600">
                Halaman ini memakai Gemini API. Tombol cek dulu akan membuat draft ke form create, sedangkan tombol langsung simpan
                akan menyimpan hasil AI sebagai draft yang aman untuk ditinjau lagi.
            </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <button
                        type="submit"
                        name="action_type"
                        value="instant"
                        class="w-full sm:w-auto px-4 py-2.5 bg-byolink-1 text-white rounded-md font-semibold border border-byolink-1 hover:bg-byolink-3 hover:border-byolink-3 duration-300">
                        Langsung Simpan
                    </button>
                    <button
                        type="submit"
                        name="action_type"
                        value="review"
                        class="w-full sm:w-auto px-4 py-2.5 bg-white text-byolink-1 rounded-md font-semibold border border-byolink-1 hover:bg-byolink-1 hover:text-white duration-300">
                        Cek Dulu
                    </button>
                </div>
            </form>

            @include('components.admin.component.validationerror')
        </div>
    </div>

    @include('components.admin.component.success')
</x-app-layout>
