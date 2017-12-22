<?php

namespace App\Http\Modules\Catalog\Backend\Controllers;

use App\Http\Controllers\BackendController;
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
        return $this->view('catalog::groups.index', compact('url', 'list'));
    }

    public function edit($id)
    {
        $obj = Items::find((int)$id);
        return $this->view('catalog::groups.edit', compact('obj'));
    }

    public function save(Request $request, $id)
    {
        $obj = $this->model->find((int)$id);
        if (!$obj) {
            $this->redirect('/');
        }
        $obj->status = (boolean)$request->input('status');
        $obj->alias = $request->input('alias');
        $obj->name = $request->input('name');
        $obj->h1 = $request->input('h1');
        $obj->text = $request->input('text');

        try {
            $obj->save();
        } catch(\Exception $e) {}

        return $this->view('catalog::groups.edit', compact('obj'));
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
}
