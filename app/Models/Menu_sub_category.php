<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu_sub_category extends Model
{
    use HasFactory;
    protected $table = 'menu_sub_category';
    public function menus()
    {
        return $this->belongsTo('App\Models\Menu_sub_category');
    }
    
    public function megamenu()
    {
        return $this->hasMany('App\Models\Menu_sub_category','mega_parent_id','id');
    }

}
