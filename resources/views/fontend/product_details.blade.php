@extends('layouts.app');
@section('title')
Product Details
@endsection
@section('content')
  <div class="breadcrumbs_area product_bread">
        <div class="container">   
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="{{url('/')}}">home</a></li>
                            <li>></li>
                            <li><a href="javascript:void(0)">shop</a></li>
                            <li>></li>
                             <li><a href="javascript:void(0)">Clothing</a></li>
                             <li>></li>
                            <li>product details</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>         
    </div>
    <!--breadcrumbs area end-->
    
     <!--product details start-->
    <div class="product_details">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                   <div class="product-details-tab">

                        <div id="img-1" class="zoomWrapper single-zoom">
                            <a href="#">
                                <img id="zoom1" src="{{(empty($product->image_src)) ? asset('assets/fontend/img/product/product3.jpg'): $product->image_src }}" data-zoom-image="{{(empty($product->image_src)) ? asset('assets/fontend/img/product/product3.jpg'): $product->image_src }}" alt="big-1">
                            </a>
                        </div>

                        <div class="single-zoom-thumb">
                            <ul class="s-tab-zoom owl-carousel single-product-active" id="gallery_01">
                                <li>
                                    <a href="#" class="elevatezoom-gallery active" data-update="" data-image="{{(empty($product->image_src)) ? asset('assets/fontend/img/product/product3.jpg'): $product->image_src }}" data-zoom-image="{{(empty($product->image_src)) ? asset('assets/fontend/img/product/product3.jpg'): $product->image_src }}">
                                        <img src="{{(empty($product->image_src)) ? asset('assets/fontend/img/product/product3.jpg'): $product->image_src }}" alt="zo-th-1"/>
                                    </a>

                                </li>
                                <li >
                                    <a href="#" class="elevatezoom-gallery active" data-update="" data-image="{{asset('assets/fontend/img/product/product1-big.jpg')}}" data-zoom-image="{{asset('assets/fontend/img/product/product1-big.jpg')}}">
                                        <img src="{{asset('assets/fontend/img/product/product13.jpg')}}" alt="zo-th-1"/>
                                    </a>

                                </li>
                                <li >
                                    <a href="#" class="elevatezoom-gallery active" data-update="" data-image="{{asset('assets/fontend/img/product/product3-big.jpg')}}" data-zoom-image="assets/img/product/product3-big.jpg')}}">
                                        <img src="{{asset('assets/fontend/img/product/product4.jpg')}}" alt="zo-th-1"/>
                                    </a>

                                </li>
                                <li >
                                    <a href="#" class="elevatezoom-gallery active" data-update="" data-image="assets/img/product/product2-big.jpg" data-zoom-image="{{asset('assets/fontend/img/product/product2-big.jpg')}}">
                                        <img src="{{asset('assets/fontend/img/product/product2.jpg')}}" alt="zo-th-1"/>
                                    </a>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product_d_right">
                       <form action="#">
                           
                            <h1>{{$product->title}}</h1>
                            <div class="product_nav">
                                <ul>
                                    <li class="prev"><a href="#"><i class="fa fa-angle-left"></i></a></li>
                                    <li class="next"><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                </ul>
                            </div>
                            <div class=" product_ratting">
                                <ul>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"> (customer review ) </a></li>
                                </ul>
                            </div>
                            <div class="product_price">
                                <span class="old_price">${!!$product->cost_per_item!!}</span>
                                <span class="current_price">$70.00</span>
                            </div>
                            <div class="product_desc">
                                {!!$product->body!!}
                            </div>

                            <div class="product_variant quantity">
                                <label>quantity</label>
                                <input min="1" max="100" value="1" type="number">
                                {{-- <button class="button" type="submit">add to cart</button>  --}}
                                <a   href="javascript:add_to_cart({{$product->id}})" title="add to cart">
                                    <button class="button" type="button">add to cart</button>
                                </a> 
                                
                            </div>
                            <div class=" product_d_action">
                               <ul>
                                   <li><a href="#" title="Add to wishlist">+ Add to Wishlist</a></li>
                                   <li><a href="#" title="Add to wishlist">+ Compare</a></li>
                               </ul>
                            </div>
                            <div class="product_meta">
                                <span>Category: <a href="#">{!! $product->type!!}</a></span>
                            </div>
                            
                        </form>
                        <div class="priduct_social">

                            {{-- @php echo print_r(URL::current()); @endphp --}}

                            {!! Share::page(URL::current())->facebook()->twitter()->whatsapp() !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>    
    </div>
    <!--product details end-->

        <!--product info start-->
        <div class="product_d_info">
            <div class="container">   
                <div class="row">
                    <div class="col-12">
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
                                        {!! $product-> long_description!!}
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
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product_review_form">
                                            <form action="#">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="review_comment">Your review </label>
                                                        <textarea name="comment" id="review_comment" ></textarea>
                                                    </div> 
                                                    <div class="col-lg-6 col-md-6">
                                                        <label for="author">Name</label>
                                                        <input id="author"  type="text">
    
                                                    </div> 
                                                    <div class="col-lg-6 col-md-6">
                                                        <label for="email">Email </label>
                                                        <input id="email"  type="text">
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
                </div>
            </div>    
        </div>  
        <!--product info end-->
        
        <!--product section area start-->
        <section class="product_section  p_section1">
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
                                    <div class="custom-col-5">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="{{asset('assets/fontend/img/product/product13.jpg')}}" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="{{asset('assets/fontend/img/product/product14.jpg')}}" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" data-toggle="modal" data-target="#modal_box" data-placement="top" data-original-title="quick view"> quick view</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <div class="tag_cate">
                                                    <a href="#">Clothing,</a>
                                                    <a href="#">Potato chips</a>
                                                </div>
                                                <h3><a href="product-details.html">Aliquam furniture</a></h3>
                                                <span class="old_price">$86.00</span>
                                                <span class="current_price">$60.00</span>
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
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere metus vitae </p>
                                                    </div>
                                                    <div class="action_links">
                                                        <ul>
                                                            <li><a href="wishlist.html" data-placement="top" title="Add to Wishlist" data-toggle="tooltip"><span class="icon icon-Heart"></span></a></li>
                                                            <li class="add_to_cart"><a href="cart.html" title="add to cart">add to cart</a></li>
                                                            <li><a href="compare.html" title="compare"><i class="ion-ios-settings-strong"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="custom-col-5">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="{{asset('assets/fontend/img/product/product1.jpg')}}" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="{{asset('assets/fontend/img/product/product2.jpg')}}" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" data-toggle="modal" data-target="#modal_box" data-placement="top" data-original-title="quick view"> quick view</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <div class="tag_cate">
                                                    <a href="#">Clothing,</a>
                                                    <a href="#">Potato chips</a>
                                                </div>
                                                <h3><a href="product-details.html">Dummy animal</a></h3>
                                                <span class="current_price">$65.00</span>
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
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere metus vitae </p>
                                                    </div>
                                                    <div class="action_links">
                                                        <ul>
                                                            <li><a href="wishlist.html" title="Wishlist"><span class="icon icon-Heart"></span></a></li>
                                                            <li class="add_to_cart"><a href="cart.html" title="add to cart">add to cart</a></li>
                                                            <li><a href="compare.html" title="compare"><i class="ion-ios-settings-strong"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="custom-col-5">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="{{asset('assets/fontend/img/product/product10.jpg')}}" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="{{asset('assets/fontend/img/product/product11.jpg')}}" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" data-toggle="modal" data-target="#modal_box" data-placement="top" data-original-title="quick view"> quick view</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <div class="tag_cate">
                                                    <a href="#">Women</a>
                                                </div>
                                                <h3><a href="product-details.html">Furniture</a></h3>
                                                <span class="old_price">$86.00</span>
                                                <span class="current_price">$60.00</span>
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
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere metus vitae </p>
                                                    </div>
                                                    <div class="action_links">
                                                        <ul>
                                                            <li><a href="wishlist.html" title="Wishlist"><span class="icon icon-Heart"></span></a></li>
                                                            <li class="add_to_cart"><a href="cart.html" title="add to cart">add to cart</a></li>
                                                            <li><a href="compare.html" title="compare"><i class="ion-ios-settings-strong"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="custom-col-5">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="{{asset('assets/fontend/img/product/product12.jpg')}}" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="{{asset('assets/fontend/img/product/product13.jpg')}}" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" data-toggle="modal" data-target="#modal_box" data-placement="top" data-original-title="quick view"> quick view</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <div class="tag_cate">
                                                    <a href="#">Men,</a>
                                                </div>
                                                <h3><a href="product-details.html">Letraset animal</a></h3>
                                                <span class="old_price">$86.00</span>
                                                <span class="current_price">$70.00</span>
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
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere metus vitae </p>
                                                    </div>
                                                    <div class="action_links">
                                                        <ul>
                                                            <li><a href="wishlist.html" title="Wishlist"><span class="icon icon-Heart"></span></a></li>
                                                            <li class="add_to_cart"><a href="cart.html" title="add to cart">add to cart</a></li>
                                                            <li><a href="compare.html" title="compare"><i class="ion-ios-settings-strong"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="custom-col-5">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="{{asset('assets/fontend/img/product/product15.jpg')}}" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="{{asset('assets/fontend/img/product/product14.jpg')}}" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" data-toggle="modal" data-target="#modal_box" data-placement="top" data-original-title="quick view"> quick view</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <div class="tag_cate">
                                                    <a href="#">Women</a>
                                                </div>
                                                <h3><a href="product-details.html">Aliquam furniture</a></h3>
                                                <span class="old_price">$86.00</span>
                                                <span class="current_price">$60.00</span>
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
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere metus vitae </p>
                                                    </div>
                                                    <div class="action_links">
                                                        <ul>
                                                            <li><a href="wishlist.html" title="Wishlist"><span class="icon icon-Heart"></span></a></li>
                                                            <li class="add_to_cart"><a href="cart.html" title="add to cart">add to cart</a></li>
                                                            <li><a href="compare.html" title="compare"><i class="ion-ios-settings-strong"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="custom-col-5">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="{{asset('assets/fontend/img/product/product16.jpg')}}" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="{{asset('assets/fontend/img/product/product11.jpg')}}" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" data-toggle="modal" data-target="#modal_box" data-placement="top" data-original-title="quick view"> quick view</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <div class="tag_cate">
                                                    <a href="#">Clothing,</a>
                                                    <a href="#">Potato chips</a>
                                                </div>
                                                <h3><a href="product-details.html">Natural Lorem Ipsum</a></h3>
                                                <span class="current_price">$65.00</span>
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
                                                       <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere metus vitae </p>
                                                    </div>
                                                    <div class="action_links">
                                                        <ul>
                                                            <li><a href="wishlist.html" title="Wishlist"><span class="icon icon-Heart"></span></a></li>
                                                            <li class="add_to_cart"><a href="cart.html" title="add to cart">add to cart</a></li>
                                                            <li><a href="compare.html" title="compare"><i class="ion-ios-settings-strong"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="custom-col-5">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="{{asset('assets/fontend/img/product/product5.jpg')}}" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="{{asset('assets/fontend/img/product/product6.jpg')}}" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" data-toggle="modal" data-target="#modal_box" data-placement="top" data-original-title="quick view"> quick view</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <div class="tag_cate">
                                                    <a href="#">Clothing,</a>
                                                </div>
                                                <h3><a href="product-details.html">Furniture</a></h3>
                                                <span class="old_price">$86.00</span>
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
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere metus vitae </p>
                                                    </div>
                                                    <div class="action_links">
                                                        <ul>
                                                            <li><a href="wishlist.html" title="Wishlist"><span class="icon icon-Heart"></span></a></li>
                                                            <li class="add_to_cart"><a href="cart.html" title="add to cart">add to cart</a></li>
                                                            <li><a href="compare.html" title="compare"><i class="ion-ios-settings-strong"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="custom-col-5">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="{{asset('assets/fontend/img/product/product16.jpg')}}" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="{{asset('assets/fontend/img/product/product15.jpg')}}" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" data-toggle="modal" data-target="#modal_box" data-placement="top" data-original-title="quick view"> quick view</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <div class="tag_cate">
                                                    <a href="#">Clothing,</a>
                                                    <a href="#">Potato chips</a>
                                                </div>
                                                <h3><a href="product-details.html">Letraset animal</a></h3>
                                                <span class="old_price">$86.00</span>
                                                <span class="current_price">$60.00</span>
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
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere metus vitae </p>
                                                    </div>
                                                    <div class="action_links">
                                                        <ul>
                                                            <li><a href="wishlist.html" title="Wishlist"><span class="icon icon-Heart"></span></a></li>
                                                            <li class="add_to_cart"><a href="cart.html" title="add to cart">add to cart</a></li>
                                                            <li><a href="compare.html" title="compare"><i class="ion-ios-settings-strong"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="custom-col-5">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="{{asset('assets/fontend/img/product/product8.jpg')}}" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="{{asset('assets/fontend/img/product/product3.jpg')}}" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" data-toggle="modal" data-target="#modal_box" data-placement="top" data-original-title="quick view"> quick view</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <div class="tag_cate">
                                                    <a href="#">men</a>
                                                    <a href="#">Potato chips</a>
                                                </div>
                                                <h3><a href="product-details.html">Aliquam furniture</a></h3>
                                                <span class="old_price">$86.00</span>
                                                <span class="current_price">$60.00</span>
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
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere metus vitae </p>
                                                    </div>
                                                    <div class="action_links">
                                                        <ul>
                                                            <li><a href="wishlist.html" title="Wishlist"><span class="icon icon-Heart"></span></a></li>
                                                            <li class="add_to_cart"><a href="cart.html" title="add to cart">add to cart</a></li>
                                                            <li><a href="compare.html" title="compare"><i class="ion-ios-settings-strong"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="custom-col-5">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="{{asset('assets/fontend/img/product/product10.jpg')}}" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="{{asset('assets/fontend/img/product/product12.jpg')}}" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" data-toggle="modal" data-target="#modal_box" data-placement="top" data-original-title="quick view"> quick view</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <div class="tag_cate">
                                                    <a href="#">men</a>
                                                    <a href="#">Potato chips</a>
                                                </div>
                                                <h3><a href="product-details.html">Natural Contrary</a></h3>
                                                <span class="old_price">$86.00</span>
                                                <span class="current_price">$60.00</span>
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
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere metus vitae </p>
                                                    </div>
                                                    <div class="action_links">
                                                        <ul>
                                                            <li><a href="wishlist.html" title="Wishlist"><span class="icon icon-Heart"></span></a></li>
                                                            <li class="add_to_cart"><a href="cart.html" title="add to cart">add to cart</a></li>
                                                            <li><a href="compare.html" title="compare"><i class="ion-ios-settings-strong"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="custom-col-5">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="{{asset('assets/fontend/img/product/product3.jpg')}}" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="{{asset('assets/fontend/img/product/product5.jpg')}}" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" data-toggle="modal" data-target="#modal_box" data-placement="top" data-original-title="quick view"> quick view</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <div class="tag_cate">
                                                    <a href="#">Clothing,</a>
                                                    <a href="#">Potato chips</a>
                                                </div>
                                                <h3><a href="product-details.html">Donec eu furniture</a></h3>
                                                <span class="current_price">$62.00</span>
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
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere metus vitae </p>
                                                    </div>
                                                    <div class="action_links">
                                                        <ul>
                                                            <li><a href="wishlist.html" title="Wishlist"><span class="icon icon-Heart"></span></a></li>
                                                            <li class="add_to_cart"><a href="cart.html" title="add to cart">add to cart</a></li>
                                                            <li><a href="compare.html" title="compare"><i class="ion-ios-settings-strong"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="custom-col-5">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="{{asset('assets/fontend/img/product/product16.jpg')}}" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="{{asset('assets/fontend/img/product/product5.jpg')}}" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" data-toggle="modal" data-target="#modal_box" data-placement="top" data-original-title="quick view"> quick view</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <div class="tag_cate">
                                                    <a href="#">Women</a>
                                                </div>
                                                <h3><a href="product-details.html">Duis pulvinar</a></h3>
                                                <span class="old_price">$86.00</span>
                                                <span class="current_price">$70.00</span>
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
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere metus vitae </p>
                                                    </div>
                                                    <div class="action_links">
                                                        <ul>
                                                            <li><a href="wishlist.html" title="Wishlist"><span class="icon icon-Heart"></span></a></li>
                                                            <li class="add_to_cart"><a href="cart.html" title="add to cart">add to cart</a></li>
                                                            <li><a href="compare.html" title="compare"><i class="ion-ios-settings-strong"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </section>
        <!--product section area end-->
@endsection