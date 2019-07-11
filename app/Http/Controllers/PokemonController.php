<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use App\Models\Type;

class PokemonController extends Controller
{
    public function search($keyword)
    {
        $response = Pokemon::search($keyword)->first();
        return response($response, 200);
    }

    public function affinity()
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

        foreach ($affinities as $key => $affinity) {
            $affinities[$key] = $affinity->collapse()->unique();
        }

        return response($affinities, 200);
    }
}
