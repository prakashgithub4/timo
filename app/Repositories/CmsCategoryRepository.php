<?php

namespace App\Repositories;

use App\Repositories\Interfaces\CmsInterface;
use App\Models\CmsCategory;

class CmsCategoryRepository implements CmsInterface
{
    public function _update($id, $data)
    {
        $cms = CmsCategory::find($id);
        $cms->name = $data['name'];
        $cms->save();
         return true;
    }
    public function _view_cms($status)
    {
        return CmsCategory::where('status', $status)->first();
    }

    public function _getCms(){
        return CmsCategory::all();
    }

    public function _add($data)
    {
        return CmsCategory::create($data);
    }
    public function _edit($id)
    {
        return CmsCategory::find($id);
    }
   
    public function _delete($id)
    {
        return CmsCategory::find($id)->delete();
    }
}
