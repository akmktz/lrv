<?php

namespace App\Http\Modules\Catalog\Backend\Controllers;

use App\Http\Controllers\BackendController;
use App\Http\Modules\Catalog\Backend\Models\Groups;

class GroupsController extends BackendController
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new Groups();
    }

    public function indexGetData()
    {
        $list = $this->createHierarchicalList($this->model->orderBy('sort', 'ASC')->get());
        array_shift($list);
        $this->assignViewData('list',  $list);
    }

    protected function addGetData()
    {
        $item = clone $this->model;
        $item->sort = 0;
        $this->assignViewData('item', $item);
        $groups = $this->createHierarchicalList($this->model->orderBy('sort', 'ASC')->get(), old('parent_id'));
        $this->assignViewData('groups', $groups);
    }

    protected function editGetData($id)
    {
        $item = $this->model->find((int)$id);
        $this->assignViewData('item', $item);

        $groups = $this->createHierarchicalList($this->model->orderBy('sort', 'ASC')->get(), old('parent_id', $item->parent_id), $item->id);
        $this->assignViewData('groups', $groups);
    }

}
