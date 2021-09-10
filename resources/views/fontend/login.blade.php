@extends('layouts.app')
@section('title')
Login
@endsection
@section('content')
<div class="signup_section">
    <div class="container">   
        <div class="row">
            <div class="col-md-5">
                <div class="signUp_block">
                    <div class="signUp_frame">
                        <form method="POST" action ="{{route('user.loggedin')}}" id="login">
                          @csrf
                            <div class="sign_top">
                                <h3>Sign In</h3>
                                <label>Already have an account? Please sign in.</label>
                               
                            </div>
                            @if ($message = Session::get('error'))
                            <label>{{ $message }}</label>
                            @endif
                            <div class="main_form d-flex flex-column align-items-center">
                                <div class="form-group w-100 email_blk">
                                <!-- <label for="exampleInputEmail1">Email address</label> -->
                                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter Email" required>
                                @error('email')
                                <span  role="alert">
                                  <label>{{ $message }}</label>
                                </span>
                                @enderror
                                </div>
                                <div class="form-group mt-4 w-100 password_blk">
                                <!-- <label for="exampleInputPassword1">Password</label> -->
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required>
                                @error('password')
                                <span  role="alert">
                                  <label>{{ $message }}</label>
                                </span>
                                @enderror
                                <small id="emailHelp" class="form-text text-muted">Passwords are case sensitive</small>
                                </div>
                                <div class="form-group form-check mt-3 pl-0 w-100">
                                <a class="forgotPass" href="{{route('user.forget')}}">Forgot Password</a>
                                </div>
                                <button type="submit" class="btn btn-primary w-50 mt-5">Sign In</button>
                                <a class="new_account" href="{{route('user.create')}}">Create New Account</a>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
            <div class="col-md-7 text-right">
                <div class="image_blk">
                    <!-- <img src="assets/img/background/ring_log.png"> -->
                    <div class="sign_topsec text-left">
                        <h3>Create Your Account</h3>
                        <label>Enjoy additional benefits when you become a Blue Nile member</label>
                    </div>
                    <div class="benefits-wrap">
                        <h3 class="h4">Benefits of becoming a Member:</h3>
                        <ul>
                          <li class="benefits">
                            <div class="flex-wrap-item">
                              <i class="fa fa-undo" aria-hidden="true"></i>
                              <div class="detail">Easy access to order history, saved items, and more</div>
                            </div>
                          </li>
                          <li class="benefits">
                            <div class="flex-wrap-item">
                             <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                              <div class="detail">Faster checkout with stored shipping and billing information</div>
                            </div>
                          </li>
                          <li class="benefits">
                            <div class="flex-wrap-item">
                            <i class="fa fa-gift" aria-hidden="true"></i>
                              <div class="detail">Exclusive offers, discounts, and shipping upgrades</div>
                            </div>
                          </li>
                        </ul>
                         <a class="btn btn-primary mt-4" href="{{route('user.create')}}">Create New Account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection    
@section('script')
<script>
  $(document).ready(function() {
      $("#login").validate({
          rules: {
              email: {
                  required: true,
                  email: true,
                  maxlength: 50
              },
             
              password: {
                  required: true,
                  minlength: 5
              },
            
          },
          messages: {
              
              email: {
                  required: "Email is required",
                  email: "Email must be a valid email address",
                  maxlength: "Email cannot be more than 50 characters",
              },
             
              password: {
                  required: "Password is required",
                  minlength: "Password must be at least 6 characters"
              }
             
             
          }
      });
  });
</script>
@endsection