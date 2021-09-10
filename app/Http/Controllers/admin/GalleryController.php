<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\GalleryRepository;
use App\Traits\ImageTraits;
use File;

class GalleryController extends Controller
{
    //
    use ImageTraits;
    public $gallery;
    public function __construct(GalleryRepository $gallery)
    {
        $this->middleware('admin');
        $this->gallery = $gallery;
    }
    public function index($product_id)
    {
        $galleries = $this->gallery->_getGalleries($product_id);

        return view('admin.gallery.gallery', compact('galleries', 'product_id'));
    }
    public function add($product_id)
    {
        return view('admin.gallery.add', compact('product_id'));
    }
    public function save(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);
        $image = null;
        if ($request->hasFile('image')) {
            $image = $this->Uploadfile($request->file('image'), 'uploads/gallery');
        }
        $input_array = array(
            'image' => createurl($image['file']),
            'product_id' => $request->product_id,
            'user_id' => \Auth::user()->id
        );

        $this->gallery->_add($input_array);
        return redirect()->route('admin.galleries', $request->product_id)->with('success', 'Gallery Image added successfully');
    }
    public function delete($gallery_id,$product_id)
    {
        $getgalleryimage = $this->gallery->_edit($gallery_id);
        $getImageName = explode('/',$getgalleryimage->image);
        $index = count($getImageName) - 1;
    
        if (File::exists(public_path('uploads/gallery/' . $getImageName[$index]))) {
            File::delete(public_path('uploads/gallery/' .$getImageName[$index]));
        }
        $this->gallery->_delete($gallery_id);
        return redirect()->route('admin.galleries',$product_id)->with('success', 'Gallery Image deleted successfully');
    }
}
