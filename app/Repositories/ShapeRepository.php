<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Shape;

class ShapeRepository
{
    public function _add($data)
    {
        return Shape::create($data);
    }
    public function _edit($id)
    {
        return Shape::find($id);
    }

    public function _delete($id)
    {
        return Shape::find($id)->delete();
    }
    public function _update($id, $data)
    {
        $shape = Shape::find($id);
        $shape->name = $data['name'];
        $shape->logo = $data['logo'];
        $shape->banner = $data['banner'];
        $shape->description = $data['description']; 
        $shape->save();
    }
    public function _getshaps()
    {
        return Shape::all();
    }
}
