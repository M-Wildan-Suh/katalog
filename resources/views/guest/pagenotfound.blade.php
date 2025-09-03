<x-layout.guest title="WebMandiri - Page not Found" :category="$category">
    <div class=" w-full px-4 sm:px-8">
        <div class=" min-h-[calc(100vh-394px)] sm:min-h-[calc(100vh-363px)] w-full mx-auto max-w-[1080px] py-10 flex items-center justify-center text-center flex-col">
            <p>Error</p>
            <p class=" text-9xl sm:text-[160px] font-bold">404</p>
            <p class=" font-bold">Page Not Found</p>
        </div>
    </div>
    @include('components.guest.footer')
</x-layout.guest>