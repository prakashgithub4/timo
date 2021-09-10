<?php

namespace App\Repositories;

use App\Models\Gallery;

class GalleryRepository
{
    public function _add($data)
    {
        return Gallery::create($data);
    }
    public function _edit($id)
    {
        return Gallery::find($id);
    }

    public function _delete($id)
    {
        return Gallery::find($id)->delete();
    }
    public function _update($id,$data)
    {
        $cat = Gallery::find($id);
        $cat->product_id  = $data['product_id'];
        $cat->image = $data['image'];
        $cat->user_id = $data['user_id'];
        $cat->slug = $data['status'];
        $cat->save();
    }
    public function _getGalleries($product_id)
    {
        return Gallery::where('product_id',$product_id)->get();
    }
}
