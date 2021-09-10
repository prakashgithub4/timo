<?php

namespace App\Models;
use App\Models\Menu;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use HasFactory,SoftDeletes;
    protected $table ='product_category';
    protected $primaryKey = "product_category_id";
    protected $fillable=['menu_id', 'product_category', 'mega_menu', 'sequence','created_at', 'updated_at', 'deleted_at'];

    public function menu()
    {   
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }

    
}


