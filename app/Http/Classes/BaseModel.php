<?php

namespace App\Http\Classes;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{

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
}
