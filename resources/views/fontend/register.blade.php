@extends('layouts.app')
@section('title')
Register
@endsection
@section('content')
    <div class="signup_section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="progress_blk">
                        <div class="progess_line">
                            <div class="step_group">
                                <div class="steps active"></div>
                                <div class="steps"></div>
                                <div class="steps"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-5">
                    <div class="signUp_block">
                        <div class="signUp_frame">
                            <form method="post" action="{{route('registered.user')}}" id="regForm">
                                @csrf
                                <div class="sign_top">
                                    <h3>Create Your Account</h3>
                                    <label>Enter Your email ID and Password to set up your Account.</label>
                                    @if(Session::has('fail'))
		                             <small>  {{ Session::get('fail') }}</small>
	                                @endif
                                </div>
                                <div class="main_form d-flex flex-column align-items-center">
                                    <div class="form-group w-100 email_blk">
                                        <!-- <label for="exampleInputEmail1">Email address</label> -->
                                        <input type="email" name="email" class="form-control" id="email"
                                            aria-describedby="emailHelp" placeholder="Enter Email" required>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                    </div>
                                    <div class="form-group mt-4 w-100 password_blk">
                                        <!-- <label for="exampleInputPassword1">Password</label> -->
                                        <input type="password" name="password" class="form-control" id="password"
                                            placeholder="Enter Password" onkeyup="passwordlength(this.value)">
                                        <small id="emailHelp" class="form-text text-muted">Password must be at least 6
                                            characters long.</small>
                                         @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <span class="float-right strength">
                                            <div style="display:none" class="weak"></div>
                                            <div style="display:none" class="avg"></div>
                                            <div style="display:none" class="good"></div>
                                        </span>
                                    </div>
                                    <div class="form-group mt-4 w-100 password_blk">
                                        <!-- <label for="exampleInputPassword1">Password</label> -->
                                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                                            placeholder="Confirm Password">
                                           
                                        <!-- <small id="emailHelp" class="form-text text-muted">Passwords are case sensitive</small> -->

                                    </div>
                                    <div class="term_line form-group form-check mt-3 pl-0 w-100">
                                        <p>By creating an account, you agree that your data will be used in accordance with
                                            Blue Nile's <a href="#">Terms and conditions </a> and <a href="#">Privacy
                                                Policy</a>.</p>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-50 mt-5">Create Account</button>
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
                                        <div class="detail">Faster checkout with stored shipping and billing information
                                        </div>
                                    </div>
                                </li>
                                <li class="benefits">
                                    <div class="flex-wrap-item">
                                        <i class="fa fa-gift" aria-hidden="true"></i>
                                        <div class="detail">Exclusive offers, discounts, and shipping upgrades</div>
                                    </div>
                                </li>
                            </ul>
                            <a class="btn btn-primary mt-4" href="#">Create New Account</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
 <script>

        function passwordlength(value) {
            
            var strength = 1;
            var arr = [/.{5,}/, /[a-z]+/, /[0-9]+/, /[A-Z]+/];
            jQuery.map(arr, function(regexp) {
                if (value.match(regexp))
                    strength++;
            });
          
            
           if(strength > 1 && strength <= 2)
           {
            $(".weak").css({'display':'block'})
           }
           else if(strength >= 2 && strength <= 3)
           {
            $(".avg").css({'display':'block'})
           }
           else if(strength >= 5)
           {
            $(".good").css({'display':'block'})
           }
          else if(strength == 1)
          {
            $(".weak").css({'display':'none'})
            $(".avg").css({'display':'none'})
            $(".good").css({'display':'none'})
          }
        }
    </script>
<script>
    $(document).ready(function() {
        $("#regForm").validate({
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
                password_confirmation: {
                    required: true,
                    equalTo: "#password"
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
                },
                password_confirmation: {
                    required:  "Confirm password is required",
                    equalTo: "Password and confirm password should same"
                },
               
            }
        });
    });
</script>

@endsection
