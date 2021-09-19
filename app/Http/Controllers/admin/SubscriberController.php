<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\SubscriberRepository;
use Mail;
use Illuminate\Support\Str;
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

    public function share($id)
    {
            $token = Str::random(64);
            $subscriber = $this->subscriber->_edit($id);
            $data = ['token' => $token,'name' => $subscriber->email,'body' => $subscriber->link];
            \Mail::send('admin.subscribers.offers', $data, function($message) use($subscriber){
                $message->to($subscriber->email);
                $message->subject('Offers !!');
               // $message->body($subscriber->link);
            });
            return redirect()->route('admin.subscribers')->with('success', 'Mail has been sent successfully');
    }

    public function shareAll(Request $request)
    {
        $ids = explode(",",$request->ids);
        foreach ($ids as $id) 
		{
			$token = Str::random(64);
            $subscriber = $this->subscriber->_edit($id);
            $data = ['token' => $token,'name' => $subscriber->email,'body' => $subscriber->link];
            \Mail::send('admin.subscribers.offers', $data, function($message) use($subscriber){
                $message->to($subscriber->email);
                $message->subject('Offers !!');
               // $message->body($subscriber->link);
            });
		}
        return response()->json(['success'=>"Mail has been sent successfully."]);
    }
}
