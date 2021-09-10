<?php

namespace App\Http\Controllers\fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Models\Compair as Compare;
use Auth;

class CompairController extends Controller
{
  //
 
  
  public function index()
  {
    $compair_array=[];
    $product = Product::select('products.image_src','products.id as p_id','products.color','products.attribute','products.attribute_values','products.shape','categories.name as cat_name','compairs.*','shapes.name as sname','colors.name as cname')
       ->join('compairs','products.id','=','compairs.product_id')
          ->leftJoin('categories','products.category','=','categories.id')
          ->leftJoin('shapes','products.shape','=','shapes.id')
          ->leftJoin('colors','products.color','=','colors.id')

          ->where('products.published','TRUE')->get();
          $compair_array['products'][] = ['product'=>'Product'];
          $compair_array['color'][] = ['color'=>'Color'];
          $compair_array['shape'][] = ['shape'=>'Shape'];

           $compair_array['attribute']=[];
           $compair_array['attribute_name'] =[];
           $compair_array['category'][] = ['category_name'=>'View Details'];
           $compair_array['price'][] = ['price'=>'Price'];
           $compair_array['add_to_cart'][] =['add_to_cart'=>'Add To Cart'];
           $compair_array['delete'][] =['delete'=>'Delete'];


          foreach($product as $products)
          {
            $price_range = price_rang($products->p_id);
            $compair_array['products'][] = ['image'=>$products->image_src];
            $compair_array['color'][] = ['name'=>$products->cname];
            $compair_array['shape'][] = ['name'=>$products->sname];
            $compair_array['category'][] = ['name'=>(is_null($products->cat_name))? 'Uncategorize' : $products->cat_name];
            $compair_array['price'][] = ['amount'=>'$'.number_format($price_range['current_price'],2)];
            $compair_array['add_to_cart'][] = ['product_id'=>$products->p_id];
            $compair_array['delete'][] = ['compaire_id'=>$products->id];
            if(!is_null($products->attribute_values))
            {
              $attributes= json_decode($products->attribute_values);
              foreach($attributes as $key=>$item)
              {
                
                  $compair_array['attribute'][$item->attribute_id][] = $item->value;
                
                
                $attribute_data = \App\Models\Attribute::find($item->attribute_id);
               
                  $compair_array['attribute_name'][$key] = ['name'=>$attribute_data->name,'attribute_id'=>$attribute_data->id];
                
              }
           }
           
        }
 //echo "<pre>"; print_r($compair_array['delete']); exit;

    return view('fontend.compair',compact('compair_array'));
  }
  public function addtocmpair(Request $request)
  {
    $userdata = Auth::user();
    if(!empty($userdata) && ($userdata->user_type == 'customer'))
    {
      $compair = Compare::where('user_id',$userdata->id)->count();
      $current_price = price_rang($request->product_id);

       if($compair < 3)
       {
          $checkproduct = Compare::where('product_id',$request->product_id)->first();
        if(empty($checkproduct))
        {
           $compairadd = new Compare();
           $compairadd->product_id = $request->product_id;
           $compairadd->code ="LD".rand(10000000,99999999);
           $compairadd->price = $current_price['current_price'];
           $compairadd->user_id = $userdata->id;
           $compairadd->save();
           return response()->json(['stat'=>true,'message'=>'Compare item has been added successfully']);
        }
          else
          {
             return response()->json(['stat'=>false,'message'=>"This product is already added in your compair list"]);
          }
        
       }
       else
       {
        return response()->json(['stat'=>false,'message'=>"Sorry You have alrady added three item in your compair list"]);
       }
    }
    else
    {
      return response()->json(['stat'=>false,'message'=>"Please Login first"]);
    }
    
  }

  function remove_compare(Request $request)
  {
    $userdata = Auth::user();
    if(!empty($userdata))
    {
      $compare  = Compare::find($request->compare_id)->delete();
      return response()->json(['stat'=>true,'message'=>'Compare item has been removed successfully']);
    }
    else
    {
      return response()->json(['stat'=>false,'message'=>'please login first']);
    }
    
  }
}
