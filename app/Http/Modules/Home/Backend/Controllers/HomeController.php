<?php

namespace App\Http\Modules\Home\Backend\Controllers;

use App\Http\Controllers\BackendController;

class HomeController extends BackendController
{

    public function index()
    {
        return $this->view('home::home');
    }
}
