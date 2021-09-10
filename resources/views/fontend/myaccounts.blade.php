 @extends('layouts.app')
 @section('title')
 My Profile
 @endsection 
 @section('content')

 <!--breadcrumbs area start-->
         <div class="breadcrumbs_area">
            <div class="container">
               <div class="row">
                  <div class="col-12">
                     <div class="breadcrumb_content">
                        <h3>My account</h3>
                        <ul>
                           <li><a href="{{url('/')}}">home</a></li>
                           <li>></li>
                           <li>My account</li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!--breadcrumbs area end-->
         <!-- my account start  -->
         <section class="main_content_area">
            <div class="container">
               <div class="account_dashboard">
                  <div class="row">
                     <div class="col-sm-12 col-md-3 col-lg-3">
                        <!-- Nav tabs -->
                        <div class="dashboard_tab_button">
                           <ul role="tablist" class="nav flex-column dashboard-list">
                              <li><a href="{{route('user.account','settings')}}"  class="nav-link {{($slug == 'settings')? 'active':''}}"><i class="fa fa-cog" aria-hidden="true"></i> Account Settings</a></li>

                              <li><a href="{{route('user.account','change_password')}}"  class="nav-link {{($slug == 'change_password')? 'active':''}}"><i class="fa fa-cog" aria-hidden="true"></i> Change Password</a></li>
                              <li> <a href="{{route('user.account','order')}}"  class="nav-link {{($slug == 'order')? 'active':''}}"><i class="fa fa-truck" aria-hidden="true"></i> Orders</a></li>
                              <li><a href="{{route('user.account','returns')}}"  class="nav-link {{($slug == 'returns')? 'active':''}}"><i class="fa fa-history" aria-hidden="true"></i> Returns</a></li>
                              <li><a href="{{route('wishlist')}}" target="_blank" ><i class="fa fa-heart" aria-hidden="true"></i> Wish List</a></li>
                              <li><a href="{{route('user.account','address')}}"  class="nav-link {{($slug == 'address')? 'active':''}}"><i class="fa fa-book" aria-hidden="true"></i> Address Book</a></li>
                              <li><a href="{{route('user.account','credit-card')}}"  class="nav-link {{($slug == 'credit-card')? 'active':''}}"><i class="fa fa-credit-card" aria-hidden="true"></i> Credit Card </a></li>
                              <li><a href="{{route('user.logout')}}" class="nav-link"><i class="fa fa-sign-out" aria-hidden="true"></i>  Sign Out</a></li>
                           </ul>
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-9 col-lg-9">
                        <!-- Tab panes -->
                        <div class="tab-content dashboard_content">
                           <div class="tab-pane fade show {{($slug == 'settings')? 'show active':''}}" id="account">
                              <h3 class="mb-4">Account Settings</h3>
                              <div class="login">
                                 <div class="login_form_container">
                                    <div class="account_login_form">
                                       <fieldset>
                                          <legend>Edit Name</legend>
                                          <form id="profile" method = "POST" action="{{route('account.update')}}">
                                             @csrf
                                             <label>First Name <span>*</span></label>
                                             <input type="text" name="first_name" value="{{isset($profile) ?$profile->first_name :''}}" required>
                                             <label>Last Name <span>*</span></label>
                                             <input type="text" name="last_name" value="{{isset($profile) ? $profile->last_name: ''}}" required>
                                             <label>Email <span>*</span></label>
                                             <input type="email" name="email" id="email" value="{{isset($user) ? $user->email : ''}}" required>
                                             <label>Confirm Email <span>*</span></label>
                                             <input type="email" name="email_confirmation" id="confirm_mail" required>
                                             <div class="save_button primary_btn default_button">
                                                <input type="submit"  value="save changes" class="button">
                                             </div>
                                          </form>
                                       </fieldset>
                                    </div>
                                    <!-- <div class="account_login_form">
                                       <fieldset>
                                          <legend>Password change</legend>
                                          <form  id="changepassword" method="POST" action="{{route('account.changepassword')}}">
                                             @csrf
                                             <label>Current password (leave blank to leave unchanged) <span>*</span></label>
                                             <input type="password" name="current_password" required/>
                                             <label>New password (leave blank to leave unchanged) <span>*</span></label>
                                             <input type="password" name="password" id="password" required/>
                                             <label>Confirm new password</label>
                                             <input type="password" name="password_confirmation" required/>
                                             <div class="save_button primary_btn default_button">
                                                <input type="submit" name="" value="save changes" class="button">
                                             </div>
                                          </form>
                                       </fieldset>
                                    </div> -->
                                 </div>
                              </div>
                           </div>

                            <div class="tab-pane fade show {{($slug == 'change_password')? 'show active':''}}" id="change_password">
                              <h3 class="mb-4">Change Password</h3>
                              <div class="login">
                                 <div class="login_form_container">
                                    
                                    <div class="account_login_form">
                                       <fieldset>
                                          <legend>Password change</legend>
                                          <form  id="changepassword" method="POST" action="{{route('account.changepassword')}}">
                                             @csrf
                                             <label>Current password (leave blank to leave unchanged) <span>*</span></label>
                                             <input type="password" name="current_password" required/>
                                             <label>New password (leave blank to leave unchanged) <span>*</span></label>
                                             <input type="password" name="password" id="password" required/>
                                             <label>Confirm new password</label>
                                             <input type="password" name="password_confirmation" required/>
                                             <div class="save_button primary_btn default_button">
                                                <input type="submit" name="" value="save changes" class="button">
                                             </div>
                                          </form>
                                       </fieldset>
                                    </div>
                                 </div>
                              </div>
                           </div>

                           <div class="tab-pane fade {{($slug == 'order')? 'show active':''}}" id="orders">
                              <h3>Orders</h3>
                              <h4 class="order-cl">You haven't placed an order with this account yet. For help, please call us at <a href="tel:1-800-242-2728">1-800-242-2728</a>. <a href="#">Start Shopping now</a></h4>
                              <div class="table-responsive">
                                 <table class="table">
                                    <thead>
                                       <tr>
                                          <th>Order</th>
                                          <th>Date</th>
                                          <th>Status</th>
                                          <th>Total</th>
                                          <th>Actions</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr>
                                          <td>1</td>
                                          <td>May 10, 2018</td>
                                          <td><span class="success">Completed</span></td>
                                          <td>$25.00 for 1 item </td>
                                          <td><a href="cart.html" class="view">view</a></td>
                                       </tr>
                                       <tr>
                                          <td>2</td>
                                          <td>May 10, 2018</td>
                                          <td>Processing</td>
                                          <td>$17.00 for 1 item </td>
                                          <td><a href="cart.html" class="view">view</a></td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                           <div class="tab-pane fade {{($slug == 'returns')? 'show active':''}}" id="returns">
                              <h3>Returns</h3>
                              <p>Online returns currently in progress:</p>
                              <p>You do not currently have any active online returns.</p>
                              <h3>Return History</h3>
                              <p>There are no online returns for this account. For help, please call us at 1-800-242-2728</p>
                              <div class="text">
                                 <h3 class="ecomm-title-t3">Need Help?</h3>
                                 <p class="darker">For items that do not meet these online return requirements, please call us to discuss a return.</p>
                               </div>
                               <div class="links">
                                 <div class="link-wrapper">
                                     <a href="tel:1-800-242-2728" aria-label="Telephone Number 1-800-242-2728"><span aria-hidden="true"><i class="icon-phone"></i></span><span>1-800-242-2728</span></a>
                                     <a href="mailto:service@bluenile.com" data-email-address="service@bluenile.com"><span aria-hidden="true"><i class="icon-envelope-filled"></i></span><span>Email Us</span></a>
                                 </div>
                               </div>
                           </div>
                           <div class="tab-pane fade {{($slug == 'address')? 'show active':''}}" id="account-details">
                              <h3 class="mb-2">Address Book</h3>
                              <p>Save billing and shipping addresses for quick and easy checkout every time you place an order.</p>
                              <div class="login">
                                 <div class="login_form_container">
                                    <div class="account_login_form mt-3">
                                       <fieldset>
                                          <legend>Enter New Address</legend>
                                          <form action="{{route('account.address.save')}}" method="POST" id="addressform">
                                             @csrf
                                             <label>First Name <span>*</span></label>
                                             <input type="text" name="first_name" required/>
                                             <label>Last Name <span>*</span></label>
                                             <input type="text" name="last_name" required/>
                                             <label>Company</label>
                                             <input type="text" name="company">
                                             <label>Address <span>*</span></label>
                                             <input type="text" name="address" required>
                                             <label>City <span>*</span></label>
                                             <input type="text" name="city" required>
                                             <label>Country <span>*</span></label>
                                             <select name="country" id="state-id-select" class="bn-select state-control state-select required" data-field-name="state" required placeholder="State" style="display: inline-block;" onchange="getState(this.value)">
                                                <option value=''>--</option>
                                                @foreach($country as $countries)
                                                <option value="{{$countries->id}}">{{$countries->sortname}} -- {{$countries->name}}</option>
                                                @endforeach
                                             </select>
                                             <label>State <span>*</span></label>
                                             <select name="state" id="state" class="bn-select state-control state-select required" data-field-name="state"  placeholder="State" style="display: inline-block;" required>
                                                <option value=''>--</option>
                                             </select>
                                             <label>Zip Code <span>*</span></label>
                                             <input type="text" name="zipcode" required/>
                                            <!--  <label>State <span>*</span></label>
                                             <select name="state-select" id="state-id-select" class="bn-select state-control state-select required" data-field-name="state" required="required" placeholder="State" style="display: inline-block;">
                                                <option>--</option>
                                                <option value="AA">AA -- APO/FPO Americas</option>
                                                <option value="AE">AE -- APO/FPO Europe</option>
                                                <option value="AK">AK -- Alaska</option>
                                                <option value="AL">AL -- Alabama</option>
                                                <option value="AP">AP -- APO/FPO Pacific</option>
                                                <option value="AR">AR -- Arkansas</option>
                                                <option value="AZ">AZ -- Arizona</option>
                                                <option value="CA">CA -- California</option>
                                                <option value="CO">CO -- Colorado</option>
                                                <option value="CT">CT -- Connecticut</option>
                                                <option value="DC">DC -- District of Columbia</option>
                                                <option value="DE">DE -- Delaware</option>
                                                <option value="FL">FL -- Florida</option>
                                                <option value="GA">GA -- Georgia</option>
                                                <option value="HI">HI -- Hawaii</option>
                                                <option value="IA">IA -- Iowa</option>
                                                <option value="ID">ID -- Idaho</option>
                                                <option value="IL">IL -- Illinois</option>
                                                <option value="IN">IN -- Indiana</option>
                                                <option value="KS">KS -- Kansas</option>
                                                <option value="KY">KY -- Kentucky</option>
                                                <option value="LA">LA -- Louisiana</option>
                                                <option value="MA">MA -- Massachusetts</option>
                                                <option value="MD">MD -- Maryland</option>
                                                <option value="ME">ME -- Maine</option>
                                                <option value="MI">MI -- Michigan</option>
                                                <option value="MN">MN -- Minnesota</option>
                                                <option value="MO">MO -- Missouri</option>
                                                <option value="MS">MS -- Mississippi</option>
                                                <option value="MT">MT -- Montana</option>
                                                <option value="NC">NC -- North Carolina</option>
                                                <option value="ND">ND -- North Dakota</option>
                                                <option value="NE">NE -- Nebraska</option>
                                                <option value="NH">NH -- New Hampshire</option>
                                                <option value="NJ">NJ -- New Jersey</option>
                                                <option value="NM">NM -- New Mexico</option>
                                                <option value="NV">NV -- Nevada</option>
                                                <option value="NY">NY -- New York</option>
                                                <option value="OH">OH -- Ohio</option>
                                                <option value="OK">OK -- Oklahoma</option>
                                                <option value="OR">OR -- Oregon</option>
                                                <option value="PA">PA -- Pennsylvania</option>
                                                <option value="RI">RI -- Rhode Island</option>
                                                <option value="SC">SC -- South Carolina</option>
                                                <option value="SD">SD -- South Dakota</option>
                                                <option value="TN">TN -- Tennessee</option>
                                                <option value="TX">TX -- Texas</option>
                                                <option value="UT">UT -- Utah</option>
                                                <option value="VA">VA -- Virginia</option>
                                                <option value="VT">VT -- Vermont</option>
                                                <option value="WA">WA -- Washington</option>
                                                <option value="WI">WI -- Wisconsin</option>
                                                <option value="WV">WV -- West Virginia</option>
                                                <option value="WY">WY -- Wyoming</option>
                                             </select> -->
                                             <label>Phone Number <span>*</span></label>
                                             <input type="text" name="phono" required/>
                                             <label>Address Type <span>*</span></label>
                                             <div class="input-radio">
                                                <span class="custom-radio"><input type="radio" value="Home" name="type"> Home</span>
                                                <span class="custom-radio"><input type="radio" value="Business" name="type"> Business</span>
                                             </div>
                                             <label>Default Settings</label><br>
                                             <span class="custom_checkbox">
                                             <input type="checkbox" value="1" name="shipping">
                                             <label>Make this my default shipping address</label>
                                             </span>
                                             <br>
                                             <span class="custom_checkbox">
                                             <input type="checkbox" value="1" name="default_billing">
                                             <label>Make this my default billing address</label>
                                             </span>
                                             <div class="save_button primary_btn default_button">
                                                <input type="submit"  value="save changes" class="button">
                                             </div>
                                          </form>
                                       </fieldset>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="tab-pane fade {{($slug == 'credit-card')? 'show active':''}}" id="creditcard">
                              <h3>Credit Card</h3>
                              <p>The Blue Nile Credit Card provides exclusive financing offers, giving you the flexibility to pay over time.See Disclaimer #1* Benefits of the card include convenient payment options, no annual feeSee Disclaimer #2**, and special access to card member-only offers and promotions.</p>
                              <h3>Card members Enjoy:</h3>
                              <ul class="benefits-list-container">
                                 <li><span>No annual fee<a href="#disclaimer2" data-link-type="disclaimer" aria-describedby="disclaimers-label" id="disclaimer2-2"><span class="screen-reader-only">See Disclaimer #2</span><span aria-hidden="true">**</span></a>
                       </span></li>
                                 <li><span>Convenient online account management</span></li>
                                 <li><span>Special access to card member-only offers and promotions</span></li>
                                 <li><span>Exclusive financing offers giving you the flexibility to pay over time<a href="#disclaimer1" data-link-type="disclaimer" aria-describedby="disclaimers-label" id="disclaimer1-2"><span class="screen-reader-only">See Disclaimer #1</span><span aria-hidden="true">*</span></a>
                       </span></li>
                               </ul>
                               <p>*Promotional financing available with Blue Nile Credit Card Accounts offered by Comenity Capital Bank, which determines qualifications for credit and promotion eligibility. Minimum purchase and minimum monthly payments are required. </p>
                               <p>**Standard purchase variable APR of 28.99%, based on the Prime Rate. Minimum Interest charge is $2.00 per credit plan.</p>
                               <p>Blue Nile credit card accounts are issued by Comenity Capital Bank.
                                 A Blue Nile Credit Card and diamond engagement ring leaning against a gift box.
                                 </p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         @endsection
         @section('script')
         <script>
            async function getState(value)
            {
               let html = '';
               try{
                   let url = "{{url('country/getstate')}}/"+value;
                  const result = await $.ajax({
                    url: url,
                    type: 'get',  
                });
                  html += `<option value=''>--</option>`;
                  $.each(result.data,function(index,item){
                     html += '<option value='+item['id']+'>'+item['name']+'</option>';
                  });
                $("#state").html(html);

               }
               catch(error)
               {
                  console.log(error)
               }
              
            }
         </script>
         <script>

    $(document).ready(function() {
        $("#profile").validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                    maxlength: 50
                },
               confirm_mail:{
                  equalTo: "#email"
               }
               
              
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
               
            },
            submitHandler: function(form)
             {
                $.ajax({
                      type: form.method,
                      data: $(form).serialize(),
                      url: form.action,
                      success: function(response) 
                      {
                        if(response.stat == true)
                        {
                          // $("#email").val('');
                           $("#confirm_mail").val('');
                            $.toast({
                              heading: 'success',
                              text: response.message,
                              icon: 'success',
                              position: 'top-right'
                          });
                        }
                        else
                        {
                         $.toast({
                                 heading: 'warning',
                                 text: response.message,
                                 icon: 'warning',
                                 position: 'top-right'
                             });
                        }
                      }

                      });
              }
        });

        /* Chhange Password*/
         $("#changepassword").validate({
            rules: {
               password:{
                  required:true,
               },
               password_confirmation:{
                  required:true,
                  equalTo: "#password"

               }
               
              
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
               
            },
            submitHandler: function(form)
             {
               
                $.ajax({
                      type: form.method,
                      data: $(form).serialize(),
                      url: form.action,
                      success: function(response) 
                      {
                        console.log(response);
                        if(response.stat == true)
                        {
                            $.toast({
                              heading: 'success',
                              text: response.message,
                              icon: 'success',
                              position: 'top-right'
                          });
                            $(form)[0].reset()
                        }
                        else
                        {
                         $.toast({
                                 heading: 'warning',
                                 text: response.message,
                                 icon: 'warning',
                                 position: 'top-right'
                             });
                        }
                       }

                      });
              }
        });

            $("#addressform").validate({
            rules: {
               password:{
                  required:true,
               },
               password_confirmation:{
                  required:true,
                  equalTo: "#password"

               }
               
              
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
               
            },
            submitHandler: function(form)
             {
               
                $.ajax({
                      type: form.method,
                      data: $(form).serialize(),
                      url: form.action,
                      success: function(response) 
                      {
                          if(response['stat'] == true)
                          {
                              $.toast({
                                 heading: 'success',
                                 text: response.message,
                                 icon: 'success',
                                 position: 'top-right'
                             });
                               $(form)[0].reset()
                          }
                          else
                          {
                             $.toast({
                                 heading: 'warning',
                                 text: response.message,
                                 icon: 'warning',
                                 position: 'top-right'
                             });
                          }
                      
                       }

                      });
              }
        });

    });



</script>
@endsection