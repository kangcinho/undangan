<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class ThemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('themes')->insert(
            [
                'nama' => "Tema 1",
                'url' => "tema1.thema1"
            ]
        );
        DB::table('themes')->insert(
            [
                'nama' => "Tema 2",
                'url' => "tema2.thema2"
            ],
        );
    }
}
