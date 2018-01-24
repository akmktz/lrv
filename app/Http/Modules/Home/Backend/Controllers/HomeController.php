<?php

namespace App\Http\Modules\Home\Backend\Controllers;

use App\Http\Controllers\BackendController;

/**
 * Class HomeController
 * @package App\Http\Modules\Home\Backend\Controllers
 */
class HomeController extends BackendController
{
    /**
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return $this->view('home::home');
    }
}
