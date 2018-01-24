<?php

namespace App\Http\Controllers;

use App\Http\Classes\BackendUrlGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

/**
 * Class BackendController
 * @package App\Http\Controllers
 */
abstract class BackendController extends Controller
{
    protected $moduleName;
    protected $controllerName;
    protected $routeNameAdd;
    protected $routeNameList;
    protected $routeNameEdit;
    protected $viewData = [];

    /**
     * BackendController constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();

        // Module and controller names
        $temp = preg_split('/Modules\\\\(.*?)\\\\(.*)\\\\(.*?)$/', static::class, -1, PREG_SPLIT_DELIM_CAPTURE);
        $this->moduleName = isset($temp[1]) ? strtolower($temp[1]) : '';
        $this->controllerName = isset($temp[3]) ? str_replace('controller', '', strtolower($temp[3])) : '';

        if (!$this->moduleName || !$this->controllerName) {
            throw new \Exception('Ошибка определения имени модуля и контроллера');
        }

        // Route names
        $this->routeNameList = 'admin' . ucfirst($this->controllerName) . 'List';
        $this->routeNameAdd = 'admin' . ucfirst($this->controllerName) . 'Add';
        $this->routeNameEdit = 'admin' . ucfirst($this->controllerName) . 'Edit';

        // View data
        $this->assignViewData('routeNameList', $this->routeNameList);
        $this->assignViewData('routeNameAdd', $this->routeNameAdd);
        $this->assignViewData('routeNameEdit', $this->routeNameEdit);

        // Webroot /backend
        $routes = app()['router']->getRoutes();
        $customUrlGenerator = new BackendUrlGenerator($routes, app()->make('request'));
        app()->instance('url', $customUrlGenerator);

        // Views path
        View::addLocation(resource_path('views') . '/backend/');

        // Widget path
        config(['laravel-widgets.default_namespace' => app()->getNamespace() . 'Widgets\Backend']);
    }

    /**
     * @param $key
     * @param $value
     */
    protected function assignViewData($key, $value)
    {
        $this->viewData[$key] = $value;
    }

    /**
     * @param $data
     * @param null $currentId
     * @param null $disabledId
     * @param int $parentId
     * @param string $indents
     * @param int $level
     * @return array
     */
    protected function createHierarchicalList($data, $currentId = null, $disabledId = null, $parentId = 0, $indents = '', $level = 0)
    {
        $result = [];

        if ($parentId == 0) {
            $temp = [];

            foreach ($data as $el) {
                $temp[$el->parent_id][$el->id] = [
                    'obj' => $el,
                    'name' => $el->name,
                    'parent_id' => $el->parent_id,
                    'id' => $el->id,
                    'alias' => $el->alias,
                    'status' => $el->status,
                    'level' =>0,
                ];
            }
            $data = $temp;

            $result = [
                0 => [
                    'id' => 0,
                    'parent_id' => 0,
                    'name' => '------',
                    'name_hierarchical' => '------',
                    'selected' => (0 == $currentId ? 'selected' : ''),
                ],
            ];
        }

        if (empty($data[$parentId]) || !is_array($data)) {
            return $result;
        }

        foreach ($data[$parentId] as $id => $el) {
            $result[] = [
                'obj' => $el['obj'],
                'id' => $el['id'],
                'alias' => $el['alias'],
                'status' => $el['status'],
                'name' => $el['name'],
                'name_hierarchical' => $indents . $el['name'],
                'selected' => $id != $disabledId ? ($id == $currentId ? 'selected' : '') : 'disabled',
                'level' => $level,
            ];

            if (!empty($data[$id])) {
                $result = array_merge(
                    $result,
                    $this->createHierarchicalList(
                        $data,
                        $currentId,
                        $disabledId,
                        $id,
                        $indents . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
                        $level + 1
                    )
                );
            }
        }

        return $result;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function status(Request $request)
    {
        $id = $request->input('id');
        if (!$id) {
            return [
                'success' => false,
                'message' => 'id элемента не указан',
            ];
        }

        $item = $this->model->find((int)$id);
        if (!$item) {
            return [
                'success' => false,
                'message' => 'Элемент с таким id не найден',
            ];
        }

        $item->status = (boolean)$request->input('status');
        try {
            $item->save();
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Ошибка БД',
            ];
        }

        return [
            'success' => true,
            'message' => 'Статус изменен',
        ];
    }

    // ACTIONS

    /**
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $this->indexGetData();
        return $this->view($this->moduleName . '::' . $this->controllerName . '.index', $this->viewData);
    }

    protected function indexGetData()
    {
        $this->assignViewData('list', $this->model->orderBy('name', 'ASC')->paginate(50));
    }

    /**
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function add()
    {
        $this->addGetData();
        return $this->view($this->moduleName . '::' . $this->controllerName . '.edit', $this->viewData);
    }

    protected function addGetData()
    {
        $this->assignViewData('item', clone $this->model);
    }
}
