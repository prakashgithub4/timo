@extends('layouts.app')
@section('title')
    Forget Password
@endsection
@section('content')
    <div class="signup_section">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="signUp_block">
                        <div class="signUp_frame">
                            <form action="{{ route('user.resetlink') }}" method="POST" id="forgetpassword">
                                @csrf
                                <div class="sign_top">
                                     <span  style="color:white"></span>
                                    <h3><img class="key"
                                            src="{{ asset('assets/fontend/img/icon/lock.png') }}">Account Assistance</h3>
                                    <label class="sign_label">To receive information about how to reset your password,
                                        enter the email address you used to create your account.</label>
                                </div>
                                <div class="main_form d-flex flex-column align-items-center">
                                    <div class="form-group w-100 email_blk">
                                        <!-- <label for="exampleInputEmail1">Email address</label> -->
                                        <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" placeholder="Enter Your Email">

                                    </div>

                                    <button type="submit" class="btn btn-primary w-50 mt-5">Submit</button>
                                    <!-- <a class="new_account" href="#">Create New Account</a> -->
                                    
                                </div>

                            </form>
                        </div>

                    </div>

                </div>
                <div class="col-md-7 text-right">
                    <div class="image_blk">
                        <!-- <img src="assets/img/background/ring_log.png"> -->
                        <div class="sign_topsec text-left">
                            <h3>Need to Create Your Account?</h3>
                            <label class="create_label">If you are unable to access your email address <br> or if you do
                                not have an email address associated with a Blue Nile account,<br> please create a new
                                account.</label>
                        </div>
                        <div class="benefits-wrap">
                            <!-- <h3 class="h4">Benefits of becoming a Member:</h3>
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
                            </ul> -->
                            <a class="btn btn-primary mt-4" href="{{ route('user.create') }}">Create New Account</a>
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
          
            $("#forgetpassword").validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                        maxlength: 50
                    },


                },
                messages: {

                    email: {
                        required: "Email is required",
                        email: "Email must be a valid email address",
                        maxlength: "Email cannot be more than 50 characters",
                    }

                },
                submitHandler: function(form) {
                    //form.submit();
                    $.ajax({
                type: form.method,
                data: $(form).serializeArray(),
                url: form.action,
                success: function(response) {
                  
                  $("span").html(response.message);
                   
                    
                }
            });
                }
            });
        });
    </script>
@endsection
