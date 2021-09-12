<?php

namespace App\Http\Controllers\fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\HomeRepository;
use App\Repositories\SliderRepository;
use App\Models\Shape;
use App\Models\Gift;


class HomeController extends Controller
{
    //
    public $home;
    public $slide;
    function __construct(HomeRepository $home, SliderRepository $slide)
    {
        $this->home= $home;
        $this->slide= $slide;
    }
    public function index()
    {   // print_r(price_rang(2)); exit;
        $slider = $this->slide->getSlider();
        $category = $this->home->getLatestCategory();
        $secondcategories = $this->home->getLatestCategory(3,3);
        $products = $this->home->publishedproducts();
        $purchased = $this->home->publishedproducts(null,1);
        $shapes = Shape::all();  
        $gifts = Gift::all();

        return view('fontend.home')->with([
            'slider'=>$slider,
            'category'=>$category,
            'secondcategory'=>$secondcategories,
            'products'=>$products,
            'shapes'=>$shapes,
            'gifts'=>$gifts,
            'purchased_product'=>$purchased
        ]);
    }

  public function getProductById(Request $request)
    {
        $id = $request->id;
        $product = $this->home->publishedproducts($id);
        return collect(['data'=>$product]);
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
