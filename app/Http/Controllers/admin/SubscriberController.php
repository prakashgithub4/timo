<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\SubscriberRepository;

class SubscriberController extends Controller
{
    //
    public $subscriber = null;
    public function __construct(SubscriberRepository $subscriber)
    {
        $this->subscriber = $subscriber;
    }
    public function index()
    {   
        $subscriber = $this->subscriber->_getsubscriber();
        return view('admin.subscribers.subscribers',compact('subscriber'));
    }
    public function edit($id)
    {
        $subscriber = $this->subscriber->_edit($id);
        return view('admin.subscribers.add',compact('subscriber'));
    }
    public function save(Request $request)
    {
        $id = $request->id;
        $this->subscriber->_update($id,['link'=>$request->link]);
        return redirect()->route('admin.subscribers');
    }
}
