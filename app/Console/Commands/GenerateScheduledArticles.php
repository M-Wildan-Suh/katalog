<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\ArticleShow;
use App\Models\ArticleShowGallery;
use App\Models\SourceCode;
use Illuminate\Console\Command;

class GenerateScheduledArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'articles:generate-scheduled';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $articles = Article::where('schedule', true)->get();

        
        foreach ($articles as $article) {
            $alreadyGenerated = ArticleShow::where('article_id', $article->id)->count();
            $toGenerate = $article->generate_total;

            if ($toGenerate <= 0) continue;

            $this->generateArticle($article, $toGenerate); // hanya generate 1 artikel per hari per article
            $this->info("Generated 1 article for Article ID: {$article->id}");
        }
    }

    private function generateArticle($article, $total)
    {
        $maxAttempts = 10000;
        $attempts = 0;
        $savedCount = 0;

        while ($savedCount < $total && $attempts < $maxAttempts) {
            $spinnedTitle = $this->spinText($article->judul);
            $spinnedBody = $this->spinText($article->article);

            $combinedText = $spinnedTitle . ' ' . $spinnedBody;
            preg_match_all('/\[[^\]]+\]/', $combinedText, $matches);
            $tags = array_unique($matches[0] ?? []);

            foreach ($tags as $tag) {
                $source = SourceCode::where('title', $tag)->first();
                if ($source) {
                    $options = array_map('trim', explode(',', $source->content));
                    $replacement = $options[array_rand($options)];
                    $spinnedTitle = str_replace($tag, $replacement, $spinnedTitle);
                    $spinnedBody = str_replace($tag, $replacement, $spinnedBody);
                }
            }

            $spinnedBody = str_replace('[pa_judul]', $spinnedTitle, $spinnedBody);

            $isDuplicate = ArticleShow::where('judul', $spinnedTitle)
                ->orWhere('article', $spinnedBody)
                ->exists();

            if (!$isDuplicate) {
                $newArticleShow = new ArticleShow;
                $newArticleShow->article_id = $article->id;
                $newArticleShow->judul = $spinnedTitle;
                $newArticleShow->slug = ArticleShow::buildSlug($spinnedTitle, $article->article_type);
                $newArticleShow->article = $spinnedBody;
                $newArticleShow->template_id = optional($article->template->random())->id;
                $newArticleShow->banner = optional($article->articlebanner->random())->image;
                $newArticleShow->save();

                $galleries = $article->articlegallery->shuffle()->take(6);
                foreach ($galleries as $gallery) {
                    $showGallery = new ArticleShowGallery;
                    $showGallery->article_show_id = $newArticleShow->id;
                    $showGallery->article_gallery_id = $gallery->id;
                    $showGallery->image = $gallery->image;
                    $showGallery->image_alt = $gallery->image_alt;
                    $showGallery->save();
                }

                $savedCount++;
            }

            $attempts++;
        }
    }

    private function spinText($text)
    {
        while (preg_match('/\{([^{}]*)\}/', $text)) {
            $text = preg_replace_callback('/\{([^{}]*)\}/', function ($matches) {
                $options = explode('|', $matches[1]);
                return $options[array_rand($options)];
            }, $text);
        }

        return $text;
    }
}
