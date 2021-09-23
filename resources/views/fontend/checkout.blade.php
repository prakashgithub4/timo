@extends('layouts.app')
@section('title')
  Checkout
@endsection
@section('content')
<div class="breadcrumbs_area">
    <div class="container">   
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <h3>Checkout</h3>
                    <ul>
                        <li><a href="index.html">home</a></li>
                        <li>></li>
                        <li>Checkout</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>         
</div>
<!--breadcrumbs area end-->



<!--Checkout page section-->
<div class="Checkout_section" id="accordion">
   <div class="container"> 
    <form  id="myform" method="post" action="{{ route('purchase.save') }}" enctype="multipart/form-data">
        @csrf
        <div class="checkout_form">
            <div class="row">
                <div class="col-lg-7 col-md-12">
                    <div class="left-part-checkout">
                      
                            <h3>Billing Details</h3>
                            <div class="row">

                                <div class="form-group col-lg-4 mb-20">
                                    <label>First Name <span>*</span></label>
                                    <input type="text" name="first_name" id="first_name" class="form-control" required>   
                                    @error('first_name')
                                        <span>{{ $message }}</span>
                                    @enderror 
                                </div>
                                <div class="form-group col-lg-4 mb-20">
                                    <label>Last Name  <span>*</span></label>
                                    <input type="text" name="last_name" id="last_name" class="form-control" required> 
                                    @error('last_name')
                                        <span>{{ $message }}</span>
                                    @enderror 
                                </div>
                                <div class="col-lg-4 mb-20">
                                    <label>Company Name</label>
                                    <input type="text" name="comapny" id="comapny" class="form-control" >     
                                </div>
                                <div class="form-group col-12 mb-20">
                                    <label for="country">Country <span>*</span></label>
                                    <select class="niceselect_option" name="country" id="country" required> 
                                        <option value="2">India</option>      
                                        <option value="3">Algeria</option> 
                                        <option value="4">Afghanistan</option>    
                                        <option value="5">Ghana</option>    
                                        <option value="6">Albania</option>    
                                        <option value="7">Bahrain</option>    
                                        <option value="8">Colombia</option>    
                                        <option value="9">Dominican Republic</option>   

                                    </select>
                                    @error('country')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-12 mb-20">
                                    <label>Street address  <span>*</span></label>
                                    <input placeholder="House number and street name" type="text" name="address" id="address" required> 
                                    @error('address')
                                        <span>{{ $message }}</span>
                                    @enderror    
                                </div>
                                <div class="col-12 mb-20">
                                    <input placeholder="Apartment, suite, unit etc. (optional)" type="text" name="optional_address" id="optional_address">     
                                </div>
                                <div class="form-group col-lg-6 mb-20">
                                    <label>Town / City <span>*</span></label>
                                    <input  type="text" name="city" id="city" required>    
                                </div> 
                                <div class="form-group col-lg-6 mb-20">
                                    <label>State <span>*</span></label>
                                    <input type="text" name="state" id="state" required> 
                                    @error('city')
                                        <span>{{ $message }}</span>
                                    @enderror   
                                </div> 
                                <div class="form-group col-lg-6 mb-20">
                                    <label>Phone<span>*</span></label>
                                    <input type="text" name="phone" id="phone" required> 
                                    @error('phone')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div> 
                                <div class="col-lg-6 mb-20">
                                    <label> Email Address   <span>*</span></label>
                                    <input type="text" name="email" id="email" required>  

                                </div> 
                                <div class="col-12 mb-20">
                                    <input id="updates" type="checkbox" data-target="upadate_via_sms" />
                                    <label for="updates" data-toggle="collapse" data-target="#collapseOne" aria-controls="collapseOne">Get Shipping updates via text</label>

                                    <div id="collapseOne" class="collapse one" data-parent="#accordion">
                                        <div class="card-body1">
                                        <label>Enter Your Number</label>
                                            <input placeholder="Number" type="number">  
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb-20">
                                    <input id="address" type="checkbox" data-target="createp_account" />
                                    <label class="righ_0" for="address" data-toggle="collapse" data-target="#collapsetwo" aria-controls="collapseOne">Ship to a different address?</label>

                                    <!--<div id="collapsetwo" class="collapse one mt-4" data-parent="#accordion">
                                    <div class="row">
                                            <div class="col-lg-6 mb-20">
                                                <label>First Name <span>*</span></label>
                                                <input type="text">    
                                            </div>
                                            <div class="col-lg-6 mb-20">
                                                <label>Last Name  <span>*</span></label>
                                                <input type="text"> 
                                            </div>
                                            <div class="col-12 mb-20">
                                                <label>Company Name</label>
                                                <input type="text">     
                                            </div>
                                            <div class="col-12 mb-20">
                                                <div class="select_form_select">
                                                    <label for="countru_name">country <span>*</span></label>
                                                    <select class="niceselect_option" name="cuntry" id="countru_name"> 
                                                        <option value="2">bangladesh</option>      
                                                        <option value="3">Algeria</option> 
                                                        <option value="4">Afghanistan</option>    
                                                        <option value="5">Ghana</option>    
                                                        <option value="6">Albania</option>    
                                                        <option value="7">Bahrain</option>    
                                                        <option value="8">Colombia</option>    
                                                        <option value="9">Dominican Republic</option>   

                                                    </select>
                                                </div> 
                                            </div>

                                            <div class="col-12 mb-20">
                                                <label>Street address  <span>*</span></label>
                                                <input placeholder="House number and street name" type="text">     
                                            </div>
                                            <div class="col-12 mb-20">
                                                <input placeholder="Apartment, suite, unit etc. (optional)" type="text">     
                                            </div>
                                            <div class="col-md-6 mb-20">
                                                <label>Town / City <span>*</span></label>
                                                <input  type="text">    
                                            </div> 
                                            <div class="col-md-6 mb-20">
                                                <label>State / County <span>*</span></label>
                                                <input type="text">    
                                            </div> 
                                            <div class="col-md-6 mb-20">
                                                <label>Phone<span>*</span></label>
                                                <input type="text"> 

                                            </div> 
                                            <div class="col-md-6">
                                                <label> Email Address   <span>*</span></label>
                                                <input type="text"> 

                                            </div> 
                                        </div>
                                    </div>-->
                                </div>
                                <div class="col-12">
                                    <div class="form-group order-notes">
                                        <label for="order_note">Order Notes</label>
                                        <textarea id="order_note" placeholder="Notes about your order, e.g. special notes for delivery." name="order_notes" id="order_notes"></textarea>
                                    </div>    
                                </div>     	    	    	    	    	    	    
                            </div>
                           
                    </div>
                </div>
                <div class="col-lg-5 col-md-12">
                    <div class="left-part-checkout">
                        
                            <h3>Your order</h3> 
                            <div class="order_table table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                      
                                        @php $amount = 0; $exp=array(); @endphp
                                        @foreach ($product as $products)

                                        @php $exp[] = $products->CI;
                                         @endphp
                                        <tr>
                                            <td> {{$products->seo_title }}<strong> × {{$products->qty}}</strong></td>
                                            <td> ${{$products->price * $products->qty}}</td>
                                            @php $amount = $amount + $products->price * $products->qty; @endphp
                                        </tr>
                                        @endforeach
                                        @php 
                                            $string = implode(',',$exp);
                                        //echo($string);
                                         @endphp
                                        <input type="hidden" name="cat_id" id="cat_id" value="{{$string}}" ?>

                                        {{-- <tr>
                                            <td>  Handbag  justo	 <strong> × 2</strong></td>
                                            <td> $50.00</td>
                                        </tr>
                                        <tr>
                                            <td>  Handbag elit	<strong> × 2</strong></td>
                                            <td> $50.00</td>
                                        </tr>
                                        <tr>
                                            <td> Handbag Rutrum	 <strong> × 1</strong></td>
                                            <td> $50.00</td>
                                        </tr> --}}
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Cart Subtotal</th>
                                            <td>${{$amount}}</td>
                                        </tr>
                                        {{-- <tr>
                                            <th>Shipping</th>
                                            <td><strong>$5.00</strong></td>
                                        </tr> --}}
                                        <tr class="order_total">
                                            <th>Order Total</th>
                                            <td><strong>${{$amount}} <input type="hidden" name="order_total" id="order_total" value="{{$amount}}" /></strong></td>
                                        </tr>
                                    </tfoot>
                                </table>     
                            </div>
                            <div class="payment_method">
                                <div class="row">
                                    <div class="col-12">
                                        <!-- <div class="user-actions">
                                            <h3> 
                                                <i class="fa fa-file-o" aria-hidden="true"></i>
                                                Returning customer?
                                                <a class="Returning" href="#" data-toggle="collapse" data-target="#checkout_login" aria-expanded="true">Click here to login</a>     
                    
                                            </h3>
                                            <div id="checkout_login" class="collapse" data-parent="#accordion">
                                                <div class="checkout_info">
                                                    <p>If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing & Shipping section.</p>  
                                                    <form action="#">  
                                                        <div class="form_group">
                                                            <label>Username or email <span>*</span></label>
                                                            <input type="text">     
                                                        </div>
                                                        <div class="form_group">
                                                            <label>Password  <span>*</span></label>
                                                            <input type="text">     
                                                        </div> 
                                                        <div class="form_group group_3 ">
                                                            <button type="submit">Login</button>
                                                            <label for="remember_box">
                                                                <input id="remember_box" type="checkbox">
                                                                <span> Remember me </span>
                                                            </label>     
                                                        </div>
                                                        <a href="#">Lost your password?</a>
                                                    </form>          
                                                </div>
                                            </div>    
                                        </div> -->
                                        <div class="user-actions">
                                            <h2>  
                                                <i class="fa fa-file-o" aria-hidden="true"></i> Have a Cupon code ?
                                                <a class="Returning" href="#" data-toggle="collapse" data-target="#checkout_coupon" aria-expanded="true"> Click here to enter your code</a>     
                    
                                            </h2>
                                            <div id="checkout_coupon" class="collapse" data-parent="#accordion">
                                                <div class="checkout_info">
                                                    {{-- <form action="#">
                                                        <input placeholder="Coupon code" type="text" name="coupan_code" id="coupan_code">
                                                        <button type="submit">Apply coupon</button>
                                                    </form> --}}
                                                </div>
                                            </div>    
                                        </div>    
                                    </div>
                                </div>
                            <div class="panel-default">
                                    <input id="payment" name="check_method" type="radio" data-target="createp_account" />
                                    <label for="payment" data-toggle="collapse" data-target="#method" aria-controls="method">COD</label>

                                    <div id="method" class="collapse one" data-parent="#accordion">
                                        <div class="card-body1">
                                        <p>Cash on delivery available</p>
                                        </div>
                                    </div>
                                </div> 
                            <div class="panel-default">
                                    <input id="payment_defult" name="check_method" type="radio" data-target="createp_account" />
                                    <label for="payment_defult" data-toggle="collapse" data-target="#collapsedefult" aria-controls="collapsedefult">PayPal <img src="assets/img/icon/papyel.png" alt=""></label>

                                    <div id="collapsedefult" class="collapse one" data-parent="#accordion">
                                        <div class="card-body1">
                                        <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p> 
                                        </div>
                                    </div>
                                </div>
                                <div class="order_button text-center mt-3">
                                    <button  type="submit">Proceed to PayPal</button> 
                                </div>    
                            </div> 
                       
                    </div>   
                </div>
            </div> 
        </div> 
    </form>      
    </div>       
</div>
@endsection
@section('script')

    <script>
        $(function() {
           
            $('#myform').validate({
                rules: {
                    first_name: {
                        required: true
                    },
                    last_name:{
                        required: true
                    },
                     state:{
                        required: true
                    },
                     country:{
                        required: true
                    },
                    address:{
                        required: true
                    },
                     phone: {
                        required: true
                    },
                    email: {
                        required: true
                    },
                   
                },
                messages: {
                    first_name: {
                        required: "Please enter your Name",
                    },
                    last_name: {
                        required: "Please enter your Name",
                    },
                    state:{
                        required: "Please enter State",
                    },
                    address:{
                        required: "Please enter Address",
                    },
                    country:{
                        required: "Please enter Country",
                    },
                    phone:{
                        required: "Please enter Phone Number",
                    },
                    email:{
                        required: "Please enter Email",
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endsection
