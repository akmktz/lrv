<?php

namespace App\Http\Modules\Catalog\Backend\Models;


class Groups extends \App\Http\Modules\Catalog\Models\Groups
{
    protected $fillable = ['parent_id', 'status', 'alias', 'name', 'h1', 'text', 'sort'];

    public function getValidationRules($id = null)
    {
        return [
            'parent_id' => 'required',
            'alias'    => 'required|unique:catalog_items,alias,' . (int)$id . '|min:2|max:255',
            'name'     => 'required|min:3|max:255',
        ];
    }
}
