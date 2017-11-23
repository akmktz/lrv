<?php

namespace App\Http\Controllers;


use App\Http\Classes\BackendUrlGenerator;
use Illuminate\Support\Facades\View;

abstract class BackendController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        // Webroot /backend
        $routes = app()['router']->getRoutes();
        $customUrlGenerator = new BackendUrlGenerator($routes, app()->make('request'));
        app()->instance('url', $customUrlGenerator);

        // Views path
        View::addLocation(resource_path('views') . '/backend/');

        // Widget path
        config(['laravel-widgets.default_namespace' => app()->getNamespace() . 'Widgets\Backend']);
    }
}