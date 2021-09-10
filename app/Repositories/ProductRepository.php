<?php

namespace App\Repositories;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class ProductRepository 
{
    public function _add($data)
    {
        return Product::create($data);
    }
    public function _edit($id)
    {
        return Product::find($id);
    }
    public function _update($id, $data)
    {
        $user = Product::find($id);
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
        return Product::find($id)->delete();
    }
    public function _update2($id,$data)
    {
        $user = Product::find($id);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->phone = $data['phone'];
        $user->address = $data['address'];
        $user->gender=$data['gender'];
        $user->save();
    }
    public function _publish_status($id,$data)
    {
        $user = Product::find($id);
        $user->published = $data;
        $user->save();
    }
    public function _getProducts(){
        return Product::select('*')->get();
        
    }
   
}
