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
}
