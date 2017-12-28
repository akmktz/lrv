<?php

namespace App\Http\Modules\Catalog\Backend\Controllers;

use App\Http\Controllers\BackendController;
use App\Http\Modules\Catalog\Backend\Models\Groups;
use Illuminate\Http\Request;

class GroupsController extends BackendController
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new Groups();
    }

    public function index(Request $request)
    {
        //$list = $this->model->orderBy('sort', 'ASC')->get();

        $list = $this->createHierarchicalList($this->model->orderBy('sort', 'ASC')->get());
        array_shift($list);

        $url = $request->getPathInfo();
        return $this->view('catalog::groups.index', compact('url', 'list'));
    }

    public function edit($id)
    {
        $obj = Groups::find((int)$id);
        $groups = $this->createHierarchicalList($this->model->orderBy('sort', 'ASC')->get(), $obj->parent_id, $obj->id);
        return $this->view('catalog::groups.edit', compact('groups', 'obj'));
    }

    public function save(Request $request, $id)
    {
        $obj = $this->model->find((int)$id);
        if (!$obj) {
            $this->redirect('/');
        }

        $obj->parent_id = is_numeric($request->input('parent_id')) ? $request->input('parent_id') : 0;
        $obj->status = (boolean)$request->input('status');
        $obj->alias = $request->input('alias');
        $obj->name = $request->input('name');
        $obj->h1 = $request->input('h1');
        $obj->text = $request->input('text');
        $obj->sort = $request->input('sort');

        try {
            $obj->save();
        } catch(\Exception $e) {}

        $groups = $this->createHierarchicalList($this->model->orderBy('sort', 'ASC')->get(), $obj->parent_id, $obj->id);
        return $this->view('catalog::groups.edit', compact('groups', 'obj'));
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

        if ($id == 1) {
            return [
                'success' => false,
                'message' => 'Домашнюю страницу нельзя заблокировать',
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

    protected function createHierarchicalList($data, $currentId = null, $disabledId = null, $parentId = 0, $indents = '', $level = 0)
    {
        $result = [];

        if ($parentId == 0) {
            $temp = [];

            foreach($data as $el) {
                $temp[$el->parent_id][$el->id] = [
                    'name' => $el->name,
                    'parent_id' => $el->parent_id,
                    'id' => $el->id,
                    'alias' => $el->alias,
                    'level' =>0,
                    ];
            }
            $data = $temp;

            $result = [
                0 => [
                    'id' => 0,
                    'parent_id' => 0,
                    'name' => '------',
                    'selected' => (0 == $currentId ? 'selected' : ''),
                ],
            ];
        }

        if (empty($data[$parentId]) || !is_array($data)) {
            return $result;
        }

        foreach($data[$parentId] as $id => $el) {
            $result[] = [
                'id' => $el['id'],
                'alias' => $el['alias'],
                'name' => $indents . $el['name'],
                'selected' => $id != $disabledId ? ($id == $currentId ? 'selected' : '') : 'disabled',
                'level' => $level,
            ];

            if (!empty($data[$id])) {
                $result = array_merge($result, $this->createHierarchicalList($data, $currentId, $disabledId, $id, $indents . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $level + 1));
            }
        }

        return $result;
    }
}
