<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public $user = null;
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
        $this->middleware('admin');
    }
    public function changepassword()
    {
        return view('admin.users.change_password');
    }
    public function updatepassword(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);

        if ($validation->fails()) {
            return response()->json(['error' => $validation->errors(), 'status' => 'error'], 200);
        }
        $user_id = \Auth::user()->id;
        $isUpdate = $this->user->_update($user_id, [
            'password' => $request->password
        ]);
        if ($isUpdate == true) {
            return response()->json(['status' => true, 'message' => 'Password has been changed successfully']);
        } else {
            return response()->json(['status' => false, 'message' => 'Password not changed successfully']);
        }
    }
    public function customerlist($user_type)
    {
        $customer = $this->user->_getCustomer($user_type);
        return view('admin.users.users', compact('customer'));
    }
    public function addcustomer($id = null)
    {
        if (is_null($id)) {
            return view('admin.users.add');
        } else {
            $getCustomerbyId = $this->user->_edit($id);
            return view('admin.users.add', compact('getCustomerbyId'));
        }
    }
    public function createcustomer(Request $request)
    {
        
        if ($request->id == 0) {
            $request->validate([
                'name' => 'required',
                'email' => 'required|unique:users|max:255',
                'password' => 'required|confirmed',
                'phone' => 'required|max:10',
            ]);
            $input_array = array(
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'address' => $request->address,
                'user_type' => $request->user_type,
                'gender'=>$request->gender
            );
            
            $this->user->_add($input_array);
            return redirect('admin/user/'.$request->user_type)->with('success', 'User has been created successfully');
        } else {
            $request->validate([
                'name' => 'required',
                'email' => 'required|max:255',
                'password' => 'required|confirmed',
                'phone' => 'required|max:10',
                'gender'=>'required'
            ]);
            $input_array = array(
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'address' => $request->address,
                'user_type' => $request->user_type,
                'gender'=>$request->gender
            );
            $this->user->_update2($request->id, $input_array);
            return redirect('admin/user/'.$request->user_type)->with('success', 'User has been updated successfully');
        }
    }

    public function deletecustomer($id)
    {
        $this->user->_delete($id);
        return redirect('admin/customer')->with('success', 'User has been deleted successfully');
    }
}
