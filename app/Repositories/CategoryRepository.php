<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function _add($data)
    {
        return Category::create($data);
    }
    public function _edit($id)
    {
        return Category::find($id);
    }

    public function _delete($id)
    {
        return Category::find($id)->delete();
    }
    public function _update($id, $data)
    {
        $cat = Category::find($id);
        $cat->name = $data['name'];
        $cat->short = $data['short'];
        $cat->image = $data['image'];
        $cat->slug = $data['slug'];
        $cat->save();
    }
    public function _getCategories()
    {
        return Category::all();
    }
}
