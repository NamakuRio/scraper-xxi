<?php

namespace App\Http\Controllers;

use App\Jobs\InsertShortLinkJob;
use App\Models\Film;
use App\Models\FilmFile;
use App\Models\FilmSubtitle;
use App\Models\ShortLink;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;

class ShortLinkController extends Controller
{
    public function index()
    {
        return view('shortlink.index');
    }

    public function to(Request $request, ShortLink $shortLink)
    {
        DB::beginTransaction();
        try {
            $visitor = $shortLink->visitor + 1;

            $data = [
                'visitor' => $visitor,
            ];

            $updateVisitor = $shortLink->update($data);

            if (!$updateVisitor) {
                DB::rollback();
                return view('errors.404');
            }

            $agent = new Agent();

            $ip_address = $request->getClientIp();
            $device = $agent->device();
            $platform = $agent->platform();
            $browser = $agent->browser();

            $dataDetail = [
                'ip_address' => $ip_address,
                'device' => $device,
                'platform' => $platform,
                'browser' => $browser,
            ];

            $addDetail = $shortLink->shortLinkDetails()->create($dataDetail);

            if (!$addDetail) {
                DB::rollback();
                return view('errors.404');
            }

            DB::commit();
            return Redirect::to($shortLink->link_from);
        } catch (Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }
    }

    public function setShort()
    {
        InsertShortLinkJob::dispatch();
    }
}
