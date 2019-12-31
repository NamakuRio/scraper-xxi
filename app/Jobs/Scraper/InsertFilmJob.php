<?php

namespace App\Jobs\Scraper;

use App\Models\Film;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class InsertFilmJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        error_reporting(0);
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $insertFilm = Film::create($this->data);

        GetFilmSubtitleJob::dispatch($this->data, $insertFilm)->delay(now()->addSeconds(rand(60, 300)));
        GetFilmFileJob::dispatch($this->data, $insertFilm)->delay(now()->addSeconds(rand(60, 300)));
    }
}
