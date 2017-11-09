<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $viewPathStructure = 'Http/{module_path}/Views';

    public function __construct()
    {
        $this->registerModuleViewNamespace();
    }

    protected function registerModuleViewNamespace()
    {
        $controller = get_called_class();
        $namespace = explode('\\', $controller);
        $moduleName = mb_strtolower(array_get($namespace, 3));

        $viewDir = str_replace('{module_path}', implode('/', array_slice($namespace, 2, 3)), $this->viewPathStructure);
        $viewDir = app_path($viewDir);

        view()->addNamespace($moduleName, $viewDir);
    }

    public function getAppSide()
    {
        $controller = get_called_class();
        $namespace = explode('\\', $controller);
        $side = mb_strtolower(array_get($namespace, 4));
        if ($side === 'backend') {
            return $side;
        } elseif ($side === 'frontend') {
            return $side;
        } else {
            return false;
        }
    }

    public function view($view = null, $data = [], $mergeData = [])
    {
        return view($view, $data, $mergeData)->with('_SEO', ['h1' => $this->getAppSide()]);
    }
}
