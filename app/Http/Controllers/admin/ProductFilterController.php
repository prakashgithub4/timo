<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ProductFilterRepository;
class ProductFilterController extends Controller
{
    //
    protected $cms;
    public function __construct(ProductFilterRepository $cms)
    {
        $this->middleware('admin');
        $this->cms =$cms;
    }
    public function index()
    {
        $allcms = $this->cms->_getCms();
        return view('admin.product_filters.list', compact('allcms'));
    }

    public function add($id = null)
    {

        if (is_null($id)) {
            return view('admin.product_filters.add');
        } else {
            $cms_data = $this->cms->_edit($id);
            return view('admin.product_filters.add', compact('cms_data'));
        }
    }

    public function save(Request $request)
    {

        $userid = \Auth::user()->id;
        $request->validate([
            'filter_name' => 'required',
            'min_range' => 'required',
            'max_range' => 'required',
        ]);
        $input_array = array(
            'filter_name' => $request->filter_name,
            'min_range' => $request->min_range,
            'max_range' => $request->max_range,
            'status' => $request->status
           // 'id' => $userid
        );

        if ($request->id == 0) {
            $this->cms->_add($input_array);
            return redirect('admin/product_filters')->with('success', 'Data has been created successfully');
        } else {
            $this->cms->_update($request->id, $input_array);
            return redirect('admin/product_filters')->with('success', 'Data has been updated successfully');
        }
    }

    public function delete($id)
    {
        $this->cms->_delete($id);
        return redirect('admin/product_filters')->with('success', 'Data has been deleted successfully');
    }

}
