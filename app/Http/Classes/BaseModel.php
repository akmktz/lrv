<?php

namespace App\Http\Classes;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $fillable = [];
    protected $validationRules = [];
    protected $defaultValuesForFields = [];

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
        return (array)$this->validationRules;
    }

    public function getDefaultValuesForFields()
    {
        return (array)$this->defaultValuesForFields;
    }

}
