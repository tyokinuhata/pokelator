<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use App\Models\Type;

/**
 * /api/pokemon/ 以下のAPIを置いている
 *
 * Class PokemonController
 * @package App\Http\Controllers
 */
class PokemonController extends Controller
{
    /**
     * ポケモンの検索
     *
     * @param $keyword
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function searchPokemon($keyword)
    {
        $response = Pokemon::search($keyword)->first();
        return response($response, 200);
    }

    /**
     * ポケモンのタイプに対するわざの相性を取得
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function fetchAffinities()
    {
        $types = request()->types;

        $affinities = [
            'good'      => collect([]),
            'normal'    => collect([]),
            'poor'      => collect([]),
            'bad'       => collect([]),
        ];

        foreach ($types as $type) {
            $type = Type::where('name', $type)->first();

            $affinities['good']->push($type->good);
            $affinities['normal']->push($type->normal);
            $affinities['poor']->push($type->poor);
            $affinities['bad']->push($type->bad);
        }

        foreach ($affinities as $key => $type) {
            $affinities[$key] = $type->collapse()->unique();
        }

        return response($affinities, 200);
    }
}
