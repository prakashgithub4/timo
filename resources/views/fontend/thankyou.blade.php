@extends('layouts.app')
@section('title')
Thank You
@endsection
@section('content')
 <!--error section area start-->
 <div class="signup_section">
    <div class="container">
       <div class="row">
          <div class="col-12">
             <div class="progress_blk">
                <div class="progess_line">
                   <div class="step_group">
                      <div class="steps"></div>
                      <div class="steps"></div>
                      <div class="steps active"></div>
                   </div>
                </div>
             </div>
          </div>
       </div>
       <div class="row">
          <div class="col-12">
             <div class="thank_you_blk mb-5 mt-5">
                <div class="thank_you">
                   <h2>Thank you</h2>
                   <p>Account has been Created.</p>
                   <p class="mb-4">Please take a moment to tell us a little about  Yourself.</p>
                   <a href="#">Skip this Step</a>
                </div>
             </div>
          </div>
       </div>
       <div class="row">
          <div class="col-md-5">
             <div class="signUp_block">
                <div class="signUp_frame">
                   <form method="post" action="{{route('user.profile')}}">
                     @csrf
                      <div class="sign_top">
                         <h3>More Information</h3>
                         <!-- <label>Enter Your email ID and Password to set up your Account.</label> -->
                         @if ($message = Session::get('success'))
                            <label>{{ $message }}</label>
                        @endif
                      </div>
                      <div class="main_form d-flex flex-column align-items-center">
                         <div class="form-group w-100 email_blk lgusr">
                            <!-- <label for="exampleInputEmail1">Email address</label> -->
                            <input type="text" class="form-control" name="first_name" id="fisrt_name" value="{{(!isset($profile->first_name)) ? '':$profile->first_name}}" placeholder="First Name">
                         </div>
                         <div class="form-group w-100 mt-4 email_blk lgusr">
                            <!-- <label for="exampleInputEmail1">Email address</label> -->
                            <input type="text" class="form-control" name='last_name' id="last_name"  value="{{(empty($profile->last_name))?'':$profile->last_name}}" placeholder="Last Name">
                         </div>
                         <div class="form-group w-100 mt-4 email_blk dtbrt">
                            <label for="dateofbirth">Date Of Birth</label>
                            <input type="date" class="form-control" name='dob' id="dateofbirth" value="{{empty($profile->dob) ? '' : $profile->dob}}" placeholder="Date Of Birth">
                         </div>
                        
                         <div class="form-group w-100 mt-4 email_blk mrtsts">
                            <select class="form-select" name='meritial_status' aria-label="Default select example">
                               <option selected>Marital Status</option>
                               <option {{@$profile->meritial_status == 'married' ?"selected":""}} value="married">Married</option>
                               <option {{@$profile->meritial_status == 'single' ?"selected":""}} value="single">Single</option>
                            </select>
                         </div>
                         <div class="form-group w-100 mt-4 email_blk">
                            <label for="gender" class="gndr">Gender</label>
                            <div class="gender_blk">
                               <label>
                               <input type="radio" name="gender" {{@$profile->gender == 'male' ? "checked":""}} value="male">
                               <span>Male</span>
                               </label>
                               <label>
                               <input type="radio" name="gender" {{@$profile->gender == 'female' ? "checked":""}} value="female">
                               <span>Female</span>
                               </label>
                            </div>
                         </div>
                         <button type="submit" class="btn btn-primary w-50 mt-5">Submit</button>
                      </div>
                   </form>
                </div>
             </div>
          </div>
          <div class="col-md-7 text-right">
             <div class="image_blk">
                <img src="{{asset('assets/fontend/img/background/ring_log.png')}}">
             </div>
          </div>
       </div>
    </div>
 </div>
 <!--error section area end-->
@endsection