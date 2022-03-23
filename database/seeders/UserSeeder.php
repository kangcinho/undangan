<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Ferry Suryawan",
            'username' => "sangusername",
            'password' => Hash::make('passwordQ1W2E3R4T5Y6'),
        ]);
    }
}
