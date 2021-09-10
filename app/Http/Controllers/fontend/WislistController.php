<?php

namespace App\Http\Controllers\fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class WislistController extends Controller
{
    //
    public function index()
    {
        $userdata = Auth::user();
        if(empty($userdata))
        {
            $deveice_id = \Cookie::get('laravel_session');
            request()->session()->put('device', ''.$deveice_id.'');
            $wishlist_product = Product::select('wishlists.id as wislist_id','products.id','products.variant_inventory_qty','products.seo_title','products.seo_title','products.image_src','cost_per_item')->join('wishlists','products.id','=','wishlists.product_id')->where('device_id',$deveice_id)->get();
        }
        else
        {
            $deveice_id = \Cookie::get('laravel_session');
            $value = session('device');
            $wishlist = Wishlist::where('device_id',$deveice_id)->get();
            foreach($wishlist as $w)
            {
               $updated_user_id = Wishlist::where('device_id',$deveice_id)->first();
               $updated_user_id->user_id = Auth::user()->id;
               $updated_user_id->save();
            }
            $wishlist_product = Product::select('wishlists.id as wislist_id','products.variant_inventory_qty','wishlists.product_id as wp_id','products.id as product_id','products.seo_title','products.seo_title','products.image_src','cost_per_item')
                               ->join('wishlists','products.id','=','wishlists.product_id')
                               ->where('user_id',$userdata->id)
                              // ->groupBy('wp_id')
                               ->get();
            
        }
       
        return view('fontend.wishlist',compact('wishlist_product'));
    }
    public function create_wishlist(Request $request)
    {
        $userId = Auth::user();
        $deveice_id = \Cookie::get('laravel_session');

        if (empty($userId)) {
            
            return 3;
        } else {
           if(Auth::user()->user_type == 'customer')
           {
              $wishlist = Wishlist::where('product_id', $request->product_id)->where('user_id', $userId->id)->first();
            if (!empty($wishlist)) {
                $wishlist->product_id = $request->product_id;
                $wishlist->user_id = $userId->id;
                $wishlist->save();
                return 0;
            } else {
                $newwishlist = new Wishlist();
                $newwishlist->product_id = $request->product_id;
                $newwishlist->user_id = $userId->id;
                $newwishlist->save();
                return 1;
            }
           }
           else
           {
            return 3;
           }
          
        }
    }
    public function removewislist(Request $request)
    {
       $wislist = Wishlist::find($request->id)->delete();
       $wishlist_data = Wishlist::where('user_id',Auth::user()->id)->get();
       return response()->json(['stat'=>true,"message"=>"wishlist has been removed successfully",'wishlist'=>$wishlist_data]);
    }
}
