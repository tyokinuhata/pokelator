<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = ['name', 'good', 'normal', 'poor', 'bad'];

    protected $casts = [
        'good'      => 'json',
        'normal'    => 'json',
        'poor'      => 'json',
        'bad'       => 'json',
    ];
}
