<?php

namespace App\Widgets\Backend;

use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\Request;

class LeftSide extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        // Menu
        $menu = [
            [
                'icon' => 'fa-link',
                'url' => 'pages',
                'name' => 'Системные страницы',
            ],
            [
                'icon' => 'fa-link',
                'name' => 'Каталог',
                'items' => [
                    [
                        'url' => 'groups',
                        'name' => 'Группы товаров',
                    ],
                    [
                        'url' => 'items',
                        'name' => 'Товары',
                    ],
                    [
                        'url' => 'specifications',
                        'name' => 'Характеристики',
                    ],
                ],
            ],
        ];

        $requestPath = Request::path();
        foreach ($menu as $key => $el) {
            if (!is_array($el)) {
                continue;
            }

            $menu[$key]['active'] = (!empty($el['url'])
                && !strncasecmp($requestPath, $elementPath = 'admin' . '/' . $el['url'], strlen($elementPath)));
            if (!empty($el['items'])) {
                foreach ($el['items'] as $subKey => $subEl) {
                    if (!is_array($subEl)) {
                        continue;
                    }

                    $active = !strncasecmp($requestPath, $elementPath = 'admin' . '/' . $subEl['url'], strlen($elementPath));
                    $menu[$key]['items'][$subKey]['active'] = $active;
                    if ($active) {
                        $menu[$key]['active'] = true;
                    }
                }
            }
        }

        return view('widgets.left_side', [
            'config' => $this->config,
            'menu' => $menu,
        ]);
    }
}
