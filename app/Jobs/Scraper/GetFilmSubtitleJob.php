<?php

namespace App\Jobs\Scraper;

use App\Http\Controllers\ScraperController;
use App\Models\ShortLink;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GetFilmSubtitleJob implements ShouldQueue
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
        $newCode = ScraperController::generateCode(base64_encode($this->data['timestamps'] . $this->data['tmdb']) . $this->data['timestamps'] . $this->data['tmdb'] . ScraperController::generateCode($this->data['tmdb'] . $this->data['timestamps']));

        $url = 'https://playmv2.kotakcoklat.casa/?token=' . ScraperController::generateToken($this->data['cookie_name']) . '&t=' . $this->data['timestamps'] . '&k=' . $newCode . '&v=static8.js';

        $host = 'playmv.kotakcoklat.casa';
        $origin = 'https://idxx1.net';
        $referer = 'https://idxx1.net/movie/' . $this->data['slug'] . '/play';
        $headers = ScraperController::headers($host, $origin, $referer);

        $result = ScraperController::curl($url, $headers);

        $from = 'ZYX10+/PONM765LKJIAzyTSRQGxwvuHWVFEDUCBtsrqdcba9843ponmlkjihgfe2';
        $to = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/';
        $resultInJson = base64_decode(strtr($result[0], $from, $to));

        $cekArraySubtitle = count(json_decode($resultInJson)) - 1;

        $subtitleAll = json_decode($resultInJson, true)[$cekArraySubtitle];

        foreach ($subtitleAll as $key => $v) {
            Repeat: $random = Str::random(rand(6, 150));
            $cek = ShortLink::where('link_to', '=', $random)->count();

            if ($cek != 0) goto Repeat;

            $dataInsertShortLink = [
                'link_from' => $subtitleAll[$key]['file'],
                'link_to' => $random,
            ];

            $insertShortLink = ShortLink::create($dataInsertShortLink);

            $subtitleData = [
                'label' => $subtitleAll[$key]['label'],
                'file' => $random,
            ];

            InsertFilmSubtitleJob::dispatch($subtitleData, $this->film)->delay(now()->addSeconds($key));
        }
    }
}
