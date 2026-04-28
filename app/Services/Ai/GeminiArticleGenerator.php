<?php

namespace App\Services\Ai;

use App\Models\Article;
use App\Models\SourceCode;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class GeminiArticleGenerator
{
    public function generate(string $theme, string $articleType, array $selectedSourceCodes = []): array
    {
        $apiKey = (string) config('services.gemini.api_key');
        $model = (string) config('services.gemini.model', 'gemini-2.5-flash');
        $baseUrl = rtrim((string) config('services.gemini.base_url', 'https://generativelanguage.googleapis.com/v1beta'), '/');
        $timeout = (int) config('services.gemini.timeout', 60);

        if ($apiKey === '') {
            throw new RuntimeException('GEMINI_API_KEY belum diatur.');
        }

        $response = Http::timeout($timeout)
            ->acceptJson()
            ->withHeaders([
                'x-goog-api-key' => $apiKey,
            ])
            ->post($baseUrl . '/models/' . $model . ':generateContent', [
                'contents' => [[
                    'role' => 'user',
                    'parts' => [[
                        'text' => $this->buildPrompt($theme, $articleType, $selectedSourceCodes),
                    ]],
                ]],
                'generationConfig' => [
                    'responseMimeType' => 'application/json',
                    'responseJsonSchema' => $this->responseSchema(),
                ],
            ]);

        if ($response->failed()) {
            $message = $response->json('error.message')
                ?? $response->body()
                ?? 'Permintaan ke Gemini gagal.';

            throw new RuntimeException('Gemini gagal merespons: ' . $message);
        }

        $text = collect($response->json('candidates.0.content.parts', []))
            ->pluck('text')
            ->filter()
            ->implode('');

        if ($text === '') {
            throw new RuntimeException('Gemini tidak mengembalikan konten artikel.');
        }

        $decoded = json_decode($text, true);

        if (!is_array($decoded)) {
            throw new RuntimeException('Format respons Gemini tidak valid.');
        }

        return $this->normalize($decoded, $articleType, $theme);
    }

    private function buildPrompt(string $theme, string $articleType, array $selectedSourceCodes = []): string
    {
        $isSpintax = $articleType === 'spintax';
        $contentStyle = $isSpintax
            ? 'Tulis artikel HTML dengan gaya spintax ringan dan natural. Gunakan variasi seperlunya dengan format {opsi1|opsi2} hanya pada beberapa frasa penting, jangan berlebihan, dan tetap mudah dibaca.'
            : 'Tulis artikel HTML final yang natural, rapi, siap edit, dan tidak menggunakan spintax.';

        $sourceCodeInstruction = $isSpintax
            ? $this->buildSourceCodeInstruction($selectedSourceCodes)
            : null;

        return implode("\n\n", array_filter([
            'Anda adalah penulis artikel website bisnis berbahasa Indonesia.',
            'Buat keluaran JSON valid tanpa markdown dan tanpa teks tambahan.',
            $contentStyle,
            'Tema artikel: ' . $theme,
            $sourceCodeInstruction,
            'Instruksi artikel:',
            '- Buat judul yang menarik dan relevan.',
            '- Buat 3 sampai 6 kategori yang singkat dan relevan.',
            '- Buat 5 sampai 8 tag yang singkat dan relevan.',
            '- Isi artikel dalam format HTML sederhana seperti <p>, <h2>, <h3>, <ul>, <li>.',
            '- Fokus pada manfaat, penjelasan layanan/produk, dan call to action halus.',
            '- Hindari klaim bombastis, angka palsu, dan karakter yang sulit dipakai di HTML editor.',
            '- Jangan sertakan pembuka atau penutup di luar JSON.',
        ]));
    }

    private function responseSchema(): array
    {
        return [
            'type' => 'object',
            'properties' => [
                'judul' => [
                    'type' => 'string',
                ],
                'article' => [
                    'type' => 'string',
                ],
                'category' => [
                    'type' => 'array',
                    'items' => [
                        'type' => 'string',
                    ],
                ],
                'tag' => [
                    'type' => 'array',
                    'items' => [
                        'type' => 'string',
                    ],
                ],
            ],
            'required' => ['judul', 'article', 'category', 'tag'],
        ];
    }

    private function normalize(array $decoded, string $articleType, string $theme): array
    {
        $title = trim((string) ($decoded['judul'] ?? ''));
        $article = trim((string) ($decoded['article'] ?? ''));

        if ($title === '' || $article === '') {
            throw new RuntimeException('Gemini belum mengembalikan judul atau isi artikel yang valid.');
        }

        return [
            'judul' => $title,
            'article' => $article,
            'category' => $this->normalizeTextList($decoded['category'] ?? [], 6),
            'tag' => $this->normalizeTextList($decoded['tag'] ?? [], 8),
            'type' => $articleType,
            'tema' => $theme,
            'price' => Article::TYPE_ARTICLE_UNIQUE === $articleType ? 0 : 0,
        ];
    }

    private function normalizeTextList(mixed $items, int $limit): array
    {
        if (!is_array($items)) {
            return [];
        }

        return collect($items)
            ->map(fn ($item) => trim((string) $item))
            ->filter()
            ->unique(fn ($item) => mb_strtolower($item))
            ->take($limit)
            ->values()
            ->all();
    }

    private function buildSourceCodeInstruction(array $selectedSourceCodes): ?string
    {
        /** @var SourceCode|null $barang */
        $barang = $selectedSourceCodes['barang'] ?? null;
        /** @var SourceCode|null $lokasi */
        $lokasi = $selectedSourceCodes['lokasi'] ?? null;

        if (!$barang || !$lokasi) {
            return 'Untuk artikel spintax, gunakan shortcode yang relevan bila tersedia.';
        }

        $barangList = $this->excerptSourceCodeContent($barang->content);
        $lokasiList = $this->excerptSourceCodeContent($lokasi->content);

        return implode("\n", [
            'Gunakan dua source code berikut di dalam artikel spintax:',
            '- Barang: [' . $barang->title . ']',
            '  Contoh isi source code barang: ' . $barangList,
            '- Lokasi: [' . $lokasi->title . ']',
            '  Contoh isi source code lokasi: ' . $lokasiList,
            '- Sisipkan shortcode [' . $barang->title . '] dan [' . $lokasi->title . '] secara natural pada judul atau isi artikel.',
            '- Jangan ganti nama shortcode. Gunakan persis dengan format kurung siku.',
            '- Tetap hasilkan HTML yang rapi dan mudah diproses editor.',
        ]);
    }

    private function excerptSourceCodeContent(string $content): string
    {
        $items = collect(explode(',', $content))
            ->map(fn ($item) => trim($item))
            ->filter()
            ->take(6)
            ->values()
            ->all();

        if ($items === []) {
            return '-';
        }

        return implode(', ', $items);
    }
}
