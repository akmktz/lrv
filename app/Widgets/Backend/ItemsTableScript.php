<?php

namespace App\Widgets\Backend;

use Arrilot\Widgets\AbstractWidget;

class ItemsTableScript extends AbstractWidget
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

        return view('widgets.forms.itemsTableScript', [
            'config' => $this->config,
        ]);
    }
}
