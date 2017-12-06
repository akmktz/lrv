<?php

use Illuminate\Database\Seeder;

class Pages extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages_system')->insert([
            'id' => '1',
            'status' => true,
            'alias' => 'home',
            'name' => 'Home',
            'h1' => 'Home',
            'text' => 'Homepage',
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);

        DB::table('pages_system')->insert([
            'id' => '2',
            'status' => true,
            'alias' => 'products',
            'name' => 'Products',
            'h1' => 'Products',
            'text' => 'Products',
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);
    }
}
