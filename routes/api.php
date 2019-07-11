<?php

Route::get('/pokemon/search/{keyword}', 'PokemonController@search');
Route::get('/pokemon/affinity', 'PokemonController@affinity');