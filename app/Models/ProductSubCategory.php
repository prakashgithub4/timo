<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;
use App\Models\productCategory;

use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSubCategory extends Model
{
    use HasFactory,SoftDeletes;

    protected $table ='product_sub_category';
    protected $primaryKey = "product_sub_category_id";
    protected $fillable=['menu_id', 'product_category_id', 'sub_category_name','icon','created_at', 'updated_at', 'deleted_at'];

    // public function menu()
    // {   
    //     return $this->hasMany(Menu::class, 'id', 'menu_id');
    // }

    public function productcategory()
    {   
        
        return $this->belongsTo(productCategory::class, 'product_category_id', 'product_category_id');
    }

}


