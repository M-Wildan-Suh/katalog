<?php

namespace App\Http\Middleware;

use App\Models\Article;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class DailyScheduleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $cacheKey = 'daily_schedule_run_' . now()->toDateString();

        if (!Cache::has($cacheKey)) {
            $this->processScheduledData();

            Cache::put($cacheKey, true, now()->addDay());
        }

        return $next($request);
    }

    protected function processScheduledData()
    {
        // Contoh logika proses:
        $article = Article::where('schedule', true)->get();

        foreach ($article as $item) {
            if ($item->article_type === Article::TYPE_SPINTAX) {
                $scheduledArticles = $item->articleshow()->where('status', 'schedule')->get();

                if ($scheduledArticles->isNotEmpty()) {
                    // Tentukan jumlah random antara 5 sampai 20
                    $countToPublish = rand(5, 20);

                    // Ambil data secara random
                    $articlesToPublish = $scheduledArticles->shuffle()->take($countToPublish);

                    foreach ($articlesToPublish as $articleshow) {
                        $articleshow->status = 'publish';
                        $articleshow->created_at = now();
                        $articleshow->save();
                    }
                }

                // Cek lagi apakah masih ada yang status 'schedule'
                if ($item->articleshow()->where('status', 'schedule')->doesntExist()) {
                    $item->schedule = false;
                }
            } elseif ($item->isCatalogType()) {
                $articleshow = $item->articleshow->first();

                if (now()->gte($articleshow->created_at)) {
                    $articleshow->status = 'publish';

                    $articleshow->save();
                    
                    $item->schedule = false;

                }
            }
            $item->save();
        }
        // Untuk debug, bisa log juga
        Log::info('Scheduled items processed at ' . now());
    }
}
