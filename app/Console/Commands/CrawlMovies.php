<?php

namespace App\Console\Commands;

use App\Services\CommonService;
use App\Services\CrawlerService;
use Illuminate\Console\Command;
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
        $detail_url = Config::get('crawler.detail_url');
        // $pages = CrawlerService::getDataFromUrl($url . 1, false)['pagination']['totalPages'];
        $pages = 10;

        $this->info('Movies data is crawling.');
        
        if (CrawlerService::isBlockedByRobotsTxt($url)) {
            $this->error('Crawling is blocked by robots.txt');
            return;
        }
        
        for ($page = 1; $page <= $pages; $page++) {
            $movies = CrawlerService::getDataFromUrl($url . $page, false);
        
            if (empty($movies['items'])) {
                $this->warn("No data found on page {$page}. Skipping...");
                continue;
            }
        
            $this->info("Processing page {$page}...");
        
            $movieData = [];
        
            foreach ($movies['items'] as $movie) {
                $detailMovies = CrawlerService::getDataFromUrl($detail_url . $movie['slug'], false);

                
                $movieData[] = [
                    'id' => $movie['id'],
                    'title' => $movie['title'],
                    'description' => $movie['description'] ?? null,
                    'release_year' => $movie['year'] ?? null,
                    'rating' => $movie['rating'] ?? null,
                    'thumbnail' => $movie['thumb_url'] ?? null,
                    'IMDb',
                    'title_original',
                    'trailer_url',
                    'type',
                    'time',
                    'esp_total',
                    'esp_current',
                    'slug',
                    'produce_by',
                ];
            }
            
            dd($movieData);
            if (!empty($movieData)) {
                CommonService::getModel('Movies')->upsert($movieData, ['id']);
                $this->info("Page {$page} has been successfully processed.");
            }
        }
        

        $this->info('Movies data has been successfully crawled and stored.');
    }
}
