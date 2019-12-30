<?php

namespace App\Jobs\Scraper;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GetFilmPageJob implements ShouldQueue
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
        $getUrl = explode("'", substr($this->data, 1))[0];
        $slug = substr($getUrl, 7);
        $picture = explode("'", explode("<img data-original='", $this->data)[1])[0];
        $filmPage = file_get_contents("https://idxx1.net" . $getUrl . "/play");

        GetFilmDataJob::dispatch($filmPage, $slug, $picture);
    }
}
