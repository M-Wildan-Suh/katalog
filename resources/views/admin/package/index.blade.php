<x-app-layout head="Package" title="Admin - Package">
    <div class="sm:pl-12 sm:pr-12 lg:pr-32 duration-300 pt-8 pb-20 sm:pb-8 px-4 space-y-4">
        <div class="w-full p-4 sm:p-8 bg-white rounded-md shadow-md shadow-black/20 flex flex-col gap-6">
            <div class=" w-auto flex gap-2">
                <a href="{{route('package.create')}}">
                    <button
                        :disabled="count == 4"
                        @click="count == 4 ? (alert = true, setTimeout(() => alert = false, 2000)) : (addmodal = true)"
                        class=" text-nowrap w-full text-center text-sm sm:text-base md:w-auto px-4 py-2 bg-byolink-1 text-white rounded-md font-semibold border border-byolink-1 hover:border-byolink-3 hover:bg-byolink-3 duration-300">
                        Tambah Paket
                    </button>
                </a>
                <div x-data="{ alert: false, count: {{ $data->count() }} }" class="flex relative">
                    <div x-show="alert"
                        class="absolute -top-8 left-0 sm:left-1/2 sm:-translate-x-1/2 bg-black text-white text-xs sm:text-sm px-2 py-1 rounded-md shadow-md text-nowrap">
                        Data sudah mencapai sebanyak 4 data
                    </div>
                </div>
            </div>
            <table class="w-full text-sm sm:text-base rounded-md overflow-hidden">
                <thead>
                    <tr class="h-10 bg-byolink-1 text-white divide-x-2 divide-white">
                        <th class=" px-2 py-1 rounded-tl-md w-10">No</th>
                        <th class=" px-1 sm:px-2 py-1">Paket</th>
                        <th class=" px-1 sm:px-2 py-1">Harga</th>
                        <th class=" px-1 sm:px-2 py-1 hidden md:table-cell">Item Paket</th>
                        <th class=" px-1 sm:px-2 py-1">Video</th>
                        {{-- <th class=" px-1 sm:px-2 py-1">Url</th> --}}
                        <th class=" px-1 sm:px-2 py-1 w-[90px] sm:w-[100px] rounded-tr-md">Opsi</th>
                    </tr>
                </thead>
                <tbody id="guardian-container">
                    @include('admin.package.row')
                </tbody>
            </table>
        </div>
    </div>
    @include('components.admin.component.validationerror')
</x-app-layout>
