<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;

class FrontendController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        // Views path
        View::addLocation(resource_path('views') . '/frontend/');

        // Widget path
        config(['laravel-widgets.default_namespace' => app()->getNamespace() . 'Widgets\Frontend']);
    }
}
