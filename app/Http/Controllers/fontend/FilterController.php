<?php

namespace App\Http\Controllers\fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\Menu;
use App\Models\Menu_sub_category;

class FilterController extends Controller
{
    public function __construct()
    {
        $this->pageSize = 20;
    }
    public function index()
    {
        return view('fontend.diamonds_search');
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
    public function priceFilter(Request $request)
    {
       $price = $request->query();
       $min = $price['min'];
       $max = $price['max'];
       $data = $this->search(null,null,$min,$max);
       return response()->json(['stat'=>true,"data"=>$data]);
    }
   public function orderfilter(Request $request)
   {
       $urldata = $request->query();
       $order = $urldata['order'];
       $data = $this->search(null,null,null,null,$order);
       return response()->json(['stat'=>true,'data'=>$data]);
   }

    public  function search($page = 1, $pageSize = 0,$min=null,$max = null,$order = 0)
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

        $allProduct = \DB::table('products')
            ->select('products.id', 'products.seo_title', 'products.seo_description', 'products.type', 'products.image_src','shapes.name as shape','colors.name as color','products.attribute_values','products.cost_per_item')
            ->leftjoin('shapes','shapes.id','=','products.shape')
            ->leftjoin('colors','colors.id','=','products.color');
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
        if($order ==  0)
        {
            $allProduct = $allProduct->orderBy('products.id','ASC');
        }
        else 
        {
            $allProduct = $allProduct->orderBy('products.id','DESC');
        }



        $allProduct = $allProduct->where('published', 'TRUE')
            ->get();

        $result = [];
        
        foreach ($allProduct as $products) {
            $price = price_rang($products->id);
            $attribute = json_decode($products->attribute_values);
            
            if(!empty($attribute))
            {
                foreach($attribute as $attributes)
                {
                   $attribut_details = \DB::table('attributes')->select('id','name')->where('id',$attributes->attribute_id)->first();
                   if($attributes->attribute_id == 17)
                   {
                    $attribute_values[$attribut_details->name] = $attributes->value;
                   }
                   else if($attributes->attribute_id == 8)
                   {
                    $attribute_values[$attribut_details->name] = $attributes->value;
                   }
                   else if($attributes->attribute_id == 9)
                   {
                    $attribute_values[$attribut_details->name] = $attributes->value;
                   }
                }
            }
          
          
           
            
           
        //echo"<pre> jjj"; print_r($attribute_values['Cut']); exit;
            $result[] = [
                "id" => $products->id,
                "title" => $products->seo_title,
                "seo_description" => \Str::limit($products->seo_description, 50),
                "type" => $products->type,
                "image_src" => $products->image_src,
                "price" => (isset($price['current_price']))?number_format($price['current_price'], 2):0 ,
                "old_price" => isset($price['old_price'])?number_format($price['old_price'], 2) :0 ,
                'product_details' => route('product', [\Crypt::encryptString($products->id)]),
                'shape'=>$products->shape,
                'color'=>$products->color,
                'carat'=>(!empty($attribute_values))? array_unique($attribute_values) : [],
                'cuts'=>(isset($attribute_values['Cut'])) ? $attribute_values['Cut'] :[],
                'clearity'=> (isset($attribute_values['Clarity'])) ? $attribute_values['Clarity'] :[]
            ];
        }
        return response()->json(['stat' => true, "data" => $result, 'total_pages' => $number_of_page]);
    }
    
    public function product_menu_details($menu_id)
    {
        $menuDetails = Menu::find($menu_id);
        $submenuDetails = Menu_sub_category::find($menu_id);
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
                       ->where('menus.id','=',$menu_id)
                       ->orWhere('menu_sub_category.id','=',$menu_id)
                       ->paginate($this->pageSize);
        
       return view('fontend.menudetails',compact('products','menuarray'));
    }
}
