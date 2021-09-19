<?php

namespace App\Http\Controllers\fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('customer');
    }
    public function index()
    {
        $userdata = Auth::user();
       // $cart  = Cart::where('user_id',$userdata->id)->get();
        $product = Product::select('products.id','products.image_src','products.seo_title','carts.qty','carts.price')
        ->leftJoin('carts','carts.product_id','=','products.id')
        ->where('carts.user_id',$userdata->id)
        ->get();
        
     
        return view('fontend.checkout',compact('product'));
    }
}
