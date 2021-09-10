<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Traits;

class HomeController extends Controller
{
    use Traits;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        echo $this->sampleTraits();
        echo sample();
        return view('home');
    }
}
