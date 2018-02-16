<?php

namespace App\Http\Modules\Catalog\Backend\Models;

/**
 * Class SpecificationsValues
 * @package App\Http\Modules\Catalog\Backend\Models
 */
class SpecificationsValues extends \App\Http\Modules\Catalog\Models\SpecificationsValues
{
    protected $fillable = ['status', 'alias', 'name', 'type', 'sort'];

    /**
     * @param null $id
     * @return array
     */
    public function getValidationRules($id = null)
    {
        return [
            // TODO: Изменить статическое название таблицы в правиле на имя из модели
            'alias'    => 'required|unique:catalog_specifications_values,alias,' . (int)$id . '|min:2|max:255',
            'name'     => 'required|min:3|max:255',
        ];
    }

}
