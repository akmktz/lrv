<?php

namespace App\Http\Modules\Catalog\Backend\Controllers;

use App\Http\Controllers\BackendController;
use App\Http\Modules\Catalog\Backend\Models\Groups;

/**
 * Class GroupsController
 * @package App\Http\Modules\Catalog\Backend\Controllers
 */
class GroupsController extends BackendController
{
    /**
     * GroupsController constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();
        $this->model = new Groups();
    }

    public function indexGetData()
    {
        $temp = $this->model->orderBy('sort', 'ASC')->get();
        $list = [];
        foreach ($temp as $item) {
            $list[$item->parent_id][$item->id] = $item;
        }
        //$list = $this->createHierarchicalList($this->model->orderBy('sort', 'ASC')->get());
        //array_shift($list);
        $this->assignViewData('list', $list);
    }

    protected function addGetData()
    {
        $item = clone $this->model;
        $item->sort = 0;
        $this->assignViewData('item', $item);
        $groups = $this->createHierarchicalList(
            $this->model->orderBy('sort', 'ASC')->get(),
            old('parent_id')
        );
        $this->assignViewData('groups', $groups);
    }

    /**
     * @param $id
     */
    protected function editGetData($id)
    {
        $item = $this->model->find((int)$id);
        $this->assignViewData('item', $item);

        $groups = $this->createHierarchicalList(
            $this->model->orderBy('sort', 'ASC')->get(),
            old('parent_id', $item->parent_id),
            $item->id
        );
        $this->assignViewData('groups', $groups);
    }
}
