<?php

namespace App\Http\Modules\Catalog\Models;

use App\Http\Classes\BaseModel;

/**
 * Class Groups
 * @package App\Http\Modules\Catalog\Models
 */
class Groups extends BaseModel
{
    public $table = 'catalog_groups';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function specifications()
    {
        return $this->hasMany('App\Http\Modules\Catalog\Models\GroupsRelSpecifications', 'group_id', 'id');
    }
}
