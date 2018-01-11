<?php

namespace App\Http\Modules\Catalog\Backend\Controllers;

use App\Http\Controllers\BackendController;
use App\Http\Modules\Catalog\Backend\Models\Groups;
use App\Http\Modules\Catalog\Backend\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function add()
    {
        $obj = new Items;
        $groups = $this->createHierarchicalList(Groups::orderBy('sort', 'ASC')->get(), $obj->group_id);
        return $this->view('catalog::items.edit', compact('obj', 'groups'));
    }

    public function edit($id)
    {
        $obj = $this->model->find((int)$id);
        $groups = $this->createHierarchicalList(Groups::orderBy('sort', 'ASC')->get(), $obj->group_id);
        return $this->view('catalog::items.edit', compact('obj', 'groups'));
    }

    public function save(Request $request, $id = null)
    {


        if ($id !== null) {
            $obj = $this->model->find((int)$id);
            if (!$obj) {
                return redirect()->route('adminItem', [$obj->id]);
            }
        } else {
            $obj = new Items;
        }

        $obj->group_id = is_numeric($request->input('group_id')) ? $request->input('group_id') : 0;
        $obj->status = (boolean)$request->input('status');
        $obj->alias = $request->input('alias');
        $obj->name = $request->input('name');
        $obj->h1 = $request->input('h1');
        $obj->text = $request->input('text');
        $groups = $this->createHierarchicalList(Groups::orderBy('sort', 'ASC')->get(), $obj->group_id);

        $validator = Validator::make($request->all(), [
                'group_id' => 'required',
                'alias'    => 'required|unique:catalog_items|min:2|max:255',
                'name'     => 'required|min:3|max:255',
            ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return $this->view('catalog::items.edit', compact('obj', 'groups', 'errors'));
        }

        try {
            $obj->save();
        } catch(\Exception $e) {
            return $this->view('catalog::items.edit', compact('obj', 'groups'));
        }

        return redirect()->route('adminItem', [$obj->id]);
    }
}
