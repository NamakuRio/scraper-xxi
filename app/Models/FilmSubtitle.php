<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilmSubtitle extends Model
{
    protected $fillable = ['label', 'file'];

    public function film()
    {
        return $this->belongsTo(Film::class);
    }
}
