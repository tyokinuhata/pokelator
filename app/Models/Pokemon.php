<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Pokemon extends Model
{
    use Searchable;

    protected $table = 'pokemon';
    protected $fillable = [ 'no', 'name', 'types', ];
}
