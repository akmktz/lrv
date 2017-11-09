<?php

namespace App\Http\Controllers;

class BackendController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $urlGenerator = app()->url;
        $urlGenerator->forceRootUrl(rtrim($urlGenerator->to('/'), '/') . '/backend/');
    }
}
