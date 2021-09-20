<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\SliderRepository;
use App\Traits\ImageTraits;
use File;


class SliderController extends Controller
{
    use ImageTraits;
    public $slider = null;
    public function __construct(SliderRepository $slider)
    {
        $this->slider=$slider;
        $this->middleware('admin');
    }
    
    public function index()
    {
        $slider = $this->slider->getSlider();
        return view('admin.slider.list',compact('slider'));
        
        
    }

    public function addOrEdit($id = null)
    {
        
        if (is_null($id)) {
            return view('admin.slider.add');
        } else {
            $getSlider = $this->slider->_edit($id);
            
            return view('admin.slider.add', compact('getSlider'));
        }
        
    }

    public function deleteSlider( Request $request, $id)
    {
        $getImageByid = $this->slider->_edit($id);
        if (File::exists(public_path('uploads/slider/' . $getImageByid->image))) {
            File::delete(public_path('uploads/slider/' . $getImageByid->image));
        }
        $slider = $this->slider->deleteSlider($id);
        
        return redirect('admin/slider')->with('success', 'Slider has been deleted successfully');
    }

    public function saveSlider(Request $request)
    {
        
        $request->validate([
           // 'discount_title' => 'required',
            'title' => 'required',
           // 'price' => 'required',
            'image' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
           
        ]);

        if ($request->hasFile('image')) {
            $image = $this->Uploadfile($request->file('image'), 'uploads/slider');
        }
        //print_r($image); exit;
        if(isset($image))
        {
            $getImageByid = $this->slider->_edit($request->id);
            if (File::exists(public_path('uploads/slider/' . $getImageByid->image))) {
                File::delete(public_path('uploads/slider/' . $getImageByid->image));
            }
            $input_array = array(
            'discount_title' => $request->discount_title,
            'title' => $request->title,
            'image' => $image['file'],
            'url' => $request->url
            );
        }
        else
        {
             $input_array = array(
            'discount_title' => $request->discount_title,
            'title' => $request->title,
            //'image' => $image['file'],
            'url' => $request->url
            );
        }
       
        //return $input_array;
        if ($request->id == 0) {
            $this->slider->saveSlider($input_array);
            return redirect('admin/slider')->with('success', 'One Slider has been created successfully');
        } else {
           
            $this->slider->_update($request->id, $input_array);
            return redirect('admin/slider')->with('success', 'Slider has been updated successfully');
        }
    }
}
