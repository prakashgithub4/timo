<?php

namespace App\Http\Controllers\fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Country;
use Srmklive\PayPal\Services\ExpressCheckout;
use PayPal;
class CheckoutController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('customer');
        $this->provider = new ExpressCheckout();
    }
    public function index()
    {
        $userdata = Auth::user();
       // $cart  = Cart::where('user_id',$userdata->id)->get();
        $product = Product::select('carts.id as CI','products.id','products.image_src','products.seo_title','carts.qty','carts.price')
        ->leftJoin('carts','carts.product_id','=','products.id')
        ->where('carts.user_id',$userdata->id)
        ->get();
        $country = Country::all();
        
     
        return view('fontend.checkout',compact('product','country'));
    }
   
}
