<?php

namespace App\Jobs\Scraper;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GetFilmDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    protected $slug;
    protected $picture;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $slug, $picture)
    {
        error_reporting(0);
        $this->data = $data;
        $this->slug = $slug;
        $this->picture = $picture;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $title = explode('";', explode('var title = "', $this->data)[1])[0];
        $subtitle = explode('";', explode('var linksub="', $this->data)[1])[0];
        $tmdb = explode('"', explode('data-tmdb="', $this->data)[1])[0];
        $cookie_name = explode('";', explode('var cookie_name="', $this->data)[1])[0];
        $timestamps = explode(';', explode('ts2=', $this->data)[1])[0];

        $dataInsertFilm = [
            'title' => $title,
            'slug' => $this->slug,
            'picture' => $this->picture,
            'subtitle' => $subtitle,
            'tmdb' => $tmdb,
            'cookie_name' => $cookie_name,
            'timestamps' => $timestamps
        ];

        InsertFilmJob::dispatch($dataInsertFilm)->delay(now()->addSeconds(rand(60, 300)));
    }
}
