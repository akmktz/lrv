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


    protected function addGetData()
    {
        $this->assignViewData('item', $this->model);
        $groups = $this->createHierarchicalList(Groups::orderBy('sort', 'ASC')->get(), old('group_id'));
        $this->assignViewData('groups', $groups);
    }

    protected function editGetData($id)
    {
        $item = $this->model->find((int)$id);
        $this->assignViewData('item', $item);
        $this->assignViewData('groups', $this->createHierarchicalList(Groups::orderBy('sort', 'ASC')->get(), old('group_id') ?: $item->group_id));
    }

    // TODO Переделать и пренести в базовый бк контроллер
    public function save(Request $request, $id = null)
    {
        if ($id !== null) {
            $item = $this->model->find((int)$id);
            if (!$item) {
                return redirect()->route($this->routeNameEdit, [$item->id]);
            }
        } else {
            $item = new Items;
        }

        // Переделать на загрузку в модель всех данных также правила подстановки данных из массива в модели
        $item->group_id = is_numeric($request->input('group_id')) ? $request->input('group_id') : 0;
        $item->status = (boolean)$request->input('status');
        $item->alias = $request->input('alias');
        $item->name = $request->input('name');
        $item->h1 = $request->input('h1');
        $item->text = $request->input('text');
        $groups = $this->createHierarchicalList(Groups::orderBy('sort', 'ASC')->get(), $item->group_id);

        // TODO Правила валидации в модель
        $request->validate([
            'group_id' => 'required',
            'alias'    => 'required|unique:catalog_items,alias,' . (int)$item->id . '|min:2|max:255',
            'name'     => 'required|min:3|max:255',
        ]);

        //$validator = Validator::make($request->all(), [
        //        'group_id' => 'required',
        //        'alias'    => 'required|unique:catalog_items|min:2|max:255',
        //        'name'     => 'required|min:3|max:255',
        //    ]);
        //if ($validator->fails()) {
        //    //return redirect('/items/add')
        //    //    ->withErrors($validator)
        //    //    ->withInput();
        //
        //    //$errors = $validator->errors();
        //    //return $this->view('catalog::items.edit', compact('item', 'groups', 'errors'));
        //}

        // TODO: Предусмотреть возврат при ошибке с выводом ошибки
        try {
            $item->save();
        } catch(\Exception $e) {
            return $this->view(
                $this->moduleName . '::' . $this->controllerName . '.edit',
                compact('item', 'groups', 'errors')
            );
        }

        return redirect()->route($this->routeNameEdit, [$item->id]);
    }
}
