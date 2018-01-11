<?php

namespace App\Http\Controllers;


use App\Http\Classes\BackendUrlGenerator;
use Illuminate\Http\Request;
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

    protected function createHierarchicalList($data, $currentId = null, $disabledId = null, $parentId = 0, $indents = '', $level = 0)
    {
        $result = [];

        if ($parentId == 0) {
            $temp = [];

            foreach($data as $el) {
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

        foreach($data[$parentId] as $id => $el) {
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
                $result = array_merge($result, $this->createHierarchicalList($data, $currentId, $disabledId, $id, $indents . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $level + 1));
            }
        }

        return $result;
    }

    public function status(Request $request)
    {
        $id = $request->input('id');
        if (!$id) {
            return [
                'success' => false,
                'message' => 'id элемента не указан',
            ];
        }

        $obj = $this->model->find((int)$id);
        if (!$obj) {
            return [
                'success' => false,
                'message' => 'Элемент с таким id не найден',
            ];
        }

        $obj->status = (boolean)$request->input('status');
        try {
            $obj->save();
        } catch(\Exception $e) {
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
}