<?php

namespace App\Jobs;

use App\Models\Film;
use App\Models\FilmFile;
use App\Models\FilmSubtitle;
use App\Models\ShortLink;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InsertShortLinkJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $records = FilmSubtitle::offset(0)->limit(50000)->get();

        foreach ($records as $key => $record) {
            DB::beginTransaction();
            try {
                echo $record->id . ' ';

                $cekDuls = ShortLink::where('link_to', '=', $record->file)->count();
                if ($cekDuls != 0) {
                    DB::rollback();
                    echo " Udah ada";
                    echo "<br><br>";
                    continue;
                }

                Repeat: $random = Str::random(rand(6, 150));
                $cek = ShortLink::where('link_to', '=', $random)->count();
                if ($cek != 0) goto Repeat;

                $dataInsertShortLink = [
                    'link_from' => $record->file,
                    'link_to' => $random,
                ];

                $insertShortLink = ShortLink::create($dataInsertShortLink);

                if (!$insertShortLink) {
                    DB::rollback();
                    echo 'Gagal menambahkan shortlink';
                }

                $dataUpdateFilm = [
                    'file' => $random,
                ];

                $updateFilm = $record->update($dataUpdateFilm);

                if (!$updateFilm) {
                    DB::rollback();
                    echo 'Gagal update shortlink film';
                }

                DB::commit();
                echo 'Berhasil menyimpan data';
            } catch (Exception $e) {
                DB::rollback();
                echo $e->getMessage() . '';
            }
            echo "<br><br>";
        }
    }
}
