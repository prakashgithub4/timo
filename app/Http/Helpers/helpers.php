<?php

use GuzzleHttp\Cookie\SetCookie;
use App\Models\Product;
if(!function_exists('home_discount'))
{
    function home_discount($price)
    {
        $discount = \App\Models\Discount::pluck('amount');
        $percentage = $discount[0] * $price / 100; 
        $current_amount = $price - $percentage;
        return number_format($current_amount, 2);
    }
}
if(!function_exists('createurl'))
{
    function createurl($file_name)
    {
       $result = url('public/uploads/gallery').'/'.$file_name;
       return $result;
    }
}
if(!function_exists('gallerypicksecond'))
{
    function gallerypicksecond($product_id)
    {
       $result = \App\Models\Gallery::where('product_id',$product_id)->first();  
       return $result;
    }
}
if(!function_exists('currenturllastitem'))
{
    function currenturllastitem($url)
    {
       $item = explode('/',$url);
       return $item[1];
    }
}
if(!function_exists('cms'))
{
    function cms()
    {
      $cms= \App\Models\Cms::select('title','status')->get();
      return $cms;
    }
}
if(!function_exists('footercontact'))
{
    function footercontact()
    {
      $contact= \App\Models\Contactus::select('*')->first();
      return $contact;
    }
}

if(!function_exists('countwishlist'))
{
    function countwishlist()
    {
        $userdata = \Auth::user();
        if(!empty($userdata))
        {
            $wishlist = \App\Models\Wishlist::where('user_id',\Auth::user()->id)->count();
            return $wishlist;
        }
        else
        {
          return 0;
        }
        
        
    }
}

if(!function_exists('home_wish_list_count'))
{
    function home_wish_list_count($product_id)
    {
        $userdata = \Auth::user();
        if(!empty($userdata))
        {
            $wishlist = \App\Models\Wishlist::where('product_id',$product_id)->where('user_id',\Auth::user()->id)->count();
            if($wishlist > 0){
                return 1;
            }
            else
            {
                return 0;
            }
            
        }
        
        
        
    }
}

if(!function_exists('total_cart'))
{
    function total_cart()
    {
      $userdata = \Auth::user();
      $total_cart = 0;
      if(!empty($userdata)) 
      {
        $total_cart = \App\Models\Cart::select(\DB::raw('SUM(sub_total) as total_cart'))->where('user_id',\Auth::user()->id)->first();
      }
      else if(@$_COOKIE['device'])
      {
        $total_cart = \App\Models\Cart::select(\DB::raw('SUM(sub_total) as total_cart'))->where('device_id',@$_COOKIE['device'])->first();
      }
      return number_format(@$total_cart->total_cart,2);
    }
}

if(!function_exists('total_cart_count'))
{
    function total_cart_count()
    {
        $userdata = \Auth::user();
        $count = 0;
        if(!empty($userdata)) 
        {
          $count = \App\Models\Cart::where('user_id',\Auth::user()->id)->count();
        }
        else if(@$_COOKIE['device'])
        {
          $count = \App\Models\Cart::where('device_id',$_COOKIE['device'])->count();
        }
        return $count;
    }
}

if(!function_exists('cart_list'))
{
    function cart_list()
    {
        $userdata = \Auth::user();
        $cartproduct = [];
        if(!empty($userdata)) 
        {
          $cartproduct = \App\Models\Cart::select('carts.id','carts.sub_total','products.image_src','products.seo_title','carts.qty','carts.price')->join('products', 'products.id', '=', 'carts.product_id')->where('carts.user_id',\Auth::user()->id)->get();
        }
        else if(@$_COOKIE['device'])
        {
          $cartproduct = \App\Models\Cart::select('carts.id','carts.sub_total','products.image_src','products.seo_title','carts.qty','carts.price')->join('products', 'products.id', '=', 'carts.product_id')->where('carts.device_id',$_COOKIE['device'])->get();
        }
        return $cartproduct;
    }
}

if(!function_exists('is_product_cart'))
{

    function is_product_cart($p_id)
    {
        $userdata = \Auth::user();

       if(!empty($_COOKIE['device']) &&(empty($userdata)))
       {
       
         $cart = \App\Models\Cart::where('device_id',@$_COOKIE['device'])->where('product_id',$p_id)->count();

         if($cart > 0)
         {
            return 1;
         }
         else
         {
            return 0;
         }
       }
       else if(\Auth::check() && !empty($userdata))
        {
         $cart = \App\Models\Cart::where('user_id',$userdata->id)->where('product_id',$p_id)->count();
         if($cart > 0)
         {
            return 1;
         }
         else
         {
            return 0;
         }
        } 
    }
}
if(!function_exists('price_rang'))
{
    function price_rang($product_id)
    {
       
       $range_details = [];
       $counter = 0;
       $product = \App\Models\Product::select('id','cost_per_item')->where('id',$product_id)->first();
       $min = \App\Models\Product::min('cost_per_item');
       
       if(!empty($product))
       {
         $price_range = \App\Models\Price_Range::where('start_price','>=',$min)
                                               ->where('end_price','<=',$product->cost_per_item)
                                               ->where('status','=','active')
                                               ->orderBy('id','desc')
                                               ->first();
           if(!empty($price_range))
           {
             return array('old_price'=>$product->cost_per_item + $price_range->differance,'current_price'=>$product->cost_per_item - $price_range->differance);
           }
           else
           {
              return array('old_price'=>$product->cost_per_item ,'current_price'=>$product->cost_per_item);
           }

       }
       
    }
}

if(!function_exists('count_compares'))
{
    function count_compares($product_id)
    {
        $userdata = \Auth::user();
        if(!empty($userdata))
        {
          $compare = \App\Models\Compair::where('user_id',$userdata->id)->where('product_id',$product_id)->count();
            if($compare > 0)
            {
              return 1;
            }
            else
            {
              return 0;
            }
        }
        else
        {
            return 0;
        }
       
    }
}

if(!function_exists('recent_views'))
{
    function recent_views($product_id)
    {
    //unset($_COOKIE['recent_view']);
   if(isset($_COOKIE['recent_view']))
   {
    $recent = unserialize($_COOKIE['recent_view']);
    $serach_key = array_search($product_id,$recent,true);
    if($serach_key)
    {
      unset($recent[$serach_key]);
    }
    else
    {
      $recent[] = $product_id;
    }
   
    setcookie('recent_view',serialize($recent),time()+ 60*60*24*365,"/");
    return array_unique($recent);
   }
   else
   {
      $recent = unserialize(@$_COOKIE['recent_view']);
      $rect = !empty($recent) ? $recent : [];
      $serach_key = array_search($product_id,$rect,true);
      if($serach_key)
      {
        unset($recent[$serach_key]);
      }
      else
      {
        $recent[] = $product_id;
      }
      setcookie('recent_view',serialize($rect),time()+ 60*60*24*365,"/");
     
   }
   return array_unique($recent);
 }
}

if(!function_exists('recent_products'))
{
    function recentproducts()
    {
      if(isset($_COOKIE['recent_view']))
      {
        $recent  = unserialize($_COOKIE['recent_view']);
        $recents = implode(',',$recent);
        $recent_view = Product::select('id','seo_description','seo_title','type','image_src')->orderBy('id','desc')->whereIn('id',explode(',',$recents))->skip(0)->take(10)->get();
        return $recent_view;
      }
    }
}



?>