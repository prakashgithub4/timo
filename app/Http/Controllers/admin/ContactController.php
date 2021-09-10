<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ContactRepository;
use App\Traits\ImageTraits;
use File;

class ContactController extends Controller
{
    //
    use ImageTraits;

    protected $contact;
    public function __construct(ContactRepository $contact)
    {
        $this->contact = $contact;
        $this->middleware('admin');
    }
    public function index()
    {
        $contact = $this->contact->_getContact();
        return view('admin.contact.contact', compact('contact'));
    }
    public function save(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'logo' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);
        $logo = array();

        if ($request->hasFile('logo')) {
            $contact = $this->contact->_edit($request->id);
            if (\File::exists(public_path('uploads/logo/' . $contact->logo))) {
                \File::delete(public_path('uploads/logo/' . $contact->logo));
            } 
            $logo = $this->Uploadfile($request->file('logo'), 'uploads/logo');
        }
        $input_array = array(
            'title' => $request->title,
            'logo' => $logo,
            'address' => $request->address,
            'twitter' => $request->twitter,
            'facebook' => $request->facebook,
            'google' => $request->google,
            'youtube' => $request->youtube
        );
        //  }
        $this->contact->_update($request->id, $input_array);
        return redirect()->back()->with('success', 'Success fully updated contact us');
    }
}
