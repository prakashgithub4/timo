<?php

namespace App\Repositories;

use App\Models\Contactus;
use App\Models\Category;
use App\Models\Product;

class HomeRepository
{
    public function _add($data)
    {
        return Contactus::create($data);
    }
    public function _edit($id)
    {
        return Contactus::find($id);
    }

    public function _delete($id)
    {
        return Contactus::find($id)->delete();
    }
    public function _update($id, $data)
    {
        $shape = Contactus::find($id);
        $shape->name = $data['name'];
        $shape->logo = $data['logo'];
        $shape->save();
    }
    public function _getContact()
    {
        return Contactus::select('*')->first();
    }

 public function getLatestCategory($limit = 3,$offset =0)
    {
        $category = Category::select('*')->orderBy('id','desc')->skip($offset)->take($limit)->get();
        return $category;
    }
    public function publishedproducts($id = null,$is_purchases = null)
    {
        if(!is_null($is_purchases))
        {
            $product = Product::select('id', 'seo_title', 'tags', 'seo_description', 'image_src', 'variant_image', 'cost_per_item', 'body', 'type')
                ->orderBy('id', 'asc')
                ->where('published', 'TRUE')
                ->where('is_purchased', $is_purchases)
                ->orderBy('id','asc')
                ->skip(0)
                ->take(15)
                ->get();
            return $product;
        }

        if (is_null($id)) {
            $product = Product::select('id', 'seo_title', 'tags', 'seo_description', 'image_src', 'variant_image', 'cost_per_item', 'body', 'type')
                ->orderBy('id', 'asc')
                ->where('published', 'TRUE')
                ->skip(0)
                ->take(15)
                ->get();
            return $product;
        } else {
            $product = Product::select('id', 'seo_title', 'tags', 'seo_description', 'image_src', 'variant_image', 'cost_per_item', 'body', 'type')
                ->with('gallery')
                ->orderBy('id', 'asc')
                ->where('published', 'TRUE')
                ->where('id', $id)
                ->first();
            return $product;
        }
        
    }
}
