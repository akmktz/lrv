<?php

namespace App\Http\Modules\Catalog\Backend\Models;

/**
 * Class Items
 * @package App\Http\Modules\Catalog\Backend\Models
 */
class Items extends \App\Http\Modules\Catalog\Models\Items
{
    protected $imagesConfig = ['file' => 'image']; // postParamName => dbColumnName
    protected $fillable = ['group_id', 'status', 'alias', 'name', 'h1', 'text', 'sort'];

    /**
     * @param null $id
     * @return array
     */
    public function getValidationRules($id = null)
    {
        return [
            'group_id' => 'required',
            // TODO: Изменить статическое название таблицы в правиле на имя из модели, исключить дублирование
            'alias'    => 'required|regex:/(^[0-9a-z\-\_]+$)/u|unique:catalog_items,alias,' . (int)$id . '|min:2|max:255',
            'name'     => 'required|min:3|max:255',
        ];
    }

}
