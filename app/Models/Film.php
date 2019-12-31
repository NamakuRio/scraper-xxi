<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $fillable = ['title', 'slug', 'picture', 'subtitle', 'tmdb', 'cookie_name', 'timestamps'];

    public function scopePicture()
    {
        return ($this->picture ? "<img src=\"$this->picture\" alt=\"$this->title\" width=\"150\" height=\"150\">" : "<img src=\"".@asset('uploads/film/picture/default.png')."\" alt=\"$this->title\">");
    }

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
