<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Pokemon extends Model
{
    use Searchable;

    protected $table = 'pokemon';
    protected $fillable = [ 'no', 'name', 'types', ];
    protected $casts = [ 'types' => 'json' ];

    public function toSearchableArray()
    {
        return [
            'id'    => $this->id,
            'no'    => $this->no,
            'name'  => $this->name,
        ];
    }
}
