<?php

use Illuminate\Database\Seeder;

class Catalog extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('catalog_groups')->insert([
            'id' => '1',
            'parent_id' => '0',
            'status' => true,
            'alias' => 'mobile-devices',
            'name' => 'Мобильные устройства',
            'h1' => 'Мобильные устройства',
            'text' => '<b>Мобильные устройства</b><p>ТЕКСТ</p>',
            'image' => null,
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);

        DB::table('catalog_groups')->insert([
            'id' => '2',
            'parent_id' => '1',
            'status' => true,
            'alias' => 'smartphones',
            'name' => 'Смартфоны',
            'h1' => 'Смартфоны',
            'autogenerate_items_name' => 'Смартфон',
            'text' => '<b>Смартфоны</b><p>ТЕКСТ</p>',
            'image' => null,
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);

        DB::table('catalog_groups')->insert([
            'id' => '3',
            'parent_id' => '1',
            'status' => true,
            'alias' => 'tablets',
            'name' => 'Планшеты',
            'h1' => 'Планшеты',
            'autogenerate_items_name' => 'Планшет',
            'text' => '<b>Планшеты</b><p>ТЕКСТ</p>',
            'image' => null,
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);

        DB::table('catalog_groups')->insert([
            'id' => '4',
            'parent_id' => '0',
            'status' => true,
            'alias' => 'computer-technology',
            'name' => 'Компьютерная техника',
            'h1' => 'Компьютерная техника',
            'text' => '<b>Компьютерная техника</b><p>ТЕКСТ</p>',
            'image' => null,
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);

        DB::table('catalog_groups')->insert([
            'id' => '5',
            'parent_id' => '4',
            'status' => true,
            'alias' => 'personal-computers',
            'name' => 'Персональные компьютеры',
            'h1' => 'Персональные компьютеры',
            'autogenerate_items_name' => 'Персональный компьютер',
            'text' => '<b>Персональные компьютеры</b><p>ТЕКСТ</p>',
            'image' => null,
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);

        DB::table('catalog_groups')->insert([
            'id' => '6',
            'parent_id' => '4',
            'status' => true,
            'alias' => 'laptops',
            'name' => 'Ноутбуки',
            'autogenerate_items_name' => 'Ноутбук',
            'h1' => 'Ноутбуки',
            'text' => '<b>Ноутбуки</b><p>ТЕКСТ</p>',
            'image' => null,
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);

        DB::table('catalog_groups')->insert([
            'id' => '7',
            'parent_id' => '0',
            'status' => true,
            'alias' => 'appliances',
            'name' => 'Бытовая техника',
            'h1' => 'Бытовая техника',
            'text' => '<b>Бытовая техника</b><p>ТЕКСТ</p>',
            'image' => null,
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);

        DB::table('catalog_groups')->insert([
            'id' => '8',
            'parent_id' => '7',
            'status' => true,
            'alias' => 'televisions',
            'name' => 'Телевизоры',
            'h1' => 'Телевизоры',
            'autogenerate_items_name' => 'Телевизор',
            'text' => '<b>Телевизоры</b><p>ТЕКСТ</p>',
            'image' => null,
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);

        DB::table('catalog_groups')->insert([
            'id' => '9',
            'parent_id' => '7',
            'status' => true,
            'alias' => 'refrigerators',
            'name' => 'Холодильники',
            'h1' => 'Холодильники',
            'autogenerate_items_name' => 'Холодильник',
            'text' => '<b>Холодильники</b><p>ТЕКСТ</p>',
            'image' => null,
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);

        DB::table('catalog_groups')->insert([
            'id' => '10',
            'parent_id' => '7',
            'status' => true,
            'alias' => 'washing-machines',
            'name' => 'Стиральные машинки',
            'h1' => 'Стиральные машинки',
            'autogenerate_items_name' => 'Стиральная машинка',
            'text' => '<b>Стиральные машинки</b><p>ТЕКСТ</p>',
            'image' => null,
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);

        DB::table('catalog_groups')->insert([
            'id' => '11',
            'parent_id' => '0',
            'status' => true,
            'alias' => 'other-products',
            'name' => 'Другие товары',
            'h1' => 'Другие товары',
            'autogenerate_items_name' => '',
            'text' => '<b>Другие товары</b><p>ТЕКСТ</p>',
            'image' => null,
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);
    }
}
