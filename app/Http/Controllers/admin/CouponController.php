<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\User;

class CouponController extends Controller
{
    public function __construct()
    {
       $this->middleware('admin');
    }

    public function index()
    {
      $coupon = Coupon::select('products.seo_title','users.email','coupons.*')->leftJoin('users', 'users.id', '=', 'coupons.user_id')->leftJoin('products', 'products.id', '=', 'coupons.product_id')->get();
      return view('admin.coupon.coupons',compact('coupon'));
    }
    public function add($id = Null)
    {
       $product = Product::select('id','seo_title')->get();
       $user = User::select('id','email')->where('user_type','customer')->get();
      if(is_null($id))
      {
        return view('admin.coupon.add',compact('product','user'));
      }
      else
      {
         $coupon = Coupon::find($id);
         return view('admin.coupon.add',compact('product','user','coupon'));
      }
     
    }
    public function save(Request $request)
    {
      $request->validate([
            'discount'=>'required',
            'create_date'=>'required',
            'expire_date'=>'required',
            'status'=>'required'
        ]);
      $coupon = (is_null($request->id)) ? new Coupon() : Coupon::find($request->id);
      $coupon->product_id  =$request->product;
      $coupon->user_id  =$request->user;
      $coupon->discount  =(float)$request->discount; 
      $coupon->coupon  =is_null($request->coupon) ? 'coupon-'.date('Y').'-'.rand(10000,99999) : $request->coupon;
      $coupon->created_date  =date('Y-m-d',strtotime($request->create_date));
      $coupon->expire_date  =date('Y-m-d',strtotime($request->expire_date));
      $coupon->status  =$request->status; 
      $coupon->save();
      if(is_null($request->id))
      {
         return redirect()->route('admin.product.coupon')->with('success','Coupon code has been added successfully');
      }
      else
      {
          return redirect()->route('admin.product.coupon')->with('success','Coupon code has been updated successfully');
      }
      
    }
    public function remove($id)
    {
      $coupon  = Coupon::find($id)->delete();
      return redirect()->route('admin.product.coupon')->with('success','Coupon code has been removed successfully');
    }

    
}
