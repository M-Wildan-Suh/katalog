@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        @if ($paginator->hasPages())
            @php
                $currentPage = $paginator->currentPage();
                $lastPage = $paginator->lastPage();

                // Target 5 halaman
                $start = $currentPage - 1;
                $end = $currentPage + 1;

                // Penyesuaian jika berada di awal
                if ($start < 1) {
                    $end += (1 - $start); // tambahkan ke "kanan"
                    $start = 1;
                }

                // Penyesuaian jika berada di akhir
                if ($end > $lastPage) {
                    $start -= ($end - $lastPage); // geser ke "kiri"
                    $end = $lastPage;
                }

                function pageUrl($url) {
                    $finalUrl = str_replace('?page=', '/', $url);
                    return $finalUrl;
                }

                // Pastikan start tidak kurang dari 1
                if ($start < 1) $start = 1;
            @endphp

            <nav class=" w-full flex items-center justify-center space-x-1 mt-4" role="navigation" aria-label="Pagination Navigation">
                {{-- Tombol ke Halaman Pertama --}}
                @if ($currentPage > 1)
                    <a href="{{ pageUrl($paginator->url(1)) . (request('search') ? '?search=' . urlencode(request('search')) : '') }}"
                        class="  w-7 sm:w-9 aspect-square p-2 sm:p-3 rounded-md bg-neutral-100 text-neutral-600 hover:bg-byolink-2 hover:text-white duration-300"
                        aria-label="First Page">
                        <svg viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg"><path fill="none" d="M0 0h256v256H0z"></path><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="24" d="m200 208-80-80 80-80M120 208l-80-80 80-80" class="stroke-000000"></path></svg>
                    </a>
                @endif

                {{-- Tombol Sebelumnya --}}
                @if (!$paginator->onFirstPage())
                    <a href="{{ pageUrl($paginator->previousPageUrl()) . (request('search') ? '?search=' . urlencode(request('search')) : '') }}"
                        class="  w-7 sm:w-9 aspect-square p-2 sm:p-3 rounded-md bg-neutral-100 text-neutral-600 hover:bg-byolink-2 hover:text-white duration-300"
                        aria-label="Previous Page">
                        <svg viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg"><path fill="none" d="M0 0h256v256H0z"></path><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="24" d="m160 208-80-80 80-80" class="stroke-000000"></path></svg>
                    </a>
                @endif

                {{-- Ellipsis Sebelum --}}
                @if ($start > 1)
                    <span class="  w-7 sm:w-9 aspect-square flex items-center justify-center bg-neutral-100 text-neutral-600 text-start sm:text-base">...</span>
                @endif

                {{-- Loop Nomor Halaman --}}
                @for ($i = $start; $i <= $end; $i++)
                    @if ($i == $currentPage)
                        <span style="line heigh:0.75rem;" class="  w-7 sm:w-9 aspect-square flex items-center justify-center text-start sm:text-base bg-byolink-2 text-white rounded-md">{{ $i }}</span>
                    @else
                        <a href="{{ pageUrl($paginator->url($i)) . (request('search') ? '?search=' . urlencode(request('search')) : '') }}"
                        class=" w-7 sm:w-9 aspect-square flex items-center justify-center text-start sm:text-base bg-neutral-100 text-neutral-600 hover:bg-byolink-2 hover:text-white duration-300 rounded-md">{{ $i }}</a>
                    @endif
                @endfor

                {{-- Ellipsis Sesudah --}}
                @if ($end < $lastPage)
                    <span class="  w-7 sm:w-9 aspect-square flex items-center justify-center bg-neutral-100 text-neutral-600 text-start sm:text-base">...</span>
                @endif

                {{-- Tombol Selanjutnya --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ pageUrl($paginator->nextPageUrl()) . (request('search') ? '?search=' . urlencode(request('search')) : '') }}"
                        class="  w-7 sm:w-9 aspect-square p-2 sm:p-3 rounded-md bg-neutral-100 text-neutral-600 hover:bg-byolink-2 hover:text-white duration-300"
                        aria-label="Next Page">
                        <svg viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg"><path fill="none" d="M0 0h256v256H0z"></path><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="24" d="m96 48 80 80-80 80" class="stroke-000000"></path></svg>
                    </a>
                @endif

                {{-- Tombol ke Halaman Terakhir --}}
                @if ($currentPage < $lastPage)
                    <a href="{{ pageUrl($paginator->url($lastPage)) . (request('search') ? '?search=' . urlencode(request('search')) : '') }}"
                        class=" w-7 sm:w-9 aspect-square p-2 sm:p-3 rounded-md bg-neutral-100 text-neutral-600 hover:bg-byolink-2 hover:text-white duration-300"
                        aria-label="Last Page">
                        <svg viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg"><path fill="none" d="M0 0h256v256H0z"></path><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="24" d="m56 48 80 80-80 80M136 48l80 80-80 80" class="stroke-000000"></path></svg>
                    </a>
                @endif
            </nav>
        @endif
    </nav>
@endif
