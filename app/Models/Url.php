<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $fillable = [
        'base_url', 'short_url', 'expired_date', 'is_custom',
    ];


    public static function isShortUrlExist($shortLink) {
        return !empty(Url::where('short_url', $shortLink)->first());
    }
}
