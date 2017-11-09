<?php

namespace App\Http\Modules\Home\Frontend\Controllers;

use App\Http\Controllers\FrontendController;

class HomeController extends FrontendController
{

    public function index()
    {
        return $this->view('home::home');
    }
}
