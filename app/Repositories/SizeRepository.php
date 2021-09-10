<?php

namespace App\Repositories;
use App\Models\Size;

class SizeRepository
{
    public function _add($data)
    {
        return Size::create($data);
    }
    public function _edit($id)
    {
        return Size::find($id);
    }

    public function _delete($id)
    {
        return Size::find($id)->delete();
    }
    public function _update($id, $data)
    {
        $shape = Size::find($id);
        $shape->size = $data['size'];
        $shape->save();
    }
    public function _getsizes()
    {
        return Size::all();
    }
}
