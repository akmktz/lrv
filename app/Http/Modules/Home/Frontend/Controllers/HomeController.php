<?php

namespace App\Http\Modules\Home\Frontend\Controllers;

use App\Http\Controllers\FrontendController;

/**
 * Class HomeController
 * @package App\Http\Modules\Home\Frontend\Controllers
 */
class HomeController extends FrontendController
{
    /**
     * @return $this
     */
    public function index()
    {
        return $this->view('index');
    }
}
