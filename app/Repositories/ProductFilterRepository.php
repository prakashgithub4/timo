<?php

namespace App\Repositories;

use App\Repositories\Interfaces\CmsInterface;
use App\Models\ProductFilter;

class ProductFilterRepository implements CmsInterface
{
    public function _update($id, $data)
    {
        $cms = ProductFilter::find($id);
        $cms->filter_name = $data['filter_name'];
        $cms->min_range = $data['min_range'];
        $cms->max_range = $data['max_range'];
        $cms->status = $data['status'];
        $cms->save();
         return true;
    }
    public function _view_cms($status)
    {
        return ProductFilter::where('status', $status)->first();
    }

    public function _getCms(){
        return ProductFilter::all();
    }

    public function _add($data)
    {
        return ProductFilter::create($data);
    }
    public function _edit($id)
    {
        return ProductFilter::find($id);
    }
   
    public function _delete($id)
    {
        return ProductFilter::find($id)->delete();
    }
}
