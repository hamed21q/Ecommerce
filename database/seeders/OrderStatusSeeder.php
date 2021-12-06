<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_status')->insert(['status' => 'proccessing']);
        DB::table('order_status')->insert(['status' => 'sending']);
        DB::table('order_status')->insert(['status' => 'deliverd']);
        DB::table('order_status')->insert(['status' => 'canseled']);
    }
}
