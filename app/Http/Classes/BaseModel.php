<?php

namespace App\Http\Classes;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $fillable = [];
    protected $defaultValuesForFields = ['status' => false];

    public function getStatusClass()
    {
        if (!isset($this->status)) {
            return '';
        }

        if ($this->status) {
            return 'text-green fa-check';
        } else {
            return 'text-red fa-ban';
        }
    }

    public function getFillable()
    {
        return (array)$this->fillable;
    }

    public function getValidationRules($id = null)
    {
        return [
            'alias'    => 'required|unique:catalog_items,alias,' . (int)$id . '|min:2|max:255',
            'name'     => 'required|min:3|max:255',
        ];
    }

    public function getDefaultValuesForFields()
    {
        return (array)$this->defaultValuesForFields;
    }

}
