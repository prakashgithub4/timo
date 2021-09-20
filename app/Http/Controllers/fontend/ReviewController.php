<?php

namespace App\Http\Controllers\fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class ReviewController extends Controller
{
    //
   
    public function addreview(Request $request)
    {
        if($request->email == '')
        {
            return response()->json(['stat'=>false,'message'=>'email field is required']);
        }
        if($request->name == '')
        {
            return response()->json(['stat'=>false,'message'=>'name field is required']);
        }

        $review = new Review();
        $review->name = $request->name;
        $review->email = $request->email;
        $review->message = $request->comment;
        $review->ratings = $request->rate;
        $review->product_id = $request->product_id;
        $review->save();
        return response()->json(['stat'=>true,'message'=>'Review submitted successfully']);
        // }
        
    }
}
