<?php

namespace App\Http\Modules\Catalog\Models;

use App\Http\Classes\BaseModel;

/**
 * Class GroupsRelSpecifications
 * @package App\Http\Modules\Catalog\Models
 */
class GroupsRelSpecifications extends BaseModel
{
    public $table = 'catalog_groups_rel_specifications';

    protected $fillable = ['group_id', 'specification_id'];

    public $timestamps = false;
    //
}
