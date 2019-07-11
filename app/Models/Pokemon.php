<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 * ポケモン
 *
 * Class Pokemon
 * @package App\Models
 */
class Pokemon extends Model
{
    use Searchable;

    protected $table = 'pokemon';
    protected $fillable = [ 'no', 'name', 'types', ];
    protected $casts = [ 'types' => 'json' ];

    /**
     * 検索可能なカラムの定義
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'id'    => $this->id,
            'no'    => $this->no,
            'name'  => $this->name,
        ];
    }
}
