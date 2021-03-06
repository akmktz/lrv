<?php

namespace App\Http\Modules\Catalog\Backend\Models;

/**
 * Class Groups
 * @package App\Http\Modules\Catalog\Backend\Models
 */
class Groups extends \App\Http\Modules\Catalog\Models\Groups
{
    protected $imagesConfig = ['file' => 'image']; // postParamName => dbColumnName
    protected $fillable = ['parent_id', 'status', 'alias', 'name', 'h1', 'text', 'sort'];

    /**
     * @param null $id
     * @return array
     */
    public function getValidationRules($id = null)
    {
        return [
            'parent_id' => 'required',
            // TODO: Изменить статическое название таблицы в правиле на имя из модели, исключить дублирование
            'alias'    => 'required|regex:/(^[0-9a-z\-\_]+$)/u|unique:catalog_items,alias,' . (int)$id . '|min:2|max:255',
            'name'     => 'required|min:3|max:255',
        ];
    }
}
