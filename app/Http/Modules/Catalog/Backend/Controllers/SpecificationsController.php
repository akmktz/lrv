<?php

namespace App\Http\Modules\Catalog\Backend\Controllers;

use App\Http\Controllers\BackendController;
use App\Http\Modules\Catalog\Backend\Models\Specifications;
use App\Http\Modules\Catalog\Backend\Models\SpecificationsValues;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    /**
     * @param Request $request
     * @param $id
     * @return array
     */
    public function saveValue(Request $request, $id)
    {
        $itemId = (int)$request->get('id');

        $valuesModel = new SpecificationsValues();
        $data = $request->only($valuesModel->getFillableBackend());

        $validator = Validator::make(
            $data,
            $valuesModel->getValidationRules($itemId),
            $valuesModel->getValidationMessages()
        );
        if ($validator->fails()) {
            return [
                'success' => false,
                'message' => implode("\n", $validator->errors()->all()),
            ];
        }

        if ($itemId == 0) {
            $item = clone $valuesModel;
            $item->specification_id = $id;
        } else {
            $item = $valuesModel->find((int)$itemId);
            if (!$item) {
                return [
                    'success' => false,
                    'message' => 'Значение характеристики с указанным id не существует',
                ];
            }
        }

        $item->fill($data);
        try {
            $item->save();
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Ошибка БД: ' . $e->getMessage(),
            ];
        }

        return [
            'success' => true,
            'message' => 'Сохранено',
            'html' => $this->renderRows($id),
        ];
    }

    /**
     * @param Request $request
     * @param $id
     * @return array
     */
    public function deleteValue(Request $request, $id)
    {
        $itemId = (int)$request->get('id');
        if (!$itemId) {
            return [
                'success' => false,
                'message' => 'Не указан id значения характеристики',
            ];
        }

        $valuesModel = new SpecificationsValues();
        $item = $valuesModel->find((int)$itemId);
        if (!$item) {
            return [
                'success' => false,
                'message' => 'Значение характеристики с указанным id не существует',
            ];
        }

        try {
            $item->delete();
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Ошибка БД: ' . $e->getMessage(),
            ];
        }

        return [
            'success' => true,
            'message' => 'Удалено',
            'html' => $this->renderRows($id),
        ];
    }

    /**
     * @param $id
     * @return $this
     */
    protected function renderRows($id)
    {
        $valuesModel = new SpecificationsValues();
        $values = $valuesModel->where('specification_id', $id)->orderBy('name', 'ASC')->get();
        return $this->view('rows', compact('values'))->render();
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
        $values = $valuesModel->where('specification_id', $id)->orderBy('name', 'ASC')->get();
        $this->assignViewData('values', $values);
        $this->assignViewData('valueDeleteUrl', action(self::class . '@deleteValue', [$id]));
        $this->assignViewData('valueSaveUrl', action(self::class . '@saveValue', [$id]));

        parent::editGetData($id);
    }
}
