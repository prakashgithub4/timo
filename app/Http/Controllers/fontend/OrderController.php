<?php

namespace App\Http\Controllers\fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


class OrderController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('customer');
    }
    public function save(Request $request)
    {

         //print_r($request->all());
         //exit();

        $userdata = Auth::user();
        // $request->validate([
        //     'first_name' => 'required',
        //     'last_name' => 'required',
        //     'state' => 'required',
        //     'country' => 'required',
        //     'address' => 'required',
        //     'phone' => 'required',
        //     'shipping_address' => 'required',
        //     'order_total' => 'required',
        //     'payment_status' => 'required',
        //     'payment_mode' => 'required',
        // ]);
        $input_array = array(
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'state' => $request->state,
            'country' => $request->country,
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'shipping_address' => $request->shipping_address,
            'order_notes' => $request->order_notes,
            'order_total' => $request->order_total,
            'coupan_code' => $request->coupan_code,
            'payment_status' => $request->payment_status,
            'payment_mode' => $request->payment_mode,
            'comapny' => $request->comapny,
            'uid' =>$userdata->id
        );
        if($request->check_method == 'cod')
        {
           
           
             PurchaseOrder::create($input_array);
             $array  = explode(',',$request->cat_id);
             for ($i = 0; $i < count($array); $i++) {
                DB::table('carts')->where('id', $array[$i])->delete();
             }
             return Redirect::to('/')->with('success', 'Order Placed successfully');
        }
        else
        {
            $paypal = new PaymentController($input_array['order_total']);
            $paypal->charge();
        }
       
    }
}
