<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ProductCategoryRepository;
use App\Repositories\MenuRepository;
class ProductCategoryController extends Controller
{
    protected $productCategory;
    protected $menu;
    public function __construct(ProductCategoryRepository $productCategory, MenuRepository $menu)
    {
        $this->productCategory = $productCategory;
        $this->menu = $menu;
        $this->middleware('admin');
    }

    function index()
    {
        $productCategory = $this->productCategory->_get();
       // return 1;
        return view('admin.menu_category.list',compact('productCategory'));
    }


    

    function megaMenu($id,$megamenu)
    {   
        $menu = $this->productCategory->mega($id, $megamenu);
        //return $menu;
        return redirect('admin/menu-category')->with('success', 'Megamenu has been updated successfully');
    }

    public function addOrEdit($id = null)
    {
        
        if (is_null($id)) {
            $menu = $this->menu->_getByStatus();
          
            return view('admin.menu_category.add', compact('menu'));
        } else {
          
            $getMenu = $this->productCategory->_edit($id);
          
             $menu = $this->menu->_getByStatus();
            
            
            return view('admin.menu_category.add', compact('getMenu','menu'));
        }
        
    }


    public function saveMenuCategory(Request $request)
    {
       
        
       // return $request;
        $input_array = array(
            'menu_id' => $request->menu_id,
            'product_category' => $request->product_category,
        );
   
       
        if ($request->id == 0) {
           
            $this->productCategory->_add($input_array);
            return redirect('admin/menu-category')->with('success', 'Menu has been created successfully');
        } else {
            
            
            
            $this->productCategory->_update($request->id, $input_array);
            return redirect('admin/menu-category')->with('success', 'Menu has been updated successfully');
        }
    }

    public function delete( Request $request, $id)
    {
        
        
        $getproductCategory = $this->productCategory->_delete($id);
        
        return redirect('admin/menu-category')->with('success', 'Menu Category has been deleted successfully');
    }
    
}
