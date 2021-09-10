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
        $cms->save();
         return true;
    }
    public function _view_cms($status)
    {
        return Cms::where('status', $status)->first();
    }
}
