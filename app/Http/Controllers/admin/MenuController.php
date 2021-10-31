<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Product;
use App\Traits\ImageTraits;
use File;

use App\Models\Menu_sub_category;

class MenuController extends Controller
{
    use ImageTraits;
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index()
    {
        $menu = Menu::all();
        return view('admin.menu.list', compact('menu'));
    }
    public function addOrEdit($id = null)
    {
        //$getMenu = [];
        if (is_null($id)) {
            return view('admin.menu.add');
        } else {
            $getMenu = Menu::find($id);
            return view('admin.menu.add', compact('getMenu'));
        }
    }
    public function saveMenu(Request $request)
    {
        if ($request->id == 0) {
            $this->validate($request, [
                'menu_name' => 'required',
                'banner'=>['image', 'mimes:jpeg,png', 'max:2048']
            ]);
            if ($request->hasFile('banner')) {
                $menu_banner = $this->Uploadfile($request->file('banner'), 'uploads/subcat_banner');
            }
            $menu  = new Menu();
            $menu->menu_name = $request->menu_name;
            $menu->description = $request->description;
            $menu->banner = $menu_banner['file'];
            $menu->top = '1';
            $menu->save();
            return redirect()->route('admin.menu')->with('success', 'Menu added successfully');
        } else {
            $menu = Menu::find($request->id);
            if ($request->hasFile('banner')) {
                if (File::exists(public_path('uploads/subcat_banner/' . $menu->banner))) {
                    File::delete(public_path('uploads/subcat_banner/' . $menu->banner));
                }
                $menu_banner = $this->Uploadfile($request->file('banner'), 'uploads/subcat_banner');
                $menu->banner = $menu_banner['file'];
            }
            $menu->menu_name = $request->menu_name;
            $menu->description = $request->description;
            $menu->save();
            return redirect()->route('admin.menu')->with('success', 'Menu updated successfully');
        }
    }
    public function deleteMenu($id)
    {
        $menu = Menu::find($id)->delete();
        Menu_sub_category::where('menu_id',$id)->delete();
        return redirect()->route('admin.menu')->with('success', 'Menu has been deleted successfully');
    }

    public function changeStatus(Request $request)
    {
        $data = $request->query();
        $menu = Menu::find($data['menu_id']);
        $menu->status = $data['status'];
        $menu->save();
        return response()->json(["stat" => true, 'message' => "Status updated successfully"]);
    }
    public function setMegamenu(Request $request)
    {
        $data = $request->query();
        $menu = Menu::find($data['id']);
        $menu->mega = $data['value'];
        $menu->save();
        return response()->json(['stat' => true, 'message' => "Mega menu status changed successfully"]);
    }
    public function setOnSide(Request $request)
    {
        $data = $request->query();
        $menu = Menu::find($data['id']);
        $menu->side_on = $data['value'];
        $menu->save();
        return response()->json(['stat' => true, 'message' => "Set On side status has been changed successfully"]);
    }
    public function setOnTop(Request $request)
    {
        $data = $request->query();
        $menu = Menu::find($data['id']);
        $menu->top = $data['value'];
        $menu->save();
        return response()->json(['stat' => true, 'message' => "Set On top status has been changed successfully"]);
    }

    /** Assign menu */
    public function products_menu_assignview()
    {
        $menus = Menu::all();
        return view('admin.assign_menu.products',compact('menus'));
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
         
          $nestedData['SL'] =  "<input  type='checkbox' class='menu_item'  value='".$product->id."'/>  ".($key+1);
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

    public function getsubmenus(Request $request)
    {
        $id = $request->query('id');
        $subcategory = Menu_sub_category::where('menu_id',$id)->get();
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

   
    /** Sub category menu */
    public function subcatList()
    {
        $productSubCategory = Menu::with('submenus')->get();
        return view('admin.menu_sub_category.list', compact('productSubCategory'));
    }
    public function addsubmenu()
    {
        $menu = Menu::all();
        return view('admin.menu_sub_category.add', compact('menu'));
    }
    public function saveSubcategory(Request $request)
    {
        $this->validate($request, [
            'menu_id' => 'required',
        ]);
        if ($request->types == 'mega') {
            $this->validate($request, [
                'menu_id' => 'required',
                'types' => 'required',
                'mega_menu_cat' => 'required',
                'banner_image'=>['image', 'mimes:jpeg,png', 'max:2048']
            ]);
            if ($request->hasFile('banner_image')) {
                $subcat_banner = $this->Uploadfile($request->file('banner_image'), 'uploads/subcat_banner');
            }
            $subcate = new Menu_sub_category();
            $subcate->menu_id = $request->menu_id;
            $subcate->name = $request->mega_menu_cat;
            $subcate->description = $request->description;
            $subcate->banner_image = $subcat_banner['file'];
            $subcate->is_mega_category = 'true';
            $subcate->is_sub_category = 'false';
            $subcate->save();
        } else {
            $this->validate($request, [
                'menu_id' => 'required',
                'types' => 'required',
                'sub_category_name' => 'required',
                'sub_category_icon' => ['image', 'mimes:jpeg,png', 'max:2048'],
                'banner_image'=>['image', 'mimes:jpeg,png', 'max:2048']
            ]);
            if ($request->hasFile('sub_category_icon')) {
                $subcat_logo = $this->Uploadfile($request->file('sub_category_icon'), 'uploads/subcat_icons');
            }
            if ($request->hasFile('banner_image')) {
                $subcat_banner = $this->Uploadfile($request->file('banner_image'), 'uploads/subcat_banner');
            }
            $subcate = new Menu_sub_category();
            $subcate->menu_id = $request->menu_id;
            $subcate->icon = $subcat_logo['file'];
            $subcate->name = $request->sub_category_name;
            $subcate->description = $request->description;
            $subcate->banner_image = $subcat_banner['file'];
            $subcate->is_mega_category = 'false';
            $subcate->is_sub_category = 'true';
            $subcate->save();
        }
        return redirect()->route('submenus')->with('success', 'Category has been created successfully');
    }

    public function deleteSubmenu($id)
    {
        $remove = Menu_sub_category::find($id);
        if (File::exists(public_path('uploads/subcat_icons/' . $remove->icon))) {
            File::delete(public_path('uploads/subcat_icons/' . $remove->icon));
        }
        if (File::exists(public_path('uploads/subcat_banner' . $remove->banner_image))) {
            File::delete(public_path('uploads/subcat_banner' . $remove->banner_image));
        }
        $remove->delete();
        return redirect()->route('submenus')->with('success', 'Remove sub category');
    }
    public function editsubmenu($id)
    {
        $editsubmenu = Menu_sub_category::find($id);
        return view('admin.menu_sub_category.edit', compact('editsubmenu'));
    }
    public function updateSubcat(Request $request)
    {
        $this->validate($request, [
            'menu_sub_name' => 'required',
            'sub_category_icon' => ['image', 'mimes:jpeg,png', 'max:2048']
        ]);

        $submenu =  Menu_sub_category::find($request->id);

        if ($request->hasFile('sub_category_icon')) {
            if (File::exists(public_path('uploads/subcat_icons/' . $submenu->icon))) {
                File::delete(public_path('uploads/subcat_icons/' . $submenu->icon));
            }
            $subcat_logo = $this->Uploadfile($request->file('sub_category_icon'), 'uploads/subcat_icons');
            $submenu->icon = $subcat_logo['file'];
        }

        if ($request->hasFile('sub_banner')) {
            if (File::exists(public_path('uploads/subcat_banner/' . $submenu->icon))) {
                File::delete(public_path('uploads/subcat_banner/' . $submenu->icon));
            }
            $subcat_banner = $this->Uploadfile($request->file('sub_category_icon'), 'uploads/subcat_icons');
            $submenu->banner_image = $subcat_banner['file'];
        }
        $submenu->description = $request->description;
        $submenu->name = $request->menu_sub_name;
        $submenu->save();
        return redirect()->route('submenus')->with('success', 'Sub menu is updated successfully');
    }

    public function addmegamenucategory()
    {
        $menu = Menu_sub_category::where('is_mega_category', true)->get();
        $submenu = Menu_sub_category::where('is_sub_category', true)->get();
        return view('admin.megamenu.add', compact('menu', 'submenu'));
    }
    public function savemegamenucategory(Request $request)
    {
        $this->validate($request, [
            'menu_subcategory_id' => 'required',
            'sub_menu_id' => 'required'
        ]);
        $parent_details = Menu_sub_category::find($request->sub_menu_id);
        $parent_details->mega_parent_id = $request->menu_subcategory_id;
        $parent_details->save();  
        return redirect()->route('admin.mega.menu.cat.list')->with('success','Mega menu category has been added successfully');  
    }
    public function allmegasubcategory()
    {
        $productSubCategory = Menu_sub_category::with('megamenu')->where('is_mega_category',true)->get();
        return view('admin.megamenu.list',compact('productSubCategory'));
    }
}
