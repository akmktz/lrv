<?php

namespace App\Http\Modules\Catalog\Backend\Models;


class Items extends \App\Http\Modules\Catalog\Models\Items
{
    protected $fillable = ['group_id', 'status', 'alias', 'name', 'h1', 'text', 'sort'];
    protected $defaultValuesForFields = ['status' => false];

    public function getValidationRules($id = null)
    {
        return [
            'group_id' => 'required',
            'alias'    => 'required|unique:catalog_items,alias,' . (int)$id . '|min:2|max:255',
            'name'     => 'required|min:3|max:255',
        ];
    }
}
