<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\View;

class BackendController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        // Webroot /backend
        $urlGenerator = app()->url;
        $urlGenerator->forceRootUrl(rtrim($urlGenerator->to('/'), '/') . '/backend/');

        // Views path
        View::addLocation(resource_path('views') . '/backend/');

        // Widget path
        config(['laravel-widgets.default_namespace' => app()->getNamespace() . 'Widgets\Backend']);
    }
}
