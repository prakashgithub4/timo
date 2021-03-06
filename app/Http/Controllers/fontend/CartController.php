<?php

namespace App\Http\Controllers\fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Models\Coupon;
use App\Models\Coupon_Apply;
use Auth;


class CartController extends Controller
{
  //
  protected $product  = null;
  public function __construct(ProductRepository $product)
  {
    $this->product = $product;
  }
  public function index()
  {
    $userdata = \Auth::user();
    $coupon_details = Cart::select('coupons.*')
                      ->leftJoin('apply_coupons','apply_coupons.user_id','=','carts.user_id')
                      ->leftJoin('coupons','coupons.id','=','apply_coupons.coupon_id')
                      ->where('apply_coupons.user_id',$userdata->id)
                      ->first();

    return view('fontend.carts',compact('coupon_details'));
  }

  public function add_to_cart(Request $request)
  {
    $userdata = Auth::user();
    if (empty($userdata)) {
      if (isset($_COOKIE['device'])) {
        $device_id = $_COOKIE['device'];
      } else {
        $token = 'P-' . date('Y') . '-' . rand(100000, 999999);
        setcookie("device", $token, time() + 60 * 60 * 24 * 365, "/", "", 0);
        $device_id = $_COOKIE['device'];
      }

      $product_id = $request->p_id;
      $products = Product::select('id', 'variant_inventory_qty', 'cost_per_item', 'image_src', 'seo_title')->where('id', $product_id)->first();
      //$sub_total = ($products->variant_inventory_qty > 0) ? $products->cost_per_item * $products->variant_inventory_qty : 0;
      $carts = Cart::where('product_id', $product_id)->where('device_id', $device_id)->first();
      $current_price = price_rang($products->id);
      //  if ($products->variant_inventory_qty > 0) {
      if (empty($carts)) {
        $addcart = new Cart();
        $addcart->product_id = $product_id;
        $addcart->device_id = $device_id;
        //$addcart->price = $products->cost_per_item;
        $addcart->price = $current_price['current_price'];
        $addcart->sub_total = $current_price['current_price'];
        $addcart->qty = is_null($request->qty) ? 1 : $request->qty;
        $addcart->save();
      } else {
        $carts->qty = $carts->qty + 1;
        $carts->price = $carts->price;
        $carts->sub_total = $carts->price * $carts->qty;
        $carts->save();
      }
      // $products->variant_inventory_qty = ($products->variant_inventory_qty > 0)? $products->variant_inventory_qty - 1 : 0;
      // $products->save();
      //  \App\Models\Wishlist::where('user_id', $userdata->id)->where('product_id', $product_id)->delete();
      return response()->json(['stat' => true, 'message' => "cart has been added successfully", 'cartdetails' => cart_list()]);
      // } else {
      //   return response()->json(['stat' => false, 'message' => "Sorry Product is currently not available in our stock"]);
      // }
    } else {
      $product_id = $request->p_id;
      $products = Product::select('id', 'variant_inventory_qty', 'cost_per_item', 'image_src', 'seo_title')->where('id', $product_id)->first();
      // $sub_total = ($products->variant_inventory_qty > 0) ? $products->cost_per_item * $products->variant_inventory_qty : 0;
      $carts = Cart::where('product_id', $product_id)->where('user_id', $userdata->id)->first();
      $total_wish_list = \App\Models\Wishlist::where('user_id', $userdata->id)->count();
      $current_price = price_rang($products->id);
      if ($products->variant_inventory_qty > 0) {
        if ($userdata->user_type == 'customer') {
          if (empty($carts)) {
            $addcart = new Cart();
            $addcart->product_id = $product_id;
            $addcart->user_id = $userdata->id;
            $addcart->price = $current_price['current_price'];
            $addcart->sub_total = $current_price['current_price'];
            $addcart->qty = is_null($request->qty) ? 1 : $request->qty;
            $addcart->save();
          } else {
            $carts->qty = $carts->qty + 1;
            $carts->price = $carts->price;
            $carts->sub_total = $carts->price * $carts->qty;
            $carts->save();
          }
          \App\Models\Wishlist::where('user_id', $userdata->id)->where('product_id', $product_id)->delete();
          return response()->json(['stat' => true, 'message' => "cart has been added successfully", 'cartdetails' => cart_list(), "number_of_wish" => $total_wish_list]);
        } else {
          return response()->json(['stat' => false, 'message' => "Sorry this user can't perform this task"]);
        }

        // $products->variant_inventory_qty = ($products->variant_inventory_qty > 0)? $products->variant_inventory_qty - 1 : 0;
        // $products->save();


      } else {
        return response()->json(['stat' => false, 'message' => "Sorry Product is currently not available in our stock"]);
      }
    }
  }
  public function removecart(Request $request)
  {
    $cart_id = $request->cart_id;
    $carts = Cart::find($cart_id);
    //  $products = Product::find($carts->product_id);
    //  $products->variant_inventory_qty = $products->variant_inventory_qty + $carts->qty;
    //  $products->save(); 
    Cart::where('id', $cart_id)->delete();
    return response()->json(["status" => true, "data" => $carts, 'message' => "Cart has been removed successfully", 'cartdetails' => cart_list()]);
  }
  public function updatecart(Request $request)
  {
    $forms = $request->form;
    $input_array = [];
    foreach ($forms as $cart_id) {
      if ($cart_id['name'] == 'quantities') {
        $input_array['qty'][] = $cart_id['value'];
      } else if ($cart_id['name'] == 'cart_id') {
        $input_array['cart_id'][] = $cart_id['value'];
      }
    }
    foreach ($input_array['cart_id'] as $key => $item) {
      $updatecart = Cart::find($item);
      $updatecart->qty = $input_array['qty'][$key];
      $updatecart->sub_total = $input_array['qty'][$key] * $updatecart->price;
      $updatecart->save();
    }
    return 1;
  }
  public function updateuseridintocart()
  {
    $userdata = \Auth::user();
    if (!empty($userdata)) {
      if (isset($_COOKIE['device'])) {
        $device_id = $_COOKIE['device'];
        $carts = Cart::where('device_id', $device_id)->get();
        foreach ($carts as $cart) {

          $updatecart = Cart::find($cart->id);
          $updatecart->user_id = $userdata->id;
          $updatecart->device_id = Null;
          $updatecart->save();
        }
      }
      $cartswithuser = Cart::where('user_id', $userdata->id)->get();
      foreach ($cartswithuser as $key => $item) {
        $checkproducts  = Cart::where('user_id', $userdata->id)->where('product_id', $item->product_id)->count();
        if ($checkproducts > 1) {
          $updateqty = Cart::find($item->id);
          $updateqty->qty = $updateqty->qty + 1;
          $updateqty->save();
          $cart = Cart::where('user_id', $userdata->id)->where('product_id', $item->product_id)->orderBy('id', 'desc')->first();
          $cart->delete();
        }
      }
      return response()->json(['stat' => true, 'cartdetails' => cart_list()]);
    }
  }
  public function cuponcode_apply(Request $request)
  {  
     $userdata = Auth::user();
     $coupon = Coupon::where('coupon',$request->coupon)->first();
     if(!empty($coupon))
     {

     $today = date('Y-m-d');
     $expiration_day = date('Y-m-d',strtotime($coupon->expire_date));
     
     if($today < $expiration_day)
     {
       $coupon_apply  = Coupon_Apply::where('user_id',$userdata->id)->first();
       if(empty($coupon_apply))
       {
          $newcoupon = new Coupon_Apply();
          $newcoupon->user_id = $userdata->id;
          $newcoupon->coupon_id = $coupon->id;
          $newcoupon->save();
          $coupon->status = 'apply';
          $coupon->save();
          return response()->json(['stat'=>true,'message'=>'Coupon code has been applied successfully','data'=>$coupon]);
       }
       else if($coupon->status == 'apply')
       {
        return response()->json(['stat'=>false,'message'=>'Coupon is already applied','data'=>$coupon]);
       }
       else
       {
          $coupon_apply->user_id = $userdata->id;
          $coupon_apply->coupon_id = $coupon->id;
          $coupon_apply->save();
          $coupon->status = 'apply';
          $coupon->save();
          return response()->json(['stat'=>true,'message'=>'Coupon code has been applied successfully','data'=>$coupon]);
       }
     }
     else if(empty($userdata))
     {
       return response()->json(['stat'=>false,'message'=>'please login first']); 
     }
     else
     {

      $coupon_apply = Coupon_Apply::where('coupon_id',$coupon->id)->first();
      if(!empty($coupon_apply))
      {
        $coupon_apply->delete();
      }
      $coupon->status = 'expired';
      $coupon->save();
      return response()->json(['stat'=>false,'message'=>'Coupon Code is expired','data'=>[]]);
     }
    }
    else
    {
      return response()->json(['stat'=>false,'message'=>'Coupon code is invalid']);
    }
  }

  public function removecoupon()
  {
    $coupon = Coupon::find(request()->coupon_id);
    $coupon->status = 'removed';
    $coupon->save();
    $coupon_apply = Coupon_Apply::where('coupon_id',request()->coupon_id)->first();
    $coupon_apply->delete();
    return response()->json(['stat' => true, 'message' => 'Coupon code has been removed successfully', 'data' => $coupon]);
  }
  public function checkexpiration()
  {
    $userdata = \Auth::user();
    $coupon_details = Cart::select('coupons.*')
    ->leftJoin('apply_coupons','apply_coupons.user_id','=','carts.user_id')
    ->leftJoin('coupons','coupons.id','=','apply_coupons.coupon_id')
    ->where('coupons.status','apply')
    ->where('apply_coupons.user_id',$userdata->id)
    ->first();
    if(empty($coupon_details))
    {
      return response()->json(['stat'=>false,'message'=>'No any Coupon code currently applied']);
    }
    $today = date('Y-m-d');
    $expiredate = date('Y-m-d',strtotime($coupon_details->expire_date));
    if($today <= $expiredate)
    {
      $coupon = Coupon::find($coupon_details->id);
      $coupon->status = 'apply';
      $coupon->save();
      return response()->json(['stat'=>false,'message'=>'Coupon code is applied']);
     
    }
    else
    {
      $coupon_apply = Coupon_Apply::where('coupon_id',$coupon_details->id)->first();
      $coupon_apply->delete();

      $coupon = Coupon::find($coupon_details->id);
      $coupon->status = 'expired';
      $coupon->save();
      return response()->json(['stat'=>true,'message'=>'Coupon code has been expired']);
    }
  }
}
