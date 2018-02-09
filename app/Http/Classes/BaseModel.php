<?php

namespace App\Http\Classes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * Class BaseModel
 * @package App\Http\Classes
 */
class BaseModel extends Model
{
    protected $imagesConfig = []; // postParamName => dbColumnName
    protected $fillable = [];
    protected $defaultValuesForFields = ['status' => false];

    /**
     * @return string
     */
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

    /**
     * @return array
     */
    public function getFillable()
    {
        return (array)$this->fillable;
    }

    /**
     * @return array
     */
    public function getFillableBackend()
    {
        return array_diff((array)$this->fillable, (array)$this->imagesConfig);
    }

    /**
     * @param null $id
     * @return array
     */
    public function getValidationRules($id = null)
    {
        return [
            'alias'    => 'required|unique:catalog_items,alias,' . (int)$id . '|min:2|max:255',
            'name'     => 'required|min:3|max:255',
        ];
    }

    /**
     * @return array
     */
    public function getDefaultValuesForFields()
    {
        return (array)$this->defaultValuesForFields;
    }

    /**
     * @return array
     */
    public function getImagesConfig()
    {
        return (array)$this->imagesConfig;
    }

    /**
     * @param string $columnName
     * @return mixed
     */
    public function imageExist($columnName = 'image')
    {
        return Storage::exists($this->$columnName);
    }

    public function imageUrl($columnName = 'image')
    {
        return Storage::url($this->$columnName);
    }

}
