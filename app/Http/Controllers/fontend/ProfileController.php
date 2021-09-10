<?php

namespace App\Http\Controllers\fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use Auth;
use Validator;
use Hash;
use App\Models\Country;
use App\Models\State;
use App\Models\Address;


class ProfileController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('customer');
    }
    public function update_profile(Request $request)
    {
        $profile = Profile::where('user_id', \Auth::user()->id)->first();
        if (empty($profile)) {
            Profile::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'dob' => date('Y-m-d', strtotime($request->dob)),
                'meritial_status' => $request->meritial_status,
                'gender' => $request->gender,
                'user_id' => \Auth::user()->id
            ]);
        } else {
            $profile->first_name = $request->first_name;
            $profile->last_name = $request->last_name;
            $profile->dob = $request->dob;
            $profile->meritial_status = $request->meritial_status;
            $profile->gender = $request->gender;
            $profile->user_id = \Auth::user()->id;
            $profile->save();
        }

        return redirect()->route('user.thankyou')->with('success', 'Profile has been updated');
    }
    public function myaccount($slug = null)
    {
       $userdata = Auth::user();
       $profile = Profile::where('user_id',$userdata->id)->first();
       $user = \App\Models\User::find($userdata->id);
       $country = Country::all();
       return view('fontend.myaccounts',compact('profile','user','slug','country'));
    }
    public function getCountry($country_id)
    {
        $state = State::where('country_id',$country_id)->get();
        return response()->json(['stat'=>true,'data'=>$state]);
    }
    public function updateprofile(Request $request)
    {
       $userdata = Auth::user();
       $profile = Profile::where('user_id',$userdata->id)->first();
       $data = $request->all();
       if(empty($profile))
       {
         $validation = Validator::make($data,[
           'first_name' => ['required'],
           'last_name' => ['required'],
           'email'=>['required','email','confirmed'],
           
        ]);
 
       if ($validation->fails()) 
        {
            return response()->json(['stat'=>false,'error'=>$validation->errors()],400);
        }
      
       
        $profileadd = new profile();
        $profileadd->first_name = $request->first_name;
        $profileadd->last_name = $request->last_name;
        $profileadd->user_id = $userdata->id;
        $profileadd->save();
        $user = \App\Models\User::find($userdata->id);
        $user->email = $request->email;
        $user->save();
        return response()->json(['stat'=>true,'message'=>"Profile has been updated successfully",'error'=>[],"data"=>$profileadd]);
       }
       else
       {    
        $profile =  profile::where('user_id',$userdata->id)->first();
        $profile->first_name = $request->first_name;
        $profile->last_name = $request->last_name;
        $profile->user_id = $userdata->id;
        $profile->save();
        $user = \App\Models\User::find($userdata->id);
        $user->email = $request->email;
        $user->save();
        return response()->json(['stat'=>true,'message'=>"Profile has been updated successfully",'error'=>[],"data"=>$profile]);
       }

    }
    public function changepassword(Request $request)
    {
        $userdata = \Auth::user();
        $validation = Validator::make($request->all(),[
           'current_password' => ['required'],
           'password' => ['required','confirmed']
        ]);
 
       if ($validation->fails()) 
        {
            return response()->json(['stat'=>false,'error'=>$validation->errors()],400);
        }
        $user = \App\Models\User::where('id',$userdata->id)->first();
        if (Hash::check($request->current_password, $user->password)) 
        {
            $user->password =Hash::make($request->password);
            $user->save();
            return response()->json(['stat'=>true,'message'=>'New password has been updated successfully']);
        }  
        else 
        {
             return response()->json(['stat'=>false,'message'=>'Current password is not matched']);
        }
    }
    public function saveaddress(Request $request)
    {
         $validation = Validator::make($request->all(),[
           'first_name' => ['required'],
           'last_name' => ['required'],
           'address'=>['required'],
           'city'=>['required'],
           'country'=>['required'],
           'state'=>['required'],
           'zipcode'=>['required'],
           'phono'=>['required'],
           'type'=>['required'],

        ]);
       
       if ($validation->fails()) 
        {
            return response()->json(['stat'=>false,'message'=>'error','error'=>$validation->errors()],400);
        }
        $userdata = \Auth::user();
        $address = new Address();
        $address->first_name = $request->first_name;
        $address->last_name = $request->last_name;
        $address->company = $request->country;
        $address->address = $request->address;
        $address->city = $request->city;
        $address->country_id = $request->country;
        $address->state_id = $request->state;
        $address->zipcode = $request->zipcode;
        $address->phone = $request->phono;
        $address->type = $request->type;
        $address->default_bill = $request->shipping;
        $address->default_shipping = $request->default_billing;
        $address->user_id = $userdata->id;
        $address->save();
        return response()->json(['stat'=>true,'message'=>'Address has been add sucessfully','data'=>$address]);    
    }
}
