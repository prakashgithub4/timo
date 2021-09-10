<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    function __construct()
    {
        $this->middleware('admin');
    }
    public function index(){
       $review = Review::select('profiles.first_name','profiles.last_name','reviews.*')->join('profiles','profiles.user_id','=','reviews.user_id')->get();
       return view('admin.reviews.reviews',compact('review'));
    }
    public function destroy($id)
    {
      $review = Review::find($id)->delete();
      return redirect()->route('admin.review')->with('success','Review has been deleted successfully');
    }
    public function admin_reply($id)
    {
        $review = Review::select(\DB::raw("CONCAT(profiles.first_name,' ',profiles.last_name) AS full_name"),'reviews.*')->join('profiles','profiles.user_id','=','reviews.user_id')->where('reviews.id','=',$id)->first();

        return view('admin.reviews.update',compact('review'));
    }
    public function save(Request $request)
    {
      $review = Review::find($request->id);
      $review->reply = $request->reply;
      $review->added_by = \Auth::user()->id;
      $review->save();
      return redirect()->route('admin.review')->with('success','Reply Post successfully');
    }
}
