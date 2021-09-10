<?php

namespace App\Repositories;
use App\Models\User;

use Illuminate\Support\Facades\Hash;

class UserRepository 
{
    public function _add($data)
    {
        return User::create($data);
    }
    public function _edit($id)
    {
        return User::find($id);
    }
    public function _update($id, $data)
    {
        $user = User::find($id);
        if (!empty($data['name'])) {
            $user->name = $data['name'];
        } else if (!empty($data['email'])) {
            $user->email = $data['email'];
        } else if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }
        $user->save();
    }
    public function _delete($id)
    {
        return User::find($id)->delete();
    }
    public function _update2($id,$data)
    {
        $user = User::find($id);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->phone = $data['phone'];
        $user->address = $data['address'];
        $user->gender=$data['gender'];
        $user->save();
    }
    public function _getCustomer($customer){
        return User::select('*')->where('user_type',$customer)->get();
    }
   
}
