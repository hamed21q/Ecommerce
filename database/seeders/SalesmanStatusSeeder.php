<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SalesmanStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('salesman_status')->insert(['status' => 'in_wait']);
        DB::table('salesman_status')->insert(['status' => 'confirmed']);
        DB::table('salesman_status')->insert(['status' => 'rejected']);
    }
}
