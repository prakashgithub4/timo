<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ShapeRepository;
use App\Traits\ImageTraits;
use File;

class ShapeController extends Controller
{
    use ImageTraits;
    //
    protected $shape = null;
    public function __construct(ShapeRepository $shape)
    {
        $this->shape=$shape;
        $this->middleware('admin');
    }
    public function index()
    {
        $shapes = $this->shape->_getshaps();
        return view('admin.shape.shape',compact('shapes'));
    }
    public function add($id = null)
    {
      if(is_null($id))
      {
          return view('admin.shape.add');
      }
      else
      {
        $getshapesById = $this->shape->_edit($id);
        return view('admin.shape.add',compact('getshapesById'));
      }
    }
    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'logo'=>['image', 'mimes:jpeg,png', 'max:2048']
        ]);
        if ($request->hasFile('logo')) {
            $logo = $this->Uploadfile($request->file('logo'), 'uploads/shape');
        }
        if($request->hasFile('banner'))
        {
            $banner = $this->Uploadfile($request->file('banner'),'uploads/shape/banner');
        }
        $input_array = array(
            'name' => $request->name,
            'logo' => $logo['file'],
            'banner'=>$banner['file'],
            'description'=>$request->description,
            'userId'=>\Auth::user()->id
        ); 
        
        if ($request->id == 0) {
            $this->shape->_add($input_array);
            return redirect('admin/shapes')->with('success', 'Shape has been created successfully');
        } else {
            $getImageByid = $this->shape->_edit($request->id);
            if (File::exists(public_path('uploads/shape/' . $getImageByid->image))) {
                File::delete(public_path('uploads/shape/' . $getImageByid->image));
            }
            if (File::exists(public_path('uploads/shape/banner' . $getImageByid->banner))) {
                File::delete(public_path('uploads/shape/banner' . $getImageByid->banner));
            }
            $this->shape->_update($request->id, $input_array);
            return redirect('admin/shapes')->with('success', 'Shape has been updated successfully');
        }

       
    }
    public function delete($id)
    {
        $this->shape->_delete($id);
        return redirect('admin/shapes')->with('success', 'shape has been deleted successfully');
    }
    
}
