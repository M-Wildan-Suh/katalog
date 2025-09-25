<x-layout.guest title="WebMandiri - Desain" :category="$category">
    <div class=" w-full min-h-[calc(100vh-370px)]">
        <div class=" w-full py-8 sm:py-12 px-4 sm:px-6 space-y-12 sm:space-y-24">
            <div class=" w-full max-w-[1080px] mx-auto">
                <div class=" w-full space-y-6 sm:space-y-8">
                    <div class="w-full flex justify-between items-center">
                        <div style='font-family: "Montserrat", Sans-serif;' class=" w-full flex flex-col items-center sm:gap-4">
                            {{-- <p class=" text-base sm:text-xl font-bold text-center">Template</p> --}}
                            <p class=" text-xl sm:text-3xl font-bold text-center">{{$title}}</p>
                        </div>
                    </div>
                    <div id="desain" class=" w-full grid grid-cols-2 md:grid-cols-4 gap-4">
                        @include('components.guest.product')
                    </div>
                    <div id="loader" class=" w-full flex justify-center">
                        <div class=" animate-spin w-12 h-12 text-byolink-1">
                            <svg fill="none" class=" w-full h-full" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg"><path d="M4 24C4 35.0457 12.9543 44 24 44C35.0457 44 44 35.0457 44 24C44 12.9543 35.0457 4 24 4" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="4"/></svg>
                        </div>
                    </div>
                    <script>
                        let page = 2;
                        let loading = false;

                        function showLoader() {
                            loading = true;
                            document.getElementById("loader").classList.remove("hidden");
                        }

                        function hideLoader() {
                            loading = false;
                            document.getElementById("loader").classList.add("hidden");
                        }
        
                        document.addEventListener("DOMContentLoaded", () => {
                            const loader = document.getElementById("loader");
        
                            const search = "{!! request('search') ? '&search=' . urlencode(request('search')) : '' !!}";
                            let loading = false;
                            let page = 2; // kalau halaman awal = 1
        
                            function loadMoreData() {
                                if (loading) return;
                                loading = true;
                                showLoader();
        
                                fetch(`?page=${page}${search}`, {
                                        headers: {
                                            "X-Requested-With": "XMLHttpRequest"
                                        }
                                    })
                                    .then(response => response.text())
                                    .then(html => {
                                        setTimeout(() => {
                                            if (html.trim() !== "") {
                                                document
                                                    .getElementById("desain")
                                                    .insertAdjacentHTML("beforeend", html);
        
                                                page++;
                                                loading = false;
                                                hideLoader();
                                            } else {
                                                observer.disconnect();
                                                loading = false;
                                                hideLoader();
                                            }
                                        }, 500);
                                    })
                                    .catch(() => {
                                        loading = false;
                                        hideLoader();
                                    });
                            }
        
                            // Observer untuk mendeteksi ketika loader terlihat
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
        </div>
    </div>
    @include('components.guest.footer')
</x-layout.guest>