<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CmsCategoryRepository;
class CmsCategoryController extends Controller
{
    //
    protected $cms;
    public function __construct(CmsCategoryRepository $cms)
    {
        $this->middleware('admin');
        $this->cms =$cms;
    }
    public function index()
    {
        $allcms = $this->cms->_getCms();
        return view('admin.cms_category.cms', compact('allcms'));
    }

    public function add($id = null)
    {

        if (is_null($id)) {
            return view('admin.cms_category.add');
        } else {
            $cms_data = $this->cms->_edit($id);
            return view('admin.cms_category.add', compact('cms_data'));
        }
    }

    public function save(Request $request)
    {

        $userid = \Auth::user()->id;
        $request->validate([
            'title' => 'required',
        ]);
        $input_array = array(
            'name' => $request->title,
           // 'id' => $userid
        );

        if ($request->id == 0) {
            $this->cms->_add($input_array);
            return redirect('admin/cms-category')->with('success', 'Data has been created successfully');
        } else {
            $this->cms->_update($request->id, $input_array);
            return redirect('admin/cms-category')->with('success', 'Data has been updated successfully');
        }
    }

    public function delete($id)
    {
        $this->cms->_delete($id);
        return redirect('admin/cms-category')->with('success', 'Data has been deleted successfully');
    }

}
