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
use App\Repositories\AttributRepository;
use App\Models\ProductAttributeMapping as PAMapping;
use App\Models\ProductAttribute;
use App\Models\Animated;
use File;
class ProductController extends Controller
{
  //
  public $product = null;
  public function __construct(ProductRepository $product)
  {
    $this->middleware('admin');
    $this->product = $product;
    ini_set('max_execution_time', 0);
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
          $getThreeSixtyImages = Animated::where('product_id','=',$id)->get();
          return view('admin.products.edit', compact('getProduct','attributes','getThreeSixtyImages'));
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
        $nestedData['image'] = '<img src='.$product->image_src." height ='100' width='120' alt=".$product->seo_title.">";
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
            'attribute_values'=>$request->attribute_ids,
            'variant_inventory_qty'=>$request->qty
        );
            //Saving Attributes
            $product = Product::find($request->id);
            $product->title = $input_array['title'];
            $product->handle = $input_array['handle'];
          //  $product->body = $input_array['body'];
            $product->published = $input_array['published'];
            $product->is_purchased = $input_array['is_purchased'];
            $product->type = $input_array['type'];
            //$product->tags = $input_array['tags'];
            //$product->vendor = $input_array['vendor'];
            $product->variant_inventory_qty = $input_array['variant_inventory_qty'];
            $product->long_description = $input_array['long_description'];
            $product->attribute_values = json_encode($input_array['attribute_values']);
            //$product->attribute = $input_array['attribute'];
            $product->save();
            foreach($request->attribute_ids  as $key=>$item) {
              $product_attribute =  new ProductAttribute();
              $product_attribute->pid = $request->id;
              $product_attribute->aid = $item;
              $product_attribute->attribute_values =$request->attribute_value[$key];
              $product_attribute->save();
            }

            return redirect('admin/products')->with('success', 'Product has been updated successfully');
    }
    public function removeAllThreeSixtyImages($product_id)
    {
       $medias =  Animated::distinct('image')->where('product_id','=',$product_id)->pluck('image');
       $product = Product::select('seo_title')->first();
           foreach($medias as $key=>$item)
            {
            if(File::exists(public_path('uploads/'.$product->seo_title.'/'.$medias[$key]))){
                File::delete(public_path('uploads/'.$product->seo_title.'/'.$medias[$key]));
              }
         }
       $threesixtyImages = Animated::where('product_id','=',$product_id)->delete();
       $product = Product::find($product_id);
       $product->is_threesixty = '0';
       $product->save();
       return redirect('admin/products')->with('success', '360 Images has been Deleted successfully');
    }

    public function upload(Request $request)
    {
     
            //Saving Attributes

           // dd($request->all());
            $product = Product::find($request->id);
            $file_array = $request->file('360_images');
            $remove_records = Animated::where('product_id','=',$product->id)->get();


            $remove_records = Animated::where('product_id','=',$product->id)->get();
            $file_array = $request->file('360_images');
         
             if(isset($file_array)&&count($file_array) <= 30)
             {
                 foreach($file_array as $key=>$images)
                  { 
                       $name1 = $images->getClientOriginalName();
                       $ext = explode('.',$name1)[1];
                       $name = "pem_".$key.".".$ext;
                       if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png')
                       {
                         $path = public_path().'/uploads/'.$product->seo_title;
                         $images->move($path.'/', $name); 
                         chmod($path."/".$name, 0777); 
                         $imgData[] = $name;
                         $add360_images = new \App\Models\Animated();
                         $add360_images->product_id = $request->id;
                         $add360_images->image = $imgData[$key];
                         $add360_images->added_by = \Auth::user()->id;
                         $add360_images->save();
                       }
                       else
                       {
                        return response()->json(['status'=>false,'message'=>"File format is not Supported"]);
                       }
                      
                  }
                
                  $product = Product::find($product->id);
                  $product->is_threesixty = '1';
                  $product->save();
                 
                }
                else if(isset($file_array)&&count($file_array) >= 30)
                {
                  return response()->json(['status'=>false,'message'=>"Please upload below then 30 file"]);
                }
                // else if(count($remove_records) > 1) {
                //   return response()->json(['status'=>false,'message'=>"Please remove previous 360 images"]);
                // }

         }
         
        //  public function importProductApi() {
        //    try{
        //        $response = $this->getProducts();
        //        $result = [];
        //        $result ['attributes'] = ['Weight','Clarity','Cut Grade','Polish','Symmetry','Fluorescence Intensity'];
        //        $attributeId = 0;
        //        $shapeId = 0;
        //        $colorId = 0;
        //        $product_id = 0;

        //        if($response!=null) {

               
        //        foreach($response as $key=>$products)
        //        {
             
        //           $productsdetails = Product::where('variant_SKU','=',$products->Stock_No)->count();
                  
        //           if($productsdetails == 0) {
        //             $result ['product'][] = [
        //               'variant_SKU' => $products->Stock_No, 
        //               'type' => $products->Diamond_Type, 
        //               'cost_per_item' => $products->Buy_Price,
        //               'seo_title'=>$products->Shape.''.$products->Stock_No,
        //               'image_src'=>$products->ImageLink,
        //               'body'=>$products->Video_HTML,
        //               'variant_inventory_qty'=>100,
        //               'Clarity' =>$products->Clarity,
        //               'Cut_Grade' =>$products->Cut_Grade,
        //               'Polish'=>$products->Polish,
        //               'Symmetry'=>$products->Symmetry,
        //               'Fluorescence_Intensity'=>$products->Fluorescence_Intensity,
        //               'Weight'=>$products->Weight,
        //               'Shape'=>
        //               'IsApi'=>'1',

        //             ];
        //             //   $newproducts = new Product();
        //             //   $newproducts->variant_SKU = $products->Stock_No;
        //             //   $newproducts->type = $products->Diamond_Type;
        //             //   $newproducts->cost_per_item = $products->Buy_Price;
        //             //   $newproducts->seo_title = $products->Shape.''.$products->Stock_No;
        //             //   $newproducts->image_src = $products->ImageLink;
        //             //   $newproducts->body =$products->Video_HTML;
        //             //   $newproducts->variant_inventory_qty = 100;
        //             //   //$newproducts->shape = $shapeId;
        //             //  // $newproducts->color = $colorId;
        //             //   $newproducts->published = 'TRUE';
        //             //   $newproducts->IsApi = '1';
        //             //   $newproducts->save();
                  
                    

        //             //   foreach($result ['attributes'] as $attribute) {
        //             //     $attributecheck = Attribute::where('name','Like','%'.$attribute.'%')->count();
        //             //     if($attributecheck <= 0) {
        //             //       $add_attribute = new Attribute();
        //             //       $add_attribute->name = $attribute;
        //             //       $add_attribute->userId = \Auth::user()->id;
        //             //       $add_attribute->save();
        //             //       $attributeId = $add_attribute->id;
        //             //     } else {
        //             //       $add_attribute = Attribute::where('name','Like','%'.$attribute.'%')->first();
        //             //       $attributeId = $add_attribute->id;
        //             //     } 
        //             //   }
  
        //             //  $result ['attributes_values'][] = [
        //             //   'Stock_No'=>$products->Stock_No,
        //             //   'Weight'=>$products->Weight,
        //             //   'Clarity'=>$products->Clarity,
        //             //   'Cut_Grade'=>$products->Cut_Grade,
        //             //   'Polish'=>$products->Polish,
        //             //   'Symmetry'=>$products->Symmetry,
        //             //   'Fluorescence_Intensity'=>$products->Fluorescence_Intensity,
        //             // ];
        //             // foreach($result ['attributes_values'] as $attributes) {
        //             //   if(isset($attributes['Weight'])){
        //             //     $productAttributeMap = new PAMapping();
        //             //     $productAttributeMap->attribute_values = $attributes['Weight'];
        //             //     $productAttributeMap->aid = $attributeId;
        //             //     $productAttributeMap->pid = $product_id;
        //             //     $productAttributeMap->save();
        //             //   }
        //             //   if(isset($attributes['Clarity'])){
        //             //     $productAttributeMap = new PAMapping();
        //             //     $productAttributeMap->attribute_values = $attributes['Clarity'];
        //             //     $productAttributeMap->aid = $attributeId;
        //             //     $productAttributeMap->pid = $product_id;
        //             //     $productAttributeMap->save();
        //             //   }
        //             //   if(isset($attributes['Cut_Grade'])){
        //             //     $productAttributeMap = new PAMapping();
        //             //     $productAttributeMap->attribute_values = $attributes['Cut_Grade'];
        //             //     $productAttributeMap->aid = $attributeId;
        //             //     $productAttributeMap->pid = $product_id;
        //             //     $productAttributeMap->save();
        //             //   }
        //             //   if(isset($attributes['Symmetry'])){
        //             //     $productAttributeMap = new PAMapping();
        //             //     $productAttributeMap->attribute_values = $attributes['Polish'];
        //             //     $productAttributeMap->aid = $attributeId;
        //             //     $productAttributeMap->pid = $product_id;
        //             //     $productAttributeMap->save();
        //             //   }
        //             //   if(isset($attributes['Fluorescence_Intensity'])){
        //             //     $productAttributeMap = new PAMapping();
        //             //     $productAttributeMap->attribute_values = $attributes['Polish'];
        //             //     $productAttributeMap->aid = $attributeId;
        //             //     $productAttributeMap->pid = $product_id;
        //             //     $productAttributeMap->save();
        //             //   }
        //              } 
        //              if(count($result ['product']) <= 10) {
        //                Product::insert($result ['product']);
        //              }
                   
                  
        //           }
        //           return redirect('admin/products')->with('success','Maximum Request Limit is exceed');
        //       }
        //       return redirect('admin/products')->with('success','Product Import Successfully');
             
            
             
        //    } catch(\Exception $ex){
        //      return response()->json(["message"=>$ex->getMessage()]);
        //    }
        //  }
        
        public function importProductApi() {
          session_start();
          try{
            
              $response =[];
              $local = [];
              $shapeId = 0;
              $colorId = 0;
              $attributeId = 0;
              $product_id = 0;
         
              if(isset($_SESSION['products']))
              {
                  $response =  $_SESSION['products'];
              }
              else{
                  $response_data = $this->getProducts();
                  $_SESSION['products'] = $response_data;
                  $response =  $_SESSION['products'];
              }
             $limit  = 20;
             $page = 1;
             $totalProducts = count($response);
           //  $totalPages = ceil($totalProducts/$limit);
             $offset =( $page < 0 ) ? $offset = 0: ($page - 1) * $limit;
             //$page = max($page, 1);
           //  $page = min($page, $totalPages);
             $response2 = array_slice($response,$offset,$limit);
           // echo"<pre>"; print_r(count($response2)); exit;
           //  $totalProducts = count($response);
           $attributes=[
            "Weight",
            "Clarity",
            "Cut Grade",
            "Polish",
            "Symmetry",
            "Fluorescence Intensity",
        ];
      
              foreach($response2 as $key=>$products)
              {
               $result []=[
                     'stock_no'=> encrypt($products->Stock_No),
                     'image_src'=>$products->ImageLink,
                     'seo_title'=>$products->Diamond_Type,
                     'current_price'=>number_format($products->Buy_Price, 2, '.', ''),
                     'old_price'=>number_format($products->Memo_Price,2, '.', ''),
                     'short_description'=>$products->Clarity_Description
                 ];
                 
                 $shape = Shape::where('name','Like','%'.$products->Shape.'%')->count();
                 if($shape == 0){
                     $newshape = new Shape();
                     $newshape->name = $products->Shape;
                     $newshape->save();
                     $shapeId = $newshape->id;
                 } 
                 $color = Color::where('name','Like','%'.$products->Color.'%')->count();
               
                 if($color == 0) {
                     $newColor = new Color();
                     $newColor->name = $products->Color;
                     $newColor->code = '#0000FF';
                     $newColor->save();
                     $colorId = $newColor->id;
                 } 
                
                 
                 foreach($attributes as $attribute) {
                 
                   $checkattribute = Attribute::where("name",'Like','%'.$attribute.'%')->count();
                   if($checkattribute <= 0) {
                     $newAttribute = new Attribute();
                     $newAttribute->name = $attribute;
                     $newAttribute->save();
                     $attributeId =  $newAttribute->id;
                   } else {
                    $checkattribute = new Attribute();
                    $checkattribute->name = $attribute;
                    $checkattribute->save();
                    $attributeId =  $checkattribute->id;
                   }
                 }
              
               
                 $productsdetails = Product::where('variant_SKU','=',$products->Stock_No)->count();
                 if($productsdetails == 0) {
                     $newproducts = new Product();
                     $newproducts->variant_SKU = $products->Stock_No;
                     $newproducts->type = $products->Diamond_Type;
                     $newproducts->cost_per_item = $products->Buy_Price;
                     $newproducts->seo_title = $products->Shape.''.$products->Stock_No;
                     $newproducts->image_src = $products->ImageLink;
                     $newproducts->body =$products->Video_HTML;
                     $newproducts->variant_inventory_qty = 100;
                     $newproducts->shape = $shapeId;
                     $newproducts->color = $colorId;
                     $newproducts->published = 'TRUE';
                     $newproducts->IsApi = '1';
                     $newproducts->save();
                     $product_id = $newproducts->id;
                 }
                //$checkproduct = PAMapping::where('pid','=', $product_id)->first();
                if($products->Clarity) {
                 $neproductAttribut = new PAMapping();
                 $neproductAttribut->pid = $product_id;
                 $neproductAttribut->aid = $attributeId;
                 $neproductAttribut->attribute_values = $products->Clarity;
                 $neproductAttribut->save();
                }
                if($products->Cut_Grade) {
                 $neproductAttribut = new PAMapping();
                 $neproductAttribut->pid = $product_id;
                 $neproductAttribut->aid = $attributeId;
                 $neproductAttribut->attribute_values = $products->Cut_Grade;
                 $neproductAttribut->save();
                }
                if($products->Polish) {
                 $neproductAttribut = new PAMapping();
                 $neproductAttribut->pid = $product_id;
                 $neproductAttribut->aid = $attributeId;
                 $neproductAttribut->attribute_values = $products->Polish;
                 $neproductAttribut->save();
                }
                if($products->Symmetry) {
                 $neproductAttribut = new PAMapping();
                 $neproductAttribut->pid = $product_id;
                 $neproductAttribut->aid = $attributeId;
                 $neproductAttribut->attribute_values = $products->Symmetry;
                 $neproductAttribut->save();
                }
                if($products->Fluorescence_Intensity) {
                 $neproductAttribut = new PAMapping();
                 $neproductAttribut->pid = $product_id;
                 $neproductAttribut->aid = $attributeId;
                 $neproductAttribut->attribute_values = $products->Fluorescence_Intensity;
                 $neproductAttribut->save();
                }
                 
             }
             return redirect('admin/products')->with('success','Product Import Successfully');
          } catch(\Exception $ex){
            return response()->json(["message"=>$ex->getMessage()]);
          }
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
             
}