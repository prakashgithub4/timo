<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\SizeRepository;

class SizeController extends Controller
{
    //
    public $size = null;
    public function __construct(SizeRepository $size)
    {
        $this->size=$size;
        $this->middleware('admin');
    }
    public function index()
    {
        $size = $this->size->_getsizes();
        return view('admin.size.size',compact('size'));
    }
    public function add($id = null)
    {
      if(is_null($id))
      {
          return view('admin.size.add');
      }
      else
      {
        $getsizesById = $this->size->_edit($id);
        return view('admin.size.add',compact('getsizesById'));
      }
    }
    public function save(Request $request)
    {
        $request->validate([
            'size' => 'required',
        ]);
       
        $input_array = array(
            'size' => $request->size,
        ); 
        
        if ($request->id == 0) {
            $this->size->_add($input_array);
            return redirect('admin/sizes')->with('success', 'size has been created successfully');
        } else {
         
            $this->size->_update($request->id, $input_array);
            return redirect('admin/sizes')->with('success', 'size has been updated successfully');
        }

       
    }
    public function delete($id)
    {
        $this->size->_delete($id);
        return redirect('admin/sizes')->with('success', 'size has been deleted successfully');
    }
}
