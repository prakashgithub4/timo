<?php

namespace App\Repositories;
use App\Models\Contactus;

class ContactRepository
{
    public function _add($data)
    {
        return Contactus::create($data);
    }
    public function _edit($id)
    {
        return Contactus::find($id);
    }

    public function _delete($id)
    {
        return Contactus::find($id)->delete();
    }
    public function _update($id, $data)
    {
        $user = Contactus::find($id);
        $user->title = $data['title'];
        if(isset($data['logo']['file'])){
            $user->logo  = $data['logo']['file'];
        }
       
        $user->address  = $data['address'];
        $user->facebook  = $data['facebook'];
        $user->twitter  = $data['twitter'];
        $user->google  = $data['google'];
        $user->youtube  = $data['youtube'];
        $user->save();
    }
    public function _getContact()
    {
        return Contactus::select('*')->first();
    }
}
