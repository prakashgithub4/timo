<?php

namespace App\Repositories;

use App\Models\Menu;
use Log;

class MenuRepository
{
    public function _add($data)
    {
        Log::info($data);
        return Menu::create($data);
    }
    public function _get()
    {
        return Menu::all();
    }
    public function _getByStatus()
    {
        return Menu::where('status', 'active')->get();
    }
    public function _edit($id)
    {
        return Menu::find($id);
    }

    public function _delete($id)
    {
        return Menu::find($id)->delete();
    }
    
    public function _status($id, $status)
    {
        $menu = Menu::find($id);
        $menu->status  =$status;
        $menu->save();
    }
    public function _setOnTop($id, $top)
    {
       
        $menu = Menu::find($id);
        $menu->mega  =$top;
        $menu->save();
    }

    

    public function _setOnHead($id, $head_on)
    {
       
        $menu = Menu::find($id);
        $menu->head_on  =$head_on;
        $menu->save();
    }
    
    public function _update($id, $data)
    {
        $menu = Menu::find($id);
        $menu->menu_name = $data['menu_name'];
        $menu->status  = $data['status'];
        //$menu->top  = $data['top'];
       // $menu->deleted_at  = $data['deleted_at'];
        $menu->save();
    }

    public function _setOnSide($id, $side_on)
    {
       
        $menu = Menu::find($id);
        $menu->side_on  =$side_on;
        $menu->save();
    }
    
}
