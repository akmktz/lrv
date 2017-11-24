<?php

namespace App\Widgets\Backend;

use Arrilot\Widgets\AbstractWidget;

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
        //

        return view('widgets.left_side', [
            'config' => $this->config,
        ]);
    }
}