<?php

namespace App\Console\Commands;

use App\Models\Type;
use Illuminate\Console\Command;

/**
 * ポケモンのタイプを作成するコマンド
 *
 * Class MakeTypes
 * @package App\Console\Commands
 */
class MakeTypes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:types';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new types data';

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
        $file = file_get_contents(__DIR__ . '/jsons/fanzeyi.types.json');
        $file = mb_convert_encoding($file, 'UTF-8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
        $file = json_decode($file, true);

        $this->info('Data import now...');

        foreach ($file as $type) {
            Type::create([
                'name'      => $type['japanese'],
                'good'      => $type['good'],
                'normal'    => $type['normal'],
                'poor'      => $type['poor'],
                'bad'       => $type['bad'],
            ]);
        }

        $this->info('Data import success!');
    }
}
