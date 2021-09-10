<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\AttributRepository;
class AttributeController extends Controller
{
    //
    protected $attribute = null;
    public function __construct(AttributRepository $attribute)
    {
        $this->attribute = $attribute;
        $this->middleware('admin');
    }
    public function index()
    {
        $attribute = $this->attribute->_getattributes();
        return view('admin.attribute.attributes',compact('attribute'));
    }
   

    public function add($id = null)
    {
      if(is_null($id))
      {
          return view('admin.attribute.add');
      }
      else
      {
        $getattributesById = $this->attribute->_edit($id);
        return view('admin.attribute.add',compact('getattributesById'));
      }
    }
    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        
        $input_array = array(
            'name' => $request->name,
            'userId'=>\Auth::user()->id
        ); 
        if ($request->id == 0) {
            $this->attribute->_add($input_array);
            return redirect('admin/attribute')->with('success', 'Attribute has been created successfully');
        } else {
            $this->attribute->_update($request->id, $input_array);
            return redirect('admin/attribute')->with('success', 'Attribute has been updated successfully');
        }

       
    }
    public function delete($id)
    {
        $this->attribute->_delete($id);
        return redirect('admin/attribute')->with('success', 'Attribute has been deleted successfully');
    }
}
