<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
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
        DB::table('roles')->insert(['name' => 'salesman']);
        DB::table('roles')->insert(['name' => 'costumer']);
    }
}
