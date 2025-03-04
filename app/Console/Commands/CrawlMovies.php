<?php

namespace App\Console\Commands;

use App\Jobs\CrawlMovieJob;
use App\Services\CrawlerService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Config;
use App\Services\CommonService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Queue;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Support\Facades\Log;

class CrawlMovies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:crawl-movies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl movie data from API and store it in the database';

    /**
     * Execute the console command.
     */

    private int $successCount = 0;
    private int $failedCount = 0;

    public function handle()
    {
        $url = Config::get('crawler.movies_url');
        $pages = 10;
        $this->info('Starting movie data crawl...');

        if (CrawlerService::isBlockedByRobotsTxt($url)) {
            $this->error('Crawling is blocked by robots.txt');
            return;
        }

        $slugs = $this->getSlugs($pages);
        if (empty($slugs)) {
            $this->warn('No movie slugs found. Exiting...');
            return;
        }

        $totalMovies = count($slugs);
        $jobs = [];

        foreach ($slugs as $slug) {
            $jobs[] = new CrawlMovieJob($slug);
        }
        Queue::after(function (JobProcessed $event) {
            echo "Processing job for movie: {$event->job->getJobId()}\n";
        });
    
        Queue::failing(function (JobFailed $event) {
            Log::error("Job {$event->job->getJobId()} failed with error: " . $event->exception->getMessage());
        });

        if (!empty($jobs)) {
            Bus::batch($jobs)->dispatch();
            $this->info("Dispatched " . count($jobs) . " jobs to the queue.");
        }

        $this->info("Queue worker started!");
        exec('php artisan queue:work -vv --stop-when-empty');
        $this->info("Queue process completed!");

        $successRate = ($totalMovies > 0) ? ($this->successCount / $totalMovies) * 100 : 0;

        CommonService::getModel('CrawlMovieLog')->upsert([
            [
                'date' => Carbon::now(),
                'total_movies' => $totalMovies,
                'success' => $this->successCount,
                'failed' => $this->failedCount,
                'success_rate' => $successRate
            ]
        ], ['date'], ['total_movies', 'success', 'failed', 'success_rate']);

        $this->info('Crawling process completed.');
    }

    /**
     * Lấy danh sách slug từ nhiều trang
     */
    private function getSlugs($pages)
    {
        $slugs = [];
        $url = Config::get('crawler.movies_url');

        for ($page = 1; $page <= $pages; $page++) {
            $this->info("Fetching movie list from page {$page}...");

            $movies = CrawlerService::getDataFromUrl($url . $page, false);

            if (empty($movies['items'])) {
                $this->warn("No data found on page {$page}. Skipping...");
                continue;
            }

            foreach ($movies['items'] as $movie) {
                if (!empty($movie['slug'])) {
                    $slugs[] = $movie['slug'];
                }
            }
        }

        return $slugs;
    }
}
