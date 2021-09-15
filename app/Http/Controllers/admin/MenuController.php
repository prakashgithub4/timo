<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\MenuRepository;
use App\Models\Product;
use App\Models\Menu;
use App\Models\ProductSubCategory;

class MenuController extends Controller
{
    protected $menu;
    public function __construct(MenuRepository $menu)
    {
        $this->menu = $menu;
        $this->middleware('admin');
    }

    function index()
    {
        $menu = $this->menu->_get();
        //return $menu;
        return view('admin.menu.list',compact('menu'));
    }


    function status(Request $reques,$id,$status)
    {
        $menu = $this->menu->_status($id, $status);
        //return $menu;
        return redirect('admin/menu')->with('success', 'Menu has been updated successfully');
    }

    function setOnTop(Request $reques,$id,$top)
    {
        $menu = $this->menu->_setOnTop($id, $top);
        //return $menu;
        return redirect('admin/menu')->with('success', 'Mega menu has been updated successfully');
    }

    public function addOrEdit($id = null)
    {
        
        if (is_null($id)) {
            return view('admin.menu.add');
        } else {
            $getMenu = $this->menu->_edit($id);
            
            return view('admin.menu.add', compact('getMenu'));
        }
        
    }


    public function saveMenu(Request $request)
    {
       
        

        $input_array = array(
            'menu_name' => $request->menu_name,
            'status' => $request->status==null? 'inactive' : 'active',
            'top' => $request->top==null?'0':'1'

            
        );
   
       
        if ($request->id == 0) {
           
            $this->menu->_add($input_array);
            return redirect('admin/menu')->with('success', 'Menu has been created successfully');
        } else {
            
            $getImageByid = $this->menu->_edit($request->id);
         
            $this->menu->_update($request->id, $input_array);
            return redirect('admin/menu')->with('success', 'Menu has been updated successfully');
        }
    }

    public function deleteMenu( Request $request, $id)
    {
        $getMenu = $this->menu->_edit($id);
        
        $getMenu = $this->menu->_delete($id);
        
        return redirect('admin/menu')->with('success', 'Menu has been deleted successfully');
    }
    
  
    function setOnHead(Request $reques,$id,$top)
    {
        $menu = $this->menu->_setOnHead($id, $top);
        //return $menu;
        return redirect('admin/menu')->with('success', 'Head Set has been updated successfully');
    }

    public function product_list(Request $request)
    {
      $columns = array(
        0 => 'id',
       // 1 =>'Handle',
       // 2 =>'Code',
        3 =>'Title',
       // 4 =>'Vendor',
      //  5 =>'Type',
       // 6=> 'Tags',
      //  7=>'Published',
      //  8=>'Is Purchased',
      //  8=>'Gender',
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

        $products = Product::select('products.id','products.seo_title','products.image_src','menus.menu_name','product_sub_category.sub_category_name')
          ->leftjoin('menus','menus.id','=','products.menu')
          ->leftjoin('product_sub_category','product_sub_category.product_sub_category_id','=','products.sub_menu')
          ->offset($start)
          ->limit($limit)
          ->orderBy($order, $dir)
          ->get();

    
      } else {
        $search = $request->input('search.value');
        $products =  Product::select('products.id','products.seo_title','products.image_src','menus.menu_name','product_sub_category.sub_category_name')
        ->leftjoin('menus','menus.id','=','products.menu')
        ->leftjoin('product_sub_category','product_sub_category.product_sub_category_id','=','menus.id')
        ->where('products.id', 'LIKE', "%{$search}%")
        ->orWhere('products.seo_title', 'LIKE', "%{$search}%")
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
         
          $nestedData['SL'] =  "<input  type='checkbox' class='menu_item' value='".$product->id."'/>  ".($key+1);
          $nestedData['title'] = $product->seo_title; 
          $nestedData['menu'] =  (is_null($product->menu_name)) ? 'N/A' : $product->menu_name;
          $nestedData['sub_menu'] =(is_null($product->sub_category_name)) ?'N/A' : $product->sub_category_name;
          $nestedData['Image'] ="<img src='".$product->image_src."' height='100' width='100'>";
          $nestedData['options'] = "<a href='".route('admin.galleries',$product->id)."' class='btn btn-info'><i class='far fa-images'></i></button>";
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
    public function products_menu_assignview()
    {
        $menus = Menu::all();
        return view('admin.assign_menu.products',compact('menus'));
    }
    
    public function getsubmenus(Request $request)
    {
        $id = $request->query('id');
        $subcategory = ProductSubCategory::where('menu_id',$id)->get();
        return response()->json(['stat'=>true,'message'=>"get subCategory has been fetch successfully","data"=>$subcategory]);
    }
    public function updatemenu(Request $request)
    {
        $product_ids = is_null($request->product_ids) ?[] : $request->product_ids;
        
        $menu_id = $request->menu_id;
        $sub_menu = $request->sub_menu;
       
        if(is_null($menu_id))
        {
            return response()->json(['stat'=>false,'message'=>'Please choose either menu','data'=>[]]);
        }
        
        else
        {
            if(count($product_ids) > 0)
            {
                $i = 0;
                while($i < count($product_ids))
                {
                    $product = Product::find($product_ids[$i]);
                    $product->menu = $menu_id;
                    $product->sub_menu = $sub_menu;
                    $product->save();
                    $i++;
                }
                return response()->json(['stat'=>true,'message'=>'menu added successfully','data'=>[]]);
            }
            else
            {
                return response()->json(['stat'=>false,'message'=>'Please choose each of these products','data'=>[]]);
            }
        
        }
    }

}
