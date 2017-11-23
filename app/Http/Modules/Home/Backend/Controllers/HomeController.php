<?php

namespace App\Http\Modules\Home\Backend\Controllers;

use App\Http\Controllers\BackendController;

class HomeController extends BackendController
{

    public function index()
    {
        //echo base_path('resources/views').'/widgets/'; die;
        return $this->view('home::home');
    }
}
