@php
    preg_match('/<(p|div)[^>]*>(.*?)<\/\1>/is', $data->article, $matches);
    $firstBlock = $matches[2] ?? $data->article;

    $cleanText = strip_tags($firstBlock);

    // Hapus &nbsp; dan decode entity lain seperti &amp;, &quot;, dll
    $cleanText = str_replace('&nbsp;', ' ', $cleanText);
    $cleanText = html_entity_decode($cleanText, ENT_QUOTES | ENT_HTML5);

    $sentence = Str::limit(trim($cleanText), 155);
@endphp
<x-layout.guest :title="$data->judul. ' - Catalog'" :desc="$sentence" :tags="$data->articles->articletag" :category="$category">
    <div class=" background w-full">
        {{-- Header --}}
        @include('components.guest.header.'.$template->head_type)
        <div class=" w-full pt-4 px-4 sm:pt-6 sm:px-6 pb-2 space-y-4 sm:space-y-6">
            @if ($data->articleshowgallery->isNotEmpty())
                {{-- Gallery --}}
                @include('components.guest.gallery.'. $template->gallery_type)
            @endif
            
            {{-- Video --}}
            @if ($data->articles->video_type != 'none')  
                @include('components.guest.'.$data->articles->video_type)
            @endif
            
            {{-- Description --}}
            <x-guest.description :template="$template" :data="$data"/>
            
            {{-- Related --}}
            <div class=" w-full max-w-[600px] mx-auto space-y-4">
                <div style="background-color: {{ $template->desc_main_color ?? 'white' }}; color: {{ $template->desc_text_color }}" class=" w-auto p-4 text-base sm:text-xl font-bold rounded-md shadow-md">Pilihan Desain Lainnya</div>
                <div class=" w-full grid grid-cols-2  gap-4">
                    @foreach ($related as $item)
                        @include('components.guest.item')
                    @endforeach
                </div>
            </div>
        </div>
        {{-- Contact --}}
        @include('components.guest.contact.one')
    </div>
    @if (Auth::user())    
        <a href="{{$data->articles->article_type === 'spintax' ? route('article-generated.show', ['article_generated' => $data->id]) : route('article-show.show', ['article_show' => $data->id])}}" target="__blank">
            <button class=" fixed top-24 right-8 bg-white text-black font-semibold hover:bg-byolink-1 hover:text-white duration-300 px-4 py-2 rounded-full">Edit</button>
        </a>
    @endif
    <style>
        .background {
            @if ($template->bg_type === 'normal')
                background-color: {{ $template->bg_main_color }};
            @elseif ($template->bg_type === 'gradient')
                background: linear-gradient(to bottom, {{ $template->bg_main_color }}, {{ $template->bg_second_color }});
            @elseif ($template->bg_type === 'image')
                background-image: url('{{ asset('storage/images/template/background/'.$template->bg_image) }}');
                background-size: cover;
                background-position: center;
            @endif
        };
    </style>
</x-layout.guest>