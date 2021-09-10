<?php

namespace App\Repositories;
use App\Models\Color;
class ColorRepository 
{
    public function _add($data)
    {
        return Color::create($data);
    }
    public function _edit($id)
    {
        return Color::find($id);
    }
   
    public function _delete($id)
    {
        return Color::find($id)->delete();
    }
    public function _update($id,$data)
    {
        $user = Color::find($id);
        $user->name = $data['name'];
        $user->code = $data['code'];
        $user->save();
    }
    public function _getColors(){
        return Color::all();
    }
   
}
