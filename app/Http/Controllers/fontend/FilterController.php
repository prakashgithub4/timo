<?php

namespace App\Http\Controllers\fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\Color;
use App\Models\Shape;
use App\Models\ProductAttributeMapping as PA;

class FilterController extends Controller
{
    public function __construct()
    {
        $this->pageSize = 20;
    }
    public function index()
    {

        $colors = Color::all();
        $shape = Shape::all();
        return view('fontend.diamonds_search',compact('colors','shape'));
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
       $color = $price['color'];
       $shape = $price['shape'];
       $lower1 = $price['lower1'];
       $max1 = $price['max1'];
       $data = $this->search(null,null,$min,$max,$color,$lower1,$max1,$shape);
       return response()->json(['stat'=>true,"data"=>$data]);
    }
   public function orderfilter(Request $request)
   {
       $urldata = $request->query();
       $order = $urldata['order'];
       $data = $this->search(null,null,null,null,null,null,null,null,$order);
       return response()->json(['stat'=>true,'data'=>$data]);
   }

    public  function search($page = 1, $pageSize = 0,$min=null,$max = null,$color=null,$shape=null,$lower1=null,$max1=null,$order = 0)
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

        $allProduct = Product::with('attributemapping')
            ->select('products.id', 'products.seo_title', 'products.seo_description', 'products.type', 'products.image_src','shapes.name as shape','colors.name as color','products.cost_per_item')
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

        if(!is_null($color) && !empty($color))
        {
            $allProduct = $allProduct->where('colors.id',$color);
        }
        if(!is_null($shape) && !is_null($shape))
        {
            $allProduct = $allProduct->where('products.shape',$shape);
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
        $attribute_values=[];
        $attribute=[];
        foreach ($allProduct as $products) {
            $price = price_rang($products->id);
            //$attribute = json_decode($products->attribute_values);

            $attribute =  PA::select('product_attribute_mapping.aid as pid','product_attribute_mapping.aid as id','product_attribute_mapping.attribute_values as value')
            ->where('product_attribute_mapping.pid',$products->id)
            ->get();

            
            if(!empty($attribute))
            {
                foreach($attribute as $attributes)
                {
                   $attribut_details = \DB::table('attributes')->select('id','name')->where('id',$attributes->id)->first();

                   if($attributes->id == 18 )
                   {
                    $attribute_values[$attribut_details->name] = $attributes->value !=null ? $attributes->value :null;
                   }
                   else if($attributes->id == 8)
                   {
                    $attribute_values[$attribut_details->name] = $attributes->value !=null ? $attributes->value :null;
                   }
                   else if($attributes->id == 9)
                   {
                    $attribute_values[$attribut_details->name] = $attributes->value !=null ? $attributes->value :null;
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
                'carat'=>(!empty($attribute_values["Carat"]))? $attribute_values['Carat'] : [],
                'cuts'=>(isset($attribute_values['Cut'])) ? $attribute_values['Cut'] :[],
                'clearity'=> (isset($attribute_values['Clarity'])) ? $attribute_values['Clarity'] :[], 
                'attribute_values' =>$attribute_values
            ];
        }
        return response()->json(['stat' => true, "data" => $result, 'total_pages' => $number_of_page]);
    }
}
