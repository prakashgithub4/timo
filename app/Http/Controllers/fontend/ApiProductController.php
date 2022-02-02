<?php

namespace App\Http\Controllers\fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Product;
use App\Models\Shape;
use App\Models\Attribute;
use App\Models\Color;

class ApiProductController extends Controller
{
    public $pagesize;
    public function __construct()
    {
        $this->pagesize = 52;
    }
    public function index()
    {
      $result = [];
        
        return view('fontend.allproducts'); 
    }

    public function productlist(Request $request)
    {
        $product = Product::where('published','=','TRUE')->get();
         foreach($product as $key=>$products)
         {
            $price = price_rang($products->id);
            $result []=[
                'stock_no'=> encrypt($products->variant_SKU),
                'image_src'=>$products->image_src,
                'seo_title'=>$products->seo_title,
                'current_price'=>isset($price['current_price'])?"$".number_format($price['current_price'], 2, '.', ''):0.00,
                'old_price'=>isset($price['old_price'])?"$".number_format($price['old_price'],2, '.', ''): 0.00,
                'short_description'=>$products->Clarity_Description
            ];
        }

         $result3 = $result;
         $querystring = $request->query();
         $page =!empty($querystring['page_no']) ?(int)$querystring['page_no'] : 1;
         $offset = ($page - 1) * $this->pagesize;
         $total_num_of_page[] = ceil(count($result3)/$this->pagesize);
         $pagination = array_slice($result3, $offset, $this->pagesize);
         return response()->json(['stat'=>true,'data'=>$pagination,'num_of_pages'=>$total_num_of_page,'current_page'=>$page]);
    
}
    public function getProducts()
    {
        $curl_handle = curl_init();
        $url = "https://belgiumdia.com/api/DeveloperAPI?APIKEY=5247fe848a82a2de2a9c218b7b0f91c55d5fc2afd595";
        // Set the curl URL option
        curl_setopt($curl_handle, CURLOPT_URL, $url);

        // This option will return data as a string instead of direct output
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);

        // Execute curl & store data in a variable
        $curl_data = curl_exec($curl_handle);
        curl_close($curl_handle);
        // Decode JSON into PHP array
        $data = json_decode($curl_data);
        return $data->Stock;
    }
  public function getProductDetail($stock_no) {
        session_start();
         $local = [];
       // $_SESSION['productDetails'] = [];
        if(isset($_SESSION['productDetails']) && isset($_SESSION['productDetails'][0]->Stock_No) && ($_SESSION['productDetails'][0]->Stock_No == $stock_no))
        {
            $local =  $_SESSION['productDetails'];
        } else {
            sleep(30);
           $response_data = $this->getProductdetailsfromApi(decrypt($stock_no));
           $_SESSION['productDetails'] = !is_null($response_data) &&  ($response_data[0]->Stock_No == $stock_no) ? $response_data : $response_data ;
           $local =  $_SESSION['productDetails'];
         }
       return view('fontend.api_product_details',compact('local'));
       
    }
    public function getProductdetailsfromApi($stock_no) {
         $curl_handle = curl_init();
        $url = "https://belgiumdia.com/api/DeveloperAPI?stock=".$stock_no."&APIKEY=5247fe848a82a2de2a9c218b7b0f91c55d5fc2afd595";
        // Set the curl URL option
        curl_setopt($curl_handle, CURLOPT_URL, $url);

        // This option will return data as a string instead of direct output
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);

        // Execute curl & store data in a variable
        $curl_data = curl_exec($curl_handle);
        curl_close($curl_handle);
        // Decode JSON into PHP array
        $data = json_decode($curl_data);
        return $data->Stock;
    }
}
