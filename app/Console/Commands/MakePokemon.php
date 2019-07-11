<?php

namespace App\Console\Commands;

use App\Models\Pokemon;
use Illuminate\Console\Command;

/**
 * ポケモンデータを作成するコマンド
 *
 * Class MakePokemon
 * @package App\Console\Commands
 */
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
        $master1 = file_get_contents(__DIR__ . '/jsons/kotofurumiya.pokemon.json');
        $master1 = mb_convert_encoding($master1, 'UTF-8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
        $master1 = json_decode($master1, true);

        $master2 = file_get_contents(__DIR__ . '/jsons/fanzeyi.pokemon.json');
        $master2 = mb_convert_encoding($master2, 'UTF-8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
        $master2 = json_decode($master2, true);

        $this->info('Data import now...');

        foreach ($master1 as $pokemon) {
            Pokemon::create([
                'no'=> $pokemon['no'],
                'name'=> $pokemon['name'],
                'types'=> $pokemon['types'],
            ]);
        }

        foreach ($master2 as $pokemon) {
            Pokemon::where('no', $pokemon['id'])->update([
                'image' => str_pad($pokemon['id'], 3, 0, STR_PAD_LEFT) . $pokemon['name']['english'] . '.png',
            ]);
        }

        $this->info('Data import success!');
    }
}
