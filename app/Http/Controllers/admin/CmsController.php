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
    public function index($slug){
        $cms_data = $this->cms->_view_cms($slug);
        return view('admin.cms.cms',compact('cms_data'));
    }
    public function update(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $this->cms->_update($request->id,['title'=>$request->title,'description'=>$request->description]);
        return redirect('admin/cms/'.$request->slug)->with('success', 'Cms updated successfully');
    }
}
