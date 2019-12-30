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

        InsertFilmJob::dispatch($dataInsertFilm);

        // $newCode = ScraperController::generateCode(base64_encode($timestamps . $tmdb) . $timestamps . $tmdb . ScraperController::generateCode($tmdb . $timestamps));

        // $url = 'https://playmv2.kotakcoklat.casa/?token=' . ScraperController::generateToken($cookie_name) . '&t=' . $timestamps . '&k=' . $newCode . '&v=static8.js';

        // $host = 'playmv.kotakcoklat.casa';
        // $origin = 'https://idxx1.net';
        // $referer = 'https://idxx1.net/movie/' . $this->slug . '/play';
        // $headers = ScraperController::headers($host, $origin, $referer);

        // $result = ScraperController::curl($url, $headers);

        // $from = 'ZYX10+/PONM765LKJIAzyTSRQGxwvuHWVFEDUCBtsrqdcba9843ponmlkjihgfe2';
        // $to = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/';
        // $resultInJson = base64_decode(strtr($result[0], $from, $to));

        // //cek drive
        // if (strpos(json_decode($resultInJson, true)[0]['sources'][0]['file'], 'docs.') !== false) {
        //     $drive  = json_decode($resultInJson, true)[0]['sources'][0]['file'];
        // } else if (strpos(json_decode($resultInJson, true)[1]['sources'][0]['file'], 'docs.') !== false) {
        //     $drive  = json_decode($resultInJson, true)[1]['sources'][0]['file'];
        // } else {
        //     $drive  = 'nol';
        // }

        // $cekArraySubtitle = count(json_decode($resultInJson)) -1;

        // $subtitleAll = json_decode($resultInJson, true)[$cekArraySubtitle];
        // $subtitleData = [];

        // foreach($subtitleAll as $key => $v){
        //     $subtitleData = [
        //         'label' => $subtitleAll[$key]['label'],
        //         'file' => $subtitleAll[$key]['file'],
        //     ];
        // }

        // if ($drive !== "nol") {
        //     if (!empty($timestamps)) {
        //         $gDriveId = explode('?e=', explode('/*/', $drive)[1])[0];
        //         $newToken = ScraperController::generateCode(base64_encode($timestamps . $gDriveId) . $timestamps . $gDriveId . ScraperController::generateCode($gDriveId . $timestamps));

        //         $url = 'https://playdrv3.kotakcoklat.casa/mv/?dv=' . urlencode($gDriveId) . '&ts=' . $timestamps . '&token=' . $newToken . '&hs=0&epi=0';

        //         $host = 'playdrv3.kotakcoklat.casa';
        //         $origin = 'https://idxx1.net';
        //         $referer = 'https://idxx1.net/movie/' . $this->slug . '/play';
        //         $headers = ScraperController::headers($host, $origin, $referer);

        //         $result = ScraperController::curl($url, $headers);

        //         $file = [];

        //         foreach(json_decode($result, true)[0]['sources'] as $key => $v){
        //             $file = [
        //                 'quality' => json_decode($result, true)[0]['sources'][$key]['label'],
        //                 'google_drive_id' => explode('/*/', json_decode($result, true)[0]['sources'][$key]['file'][0])[1],
        //                 'google_drive_link' =>'https://drive.google.com/open?id='.explode('/*/', json_decode($result, true)[0]['sources'][$key]['file'][0])[1],
        //                 'link' => json_decode($result, true)[0]['sources'][$key]['file']
        //             ];
        //         }
        //     }
        // }
    }
}
