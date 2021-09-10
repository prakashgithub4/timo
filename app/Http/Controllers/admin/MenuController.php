<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\MenuRepository;

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
}
