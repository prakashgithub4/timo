@extends('layouts.app')
@section('title')
Product Details
@endsection
@section('content')
<div class="product-dt">
    <div class="breadcrumbs_area">
        <div class="container">   
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="#">Diamonds</a></li>
                            <li>&gt;</li>
                            <li>All Diamonds</li>
                            <li>&gt;</li>
                            <li>{{$product->type}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>         
    </div>
    <div class="product_details">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                <div class="product-details-tab">

                        <div id="img-1" class="zoomWrapper single-zoom">
                            <a href="#">
                                <img id="zoom1" src="{{@$product_image_array[0]['image']}}" data-zoom-image="{{@$product_image_array[0]['image']}}" alt="big-1">
                            </a>
                        </div>

                        


                        <div class="single-zoom-thumb">
                            <ul class="s-tab-zoom owl-carousel single-product-active" id="gallery_01">
                                @if (@count($product_image_array) > 0)
                                @foreach($product_image_array as $item)
                                <li>
                                    <a href="#" class="elevatezoom-gallery active" data-update="" data-image="{{$item['image']}}" data-zoom-image="{{$item['image']}}">
                                        <img src="{{$item['image']}}" alt="zo-th-1"/>
                                    </a>

                                </li>
                                @endforeach
                                @endif
                             
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product_d_right">
                    <form action="#">
                        
                            <h1>{{$product->seo_title}}</h1>
                            <div class="product_ratting">
                                <ul>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"> (customer review ) </a></li>
                                </ul>
                            </div>
                            @php $price = price_rang($product->id); @endphp
                            <div class="product_price">
                                <span class="old_price" id="old">${{number_format($price['old_price'],2)}}</span>
                                <span class="current_price" id="new">${{number_format($price['current_price'],2)}}</span>
                                <input type="hidden" id ="current_price" value="{{$price['current_price']}}"/>
                                <input type="hidden" id ="old_price" value="{{$price['old_price']}}"/>
                            </div>
                            <div class="product_desc">
                                <p>{{$product->seo_description}} </p>
                            </div>

                            <div class="product_variant quantity">
                                <label>quantity</label>
                                <input min="1" max="100" value="1" type="number" onchange="onchangeqty(this.value)">
                                <button class="button" onclick="add_to_cart({{$product->id}})" type="button">add to cart</button>  
                                
                            </div>
                            <div class=" product_d_action">
                            <ul>
                                <li><a href="javascript:addwishlist({{$product->id}})" title="{{($product->product_wish_list_count > 0) ? 'Added to Wishlist':'Add Wishlist'}}">+ Add to Wishlist</a></li>
                                <li><a href="javascript:compair({{$product->id}})" title="{{($product->isCompare > 0) ? 'Compared' :'Compare'}}">+ Compare</a></li>
                            </ul>
                            </div>
                            <div class="product_meta">
                                <span>Category: <a href="javascript:void(0)">{{$product->type}}</a></span>
                            </div>                                
                        </form>
                        <div class="priduct_social">
                            <ul>
                                <li><a href="http://www.facebook.com/sharer.php?u={{route('product',Crypt::encryptString($product->id))}}" title="facebook"><i class="fa fa-facebook"></i></a></li>           
                                <li><a href="#" title="twitter"><i class="fa fa-twitter"></i></a></li>           
                                <li><a href="#" title="pinterest"><i class="fa fa-pinterest"></i></a></li>           
                                <li><a href="#" title="google +"><i class="fa fa-google-plus"></i></a></li>        
                                <li><a href="#" title="linkedin"><i class="fa fa-linkedin"></i></a></li>        
                            </ul>      
                        </div>

                    </div>
                </div>
            </div>
        </div>    
    </div>
    <div class="product_d_info">
        <div class="container">   
            <div class="row">
                <div class="col-8">
                    <div class="product_d_inner">   
                        <div class="product_info_button">    
                            <ul class="nav" role="tablist">
                                <li >
                                    <a class="active" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">Description</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews (1)</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="info" role="tabpanel" >
                                <div class="product_info_content">
                                    {{$product->long_description}}
                                  
                                </div>  
                                <div class="proinfo">
                                    <h3>Diamond Details</h3>
                                    <table class="table table-striped">
                                        <tbody>
                                            @php $flag = 0; @endphp
                                            @foreach ($attribute_array as $key=>$item)
                                            @if(!is_null($item['value']))
                                            <tr>
                                                <th scope="row">{{$key + 1}}</th>
                                                <td>{{$item['name']}}</td>
                                                <td>{{$item['value']}}</td>
                                              </tr>
                                              @else
                                                @php $flag = 1; @endphp
                                              @endif
                                            @endforeach
                                           @if($flag == 1)
                                           <tr>
                                               <td colspan = 3>No attribute</td>
                                           </tr>
                                           @endif
                                           
                                        </tbody>
                                      </table>
                                </div>  
                            </div>

                            <div class="tab-pane fade" id="reviews" role="tabpanel" >
                                <div class="reviews_wrapper">
                                    <h2>1 review for Donec eu furniture</h2>
                                    <div class="reviews_comment_box">
                                        <div class="comment_thmb">
                                            <img src="{{asset('assets/fontend/img/blog/comment2.jpg')}}" alt="">
                                        </div>
                                        <div class="comment_text">
                                            <div class="reviews_meta">
                                                <div class="star_rating">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                                        <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                                        <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                                        <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                                        <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                                    </ul>   
                                                </div>
                                                <p><strong>admin </strong>- September 12, 2018</p>
                                                <span>roadthemes</span>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="comment_title">
                                        <h2>Add a review </h2>
                                        <p>Your email address will not be published.  Required fields are marked </p>
                                    </div>
                                    <div class="product_ratting mb-10">
                                        <h3>Your rating</h3>
                                        <ul>
                                           
                                            <li><a href="javascript:rating(1)" ><i class="fa fa-star"></i></a></li>
                                            <li><a href="javascript:rating(2)" ><i class="fa fa-star"></i></a></li>
                                            <li><a href="javascript:rating(3)" ><i class="fa fa-star"></i></a></li>
                                            <li><a href="javascript:rating(4)" ><i class="fa fa-star"></i></a></li>
                                            <li><a href="javascript:rating(5)" ><i class="fa fa-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_review_form">
                                        <form  method ='POST' action="{{route('product.review')}}" id="review" >
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">
                                                    <label for="review_comment">Your review </label>
                                                    <textarea name="comment" id="review_comment" ></textarea>
                                                    <input type = 'hidden' name ='product_id' value='{{$product->id}}'/>
                                                    <input type="hidden" name="rate" id = 'rate' value='0'/>
                                                </div> 
                                                <div class="col-lg-6 col-md-6">
                                                    <label for="author">Name</label>
                                                    <input id="author" name ='name' type="text" required/>
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div> 
                                                <div class="col-lg-6 col-md-6">
                                                    <label for="email">Email </label>
                                                    <input id="email" name="email" type="text" required/>
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                  @enderror
                                                </div>  
                                            </div>
                                            <button type="submit">Submit</button>
                                            </form>   
                                    </div> 
                                </div>    
                            </div>
                        </div>
                    </div>     
                </div>
                <div class="col-4">
                    <section class="contact-information">
                        <h2 class="headline">Got Questions?</h2>
                        <h3 class="subtitle">Get answers day or night.</h3>
                        <a class="phone-number" aria-label="1-888-565-7641 Phone Number" href="tel:18885657641">1-888-565-7641</a>
                        <div class="contact-links">
                            <a class="right-section" href="mailto:">
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                               <div class="icon-component email " aria-hidden="false">
                               </div>
                               <p>Email Us</p>
                            </a>
                            <a class="center-section" href="#">
                                <i class="fa fa-search" aria-hidden="true"></i>
                               <div class="icon-component appointment " aria-hidden="false">                                     
                               </div>
                               <p>Diamond Search</p>
                            </a>
                        </div>
                    </section>
                    <section class="diamond-upgrade stacked-top">
                        <h2 class="title">Lifetime diamond upgrade program</h2>
                        <p>Receive 100% credit when you return a diamond originally purchased from Blue Nile and apply its cost toward the purchase of any new diamond priced twice as much as the original.</p>
                        <p><a href="#">LEARN MORE</a></p>
                    </section>
                    <div class="financing-options">
                        <h2 class="title">Financing Options</h2>
                        <p>Flexible payment options available with Blue Nile Credit Card.</p>
                        <ul>
                           <li>6-month financing available for orders of $500 or more.</li>
                           <li>12-month financing available for orders of $1,500 or more.</li>
                           <li>48-month financing available for orders of $4,000 or more.</li>
                           <li>More financing options available.</li>
                        </ul>
                        <p><a href="#">LEARN MORE</a></p>
                     </div>
                </div>
            </div>
        </div>    
    </div>  
    <div class="product_section  p_section1 retpro">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2>Related products</h2>
                    </div> 
                </div>  
                <div class="col-12">
                    <div class="product_area ">
                            <div class="product_container bottom">
                            <div class="custom-row product_row1">
                                @if(count($realted_products) > 0)
                                @foreach($realted_products as $key=>$products)
                                @php $price = price_rang($products->id); @endphp
                                <div class="custom-col-5">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="{{route('product',[Crypt::encryptString($products->id)])}}"><img src="{{$products->image_src}}" alt=""></a>
                                            <!-- <a class="secondary_img" href="{{route('product',[Crypt::encryptString($products->id)])}}"><img src="{{(@gallerypicksecond($products->id)->image == null) ? $products->image_src : gallerypicksecond($products->id)->image }}" alt=""></a> -->
                                        </div>
                                        <div class="product_content">
                                            <div class="tag_cate">
                                                <a href="#">{{$products->type}}</a>
                                                {{-- <a href="#">Potato chips</a> --}}
                                            </div>
                                            <h3><a href="{{route('product',[Crypt::encryptString($products->id)])}}">{{$products->seo_title}}</a></h3>
                                            <span class="old_price">${{number_format($price['old_price'],2)}}</span>
                                            <span class="current_price">${{number_format($price['current_price'],2)}}</span>
                                            <div class="product_hover">
                                                <div class="product_ratings">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-ios-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-ios-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-ios-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-ios-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-ios-star-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="product_desc">
                                                    <p>{{ Str::limit($products->seo_description, 50) }} </p>
                                                </div>
                                                <div class="action_links">
                                                    <ul>
                                                        <li><a href="javascript:addwishlist({{$products->id}})"  title="{{($products->product_wish_list_count > 0) ? 'Added to Wishlist':'Add Wishlist'}}" class="{{($products->product_wish_list_count > 0) ? 'added_btn':''}} wish_{{$products->id}}"><span
                                                                    class="icon icon-Heart"></span></a></li>
                                                        <li  class="add_to_cart "><a  class="{{($products->isCart > 0) ? 'added_btn' : ''}} cart_{{$products->id}}" href="javascript:add_to_cart({{$products->id}})"  title="{{($products->isCart > 0) ? 'Go to Cart':'Add to cart'}}">add to 
                                                                cart</a></li>
                                                        <li><a href="javascript:compair({{$products->id}})"  title="{{($products->isCompare > 0) ? 'Compared' :'Compare'}}" class="{{($products->isCompare > 0) ? 'added_btn' :''}} compare_{{$products->id}}"><i
                                                                    class="ion-ios-settings-strong"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>
    <!-- <section class="product_section p_bottom p_section1 pt-5 retpro bg-white">
        <div class="container">
            <div class="row">
               <div class="col-12">
                    <div class="section_title">
                        <h2>Recently Viewed</h2>
                    </div> 
                </div>  
                <div class="col-12">
                    <div class="product_area ">
                         <div class="product_container bottom">
                            <div class="custom-row product_row1">
                                @foreach ($recent_view as $recent_views )
                                @php $price = price_rang($recent_views->id); @endphp
                                <div class="custom-col-5">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="#"><img src="{{$recent_views->image_src}}" alt=""></a>
                                            <a class="secondary_img" href="#"><img src="{{(@gallerypicksecond($recent_views->id)->image == null) ? $recent_views->image_src : gallerypicksecond($recent_views->id)->image }}" alt=""></a>
                                            <div class="quick_button">
                                                <a href="#" data-toggle="modal" data-target="#modal_box" data-placement="top" data-original-title="quick view"> quick view</a>
                                            </div>
                                        </div>
                                        <div class="product_content">
                                            <div class="tag_cate">
                                               
                                                <a href="#">{{$recent_views->tag}}</a>
                                            </div>
                                            <h3><a href="#">{{$recent_views->seo_title}}</a></h3>
                                            <span class="old_price">${{number_format($price['old_price'],2)}}</span>
                                            <span class="current_price">${{number_format($price['current_price'],2)}}</span>
                                            <div class="product_hover">
                                                <div class="product_ratings">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-ios-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-ios-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-ios-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-ios-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-ios-star-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="product_desc">
                                                    <p>{{ Str::limit($recent_views->seo_description, 50) }} </p>
                                                </div>
                                                <div class="action_links">
                                                    <ul>
                                                        <li><a href="javascript:addwishlist({{$recent_views->id}})" id="wish_{{$recent_views->id}}" title="{{($recent_views->product_wish_list_count > 0) ? 'Added to Wishlist':'Add Wishlist'}}" class="{{($recent_views->product_wish_list_count > 0) ? 'added_btn':''}}"><span
                                                                    class="icon icon-Heart"></span></a></li>
                                                        <li  class="add_to_cart "><a  class="{{($recent_views->isCart > 0) ? 'added_btn' : ''}}" href="javascript:add_to_cart({{$recent_views->id}})" id="cart_{{$recent_views->id}}" title="{{($recent_views->isCart > 0) ? 'Go to Cart':'Add to cart'}}">add to 
                                                                cart</a></li>
                                                        <li><a href="javascript:compair({{$recent_views->id}})" id="compare_{{$recent_views->id}}" title="{{($recent_views->isCompare > 0) ? 'Compared' :'Compare'}}" class="{{($recent_views->isCompare > 0) ? 'added_btn' :''}}"><i
                                                                    class="ion-ios-settings-strong"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </section> -->
     @include('parcials.recent')
</div>
@endsection
@section('script')
<script>
  // Wait for the DOM to be ready
$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("#review").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      firstname: "required",
      lastname: "required",
      email: {
        required: true,
        // Specify that email should be validated
        // by the built-in "email" rule
        email: true
      },
      password: {
        required: true,
        minlength: 5
      }
    },
    // Specify validation error messages
    messages: {
        firstname: "Please enter your firstname",
        lastname: "Please enter your lastname",
        password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 5 characters long"
        },
        email: "Please enter a valid email address"
        },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
     // form.submit();
        $.ajax(""+form.action+"", {
        type: 'POST',  // http method
        data: $(form).serializeArray(),  // data to submit
        success: function (data, status, xhr) {
            
            $.toast({
                heading: 'success',
                text: data.message,
                icon: 'success',
                position: 'top-right'
          });
          $(form)[0].reset();
        },
        error: function (jqXhr, textStatus, errorMessage) {
                
        }
      });
    }
   });
});
    function onchangeqty(qty)
    {
        let current = $("#current_price").val();
        let oldprice = $("#old_price").val();
        let current_qty = parseFloat(current) * parseInt(qty);
        let old_qty =  parseFloat(oldprice) * parseInt(qty);
        $("#old").html(`$${old_qty.toFixed(2)}`);
        $("#new").html(`$${current_qty.toFixed(2)}`);
       
    }
    function rating(rate)
    {
        $("#rate").val(rate)
        $.toast({
                heading: 'success',
                text: 'your rating is '+rate,
                icon: 'success',
                position: 'top-right'
        });
    }

</script>
@endsection