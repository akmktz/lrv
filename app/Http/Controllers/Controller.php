<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $viewPathStructure = 'Http/{module_path}/Views';
    protected $model;
    protected $moduleName;
    protected $controllerName;

    /**
     * Controller constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->registerModuleAndControllerNames();
        $this->registerModuleViewNamespace();
    }

    /**
     * @throws \Exception
     */
    protected function registerModuleAndControllerNames()
    {
        // Module and controller names
        $temp = preg_split('/Modules\\\\(.*?)\\\\(.*)\\\\(.*?)$/', static::class, -1, PREG_SPLIT_DELIM_CAPTURE);
        $this->moduleName = isset($temp[1]) ? strtolower($temp[1]) : '';
        $this->controllerName = isset($temp[3]) ? str_replace('controller', '', strtolower($temp[3])) : '';

        if (!$this->moduleName || !$this->controllerName) {
            throw new \Exception('Ошибка определения имени модуля и контроллера');
        }
    }

    /**
     *
     */
    protected function registerModuleViewNamespace()
    {
        $controller = get_called_class();
        $namespace = explode('\\', $controller);

        $viewDir = str_replace('{module_path}', implode('/', array_slice($namespace, 2, 3)), $this->viewPathStructure);
        $viewDir = app_path($viewDir);

        // Views path
        View::addLocation($viewDir . '/' . $this->controllerName);
    }

    /**
     * @return bool|mixed|null|string|string[]
     */
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

    /**
     * @param null $view
     * @param array $data
     * @param array $mergeData
     * @return $this
     */
    public function view($view = null, $data = [], $mergeData = [])
    {
        return view($view, $data, $mergeData)->with('_SEO', ['h1' => $this->getAppSide()]);
    }
}
