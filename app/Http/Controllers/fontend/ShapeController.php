<?php 

namespace App\Http\Controllers\fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Product;
use App\Models\Shape;

class ShapeController extends Controller
{
	public function __construct()
	{
		$this->pageSize = 25;
	}
	public function index($id)
	{
		$shap_id = Crypt::decryptString($id); 
		$products = Product::select('products.id','products.seo_description','products.variant_inventory_qty', 'products.image_src', 'products.seo_title','products.shape','shapes.name')
		                    ->join('shapes','shapes.id','=','products.shape')
		                    ->where('products.shape',$shap_id)
		                    ->paginate($this->pageSize);
		  $shape_details = Shape::find($shap_id);
		$total_contents = Product::select('products.id','products.seo_description','products.variant_inventory_qty', 'products.image_src', 'products.seo_title','products.shape')
		                    ->join('shapes','shapes.id','=','products.shape')
		                    ->where('products.shape',$shap_id)
		                    ->count();

         $page = $this->pageSize;
		return view('fontend.shapedetails',compact('products','total_contents','page','shape_details'));
	}
}