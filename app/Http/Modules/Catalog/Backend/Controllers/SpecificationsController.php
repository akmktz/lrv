<?php

namespace App\Http\Modules\Catalog\Backend\Controllers;

use App\Http\Controllers\BackendController;
use App\Http\Modules\Catalog\Backend\Models\Specifications;
use App\Http\Modules\Catalog\Backend\Models\SpecificationsValues;

/**
 * Class SpecificationsController
 * @package App\Http\Modules\Catalog\Backend\Controllers
 */
class SpecificationsController extends BackendController
{
    /**
     * SpecificationsController constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();

        $this->model = new Specifications();
    }

    protected function addGetData()
    {
        parent::addGetData();
    }

    /**
     * @param $id
     */
    protected function editGetData($id)
    {
        $valuesModel = new SpecificationsValues();
        $values = $valuesModel->where('specification_id', $id)->orderBy('name', 'ASC')->paginate(50);
        $this->assignViewData('values', $values);

        parent::editGetData($id);
    }
}
