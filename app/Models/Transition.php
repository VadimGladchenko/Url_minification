<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transition extends Model
{
    protected $fillable = [
        'url_id', 'browser', 'country', 'operating_system',
    ];
}
