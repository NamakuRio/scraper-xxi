<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShortLinkDetail extends Model
{
    protected $fillable = ['ip_address', 'device', 'platform', 'browser'];

    public function shortLink()
    {
        return $this->belongsTo(ShortLink::class);
    }
}
