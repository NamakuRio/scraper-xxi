<?php

namespace App\Jobs\Scraper;

use App\Http\Controllers\ScraperController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GetFilmFileJob implements ShouldQueue
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

        //cek drive
        if (strpos(json_decode($resultInJson, true)[0]['sources'][0]['file'], 'docs.') !== false) {
            $drive  = json_decode($resultInJson, true)[0]['sources'][0]['file'];
        } else if (strpos(json_decode($resultInJson, true)[1]['sources'][0]['file'], 'docs.') !== false) {
            $drive  = json_decode($resultInJson, true)[1]['sources'][0]['file'];
        } else {
            $drive  = 'nol';
        }

        if ($drive !== "nol") {
            if (!empty($this->data['timestamps'])) {
                $gDriveId = explode('?e=', explode('/*/', $drive)[1])[0];
                $newToken = ScraperController::generateCode(base64_encode($this->data['timestamps'] . $gDriveId) . $this->data['timestamps'] . $gDriveId . ScraperController::generateCode($gDriveId . $this->data['timestamps']));

                $url = 'https://playdrv3.kotakcoklat.casa/mv/?dv=' . urlencode($gDriveId) . '&ts=' . $this->data['timestamps'] . '&token=' . $newToken . '&hs=0&epi=0';

                $host = 'playdrv3.kotakcoklat.casa';
                $origin = 'https://idxx1.net';
                $referer = 'https://idxx1.net/movie/' . $this->data['slug'] . '/play';
                $headers = ScraperController::headers($host, $origin, $referer);

                $result = ScraperController::curl($url, $headers);


                foreach (json_decode($result[0], true)[0]['sources'] as $key => $v) {
                    $file = [
                        'quality' => json_decode($result[0], true)[0]['sources'][$key]['label'],
                        'google_drive_id' => explode('/*/', explode('?e=', json_decode($result[0], true)[0]['sources'][$key]['file'])[0])[1],
                        'google_drive_link' => 'https://drive.google.com/open?id=' . explode('/*/', explode('?e=', json_decode($result[0], true)[0]['sources'][$key]['file'])[0])[1],
                        'link' => json_decode($result[0], true)[0]['sources'][$key]['file']
                    ];

                    InsertFilmFileJob::dispatch($file, $this->film)->delay(now()->addSeconds($key));
                }
            }
        }
    }
}
