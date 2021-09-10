<?php

namespace App\Repositories;
use App\Models\Subscriber;

class SubscriberRepository
{
    public function _add($data)
    {
        return Subscriber::create($data);
    }
    public function _edit($id)
    {
        return Subscriber::find($id);
    }

    public function _delete($id)
    {
        return Subscriber::find($id)->delete();
    }
    public function _update($id, $data)
    {
        $shape = Subscriber::find($id);
        $shape->link = $data['link'];
        $shape->save();
    }
    public function _getsubscriber()
    {
        return Subscriber::all();
    }
}
