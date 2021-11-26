<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(['name' => 'god']);
        DB::table('roles')->insert(['name' => 'admin']);
        DB::table('roles')->insert(['name' => 'costumer']);
    }
}
