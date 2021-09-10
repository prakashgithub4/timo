<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\DiscountRepository;

class DiscountController extends Controller
{
    protected $discount;
    public function __construct(DiscountRepository $discount)
    {
        $this->discount = $discount;
        $this->middleware('admin');
    }
    public function index()
    {
        $discount = $this->discount->_getdiscount();
        return view('admin.discounts.discount',compact('discount'));
    }
    public function update(Request $request)
    {
        $this->discount->_update($request->id,['amount'=>$request->amount]);
        return redirect('admin/discount')->with('success','Discount updated successfully');
    }
}
