<?php

namespace App\Console\Commands;

use App\Models\Pokemon;
use Illuminate\Console\Command;

class MakePokemon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:pokemon';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new pokemon data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $file = file_get_contents(__DIR__ . '/jsons/kotofurumiya.pokemon.json');
        $file = mb_convert_encoding($file, 'UTF-8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
        $file = json_decode($file, true);

        $this->info('Data import now...');

        foreach ($file as $pokemon) {
            Pokemon::create([
                'no' => $pokemon['no'],
                'name' => $pokemon['name'],
                'types' => json_encode($pokemon['types'], JSON_UNESCAPED_UNICODE),
            ]);
        }

        $this->info('Data import success!');
    }
}
