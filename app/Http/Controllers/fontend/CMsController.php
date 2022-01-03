<?php

namespace App\Http\Controllers\fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cms;
use App\Repositories\CmsRepository;

class CMsController extends Controller
{
    //
    public function __construct(CmsRepository $cms)
    {
        $this->cms =$cms;
    }
    public function about()
    {
        $cms_data = $this->cms->viewCms('about-us');
        return view('fontend.about', compact('cms_data'));
    }

    public function faq()
    {
        return view('fontend.faq');
    }


    public function contact()
    {
        return view('frontend.contact');
    }
   
}
