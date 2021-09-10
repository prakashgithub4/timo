<?php

namespace App\Repositories;
use App\Models\Attribute;

class AttributRepository
{
    public function _add($data)
    {
        return Attribute::create($data);
    }
    public function _edit($id)
    {
        return Attribute::find($id);
    }

    public function _delete($id)
    {
        return Attribute::find($id)->delete();
    }
    public function _update($id, $data)
    {
        $shape = Attribute::find($id);
        $shape->name = $data['name'];
        $shape->save();
    }
    public function _getattributes()
    {
        return Attribute::all();
    }
}
