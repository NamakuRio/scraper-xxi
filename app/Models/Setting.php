<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['name', 'value', 'default_value', 'type', 'comment', 'required'];

    public function settingGroup()
    {
        return $this->belongsTo(SettingGroup::class);
    }
}
