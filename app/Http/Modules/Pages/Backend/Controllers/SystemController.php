<?php

namespace App\Http\Modules\Pages\Backend\Controllers;

use App\Http\Controllers\BackendController;
use App\Http\Modules\Pages\Models\PagesSystem;
use Illuminate\Http\Request;

class SystemController extends BackendController
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new PagesSystem();
    }

    public function index(Request $request)
    {
        $list = $this->model->orderBy('name', 'ASC')->paginate(2);
        $url = $request->getPathInfo();
        return $this->view('pages::system.index', compact('url', 'list'));
    }

    public function edit($id)
    {
        $obj = PagesSystem::find((int)$id);
        return $this->view('pages::system.edit', compact('obj'));
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

        return $this->view('pages::system.edit', compact('obj'));
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
