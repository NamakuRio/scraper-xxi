<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShortLink extends Model
{
    protected $fillable = ['link_from', 'link_to', 'visitor'];

    public function getRouteKeyName()
    {
        return 'link_to';
    }

    public function shortLinkDetails()
    {
        return $this->hasMany(ShortLinkDetail::class);
    }
}
