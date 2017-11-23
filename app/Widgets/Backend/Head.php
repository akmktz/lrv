<?php

namespace App\Widgets\Backend;

use Arrilot\Widgets\AbstractWidget;

class Head extends AbstractWidget
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

        return view('widgets.head', [
            'config' => $this->config,
        ]);
    }
}
