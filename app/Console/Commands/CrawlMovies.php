<?php

namespace App\Console\Commands;

use App\Jobs\CrawlMovieJob;
use App\Services\CommonService;
use App\Services\CrawlerService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Config;

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
    public function handle()
    {
        $url = Config::get('crawler.movies_url');

        $pages = 10; // Giới hạn số trang crawl

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

        $batch = Bus::batch([])->dispatch();
        foreach ($slugs as $slug) {
            try {
                $batch->add(new CrawlMovieJob($slug));
                $this->info("Job dispatched for slug: {$slug}");
            } catch (\Exception $e) {
                $this->error("Failed to dispatch job for slug: {$slug}. Error: " . $e->getMessage());
            }
        }

        $this->info('All movies have been dispatched to the queue.');
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
