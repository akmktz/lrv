<?php

namespace App\Http\Modules\Catalog\Backend\Models;

/**
 * Class Specifications
 * @package App\Http\Modules\Catalog\Backend\Models
 */
class Specifications extends \App\Http\Modules\Catalog\Models\Specifications
{
    protected $fillable = ['status', 'alias', 'name', 'type', 'sort'];

    /**
     * @param null $id
     * @return array
     */
    public function getValidationRules($id = null)
    {
        return [
            // TODO: Изменить статическое название таблицы в правиле на имя из модели, исключить дублирование
            'alias'    => 'required|regex:/(^[0-9a-z\-\_]+$)/u|unique:catalog_specifications,alias,' . (int)$id . '|min:2|max:255',
            'name'     => 'required|min:3|max:255',
        ];
    }

}
