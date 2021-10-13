<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Imports\ProductsImport;

use Maatwebsite\Excel\Facades\Excel;
use App\Repositories\ProductRepository;
use App\Exports\ProductsExport;
use App\Models\Attribute;
use App\Models\Color;
use App\Models\Category;
use App\Models\Shape;
use App\Models\Size;
use App\Models\Gift;
use App\Models\ProductAttribute;

class ProductController extends Controller
{
  //
  public $product = null;
  public function __construct(ProductRepository $product)
  {
    $this->middleware('admin');
    $this->product = $product;
  }

  public function add()
  {

    return view('admin.products.add');
  }

  public function edit($id = null)
  {
      $attributes = Attribute::all();
      if (is_null($id)) {
          return view('admin.products.edit',compact('attributes'));
      } else {
          $getProduct = $this->product->_edit($id);
          return view('admin.products.edit', compact('getProduct','attributes'));
      }
  }

  public function loadproductattribute(Request $request)
  { 
   $result = [];
   $product = $request->query();
   $product_attributs = Product::select('product_attribute_mapping.attribute_values','attributes.name','product_attribute_mapping.id')
               ->join('product_attribute_mapping','product_attribute_mapping.pid','=','products.id')
               ->join('attributes','attributes.id','=','product_attribute_mapping.aid')
               ->distinct('product_attribute_mapping.*')
              // ->groupBy('product_attribute_mapping.aid')
               ->where('product_attribute_mapping.pid',$product['product_id'])
               ->get();
      foreach($product_attributs as $item)
      {
         $result[] = ['attribute_values'=>$item->attribute_values,'name'=>$item->name,'url'=>route('admin.productattribute.remove',$item->id)];
      }
   
    return response()->json(['data'=>$result]);
  }
  public function removeproductattribute($id)
  {
    ProductAttribute::find($id)->delete();
    return redirect()->back();
  }

  public function save(Request $request)
  {
    $request->validate([
      //'file' => ['required', 'mimes:csv,xls', 'max:2048'],
    ]);
    Excel::import(new ProductsImport, $request->file('file'));
    \DB::select('call removenull()');
    return redirect()->back()->with('success', 'Products Uploaded Successfully');
  }
  public function download()
  {
    return Excel::download(new ProductsExport, date('Y-m-d').'_mdjInventory_Retail.xlsx');
  }
  public function products()
  {
    $products = $this->product->_getProducts();
    return view('admin.products.products', compact('products'));
  }
  public function allproducts(Request $request)
  {
    $columns = array(
      0 => 'id',
      1 =>'Handle',
      2 =>'Code',
      3 =>'Title',
      4 =>'Vendor',
      5 =>'Type',
      6=> 'Tags',
      7=>'Published',
      8=>'Is Purchased',
      8=>'Gender',
      9=>'Image',
      10=>'Action',
      11=>'Shipping Cost'
    );

    $totalData = Product::count();

    $totalFiltered = $totalData;

    $limit = $request->input('length');
    $start = $request->input('start');
    $order = $columns[$request->input('order.0.column')];
    $dir = $request->input('order.0.dir');

    if (empty($request->input('search.value'))) {
      $products = Product::offset($start)
        ->limit($limit)
        ->orderBy($order, $dir)
        ->get();
    } else {
      $search = $request->input('search.value');
      $products =  Product::where('id', 'LIKE', "%{$search}%")
        ->orWhere('title', 'LIKE', "%{$search}%")
        ->offset($start)
        ->limit($limit)
        ->orderBy($order, $dir)
        ->get();

      $totalFiltered = Product::where('id', 'LIKE', "%{$search}%")
        ->orWhere('title', 'LIKE', "%{$search}%")
        ->count();
    }

    $data = array();
    if (!empty($products)) {
      foreach ($products as $key=>$product) {
       // $show =  route('posts.show', $post->id);
       // $edit =  route('posts.edit', $post->id);
        $publish_status = ($product->published == 'TRUE')?1:0;
        $nestedData['id'] =  $product->id;
        $nestedData['handle'] = $product->handle;
        $nestedData['code'] = $product->variant_SKU;
        $nestedData['title'] = $product->title;
        $nestedData['vendor'] = $product->vendor;
        $nestedData['Shipping'] = "<input type ='text' size =5 value=".$product->shipping_cost." onblur='changeshipping(".$product->id.",this.value)' />";
        $nestedData['type'] = $product->type;
        $nestedData['tags'] = $product->tags;
        $nestedData['published'] = "<button class='btn btn-info' id='published_".$product->id."' onclick='ispublished(".$product->id.",".$publish_status.")'>".$product->published."</button>";
        $nestedData['is Purchase'] = "<input type='button' class='btn btn-success' onclick='isPurchased(".$product->id.",".$product->is_purchased.",this)' value = ".(($product->is_purchased == 1) ? 'False' : 'True')." />";
        $nestedData['gender'] = $product->gender;
        $nestedData['image_src'] ="<img src='".$product->image_src."' height='100' width='100'>";
        $nestedData['options'] = 
        "<a href='".route('admin.galleries',$product->id)."' class='btn btn-info'><i class='far fa-images'></i></button>
         <a href='".route('admin.product.edit',$product->id)."' class='btn btn-info'><i class='far fa-edit'></i></button>
        ";
        $data[] = $nestedData;
      }
    }

    $json_data = array(
      "draw"            => intval($request->input('draw')),
      "recordsTotal"    => intval($totalData),
      "recordsFiltered" => intval($totalFiltered),
      "data"            => $data
    );

    echo json_encode($json_data);
  }

  public function changepublishedstatus($id,$status)
  {
   
    if($status  == 1)
    {
      $ispublishd = 'FALSE';
    }
    else
    {
      $ispublishd = 'TRUE';
    }
    $status = $this->product->_publish_status($id,$ispublishd);
    echo $ispublishd; 
  }

  public function price_range($id = null)
  {
    if(is_null($id))
    {
      return view('admin.price_range.price');
    }
    else
    {
      $get_range_by_id = \App\Models\Price_Range::find($id);
      return view('admin.price_range.price',compact('get_range_by_id'));
    }
    
    
  }

  public function all_price_ranges()
  {
    $pric_rangs = \App\Models\Price_Range::all();
    return view('admin.price_range.price_ranges',compact('pric_rangs'));
  }

  public function delete_range($id)
  {
     $delete = \App\Models\Price_Range::find($id)->delete();

     return redirect()->route('admin.price_range.all')->with('success','Range has been deleted successfully');
  }

  public function save_range(Request $request)
  {

   $price = (is_null($request->id))? new \App\Models\Price_Range() : \App\Models\Price_Range::find($request->id);
   $price->start_price=$request->start;
   $price->end_price = $request->end;
   $price->differance = $request->diff;
   $price->status = $request->status;
   $price->save();
   if(is_null($request->id))
   {
     return redirect()->route('admin.price_range.all')->with('success','Price range has been add successfully');
   }
   else
   {
     return redirect()->route('admin.price_range.all')->with('success','Price range has been updated successfully');
   }
   
  }

  public function productlist()
  {
    return view('admin.assign_category.products');
  }

  public function getAllproducts(Request $request)
  {
    $columns = array(
      0 => 'id',
      1 =>'Handle',
      2 =>'Code',
      3 =>'Title',
      4 =>'Vendor',
      5 =>'Type',
      6=> 'Tags',
      7=>'Published',
      8=>'Gender',
      9=>'Image',
      10=>'Action'
    );

    $totalData = Product::count();

    $totalFiltered = $totalData;

    $limit = $request->input('length');
    $start = $request->input('start');
    $order = $columns[$request->input('order.0.column')];
    $dir = $request->input('order.0.dir');

    if (empty($request->input('search.value'))) {
      $products = Product::offset($start)
        ->limit($limit)
        ->orderBy($order, $dir)
        ->get();
    } else {
      $search = $request->input('search.value');

      $products =  Product::where('id', 'LIKE', "%{$search}%")
        ->orWhere('title', 'LIKE', "%{$search}%")
        ->offset($start)
        ->limit($limit)
        ->orderBy($order, $dir)
        ->get();

      $totalFiltered = Product::where('id', 'LIKE', "%{$search}%")
        ->orWhere('title', 'LIKE', "%{$search}%")
        ->count();
    }
     $attribute = Attribute::all();
     $color = Color::all();
     $category = Category::all();
     $shape = Shape::all();
     $size = Size::all();
     $gift = Gift::all();
   
    

   
    $data = array();
    if (!empty($products)) {
      foreach ($products as $key=>$product) {

         $sihtml = "<select  class='form-control' onchange='method.sizes(".$product->id.",this.value)'>"; 
         $sihtml .="<option selected>--Select--</option>";
          foreach($size as $sizes)
          {
           $sihtml .="<option ".($sizes->id == $product->size ? 'selected' : '')." value=".$sizes->id.">".$sizes->size."</option>";
          }
         $sihtml .="</select>";


        $ghtml = "<select class='form-control' onchange='method.gifts(this.value,".$product->id.")'>"; 
        $ghtml .="<option selected>--Select--</option>";
        foreach($gift as $gifts)
        {
         $ghtml .="<option ".($gifts->id == $product->gift_id ? 'selected' : '')." value=".$gifts->id." >".$gifts->title."</option>";
        }
        $ghtml .="</select>";

         $shtml = "<select class='form-control' onchange='method.shape(this.value,".$product->id.")'>"; 
         $shtml .="<option selected>--Select--</option>";
        foreach($shape as $shapes)
        {
         $shtml .="<option ".($shapes->id == $product->shape ? 'selected' : '')." value=".$shapes->id.">".$shapes->name."</option>";
        }
         $shtml .="</select>";


         $cahtml = "<select class='form-control' onchange='method.category(this.value,".$product->id.")'>"; 
         $cahtml .="<option selected>--Select--</option>";
        foreach($category as $categories)
        {
         $cahtml .="<option ".($categories->id == $product->category ? 'selected' : '')." value=".$categories->id.">".$categories->name."</option>";
        }
         $cahtml .="</select>";


        $chtml = "<select class='form-control' onchange='method.colors(this.value,".$product->id.")'>";
        
        foreach($color as $colors)
        {
         $chtml .="<option ".($colors->id == $product->color ? 'selected' : '')." value=".$colors->id.">".$colors->name."</option>";
        }
        $chtml .="</select>";

        $ahtml = "<select name = attributes[] multiple onchange='method.updateattribute(this,".$product->id.")'> class='form-control'>"; 
        $ahtml .="<option disabled>--Select--</option>";
        foreach($attribute as $attributes)
        {
         $ahtml .="<option ".((!is_null($product->attribute) && (in_array($attributes->id,json_decode($product->attribute)))) ?"selected":'')." value=".$attributes->id.">".$attributes->name."</option>";
        }
        $ahtml .="</select>";
        if(!is_null($product->attribute)){
          $ahtml .="<a href='javascript:void(0)' onclick='method.addattributevalue(".$product->id.")' data-toggle='modal' data-target='#largeModal'>Add value</a>";
        }
        

        $publish_status = ($product->published == 'TRUE')?1:0;
        $nestedData['SL'] =  $key + 1;
        $nestedData['title'] = $product->seo_title;
        $nestedData['attribute'] = $ahtml;
        $nestedData['color'] = $chtml;
        $nestedData['category'] = $cahtml;
        $nestedData['shape'] = $shtml;
        $nestedData['size'] = $sihtml; 
        $nestedData['gift'] = $ghtml;
      
        $data[] = $nestedData;
      }
    }

    $json_data = array(
      "draw"            => intval($request->input('draw')),
      "recordsTotal"    => intval($totalData),
      "recordsFiltered" => intval($totalFiltered),
      "data"            => $data
    );

    echo json_encode($json_data);
  }

  public function updatesize(Request $request)
  {
    $product = Product::find($request->product_id);
    $product->size = $request->size;
    $product->save();
    return response()->json(['stat'=>true,"message"=>"Size has been successfully updated on product table","data"=>$product]);
  
  }

  public function addgift(Request $request)
  {
    $product = Product::find($request->product_id);
    $product->gift_id = $request->gift;
    $product->save();
    return response()->json(['stat'=>true,"message"=>"Gift has been successfully updated on product table","data"=>$product]);
  }

  public function addshape(Request $request)
  {
    $product = Product::find($request->product_id);
    $product->shape = $request->shape;
    $product->save();
    return response()->json(['stat'=>true,"message"=>"Shape has been successfully updated on product table","data"=>$product]);
  }

    public function addCategory(Request $request)
    {
      $product = Product::find($request->product_id);
      $product->category = $request->cat_id;
      $product->save();
      return response()->json(['stat'=>true,"message"=>"Category has been successfully updated on product table","data"=>$product]);
    }

    public function addColors(Request $request)
    {
      $product = Product::find($request->product_id);
      $product->color = $request->color;
      $product->save();
      return response()->json(['stat'=>true,"message"=>"Color has been successfully updated on product table","data"=>$product]);
    }

     public function addattribute(Request $request)
    {
      $product_id = $request->product_id;
      $attribute_id = $request->attribute;
      $product = Product::find($product_id);
      $product->attribute = json_encode($attribute_id);
      $product->save();
      return response()->json(['stat'=>true,"message"=>"Attribute has been successfully updated on product table","data"=>$product]);
    }

    public function getattributefromproduct(Request $request)
    {
       $product = Product::select('attribute')->where('id',$request->product_id)->first();
       $attribute_array =[];
       $product_attribute = json_decode($product->attribute);

        foreach($product_attribute as $key=>$item)
        {
         $attribute = Attribute::where('id',$item)->first();
         $attribute_array['attribut'][] = array('name'=>$attribute->name,'id'=>$attribute->id);
        }


       return response()->json(['stat'=>true,"data"=>$attribute_array]);
    }
    public function updatedateattributevalue(Request $request)
    {
        $result = $request->all();
        $input_array = [];
        foreach($request->ids as $key=>$item)
        {
          $input_array[] = ["attribute_id"=>$item,"value"=>($request->value[$key]) ? $request->value[$key] : '','unit'=>($request->unit[$key]) ? $request->unit[$key] : ''];
        }
        $product = Product::find($request->product_id);
        $product->attribute_values = json_encode($input_array);
        $product->save();
        return response()->json(['stat'=>true,'message'=>'attribute value has been updated successfully']);
    }

    public function changeispurchasestatus(Request $request)
    {
      $data = $request->query();
      $product = Product::find($data['product_id']);
      $product->is_purchased = ($data['status'] == 1) ? '0' : '1';
      $product->save();
      return response()->json(['stat'=>true,'message'=>'is purchesed stattus has been changed','data'=>$product->is_purchased]);
    }

    public function productshippingcost(Request $request)
    {
       $product = Product::find($request->product_id);
       $product->shipping_cost = $request->cost;
       $product->save();
       return response()->json(['stat'=>true,'message'=>'shipping cost has been updated in product table']);
    }

    public function update(Request $request)
    {
     
       // $userid = \Auth::user()->id;
        
        // $request->validate([
        //     'handle' => 'required',
        //     'title' => 'required',
        //     'body' => 'required',
        //     'long_description' => 'required',
        //     'published' => 'required',
        // ]);
        $attribute = array();
        if(count($request->attribute_id) > 0){
          foreach($request->attribute_id as $key=>$attributes)
          {
            $attribute[] = ['value'=>$request->attribute_value[$key],'attribute_id'=>$request->attribute_id[$key]];
            $product_attribute = new ProductAttribute();
            $product_attribute->pid = $request->id;
            $product_attribute->aid = $request->attribute_id[$key];
            $product_attribute->attribute_values = $request->attribute_value[$key];
            $product_attribute->save();
          }
        }
       
        $attribute_values = isset($attribute) ? json_encode($attribute) :[];
       
        $input_array = array(
            'title' => $request->title,
            'handle' => $request->handle,
            'body' =>  $request->body,
            'long_description' =>  $request->long_description,
            'published' => $request->published,
            'is_purchased' => $request->is_purchased,
            'type' => $request->type,
            'tags' => $request->tags,
            'vendor' => $request->vendor,
            'attribute_values'=>$attribute_values
        );
        if ($request->id == 0) {
            
            return redirect('admin/products')->with('success', 'Product Added successfully');
        } else {
           
            $product = Product::find($request->id);
            $product->title = $input_array['title'];
            $product->handle = $input_array['handle'];
            $product->body = $input_array['body'];
            $product->published = $input_array['published'];
            $product->is_purchased = $input_array['is_purchased'];
            $product->type = $input_array['type'];
            $product->tags = $input_array['tags'];
            $product->vendor = $input_array['vendor'];
            $product->long_description = $input_array['long_description'];
            $product->attribute_values = $input_array['attribute_values'];
            $product->save();



            return redirect('admin/products')->with('success', 'Product has been updated successfully');
        }
    }
}
