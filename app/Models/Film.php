<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $fillable = ['title', 'slug', 'picture', 'subtitle', 'tmdb', 'cookie_name', 'timestamps'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function filmFiles()
    {
        return $this->hasMany(FilmFile::class);
    }

    public function filmSubtitles()
    {
        return $this->hasMany(FilmSubtitle::class);
    }
}
