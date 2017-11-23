<?php

namespace App\Widgets\Frontend;

use Arrilot\Widgets\AbstractWidget;

class Test extends AbstractWidget
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
        //
        $data = [
            1 => 'test1',
            2 => 'test2',
            3 => 'test3',
        ];

        return view('widgets.test', [
            'config' => $this->config,
            'data' => $data,
        ]);
    }
}
