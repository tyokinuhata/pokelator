<?php

// ポケモンの検索
Route::get('/pokemon/search/{keyword}', 'PokemonController@searchPokemon');

// ポケモンのタイプに対するわざの相性を取得
Route::get('/pokemon/affinity', 'PokemonController@fetchAffinities');