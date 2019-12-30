<?php

namespace App\Http\Controllers;

use App\Jobs\Scraper\GetHtmlListOfPageJob;
use Illuminate\Http\Request;

class ScraperController extends Controller
{
    public function index()
    {
        $url = "https://idxx1.net/21cineplex/";

        $delimiter1 = '<div id="movie-featured" class="movies-list movies-list-full tab-pane in fade active">';
        $delimiter2 = '<div style="clear:both;">';
        $delimiter3 = '<div data-movie-id=';

        $loop = true;
        $from = 1;
        $to = 134;

        GetHtmlListOfPageJob::dispatch($url, $delimiter1, $delimiter2, $delimiter3, $loop, $from, $to);
    }

    public static function generateCode($e)
    {
        $t = 0;
        $i = 0;
        $o = 0;
        for ($s = strlen($e); $o < $s; $o++) {
            $o % 2 == 0 ? $t += ord($e[$o]) : $i += ord($e[$o]);
        }
        return $t * ($t + $i) * abs($t - $i);
    }

    public static function generateToken($token)
    {
        $newString  =  '';
        $str = $token;
        for ($i = 0; $i < strlen($str); $i++) {
            if (!is_numeric($str[$i])) {
                $stringufy  =  $str[$i];
                $newString  .=  ++$stringufy;
            } else {
                $newString  .=  $str[$i];
            }
        }

        return $newString;
    }

    public static function curl($url, $headers)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result   = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return array($result, $httpcode);
    }

    public static function headers($host, $origin, $referer)
    {
        $headers = array();
        $headers[] = 'Host: '.$host.'';
        $headers[] = 'Accept: */*';
        $headers[] = 'Origin: '.$origin.'';
        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36';
        $headers[] = 'Sec-Fetch-Site: cross-site';
        $headers[] = 'Sec-Fetch-Mode: cors';
        $headers[] = 'Referer: '.$referer.'';
        $headers[] = 'Accept-Language: en-US,en;q=0.9,id;q=0.8,und;q=0.7,ms;q=0.6';

        return $headers;
    }
}
