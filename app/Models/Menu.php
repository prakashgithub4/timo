<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Menu extends Model
{
    use HasFactory;
    protected $table ='menus';
    protected $fillable=['menu_name', 'status', 'mega','created_at', 'updated_at', 'deleted_at'];
    public function submenus()
    {
        return $this->hasMany('App\Models\Menu_sub_category','menu_id','id');
    }
    
}
