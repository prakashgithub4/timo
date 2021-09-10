<?php

namespace App\Repositories;

use App\Models\SubCategory;
use App\Models\Category;

class SubCategoryRepository
{
    public function _add($data)
    {
        return SubCategory::create($data);
    }
    public function _edit($id)
    {
        return SubCategory::find($id);
    }

    public function _delete($id)
    {
        return SubCategory::find($id)->delete();
    }
    public function _update($id, $data)
    {
        $user = SubCategory::find($id);
        $user->name = $data['name'];
        $user->category_id  = $data['category_id'];
        $user->userId  = $data['userId'];
        $user->slug  = $data['slug'];
        $user->save();
    }
    public function _getCategories()
    {
        return Category::select('*')->with('subCategories')->orderBy('id','DESC')->get();
    }
}
