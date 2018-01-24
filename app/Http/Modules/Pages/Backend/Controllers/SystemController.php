<?php

namespace App\Http\Modules\Pages\Backend\Controllers;

use App\Http\Controllers\BackendController;
use App\Http\Modules\Pages\Backend\Models\System;
use Illuminate\Http\Request;

/**
 * Class SystemController
 * @package App\Http\Modules\Pages\Backend\Controllers
 */
class SystemController extends BackendController
{
    /**
     * SystemController constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();
        $this->model = new System();
    }

    /**
     * @param Request $request
     * @return array
     */
    public function status(Request $request)
    {
        if ($request->input('id') == 1) {
            return [
                'success' => false,
                'message' => 'Домашнюю страницу нельзя заблокировать',
            ];
        }

        return parent::status($request);
    }

}
