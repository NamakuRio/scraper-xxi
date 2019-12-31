<?php

namespace App\Jobs\Scraper;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GetHtmlListOfPageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $url;
    protected $delimiter1;
    protected $delimiter2;
    protected $delimiter3;
    protected $loop;
    protected $from;
    protected $to;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($url, $delimiter1, $delimiter2, $delimiter3, $loop = false, $from = 0, $to = 0)
    {
        error_reporting(0);
        $this->url = $url;
        $this->delimiter1 = $delimiter1;
        $this->delimiter2 = $delimiter2;
        $this->delimiter3 = $delimiter3;
        $this->loop = $loop;
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->loop) {
            for ($i = $this->from; $i <= $this->to; $i++) {
                $url = $this->url . $i;
                GetHtmlListOfPageJob::dispatch($url, $this->delimiter1, $this->delimiter2, $this->delimiter3)->delay(now()->addSeconds($i));

                sleep(5);
            }
        } else {
            $getHtmlListOfPage = file_get_contents($this->url);
            GetContentListJob::dispatch($getHtmlListOfPage, $this->delimiter1, $this->delimiter2, $this->delimiter3)->delay(now()->addSeconds(rand(60, 300)));
        }
    }
}
