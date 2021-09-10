<?php

namespace App\Http\Controllers\fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Repositories\UserRepository;
use App\Mail\Verify;
use App\Mail\Registered;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Passwordreset;
use Carbon\Carbon; 
use Illuminate\Support\Facades\DB;
use Mail;
use Auth;

class AuthController extends Controller
{
    public $user;
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }
    public function register()
    {
        return view('fontend.register');
    }
    public function varify()
    {
        return view('fontend.verify');
    }
    public function save(Request $request)
    {
        try {
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ]);
            $form_data = array(
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'user_type' => 'customer'
            );
            $this->user->_add($form_data);
            $genarate_code = rand(10000, 99999);
            session(['email' => $request->email]);
            \Mail::to($request->email)->send(new Verify($genarate_code));
            \App\Models\Varification::create(['code' => $genarate_code, 'valid' => date('h:m:s')]);
            return redirect()->route('varify')->with('success', 'Mail has been send successfully');
        } catch (\Exception $ex) {
            return redirect()->route('user.create')->with('fail', $ex->getMessage());
        }
    }
    public function getcheck(Request $request)
    {
        $code = $request->code;

        $verify = \App\Models\Varification::where('code', $code)->first();

        if (@$verify->code == $code) {
            return  "1";
        } else {
            return "0";
        }
    }
    public function varified()
    {
        $email = session('email');
        \Mail::to($email)->send(new Registered());
        $user = \App\Models\User::where('user_type', 'customer')->where('email', $email)->first();
        \Auth::login($user);
        $user = \App\Models\User::where('email',$email)->first();
        $user->email_verified_at = date('Y-m-d h:m:s');
        $user->save();
        return redirect()->route('user.thankyou');
    }
    public function thankyou()
    {
        $userId = \Auth::user()->id;
        $profile = \App\Models\Profile::where('user_id',$userId)->first();
        return view('fontend.thankyou',compact('profile'));
    }
    public function login()
    {
        return view('fontend.login');
    }
    public function logout()
    {
        \Auth::logout();
        return redirect('/');
    }
    public function loggedin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]); 
        $user = \App\Models\User::where('email',$request->email)->first();
        if(!empty($user))
        {
            if($user->email_verified_at == null)
            {
                return redirect()->route('user.login')->with('error','Email is not varified please verify'); 
            }
            if(\Auth::attempt(['email' => $request->email, 'password' => $request->password,'user_type'=>'customer']))
            {
                return redirect()->route('home');
            }
            else
            {
                return redirect()->route('user.login')->with('error','Invalid email or password');
            }
        }
        else
        {
             return redirect()->route('user.login')->with('error','Invalid email or password');
        }
       
    }

    function forgetpassword()
    {
        return view('fontend.forgetpassword');
    }
    public function sendresetlink(Request $request)
    {
        if($request->email == '')
        {
           return response()->json(['stat'=>false,'message'=>'email adderess field is required']);
        }
        else
        {
            $user = User::where('email',$request->email)->where('user_type','customer')->count();
            if($user > 0)
            {
                $token = Str::random(64);
                $reset = new Passwordreset();
                $reset->email = $request->email;
                $reset->token = $token;
                $reset->created_at = Carbon::now();
                $reset->save();
                \Mail::send('fontend.emails.resetlink', ['token' => $token], function($message) use($request){
                    $message->to($request->email);
                    $message->subject('Reset Password');
                });
                return response()->json(['stat'=>true,'message'=>'We have e-mailed your password reset link!']);
            }
            else
            {
                return response()->json(['stat'=>false,'message'=>'Given email id is not available in our database']);
            }
        }
       
    }
    public function change_password($token)
    {
        $password_reset = Passwordreset::where('token',$token)->first();
        if(empty($password_reset))
        {
            return abort(404);
        }
        else
        {
            return view('fontend.changepassword',compact('token'));
        }
       
    }
    public function upadatepassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);
        $updatePassword = DB::table('password_resets')
                            ->where([
                              'email' => $request->email, 
                              'token' => $request->token
                            ])
                            ->first();

        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        } else {
            $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);
            DB::table('password_resets')->where(['email'=> $request->email])->delete();
            return redirect()->route('user.login')->with('success', 'Your password has been changed!');
        }

      
    }
}
