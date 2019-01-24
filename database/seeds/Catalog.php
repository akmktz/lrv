<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class Catalog extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private $groupsTable = 'catalog_groups';
    private $itemsTable = 'catalog_items';

    public function run()
    {
        //DB::table($this->groupsTable)->delete();

        $groups = [
            [
                'id' => '1',
                'parent_id' => '0',
                'alias' => 'mobile-devices',
                'name' => 'Мобильные устройства',
                'text' => '<b>Мобильные устройства</b><p>ТЕКСТ</p>',
            ],
            [
                'id' => '2',
                'parent_id' => '1',
                'alias' => 'smartphones',
                'name' => 'Смартфоны',
                'autogenerate_items_name' => 'Смартфон',
                'text' => '<b>Смартфоны</b><p>ТЕКСТ</p>',
            ],
            [
                'id' => '3',
                'parent_id' => '1',
                'alias' => 'tablets',
                'name' => 'Планшеты',
                'autogenerate_items_name' => 'Планшет',
                'text' => '<b>Планшеты</b><p>ТЕКСТ</p>',
            ],
            [
                'id' => '4',
                'parent_id' => '0',
                'alias' => 'computer-technology',
                'name' => 'Компьютерная техника',
                'text' => '<b>Компьютерная техника</b><p>ТЕКСТ</p>',
            ],
            [
                'id' => '5',
                'parent_id' => '4',
                'alias' => 'personal-computers',
                'name' => 'Персональные компьютеры',
                'autogenerate_items_name' => 'Персональный компьютер',
                'text' => '<b>Персональные компьютеры</b><p>ТЕКСТ</p>',
            ],
            [
                'id' => '6',
                'parent_id' => '4',
                'alias' => 'laptops',
                'name' => 'Ноутбуки',
                'autogenerate_items_name' => 'Ноутбук',
                'text' => '<b>Ноутбуки</b><p>ТЕКСТ</p>',
            ],
            [
                'id' => '7',
                'parent_id' => '0',
                'alias' => 'appliances',
                'name' => 'Бытовая техника',
                'text' => '<b>Бытовая техника</b><p>ТЕКСТ</p>',
            ],
            [
                'id' => '8',
                'parent_id' => '7',
                'alias' => 'televisions',
                'name' => 'Телевизоры',
                'autogenerate_items_name' => 'Телевизор',
                'text' => '<b>Телевизоры</b><p>ТЕКСТ</p>',
            ],
            [
                'id' => '9',
                'parent_id' => '7',
                'alias' => 'refrigerators',
                'name' => 'Холодильники',
                'autogenerate_items_name' => 'Холодильник',
                'text' => '<b>Холодильники</b><p>ТЕКСТ</p>',
            ],
            [
                'id' => '10',
                'parent_id' => '7',
                'alias' => 'washing-machines',
                'name' => 'Стиральные машинки',
                'autogenerate_items_name' => 'Стиральная машинка',
                'text' => '<b>Стиральные машинки</b><p>ТЕКСТ</p>',
            ],
            [
                'id' => '11',
                'parent_id' => '0',
                'alias' => 'other-products',
                'name' => 'Другие товары',
                'autogenerate_items_name' => '',
                'text' => '<b>Другие товары</b><p>ТЕКСТ</p>',
            ],
        ];

        //foreach ($groups as $group) {
        //    DB::table($this->groupsTable)->insert([
        //        'id' => $group['id'],
        //        'parent_id' => $group['parent_id'],
        //        'status' => true,
        //        'alias' => $group['alias'],
        //        'name' => $group['name'],
        //        'h1' => $group['name'],
        //        'text' => $group['text'],
        //        'image' => null,
        //        'created_at' => new DateTime,
        //        'updated_at' => new DateTime,
        //    ]);
        //}
        $itemsCount = 100;
        $faker = Faker::create();

        // Brands
        $brands = [];
        for ($i = 0 ; $i <= $itemsCount / 10 ; $i++) {
            $brands[] = [
                'name' => $faker->company,
            ];
        }

        // Items
        $otherItemsNames = ['Духи', 'Шампунь', 'Гель для душа', 'Мыло', 'Дезодорант', 'Косметика', 'Футболка', 'Солнцезащитные очки', 'Купальник', 'Блуза', 'Рубашка', 'Брюки', 'Бриджи', 'Лосины', 'Джинсы', 'Шорты', 'Юбка', 'Комбинезон', 'Джемпер', 'Свитер', 'Гольф', 'Пуловер', 'Кофта', 'Кардиган', 'Жакет', 'Пиджак', 'Болеро', 'Топ', 'Футболка', 'Майка', 'Поло', 'Футболка с длинным рукавом', 'Тенниска', 'Реглан', 'Платье', 'Сарафан', 'Туника', 'Жилет', 'Пончо', 'Ветровка', 'Куртка', 'Пальто', 'Плащ', 'Полушубок', 'Пуховик', 'Спортивный костюм'];

        for ($i = 0 ; $i <= 10000 ; $i++) {
            $groups = array_filter($groups, function ($el) {
                return isset($el['autogenerate_items_name']);
            });
            $group = $faker->randomElement($groups);
            if ($group['autogenerate_items_name']) {
                $itemName = $group['autogenerate_items_name'] . ' ' . $faker->randomElement($brands)['name'] . ' ' .
                    $faker->regexify('[A-Z][A-Z]?') . '-' . $faker->randomNumber(3) . $faker->regexify('[a-z]?');

                $alias = $group['alias'] . '-' .
                    trim(preg_replace('/[^a-z^\-]/', '', preg_replace('/\s/', '-', mb_strtolower($itemName))), '-');
            } else {
                $itemName = $faker->randomElement($otherItemsNames) . ' ' . $faker->company;
                $alias = trim(preg_replace('/[^a-z^\-]/', '', preg_replace('/\s/', '-', mb_strtolower($itemName))), '-');
            }

            try {
                DB::table($this->itemsTable)->insert([
                    'group_id' => $group['id'],
                    'status' => true,
                    'alias' => $alias,
                    'name' => 'z' . $itemName,
                    'h1' => $itemName,
                    'text' => $faker->realText(),
                    'image' => null,
                    'cost' => $faker->randomFloat(2, 100, 10000),
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ]);
            } catch (Exception $e) {}
        }
    }
}
