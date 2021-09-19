<?php

namespace App\Http\Controllers\fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index($id=NULL,$slug=NULL)
    {
          $shareButtons = \Share::page(
            'http://localhost/tiamo_diamond/',
            'Your share text comes here',
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp()        
        ->reddit();

        $prodID= encryption_route($id,2);
        $product = Product::where('id',"=", $prodID)->first();
        //dd($product);
      // exit();

      return view('fontend.product_details', compact('shareButtons','product'));
    }
   
}
