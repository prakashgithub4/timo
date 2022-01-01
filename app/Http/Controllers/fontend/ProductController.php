<?php

namespace App\Http\Controllers\fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\Gallery;
use App\Models\Size;
use App\Models\ProductAttributeMapping as PA;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index($id)
    {

      
      $product_id = Crypt::decryptString($id); 
     // print_r($product_id);exit();
      $attribute_array = [];
      $product_image_array =[];
      $related_images = [];
      $product = Product::select('products.id','products.type','products.body','products.seo_title','products.color','products.image_src','products.seo_description','products.attribute_values','products.long_description','colors.name as cname','sizes.size','shapes.name as sname')
      ->leftJoin('colors','colors.id','=','products.color')
      ->leftJoin('sizes','sizes.id','=','products.size')
      ->leftJoin('shapes','shapes.id','=','products.shape')
      ->where('products.id',$product_id)
      ->first();
      
     
      $attribute_array[] =['value' =>$product->cname,'name'=>'Color'];
      $attribute_array[] =['value'=>$product->sname,'name'=>'Shape'];
      $attribute_array[] =['value'=>$product->size,'name'=>'Size'];
      $product_attribute_values =  json_decode($product->attribute_values);
       if(@count($product_attribute_values) >0)
       {
          foreach($product_attribute_values as $key=>$attributes)
          {
            $attribute = Attribute::where('id',$attributes->attribute_id)->first();
            $attribute_array[] = [
              'name' =>$attribute->name,
              'value'=>$attributes->value,
              'key'=>$key+1
            ];
          }
       }

       $attribute_data =  PA::select('attributes.name as name','product_attribute_mapping.attribute_values as value')
       ->leftjoin('attributes', 'product_attribute_mapping.aid', '=', 'attributes.id')
       ->leftjoin('products', 'product_attribute_mapping.pid', '=', 'products.id')
       ->where('products.id',$product_id)
       ->get();
     

      //  $attribute_data =  DB::table('product_attribute_mapping')
      //  ->leftjoin('attributes', 'product_attribute_mapping.aid', '=', 'attributes.id')
      //  ->leftjoin('products', 'product_attribute_mapping.pid', '=', 'products.id')
      //  ->where('products.id',$product_id)
      //  ->get();

     
        $product_image_array[]=['image'=>$product->image_src];
        $gellary = Gallery::where('status','active')->where('product_id',$product_id)->get();
        foreach($gellary as $gelleries)
        {
          $product_image_array[]=['image'=>$gelleries->image];
        }
      
       $realted_products = Product::select('id','seo_title','seo_description','type','image_src')->where('id','!=',$product_id)->skip(0)->take(10)->get();
       $recent = implode(',',recent_views($product_id));
       
       $recent_view = Product::select('id','seo_description','seo_title','type','image_src')->whereIn('id',explode(',',$recent))->skip(0)->take(10)->get();
       //echo"<pre>";print_r($recent_view); exit;
      return view('fontend.product_details',compact('product','attribute_array','realted_products','product_image_array','recent_view','attribute_data'));
    }
   
   
}
