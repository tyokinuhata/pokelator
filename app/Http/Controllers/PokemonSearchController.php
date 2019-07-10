<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;

class PokemonSearchController extends Controller
{
    public function search($keyword)
    {
        $response = Pokemon::search($keyword)->first();
        return response($response, 200);
    }
}
