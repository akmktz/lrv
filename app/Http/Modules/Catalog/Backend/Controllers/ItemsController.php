<?php

namespace App\Http\Modules\Catalog\Backend\Controllers;

use App\Http\Controllers\BackendController;
use App\Http\Modules\Catalog\Backend\Models\Groups;
use App\Http\Modules\Catalog\Backend\Models\Items;
use Illuminate\Http\Request;

class ItemsController extends BackendController
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new Items();
    }

    public function index(Request $request)
    {
        $list = $this->model->orderBy('name', 'ASC')->paginate(50);
        $url = $request->getPathInfo();
        return $this->view('catalog::items.index', compact('url', 'list'));
    }

    public function edit($id)
    {
        $obj = Items::find((int)$id);
        $groups = $this->createHierarchicalList(Groups::orderBy('sort', 'ASC')->get(), $obj->group_id);
        return $this->view('catalog::items.edit', compact('obj', 'groups'));
    }

    public function save(Request $request, $id)
    {
        $obj = $this->model->find((int)$id);
        if (!$obj) {
            $this->redirect('/');
        }
        $obj->group_id = is_numeric($request->input('group_id')) ? $request->input('group_id') : 0;
        $obj->status = (boolean)$request->input('status');
        $obj->alias = $request->input('alias');
        $obj->name = $request->input('name');
        $obj->h1 = $request->input('h1');
        $obj->text = $request->input('text');

        try {
            $obj->save();
        } catch(\Exception $e) {}

        $groups = $this->createHierarchicalList(Groups::orderBy('sort', 'ASC')->get(), $obj->group_id);
        return $this->view('catalog::items.edit', compact('obj', 'groups'));
    }
}
