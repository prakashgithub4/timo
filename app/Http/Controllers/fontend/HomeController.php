<?php

namespace App\Http\Controllers\fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\HomeRepository;
use App\Repositories\SliderRepository;
use App\Models\Shape;
use App\Models\Gift;
use App\Models\Product;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    //
    public $home;
    public $slide;
    function __construct(HomeRepository $home, SliderRepository $slide)
    {
        $this->home= $home;
        $this->slide= $slide;
        $this->minute = 10;
    }
    public function index()
    {   
        $slider = $this->slide->getSlider();
        $category = $this->home->getLatestCategory();
        $secondcategories = $this->home->getLatestCategory(3,3);
        $products = $this->home->publishedproducts();
        $purchased = $this->home->publishedproducts(null,1);
        $recomanded = Product::select('products.id', 'products.seo_title', 'products.tags', 'products.seo_description', 'products.image_src', 'products.variant_image', 'products.cost_per_item', 'products.body', 'products.type')
                         ->leftJoin('menus','menus.id','=','products.menu')
                         ->orderBy('products.id', 'asc')
                         ->where('products.published', 'TRUE')
                         ->where('menus.menu_name','Diamonds')
                         ->skip(0)
                         ->take(10)
                         ->get();

        $shapes = Shape::all();  
        $gifts = Gift::all();

        Cache::put('product', $products,$this->minute);
        Cache::put('slider',$slider,$this->minute);
        Cache::put('category',$category,$this->minute);
        Cache::put('secondcat',$secondcategories,$this->minute);
        Cache::put('purchased',$purchased,$this->minute);
        Cache::put('recommended',$recomanded,$this->minute);
        Cache::put('shapes',$shapes,$this->minute);
        Cache::put('gift',$gifts,$this->minute);
        if(Cache::has('product'))
        {
            $products = Cache::get('product');
        }
        if(Cache::has('slider'))
        {
            $slider = Cache::get('slider');
        }
        if(Cache::get('category'))
        {
            $category = Cache::get('category');
        }
        if(Cache::get('secondcat'))
        {
            $secondcategories = Cache::get('secondcat');
        }
        if(Cache::get('purchased'))
        {
            $purchased = Cache::get('purchased');
        }
        if(Cache::get('recommended'))
        {
            $recomanded = Cache::get('recommended');
        }
        if(Cache::get('shapes'))
        {
            $shapes = Cache::get('shapes');
        }
        if(Cache::get('gift'))
        {
            $gifts = Cache::get('gift');
        }       
        return view('fontend.home')->with([
            'slider'=>$slider,
            'category'=>$category,
            'secondcategory'=>$secondcategories,
            'products'=>$products,
            'shapes'=>$shapes,
            'gifts'=>$gifts,
            'purchased_product'=>$purchased,
            'recommended'=>$recomanded
        ]);
    }

  public function getProductById(Request $request)
    {
        $id = $request->id;
        $product = $this->home->publishedproducts($id);
        $result_array =['id'=>$product->id,'seo_title'=>$product->seo_title,'image_src'=>$product->image_src,'old_price'=>price_rang($product->id)['current_price'],
        'current_price'=>price_rang($product->id)['old_price'],'description'=>$product->seo_description,'url' =>route('product',Crypt::encryptString($product->id))];
        return collect(['data'=>$result_array]);
    }

    public function create_subscriber(Request $request)
    {
       $userdata = \Auth::user();
       if(empty($userdata))
       {
           return 3;
       }
       else
       {
           $email = $request->email;
           if(empty($email))
           {
            return 4;
           }
           $subscribers = \App\Models\Subscriber::where('email',$email)->count();
           if($subscribers == 0)
           {
               $subscriber  = new \App\Models\Subscriber();
               $subscriber -> email = $email;
               $subscriber -> save();
               return 1;
           }
           else 
           {
               return 0;
           }
       }
    }
}
