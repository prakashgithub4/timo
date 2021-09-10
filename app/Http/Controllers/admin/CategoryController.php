<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;
use App\Repositories\SubCategoryRepository;
use App\Traits\ImageTraits;
use App\Models\Gift;
use File;


class CategoryController extends Controller
{
    use ImageTraits;
    protected $category = null;
    protected $subCateory = null;
    public function __construct(CategoryRepository $category,SubCategoryRepository $subCateory)
    {
        $this->category = $category;
        $this->subCateory = $subCateory;
        $this->middleware('admin');
    }
    public function index()
    {
        $categories = $this->category->_getCategories();
        return view('admin.categories.category', compact('categories'));
    }
    public function add($id = null)
    {
        if (is_null($id)) {
            return view('admin.categories.add');
        } else {
            $getCategorybyid = $this->category->_edit($id);
            return view('admin.categories.add', compact('getCategorybyid'));
        }
    }
    public function save(Request $request)
    {

        $userid = \Auth::user()->id;
        $image = null;
        $request->validate([
            'name' => 'required',
            'image' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $image = $this->Uploadfile($request->file('image'), 'uploads/category');
        }

        $input_array = array(
            'name' => $request->name,
            'image' => $image['file'],
            'short'=>$request->short,
            'userId' => $userid,
            'slug'=>$request->slug
        );
        if ($request->id == 0) {
            $this->category->_add($input_array);
            return redirect('admin/categories')->with('success', 'Category has been created successfully');
        } else {
            $getImageByid = $this->category->_edit($request->id);
            if (File::exists(public_path('uploads/category/' . $getImageByid->image))) {
                File::delete(public_path('uploads/category/' . $getImageByid->image));
            }
            $this->category->_update($request->id, $input_array);
            return redirect('admin/categories')->with('success', 'Category has been updated successfully');
        }
    }
    public function delete($id)
    {
        $getImageByid = $this->category->_edit($id);
        if (File::exists(public_path('uploads/category/' . $getImageByid->image))) {
            File::delete(public_path('uploads/category/' . $getImageByid->image));
        }
        $this->category->_delete($id);
        return redirect('admin/categories')->with('success', 'category has been deleted successfully');
    }
    /** Sub Category */
    public function getallsubcategory()
    {
        $categories = $this->subCateory->_getCategories();
        return view('admin.subcategory.category', compact('categories'));
    }
    public function addsubcat($id = null)
    {
        if(is_null($id))
        {
            $categories =$this->category->_getCategories();
            return view('admin.subcategory.add',compact('categories'));
        }
        else
        {
            $getsubcategorybyid = $this->subCateory->_edit($id);
            $categories =$this->category->_getCategories();
            return view('admin.subcategory.add',compact('categories','getsubcategorybyid'));
            
        }
       
    }
    public function savesubcategory(Request $request)
    {

        $userid = \Auth::user()->id;
        $request->validate([
            'name' => 'required',
            'category_id'=>'required'
        ]);
        $input_array = array(
            'name' => $request->name,
            'category_id' => $request->category_id,
            'userId' => $userid,
            'slug'=>$request->slug,
            'status '=>'A'
        );
       
        if ($request->id == 0) {
            $this->subCateory->_add($input_array);
            return redirect('admin/categories/sub')->with('success', 'Sub Category has been created successfully');
        } else {
           // $getImageByid = $this->category->_edit($request->id);
            // if (File::exists(public_path('uploads/category/' . $getImageByid->image))) {
            //     File::delete(public_path('uploads/category/' . $getImageByid->image));
            // }
           $this->subCateory->_update($request->id, $input_array);
           return redirect('admin/categories/sub')->with('success', 'Category has been updated successfully');
        }
    }
    public function subdelete($id)
    {
        $this->subCateory->_delete($id);
        return redirect('admin/categories/sub')->with('success', 'Sub category has been deleted successfully');
    }

    public function gifts()
    {   
        $categories = Gift::all();
        return view('admin.gifts.gifts',compact('categories'));
    }
    public function addgift($id = null)
    {
        if(is_null($id))
        {
             return view('admin.gifts.add');
        }
        else
        {
            $gifts = Gift::find($id);
            return view('admin.gifts.add',compact('gifts'));
        }
       
    }
    public function savegifts(Request $request)
    {

         $request->validate([
            'title' => 'required',
            'image' => ['required','image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);
          if ($request->hasFile('image')) {
            $image = $this->Uploadfile($request->file('image'), 'uploads/gifts');
        }
        if($request->id == 0)
        {
         $gift = new Gift();
         $gift->title = $request->title;
         $gift->description = $request->short;
         $gift->image = $image['file'];
         $gift->save();
         return redirect()->route('admin.gifts')->with('success','Gift has been added successfully');
        }
        else
        {

         $gift = Gift::find($request->id);
        
        if (File::exists(public_path('uploads/gifts/' . $gift->image))) {
            File::delete(public_path('uploads/gifts/' . $gift->image));
        }

         $gift->title = $request->title;
         $gift->description = $request->short;
         $gift->image = $image['file'];
         $gift->save();
         return redirect()->route('admin.gifts')->with('success','Gift has been added successfully');
        }
        
        
    }
    public function remove_gift($id)
    {
        $gift = Gift::find($id);
         if (File::exists(public_path('uploads/gifts/' . $gift->image))) {
            File::delete(public_path('uploads/gifts/' . $gift->image));
        }
        $gift->delete();
        return redirect()->route('admin.gifts')->with('success','Gift has been deleted successfully');

    }

    
}
