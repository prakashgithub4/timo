<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ColorRepository;

class ColorController extends Controller
{
    //
    protected $colors;
    public function __construct(ColorRepository $color)
    {
        $this->colors = $color;
        $this->middleware('admin');
    }
    public function index()
    {
        $allcolors = $this->colors->_getColors();
        return view('admin.colors.colors', compact('allcolors'));
    }
    public function add($id = null)
    {
        if (is_null($id)) {
            return view('admin.colors.add');
        } else {
            $getColorbyId = $this->colors->_edit($id);
            return view('admin.colors.add', compact('getColorbyId'));
        }
    }
    public function save(Request $request)
    {

        $userid = \Auth::user()->id;

        $request->validate([
            'name' => 'required',
            'color' => 'required',
        ]);
        $input_array = array(
            'name' => $request->name,
            'code' => $request->color,
            'userId' => $userid
        );

        if ($request->id == 0) {
            $this->colors->_add($input_array);
            return redirect('admin/colors')->with('success', 'color has been created successfully');
        } else {
            $this->colors->_update($request->id, $input_array);
            return redirect('admin/colors')->with('success', 'color has been updated successfully');
        }
    }
    public function delete($id)
    {
        $this->colors->_delete($id);
        return redirect('admin/colors')->with('success', 'color has been deleted successfully');
    }
}
