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
        return (array)$this->fillable + (array)$this->imagesConfig;
    }

    /**
     * @return array
     */
    public function getFillableBackend()
    {
        return array_diff((array)$this->fillable, (array)$this->imagesConfig);
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
     * @return bool
     */
    public function imageExist($columnName = 'image')
    {
        if (!$this->$columnName) {
            return false;
        }

        return Storage::exists($this->$columnName);
    }

    public function imageUrl($columnName = 'image')
    {
        return Storage::url($this->$columnName);
    }

    /**
     * @param null $id
     * @return array
     */
    public function getValidationRules($id = null)
    {
        return [
            'alias'    => 'required|regex:/(^[0-9a-z\-\_]+$)/u|unique:catalog_items,alias,' . (int)$id . '|min:2|max:255',
            'name'     => 'required|min:3|max:255',
        ];
    }

    /**
     * @return array
     */
    public function getValidationMessages()
    {
        return [
            'name.required' => 'Поле "Наименование" должно быть заполнено',
            'name.max' => 'Значение поля "Наименование" должно состоять максимум из :max символов',
            'name.min' => 'Значение поля "Наименование" должно состоять минимум из :min символов',
            'alias.required' => 'Поле "Алиас" должно быть заполнено',
            'alias.unique' => 'Алиас должен быть уникальным',
            'alias.regex' => 'Алиас должен состоять только из цифр, английских маленьких букв, символов "тире" и "подчеркивание"',
        ];
    }
}
