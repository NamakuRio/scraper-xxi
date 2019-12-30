<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilmFile extends Model
{
    protected $fillable = ['quality', 'google_drive_id', 'google_drive_link', 'link'];

    public function film()
    {
        return $this->belongsTo(Film::class);
    }
}
