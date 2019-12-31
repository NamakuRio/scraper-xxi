<?php

namespace App\Jobs\Scraper;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class InsertFilmFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    protected $film;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $film)
    {
        error_reporting(0);
        $this->data = $data;
        $this->film = $film;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $insertFilmFile = $this->film->filmFiles()->create($this->data)->delay(now()->addSeconds(60, 300));
    }
}
