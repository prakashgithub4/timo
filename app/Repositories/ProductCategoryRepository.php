<?php

namespace App\Repositories;

use App\Models\ProductCategory;

use App\Models\Menu;
use Log;
use DB;
class ProductCategoryRepository
{
    public function _add($data)
    {
        Log::info($data);
        return ProductCategory::create($data);
    }
    public function _get()
    {   
         $pct = ProductCategory::with('menu')->get()->toArray();
         log::info($pct);
         return json_decode(json_encode($pct)); 
    }
    
    public function _edit($id)
    {
        return ProductCategory::find($id);
    }

    public function _delete($id)
    {
        return ProductCategory::find($id)->delete();
    }
    

    public function mega($id, $mega)
    {
        
        $ProductCategory = ProductCategory::find($id);
        $ProductCategory->save();
    }
    
    public function _update($id, $data)
    {
        $ProductCategory = ProductCategory::find($id);
        $ProductCategory->menu_id = $data['menu_id'];
        $ProductCategory->product_category  = $data['product_category'];
       // $ProductCategory->deleted_at  = $data['deleted_at'];
        $ProductCategory->save();
    }

    public function fetchCategory($menu_id)
    {
        $cat = ProductCategory::where('menu_id', $menu_id)->get();
        return $cat;
    }
    
}
