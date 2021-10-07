<?php

namespace App\Repositories;

use App\Models\productCategory;
use App\Models\ProductSubCategory;
use App\Models\Menu;
use Log;
use DB;
class ProductSubCategoryRepository
{
    public function _add($data)
    {
        Log::info($data);
        return productSubCategory::create($data);
    }
    public function _get()
    {   
         $pct = DB::table('product_sub_category')
                ->leftJoin('product_category', 'product_category.product_category_id', '=', 'product_sub_category.product_category_id' )
                ->leftJoin ('menus', 'menus.id', '=', 'product_category.menu_id')->where('product_sub_category.deleted_at',NULL)->selectRaw("menus.menu_name, product_category.product_category, product_sub_category.sub_category_name, product_sub_category.product_sub_category_id,product_sub_category.icon")->get();
        

        return ($pct);
    }
    
    public function _edit($id)
    {
        return productSubCategory::find($id);
    }

    public function _delete($id)
    {
        return productSubCategory::find($id)->delete();
    }
    

    public function mega($id, $mega)
    {
        
        $productSubCategory = productSubCategory::find($id);
        
        $productSubCategory->mega_menu  =$mega;
        $productSubCategory->save();
    }
    
    public function _update($id, $data)
    {
        $productSubCategory = productSubCategory::find($id);
        $productSubCategory->menu_id = $data['menu_id'];
        $productSubCategory->product_category_id  = $data['product_category_id'];
        $productSubCategory->sub_category_name  = $data['sub_category_name'];
        $productSubCategory->icon  = $data['icon'];

        $productSubCategory->save();
    }

    
}
