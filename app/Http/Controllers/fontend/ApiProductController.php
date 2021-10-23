<?php

namespace App\Http\Controllers\fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Product;


class ApiProductController extends Controller
{
    public $pagesize;
    public function __construct()
    {
        $this->pagesize = 50;
    }
    public function index()
    {
      $result = [];
        
        return view('fontend.allproducts'); 
    }

    public function productlist(Request $request)
    {
        $response =[];
        $local = [];
        if(\Session::has('product_list'))
        {
            $response =  \Session::get('product_list');
        }
        else{
           
            $response_data = $this->getProducts();
            \Session::put('product_list',$response_data);
           $response =  \Session::get('product_list');
        }
       
         foreach($response as $products)
         {
            $result []=[
                'stock_no'=> $products->Stock_No,
                'image_src'=>$products->ImageLink,
                'seo_title'=>$products->Diamond_Type,
                'current_price'=>number_format($products->Buy_Price, 2, '.', ''),
                'old_price'=>number_format($products->COD_Buy_Price,2, '.', ''),
                'short_description'=>$products->Clarity_Description
            ];
         }
         $localproduct = Product::select('id','seo_title','image_src','seo_description','type')->get();
       
         foreach($localproduct as $item)
         {
             $price  = price_rang($item->id);
             $local [] = [
             'id'=>$item->id,
             'seo_title'=>$item->seo_title,
             'image_src'=>$item->image_src,
             'current_price'=>isset($price['current_price']) ? number_format($price['current_price'], 2, '.', ''):null,
             'old_price'=>isset($price['old_price'])?  number_format($price['old_price'], 2, '.', ''):null
            ];
            
         }
         $result3 = array_merge($local,$result);
        
        
         
      

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
        $url = "https://belgiumdia.com/api/DeveloperAPI?stock=&APIKEY=524768a17cce78adb1c84ffb47be828494c118923dc8";
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
