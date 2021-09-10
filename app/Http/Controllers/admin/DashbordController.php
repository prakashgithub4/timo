<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class DashbordController extends Controller
{
    function __construct()
    {
        $this->middleware('admin');
    }
    public function index(){
        $products = Product::count();
        return view('admin.dashbord.index',compact('products'));
    }
}
