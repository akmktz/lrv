<?php

namespace App\Http\Modules\Catalog\Backend\Controllers;

use App\Http\Controllers\BackendController;
use App\Http\Modules\Catalog\Backend\Models\Groups;
use App\Http\Modules\Catalog\Backend\Models\Items;

/**
 * Class ItemsController
 * @package App\Http\Modules\Catalog\Backend\Controllers
 */
class ItemsController extends BackendController
{
    /**
     * ItemsController constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();

        $this->model = new Items();
    }

    protected function addGetData()
    {
        $item = clone $this->model;
        $this->assignViewData('item', $item);
        $groups = $this->createHierarchicalList(
            Groups::orderBy('sort', 'ASC')->get(),
            old('group_id')
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
        $this->assignViewData(
            'groups',
            $this->createHierarchicalList(
                Groups::orderBy('sort', 'ASC')->get(),
                old('group_id', $item->group_id)
            )
        );
    }
}
