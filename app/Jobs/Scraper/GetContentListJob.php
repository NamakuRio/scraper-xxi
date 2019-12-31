<?php

namespace App\Jobs\Scraper;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GetContentListJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    protected $delimiter1;
    protected $delimiter2;
    protected $delimiter3;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $delimiter1, $delimiter2, $delimiter3)
    {
        error_reporting(0);
        $this->data = $data;
        $this->delimiter1 = $delimiter1;
        $this->delimiter2 = $delimiter2;
        $this->delimiter3 = $delimiter3;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $getContentList = explode($this->delimiter1, $this->data)[1];
        $closeExplodeListContent = explode($this->delimiter2, $getContentList)[0];

        foreach (explode($this->delimiter3, $closeExplodeListContent) as $key => $v) {
            if ($key == 0) continue;

            GetFilmPageJob::dispatch($v)->delay(now()->addSeconds($key));

            sleep(5);
        }
    }
}
