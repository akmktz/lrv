<?php

namespace App\Http\Modules\Catalog\Backend\Controllers;

use App\Http\Controllers\BackendController;
use App\Http\Modules\Catalog\Backend\Models\Groups;
use Illuminate\Http\Request;

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

    /**
     * @param Request $request
     * @return array
     */
    public function sort(Request $request)
    {
        $sortData = $request->input('data');
        if (!$sortData || !is_array($sortData) || !count($sortData)) {
            return [
                'success' => false,
                'message' => 'Указаны неправильные данные сортировки',
            ];
        }

        $this->writeSortToDB(0, $sortData);

        return ['success' => true];
    }

    /**
     * @param $parentId
     * @param $sortData
     * @return array
     */
    protected function writeSortToDB($parentId, $sortData)
    {
        foreach ($sortData as $sort => $data) {
            $id = (int)array_get($data, 'id');
            if (!$id) {
                continue;
            }

            $item = $this->model->find($id);
            if (!$item) {
                continue;
            }

            if ($item->sort != $sort || $item->parent_id != $parentId) {
                $item->parent_id = $parentId;
                $item->sort = (int)$sort;

                try {
                    $item->save();
                } catch (\Exception $e) {
                    return [
                        'success' => false,
                        'message' => 'Ошибка БД',
                    ];
                }
            }

            $children = array_get($data, 'children');
            if (!empty($children)) {
                $this->writeSortToDB($id, $children);
            }
        }
    }
}
