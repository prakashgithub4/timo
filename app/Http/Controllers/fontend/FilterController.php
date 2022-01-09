<?php

namespace App\Http\Controllers\fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\Shape;
use App\Models\ProductAttributeMapping;
use App\Models\Wishlist;
use App\Models\Menu;
use App\Models\Menu_sub_category;
use App\Models\Share;
use App\Models\User;
use Crypt;

class FilterController extends Controller
{

    public function __construct()
    {
        $this->pageSize = 20;
       
    }
    public function index()
    {
        $shape = Shape::all();
        $carat = Product::join('product_attribute_mapping','products.id','=','product_attribute_mapping.pid')
        ->join('attributes','product_attribute_mapping.aid','=','attributes.id')
        ->where('attributes.name','=','Carat');
        $maxcarat=null;
        $mincarat = null;
        if($carat->count() > 5){
            $maxcarat =$carat->max('product_attribute_mapping.attribute_values');
            $mincarat =$carat->min('product_attribute_mapping.attribute_values');
        }
        $filter = \DB::table('filter')->select('name')->get();
        
        return view('fontend.diamonds_search',compact('shape','maxcarat','mincarat','filter'));
    }

    public function allPosts(Request $request)
    {
        return $this->search();
    }
    public function getPagelengthwisedata(Request $request)
    {
        $length = $request->query();
        return $this->search(null,$length['page_length']);
    }
    
    public function pageLink(Request $request)
    {
       $page = $request->query();
       $data = $this->search($page['page'],$page['length']);
       return response()->json(['stat'=>true,'data'=>$data]);
       
    }
    public function filter(Request $request)
    {
       $filter = $request->query();
       
       $shape =isset($filter['shape'])?$filter['shape']:null;
       $carat = isset($filter['carat']) ? $filter['carat']: null;
       $dept = isset($filter['dept']) ? $filter['dept'] : null;
       $min = isset($filter['min'])?$filter['min']:null;
       $max = isset($filter['max'])?$filter['max']:null;
       if(isset($filter['cmin'])&&isset($filter['cmax']))
       {
          $carats= ["min"=>$filter['cmin'],"max"=>$filter['cmax']];
       }
       else
       {
        $carats= [];
       }
       $shape_id=isset($filter['shapes']) ? $filter['shapes'] :null;

       $ordervalue = isset($filter['order']) ? $filter['order']:null;
       $sort = isset($filter['sort']) ? $filter['sort'] :null;
       $attributes = isset($filter['attribute'])?$filter['attribute']:null;
      
      

       $data = $this->search(null,null,$min,$max,$ordervalue,$shape_id,$carats);
     // echo"<pre>"; print_r($data);exit;
        return response()->json(['stat'=>true,'data'=>$data]);
     
      
       // echo"<pre>";print_r($filter);exit;


  
       // $data = $this->search(null,null,$min,$max);
       // return response()->json(['stat'=>true,"data"=>$data]);
    }
   
   
   
   // public function carat_filter(Request $request)
   // {
   //     $query = $request->query();
   //     $result =  $this->search(null, null,null,null,null, null,$query);
   //     return response()->json(['stat'=>true,'data'=>$result]);
   // }


   // public function symentry_filter(Request $request)
   // {
   //     $query = $request->query();
   //     $result =  $this->search(null, null,null,null,null, null,null,null,null,null,$query);
   //     return response()->json(['stat'=>true,'data'=>$result]);
   // }

   // public function florance_filter(Request $request)
   // {
   //     $query = $request->query();
   //     $result =  $this->search(null, null,null,null,null, null,null,null,null,null,null,$query);
   //     return response()->json(['stat'=>true,'data'=>$result]);
   // }
   // public function dept_filter(Request $request)
   // {
   //     $query = $request->query();
   //     $result =  $this->search(null, null,null,null,null, null,$query);
   //     return response()->json(['stat'=>true,'data'=>$result]);
   // }





    public  function search($page = 1, $pageSize = 0,$min=null,$max = null,$order = 0,$shapeId = null,$attribute=null)
    {

        /** Calculate Pagination **/
        $pageSize = ($pageSize == 0) ? $this->pageSize : $pageSize;
        $product = Product::where('published', 'TRUE')->count();
        $number_of_page = ceil($product / $pageSize);
        $attribute_values =[];
        if ($page == 0) {
            $page = 1;
        } else {
            $page = $page;
        }
        $page_first = ($page - 1) * $pageSize;
        // \DB::enableQueryLog();


        $allProduct = \DB::table('products')
            ->select(['products.id','shapes.id as sid','shapes.name as sname','products.seo_title','shapes.logo as slogo','products.seo_description',
             'products.type', 'products.image_src','shapes.name as shape','colors.name as color',
             'products.attribute_values','products.cost_per_item'
         ])->leftjoin('product_attribute_mapping','products.id','=','product_attribute_mapping.pid')
           // ->leftjoin('attributes','product_attribute_mapping.aid','=','attributes.id')
            ->leftjoin('shapes','shapes.id','=','products.shape')
            ->leftjoin('colors','colors.id','=','products.color')
            ->distinct();

        $allProduct = $allProduct->offset($page_first);
        if ($pageSize != 0) {
            $allProduct = $allProduct->limit($pageSize);
        } else {
            $allProduct = $allProduct->limit($pageSize);
        }
        if(!is_null($min) && !is_null($max))
        {
            $allProduct = $allProduct->whereBetween('products.cost_per_item',[$min,$max]);
        }
        if(isset($shapeId))
        { 
            $shapIds = implode(',',$shapeId);
            $sids = explode(',',$shapIds);
            $allProduct = $allProduct->whereIn('products.shape',$sids);
        }
        if(!empty($attribute))
        {
            $allProduct = $allProduct->whereBetween('product_attribute_mapping.attribute_values',[$attribute['min'],$attribute['max']]);
        }
      
        if($order ==  0)
        {
            $allProduct = $allProduct->orderBy('products.id','ASC');
        }
        else 
        {
            $allProduct = $allProduct->orderBy('products.id','DESC');
        }
       



        $allProduct = $allProduct->where('products.published', 'TRUE')
            ->get();
       // dd(\DB::getQueryLog());
        $result = [];
        $attributes = [];
        
      
        foreach ($allProduct as $products) {
            $price = price_rang($products->id);
            $attributes[$products->id] = ProductAttributeMapping::select('attribute_values','aid as id')->where('pid',$products->id)->get();
             $slug = strtolower($products->sname);
             $wishlist = Wishlist::where('product_id',$products->id)->count();
            
            $result[] = [
                "id" => $products->id,
                "title" => $products->seo_title,
                "seo_description" => \Str::limit($products->seo_description, 50),
                "type" => $products->type,
                "image_src" => $products->image_src,
                "price" => (isset($price['current_price']))?number_format($price['current_price'], 2):0 ,
                "old_price" => isset($price['old_price'])?number_format($price['old_price'], 2) :0 ,
                'product_details' => route('product', [\Crypt::encryptString($products->id)]),
                "attributes"=>$attributes[$products->id],
                 'shape'=>$products->shape,
                 'color'=>$products->color,
                 "slogo"=>asset('public/uploads/shape').'/'.$products->slogo,
                 'shape_url'=>route('shape.details',[Crypt::encryptString($products->sid),$slug]),
                 'product_url'=>route('product',[Crypt::encryptString($products->id)]),
                 'isWishlist'=>($wishlist > 1)?true:false
                
            ];
        }
        $price_range = pricefilterrange();
         $maxprices = $price_range['max'];

        
        return response()->json(['stat' => true, "data" => $result ,"maxprice"=>number_format($maxprices,2),'total_pages' => $number_of_page,'page'=>$page,'total'=>count($allProduct)]);
    }

    public function product_menu_details($menu_id)
    {
        $m_id = Crypt::decryptString($menu_id);
        $menuDetails = Menu::find($m_id);
        $submenuDetails = Menu_sub_category::find($m_id);
        if(!empty($menuDetails))
        {
            $menuarray =[
                "menu_name"=>$menuDetails->menu_name,
                "banner"=>$menuDetails->banner,
                "description"=>$menuDetails->description
            ];
        }
        else
        {
            $menuarray =[
                "menu_name"=>$submenuDetails->name,
                "banner"=>$submenuDetails->banner_image,
                "description"=>$submenuDetails->description
            ];
        }
        
     
        $products= Product::select([
                            'products.id',
                            'products.seo_title',
                            'products.seo_description',
                            'products.type',
                            'products.image_src'
                            ])
                       ->leftjoin('menus','products.menu','=','menus.id')
                       ->leftjoin('menu_sub_category','products.menu','=','menu_sub_category.id')
                       ->where('menus.id','=',$m_id)
                       ->orWhere('menu_sub_category.id','=',$m_id)
                       ->paginate($this->pageSize);
        
       return view('fontend.menudetails',compact('products','menuarray'));
    }

    public function shareproduct(Request $request)
    {

        $userData  = \Auth::user();

        if($userData)
        {
            $sharedetails = Share::where('productId','=',$request->productId)->first();
            if(!$sharedetails)
            {
                $share = new Share();
                $share->userId = $userData->id;
                $share->productId = $request->productId;
                $share->share_by  = $request->media;
                $share->save();
                $user = User::find($userData->id);
                $user->shared_id = $share->id;
                $user->save();
            }
            $sharedetails->no_of_sahre = $sharedetails->no_of_sahre + 1;
            $sharedetails->save();
             $user = User::find($userData->id);
             $user->shared_id = $share->id;
             $user->save();

           
            return response()->json(['stat'=>true,'message'=>'successfully shared product','data'=>$share]);
        }
       
    }

    // public function product_search(Request $request)
    // {
    //   $search = $request->query();
    //   // $products =  Product::select('id','seo_title','seo_description','image_src','type');
    //   // if(!is_null($search))
    //   // {
    //   //     $products = $products->where('seo_title', 'LIKE', "%{$search}%");
    //   // }
    //   // $products = $products->paginate(11);
    //   // return view('fontend.search',compact('products'));
    // }

    public function suggestionProducts(Request $request)
    {
       $name = $request->query('name');
       $suggestionproducts = Product::select('id','seo_title','image_src')->distinct()->where('seo_title', 'LIKE', "%{$name}%")->get();
       $result_array = [];
       if(!empty($name))  {
         foreach($suggestionproducts as $suggestions)
           {
              $result_array[] = [
                'name'=>$suggestions->seo_title, 
                'image'=>$suggestions->seo_title,
                'id'=>$suggestions->id,
                "url"=>route('product',[Crypt::encryptString($suggestions->id)]),
            ];
           }
        return response()->json(['stat'=>true, "data"=>array_unique($result_array,SORT_REGULAR)]);
       } else {
           return response()->json(['stat'=>true, "data"=>[]]);
       }
      
    }
    public function productsearch($slug = null)
    {
      
         $products =  Product::select('id','seo_title','seo_description','image_src','type');
          if(!is_null($slug))
          {
              $products = $products->where('seo_title', 'LIKE', "%{$slug}%");
          }
          $products = $products->paginate(15);
          return view('fontend.search',compact('products'));
    }
}
