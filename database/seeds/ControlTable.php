<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ControlTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('control')->insert([
            'id' => '1',
            'status' => true,
            'alias' => 'home',
            'name' => 'Home',
            'h1' => 'Home',
            'text' => 'Homepage',
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);

    }
}
