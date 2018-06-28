<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $guarded = [];

    public function getMenuTree()
    {
        $menus = $this::all();
        $menuData = list_to_tree_key($menus->toArray(), 'id', 'parent_id');

        return $menuData;
    }
}
