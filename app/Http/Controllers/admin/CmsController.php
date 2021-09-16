<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CmsRepository;
class CmsController extends Controller
{
    //
    protected $cms;
    public function __construct(CmsRepository $cms)
    {
        $this->middleware('admin');
        $this->cms =$cms;
    }
    public function index()
    {
        $allcms = $this->cms->_getCms();
        return view('admin.cms.cms', compact('allcms'));
    }

    public function add($id = null)
    {
        if (is_null($id)) {
            return view('admin.cms.add');
        } else {
            $cms_data = $this->cms->_edit($id);
            return view('admin.cms.add', compact('cms_data'));
        }
    }

    public function save(Request $request)
    {

        $userid = \Auth::user()->id;

        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $input_array = array(
            'title' => $request->title,
            'description' => $request->description,
           // 'id' => $userid
        );

        if ($request->id == 0) {
            $this->cms->_add($input_array);
            return redirect('admin/cms')->with('success', 'Data has been created successfully');
        } else {
            $this->cms->_update($request->id, $input_array);
            return redirect('admin/cms')->with('success', 'Data has been updated successfully');
        }
    }

    public function delete($id)
    {
        $this->cms->_delete($id);
        return redirect('admin/cms')->with('success', 'Data has been deleted successfully');
    }

    // public function index($slug){
    //     $cms_data = $this->cms->_view_cms($slug);
    //     return view('admin.cms.cms',compact('cms_data'));
    // }
    // public function update(Request $request){
    //     $request->validate([
    //         'title' => 'required',
    //         'description' => 'required',
    //     ]);
    //     $this->cms->_update($request->id,['title'=>$request->title,'description'=>$request->description]);
    //     return redirect('admin/cms/'.$request->slug)->with('success', 'Cms updated successfully');
    // }
}
