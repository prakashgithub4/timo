<?php

namespace App\Repositories;

use App\Repositories\Interfaces\CmsInterface;
use App\Models\Cms;

class CmsRepository implements CmsInterface
{
    public function _update($id, $data)
    {
        $cms = Cms::find($id);
        $cms->title = $data['title'];
        $cms->description = $data['description'];
        $cms->slug = $data['slug'];
        $cms->cid = $data['cid'];
        $cms->save();
         return true;
    }
    public function _view_cms($status)
    {
        return Cms::where('status', $status)->first();
    }

    public function _getCms(){
        return Cms::with('categories')->get();
    }

    public function _add($data)
    {
        return Cms::create($data);
    }
    public function _edit($id)
    {
        return Cms::find($id);
    }
   
    public function _delete($id)
    {
        return Cms::find($id)->delete();
    }

    public function viewCms($title)
    {
        return Cms::where('slug', $title)->first();
    }
}
