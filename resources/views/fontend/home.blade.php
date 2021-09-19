@extends('layouts.app')
@section('title')
Home
@endsection
@section('banner')
    <section class="slider_area owl-carousel"> 
     @foreach($slider as $slide)
    <div class="single_slider" data-bgimg="{{asset('public/uploads/slider/'.$slide->image)}}">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="slider_content">
                        <p>{{$slide->discount_title}}</p>
                        <h1>{{$slide->title}}</h1>
                        
                        <p class="slider_price">starting at <span>${{$slide->price}}</span></p>
                        @if(!empty($slide->url) || $slide->url!='')
                        <a class="button" href="{{$slide->url}}" target=_blank>shopping now</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    </section>
    
@endsection

@section('content')
    <section class="product_section p_bottom p_section1">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2>Explore Ti Amo Diamonds</h2>
                    </div>
                </div>
                <div class="col-12">
                    <div class="product_area ">
                        <div class="product_container bottom">
                            <div class="custom-row product_row1">
                                @foreach($shapes as $shape)
                                <div class="custom-col-5">
                                    <div class="single-shipping">
                                        <div class="shipping_icone icone_1">
                                            <img src="{{ asset('public/uploads/shape') }}/{{$shape->logo}}" alt="">
                                        </div>
                                        <div class="shipping_content">
                                            <h3>{{$shape->name}}</h3>
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
    </section>
    @if (count($category) > 0)
        <section class="banner_section border-0 banner-in">
            <div class="container">
                <div class="row ">
                    @foreach ($category as $categories)
                        <div class="col-lg-4 col-md-6">
                            <div class="single_banner">
                                <div class="banner_thumb">
                                    <a href="javascript:void(0)"><img src="{{ asset('public/uploads/category') }}/{{ $categories->image }}"
                                            alt=""></a>
                                    <div class="banner_content">
                                        <p>{{ $categories->short }}</p>
                                        <h2>{{ $categories->name }}</h2>
                                        <!-- <span>From $60.99 – Sale 20%</span> -->
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="product_section p_bottom p_section1">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2>Explore Ti Amo Diamonds</h2>
                    </div>
                </div>
                <div class="col-12">
                    <div class="product_area ">
                        <div class="product_container bottom">
                            <div class="custom-row product_row1">
                                @foreach ($products as $item)
                                @php $prodID= encryption_route($item->id,1); @endphp
                                @php $slug= encryption_route(strtolower(remove_space($item->handle)),1); @endphp
                                @php $price = price_rang($item->id); @endphp
                                <div class="custom-col-5">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="javascript:void(0)"><img
                                                    src="{{(empty($item->image_src)) ? asset('assets/fontend/img/product/product3.jpg'): $item->image_src }}"
                                                    alt=""></a>
                                            <a class="secondary_img" href="{{url('product/ ' . $prodID . '/' . $slug )}}"><img
                                                    src="{{ (@gallerypicksecond($item->id)->image == null) ? asset('assets/fontend/img/product/product4.jpg') : gallerypicksecond($item->id)->image }}"
                                                    alt=""></a>
                                            <div class="quick_button">
                                                <a href="javascript:void(0)" onclick="showquickview({{$item->id}})"> quick view</a>
                                            </div>
                                        </div>
                                        <div class="product_content">
                                            <div class="tag_cate">
                                                {{-- <a href="#">Clothing,</a> --}}
                                                <a href="#">{{$item->type}}</a>
                                            </div>
                                            <h3><a href="#">{{$item->seo_title}}</a></h3>
                                            <span class="current_price">${{$price['current_price']}}</span>
                                            <div class="product_hover">
                                                <!-- <div class="product_ratings">
                                                    <ul>
                                                        <li><a href="javascript:void(0)"><i class="ion-ios-star-outline"></i></a></li>
                                                        <li><a href="javascript:void(0)"><i class="ion-ios-star-outline"></i></a></li>
                                                        <li><a href="javascript:void(0)"><i class="ion-ios-star-outline"></i></a></li>
                                                        <li><a href="javascript:void(0)"><i class="ion-ios-star-outline"></i></a></li>
                                                        <li><a href="javascript:void(0)"><i class="ion-ios-star-outline"></i></a></li>
                                                    </ul>
                                                </div> -->
                                                <div class="product_desc">
                                                    <p>{{$item->seo_description}} </p>
                                                </div>
                                                <div class="action_links">
                                                    <ul>
                                                        <li><a href="javascript:addwishlist({{$item->id}})" id="wish_{{$item->id}}" title="{{($item->product_wish_list_count > 0) ? 'Added to Wishlist':'Add Wishlist'}}" class="{{($item->product_wish_list_count > 0) ? 'added_btn':''}}"><span
                                                                    class="icon icon-Heart"></span></a></li>
                                                        <li  class="add_to_cart "><a  class="{{($item->isCart > 0) ? 'added_btn' : ''}}" href="javascript:add_to_cart({{$item->id}})" id="cart_{{$item->id}}" title="{{($item->isCart > 0) ? 'Go to Cart':'Add to cart'}}">add to 
                                                                cart</a></li>
                                                        <li><a href="javascript:compair({{$item->id}})" id="compare_{{$item->id}}" title="{{($item->isCompare > 0) ? 'Compared' :'Compare'}}" class="{{($item->isCompare > 0) ? 'added_btn' :''}}"><i
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
    </section>
    @if (count($secondcategory) > 0)
        <section class="banner_section border-0 banner-in">
            <div class="container">
                <div class="row ">
                    @foreach ($secondcategory as $secondcategories)
                        <div class="col-lg-4 col-md-6">
                            <div class="single_banner">
                                <div class="banner_thumb">
                                    <a href="#"><img
                                            src="{{ asset('public/uploads/category') }}/{{ $secondcategories->image }}"
                                            alt=""></a>
                                    <div class="banner_content">
                                        <p>{{ $secondcategories->short }}</p>
                                        <h2>{{ $secondcategories->name }}</h2>
                                        <!-- <span>From $60.99 – Sale 20%</span> -->
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach

                    {{-- <div class="col-lg-4 col-md-6">
               <div class="single_banner">
                   <div class="banner_thumb">
                        <a href="#"><img src="{{asset('assets/fontend/img/bg/banner2.jpg')}}" alt=""></a>
                        <div class="banner_content">
                            <p>Bestselling Products</p>
                            <h2>Setting Styles</h2>
                            <!-- <span>Only from $89.00</span> -->
                        </div>
                    </div>
               </div>
                
            </div>
            <div class="col-lg-4 col-md-6">
               <div class="single_banner bottom">
                   <div class="banner_thumb">
                        <a href="#"><img src="{{asset('assets/fontend/img/bg/banner3.jpg')}}" alt=""></a>
                        <div class="banner_content">
                            <p>Onsale Products</p>
                            <h2>Expert Tips</h2>
                            <!-- <span>Selling Off 30%</span> -->
                        </div>
                    </div>
               </div>
                
            </div> --}}
                </div>
            </div>
        </section>
    @endif

    <section class="product_section p_bottom p_section1">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2>Explore Ti Amo Diamonds</h2>
                    </div>
                </div>
                <div class="col-12">
                    <div class="product_area ">
                        <div class="product_container bottom">
                            <div class="custom-row product_row1">
                                
                                @foreach ($products as $item)
                                @php $price = price_rang($item->id); @endphp
                                @php $prodID= encryption_route($item->id,1); @endphp
                                @php $slug= encryption_route(strtolower(remove_space($item->handle)),1); @endphp

                                <div class="custom-col-5">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="javscript:void(0)"><img
                                                    src="{{ (empty($item->image_src)) ? asset('assets/fontend/img/product/product16.jpg') : $item->image_src }}"
                                                    alt=""></a>
                                            <a class="secondary_img" href="{{url('product/ ' . $prodID . '/' . $slug )}}"><img
                                                    src="{{(@gallerypicksecond($item->id)->image == null) ? asset('assets/fontend/img/product/product4.jpg') : gallerypicksecond($item->id)->image }}"
                                                    alt=""></a>
                                            <div class="quick_button">
                                                <a href="#"  onclick="showquickview({{$item->id}})"> quick view</a>
                                            </div>
                                        </div>
                                        <div class="product_content">
                                            <div class="tag_cate">
                                                <a href="#">{{$item->type}}</a>
                                            </div>
                                            <h3><a href="#">{{$item->seo_title}}</a></h3>
                                            <span class="old_price">${{number_format($price['old_price'],2)}}</span>
                                            <span class="current_price">${{number_format($price['current_price'],2)}}</span>
                                            <div class="product_hover">
                                                <!-- <div class="product_ratings">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-ios-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-ios-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-ios-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-ios-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-ios-star-outline"></i></a></li>
                                                    </ul>
                                                </div> -->
                                                <div class="product_desc">
                                                    <p>{{$item->seo_description}} </p>
                                                </div>
                                                <div class="action_links">
                                                    <ul>
                                                        <li><a href="javascript:addwishlist({{$item->id}})" id="wish_{{$item->id}}" title="{{($item->product_wish_list_count > 0) ? 'Added to Wishlist':'Add Wishlist'}}" class="{{($item->product_wish_list_count > 0) ? 'added_btn':''}}"><span
                                                                    class="icon icon-Heart"></span></a></li>
                                                        <li  class="add_to_cart "><a  class="{{($item->isCart > 0) ? 'added_btn' : ''}}" href="javascript:add_to_cart({{$item->id}})" id="cart_{{$item->id}}" title="{{($item->isCart > 0) ? 'Go to Cart':'Add to cart'}}">add to 
                                                                cart</a></li>
                                                        <li><a href="javascript:compair({{$item->id}})" id="compare_{{$item->id}}" title="{{($item->isCompare > 0) ? 'Compared' :'Compare'}}" class="{{($item->isCompare > 0) ? 'added_btn' :''}}"><i
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
    </section>

    <section class="banner_fullwidth">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="banner_text">
                        <p>Sale Off 20% All Products</p>
                        <h2>New Trending Collection</h2>
                        <span>We Believe That Good Design is Always in Season</span>
                        <a href="#">shopping Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="product_section p_bottom p_section1">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2>Recently Purchased Engagement Rings</h2>
                    </div>
                </div>
                <div class="col-12">
                    <div class="product_area ">
                        <div class="product_container bottom">
                            <div class="custom-row product_row1">
                                @foreach($purchased_product as $item)
                                @php $price = price_rang($item->id); @endphp
                                @php $prodID= encryption_route($item->id,1); @endphp
                                @php $slug= encryption_route(strtolower(remove_space($item->handle)),1); @endphp

                                <div class="custom-col-5">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="javscript:void(0)"><img
                                                    src="{{ (empty($item->image_src)) ? asset('assets/fontend/img/product/product16.jpg') : $item->image_src }}"
                                                    alt=""></a>
                                            <a class="secondary_img" href="{{url('product/ ' . $prodID . '/' . $slug )}}"><img
                                                    src="{{(@gallerypicksecond($item->id)->image == null) ? asset('assets/fontend/img/product/product4.jpg') : gallerypicksecond($item->id)->image }}"
                                                    alt=""></a>
                                            <div class="quick_button">
                                                <a href="#"  onclick="showquickview({{$item->id}})"> quick view</a>
                                            </div>
                                        </div>
                                        <div class="product_content">
                                            <div class="tag_cate">
                                                <a href="#">{{$item->type}}</a>
                                            </div>
                                            <h3><a href="#">{{$item->seo_title}}</a></h3>
                                            <span class="old_price">${{number_format($price['old_price'],2)}}</span>
                                            <span class="current_price">${{number_format($price['current_price'],2)}}</span>
                                            <div class="product_hover">
                                                <!-- <div class="product_ratings">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-ios-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-ios-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-ios-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-ios-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-ios-star-outline"></i></a></li>
                                                    </ul>
                                                </div> -->
                                                <div class="product_desc">
                                                    <p>{{$item->seo_description}} </p>
                                                </div>
                                                <div class="action_links">
                                                    <ul>
                                                        <li><a href="javascript:addwishlist({{$item->id}})" id="wish_{{$item->id}}" title="{{($item->product_wish_list_count > 0) ? 'Added to Wishlist':'Add Wishlist'}}" class="{{($item->product_wish_list_count > 0) ? 'added_btn':''}}"><span
                                                                    class="icon icon-Heart"></span></a></li>
                                                        <li  class="add_to_cart "><a  class="{{($item->isCart > 0) ? 'added_btn' : ''}}" href="javascript:add_to_cart({{$item->id}})" id="cart_{{$item->id}}" title="{{($item->isCart > 0) ? 'Go to Cart':'Add to cart'}}">add to 
                                                                cart</a></li>
                                                        <li><a href="javascript:compair({{$item->id}})" id="compare_{{$item->id}}" title="{{($item->isCompare > 0) ? 'Compared' :'Compare'}}" class="{{($item->isCompare > 0) ? 'added_btn' :''}}"><i
                                                                    class="ion-ios-settings-strong"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                                {{-- <div class="custom-col-5">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product8.jpg') }}"
                                                    alt=""></a>
                                            <a class="secondary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product9.jpg') }}"
                                                    alt=""></a>
                                            <div class="quick_button">
                                                <a href="#" data-toggle="modal" data-target="#modal_box"
                                                    data-placement="top" data-original-title="quick view"> quick view</a>
                                            </div>
                                        </div>
                                        <div class="product_content">
                                            <div class="tag_cate">
                                                <a href="#">Clothing,</a>
                                                <a href="#">Potato chips</a>
                                            </div>
                                            <h3><a href="#">Dummy animal</a></h3>
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
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
                                                        posuere metus vitae </p>
                                                </div>
                                                <div class="action_links">
                                                    <ul>
                                                        <li><a href="#" title="Wishlist"><span
                                                                    class="icon icon-Heart"></span></a></li>
                                                        <li class="add_to_cart"><a href="#" title="add to cart">add to
                                                                cart</a></li>
                                                        <li><a href="#" title="compare"><i
                                                                    class="ion-ios-settings-strong"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-col-5">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product10.jpg') }}"
                                                    alt=""></a>
                                            <a class="secondary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product11.jpg') }}"
                                                    alt=""></a>
                                            <div class="quick_button">
                                                <a href="#" data-toggle="modal" data-target="#modal_box"
                                                    data-placement="top" data-original-title="quick view"> quick view</a>
                                            </div>
                                        </div>
                                        <div class="product_content">
                                            <div class="tag_cate">
                                                <a href="#">Women</a>
                                            </div>
                                            <h3><a href="#">Furniture</a></h3>
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
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
                                                        posuere metus vitae </p>
                                                </div>
                                                <div class="action_links">
                                                    <ul>
                                                        <li><a href="#" title="Wishlist"><span
                                                                    class="icon icon-Heart"></span></a></li>
                                                        <li class="add_to_cart"><a href="#" title="add to cart">add to
                                                                cart</a></li>
                                                        <li><a href="#" title="compare"><i
                                                                    class="ion-ios-settings-strong"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-col-5">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product12.jpg') }}"
                                                    alt=""></a>
                                            <a class="secondary_img" href="#"><img
                                                    src="{{ asset('assets/img/product/product13.jpg') }}" alt=""></a>
                                            <div class="quick_button">
                                                <a href="#" data-toggle="modal" data-target="#modal_box"
                                                    data-placement="top" data-original-title="quick view"> quick view</a>
                                            </div>
                                        </div>
                                        <div class="product_content">
                                            <div class="tag_cate">
                                                <a href="#">Men,</a>
                                            </div>
                                            <h3><a href="#">Letraset animal</a></h3>
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
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
                                                        posuere metus vitae </p>
                                                </div>
                                                <div class="action_links">
                                                    <ul>
                                                        <li><a href="#" title="Wishlist"><span
                                                                    class="icon icon-Heart"></span></a></li>
                                                        <li class="add_to_cart"><a href="#" title="add to cart">add to
                                                                cart</a></li>
                                                        <li><a href="#" title="compare"><i
                                                                    class="ion-ios-settings-strong"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-col-5">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product15.jpg') }}"
                                                    alt=""></a>
                                            <a class="secondary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product14.jpg') }}"
                                                    alt=""></a>
                                            <div class="quick_button">
                                                <a href="#" data-toggle="modal" data-target="#modal_box"
                                                    data-placement="top" data-original-title="quick view"> quick view</a>
                                            </div>
                                        </div>
                                        <div class="product_content">
                                            <div class="tag_cate">
                                                <a href="#">Women</a>
                                            </div>
                                            <h3><a href="#">Aliquam furniture</a></h3>
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
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
                                                        posuere metus vitae </p>
                                                </div>
                                                <div class="action_links">
                                                    <ul>
                                                        <li><a href="#" title="Wishlist"><span
                                                                    class="icon icon-Heart"></span></a></li>
                                                        <li class="add_to_cart"><a href="#" title="add to cart">add to
                                                                cart</a></li>
                                                        <li><a href="#" title="compare"><i
                                                                    class="ion-ios-settings-strong"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-col-5">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product16.jpg') }}"
                                                    alt=""></a>
                                            <a class="secondary_img" href="#"><img
                                                    src="{{ asset('assets/fontend//img/product/product11.jpg') }}"
                                                    alt=""></a>
                                            <div class="quick_button">
                                                <a href="#" data-toggle="modal" data-target="#modal_box"
                                                    data-placement="top" data-original-title="quick view"> quick view</a>
                                            </div>
                                        </div>
                                        <div class="product_content">
                                            <div class="tag_cate">
                                                <a href="#">Clothing,</a>
                                                <a href="#">Potato chips</a>
                                            </div>
                                            <h3><a href="#">Natural Lorem Ipsum</a></h3>
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
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
                                                        posuere metus vitae </p>
                                                </div>
                                                <div class="action_links">
                                                    <ul>
                                                        <li><a href="#" title="Wishlist"><span
                                                                    class="icon icon-Heart"></span></a></li>
                                                        <li class="add_to_cart"><a href="#" title="add to cart">add to
                                                                cart</a></li>
                                                        <li><a href="#" title="compare"><i
                                                                    class="ion-ios-settings-strong"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-col-5">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product5.jpg') }}"
                                                    alt=""></a>
                                            <a class="secondary_img" href="#"><img
                                                    src="{{ asset('assets/fontend//img/product/product6.jpg') }}"
                                                    alt=""></a>
                                            <div class="quick_button">
                                                <a href="#" data-toggle="modal" data-target="#modal_box"
                                                    data-placement="top" data-original-title="quick view"> quick view</a>
                                            </div>
                                        </div>
                                        <div class="product_content">
                                            <div class="tag_cate">
                                                <a href="#">Clothing,</a>
                                            </div>
                                            <h3><a href="#">Furniture</a></h3>
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
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
                                                        posuere metus vitae </p>
                                                </div>
                                                <div class="action_links">
                                                    <ul>
                                                        <li><a href="#" title="Wishlist"><span
                                                                    class="icon icon-Heart"></span></a></li>
                                                        <li class="add_to_cart"><a href="#" title="add to cart">add to
                                                                cart</a></li>
                                                        <li><a href="#" title="compare"><i
                                                                    class="ion-ios-settings-strong"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-col-5">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product16.jpg') }}"
                                                    alt=""></a>
                                            <a class="secondary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product15.jpg') }}"
                                                    alt=""></a>
                                            <div class="quick_button">
                                                <a href="#" data-toggle="modal" data-target="#modal_box"
                                                    data-placement="top" data-original-title="quick view"> quick view</a>
                                            </div>
                                        </div>
                                        <div class="product_content">
                                            <div class="tag_cate">
                                                <a href="#">Clothing,</a>
                                                <a href="#">Potato chips</a>
                                            </div>
                                            <h3><a href="#">Letraset animal</a></h3>
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
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
                                                        posuere metus vitae </p>
                                                </div>
                                                <div class="action_links">
                                                    <ul>
                                                        <li><a href="#" title="Wishlist"><span
                                                                    class="icon icon-Heart"></span></a></li>
                                                        <li class="add_to_cart"><a href="#" title="add to cart">add to
                                                                cart</a></li>
                                                        <li><a href="#" title="compare"><i
                                                                    class="ion-ios-settings-strong"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-col-5">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product8.jpg') }}"
                                                    alt=""></a>
                                            <a class="secondary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product3.jpg') }}"
                                                    alt=""></a>
                                            <div class="quick_button">
                                                <a href="#" data-toggle="modal" data-target="#modal_box"
                                                    data-placement="top" data-original-title="quick view"> quick view</a>
                                            </div>
                                        </div>
                                        <div class="product_content">
                                            <div class="tag_cate">
                                                <a href="#">men</a>
                                                <a href="#">Potato chips</a>
                                            </div>
                                            <h3><a href="#">Aliquam furniture</a></h3>
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
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
                                                        posuere metus vitae </p>
                                                </div>
                                                <div class="action_links">
                                                    <ul>
                                                        <li><a href="#" title="Wishlist"><span
                                                                    class="icon icon-Heart"></span></a></li>
                                                        <li class="add_to_cart"><a href="#" title="add to cart">add to
                                                                cart</a></li>
                                                        <li><a href="#" title="compare"><i
                                                                    class="ion-ios-settings-strong"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-col-5">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product10.jpg') }}"
                                                    alt=""></a>
                                            <a class="secondary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product12.jpg') }}"
                                                    alt=""></a>
                                            <div class="quick_button">
                                                <a href="#" data-toggle="modal" data-target="#modal_box"
                                                    data-placement="top" data-original-title="quick view"> quick view</a>
                                            </div>
                                        </div>
                                        <div class="product_content">
                                            <div class="tag_cate">
                                                <a href="#">men</a>
                                                <a href="#">Potato chips</a>
                                            </div>
                                            <h3><a href="#">Natural Contrary</a></h3>
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
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
                                                        posuere metus vitae </p>
                                                </div>
                                                <div class="action_links">
                                                    <ul>
                                                        <li><a href="#" title="Wishlist"><span
                                                                    class="icon icon-Heart"></span></a></li>
                                                        <li class="add_to_cart"><a href="#" title="add to cart">add to
                                                                cart</a></li>
                                                        <li><a href="#" title="compare"><i
                                                                    class="ion-ios-settings-strong"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-col-5">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product3.jpg') }}"
                                                    alt=""></a>
                                            <a class="secondary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product5.jpg') }}"
                                                    alt=""></a>
                                            <div class="quick_button">
                                                <a href="#" data-toggle="modal" data-target="#modal_box"
                                                    data-placement="top" data-original-title="quick view"> quick view</a>
                                            </div>
                                        </div>
                                        <div class="product_content">
                                            <div class="tag_cate">
                                                <a href="#">Clothing,</a>
                                                <a href="#">Potato chips</a>
                                            </div>
                                            <h3><a href="#">Donec eu furniture</a></h3>
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
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
                                                        posuere metus vitae </p>
                                                </div>
                                                <div class="action_links">
                                                    <ul>
                                                        <li><a href="#" title="Wishlist"><span
                                                                    class="icon icon-Heart"></span></a></li>
                                                        <li class="add_to_cart"><a href="#" title="add to cart">add to
                                                                cart</a></li>
                                                        <li><a href="#" title="compare"><i
                                                                    class="ion-ios-settings-strong"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-col-5">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product16.jpg') }}"
                                                    alt=""></a>
                                            <a class="secondary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product5.jpg') }}"
                                                    alt=""></a>
                                            <div class="quick_button">
                                                <a href="#" data-toggle="modal" data-target="#modal_box"
                                                    data-placement="top" data-original-title="quick view"> quick view</a>
                                            </div>
                                        </div>
                                        <div class="product_content">
                                            <div class="tag_cate">
                                                <a href="#">Women</a>
                                            </div>
                                            <h3><a href="#">Duis pulvinar</a></h3>
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
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
                                                        posuere metus vitae </p>
                                                </div>
                                                <div class="action_links">
                                                    <ul>
                                                        <li><a href="#" title="Wishlist"><span
                                                                    class="icon icon-Heart"></span></a></li>
                                                        <li class="add_to_cart"><a href="#" title="add to cart">add to
                                                                cart</a></li>
                                                        <li><a href="#" title="compare"><i
                                                                    class="ion-ios-settings-strong"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="banner_section_four py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-12">
                    <div class="">
                        <h2>Gifts They'll Love</h2>
                    </div>
                </div>
            </div>
            <div class="row no-gutters">
                @foreach($gifts as $gift)
                <div class="col-lg-4 col-md-4">
                    <div class="single_banner" data-bgimg="{{ asset('public/uploads/gifts') }}/{{$gift->image}}"
                        style="background-image: url(&quot;{{ asset('public/uploads/gifts') }}/{{$gift->image}}&quot;);">
                        <div class="banner_content">
                            <p>{{$gift->description}}</p>
                            <h2>{{$gift->title}}</h2>
                            <!-- <a href="#">Discover Now</a> -->
                        </div>
                    </div>
                </div>
                @endforeach
                
            </div>
        </div>
    </section>

    <section class="product_section p_bottom p_section1 pt-5">
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
                                <div class="custom-col-5">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product6.jpg') }}"
                                                    alt=""></a>
                                            <a class="secondary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product7.jpg') }}"
                                                    alt=""></a>
                                            <div class="quick_button">
                                                <a href="#" data-toggle="modal" data-target="#modal_box"
                                                    data-placement="top" data-original-title="quick view"> quick view</a>
                                            </div>
                                        </div>
                                        <div class="product_content">
                                            <div class="tag_cate">
                                                <a href="#">Clothing,</a>
                                                <a href="#">Potato chips</a>
                                            </div>
                                            <h3><a href="#">Aliquam furniture</a></h3>
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
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
                                                        posuere metus vitae </p>
                                                </div>
                                                <div class="action_links">
                                                    <ul>
                                                        <li><a href="#" data-placement="top" title="Add to Wishlist"
                                                                data-toggle="tooltip"><span
                                                                    class="icon icon-Heart"></span></a></li>
                                                        <li class="add_to_cart"><a href="#" title="add to cart">add to
                                                                cart</a></li>
                                                        <li><a href="#" title="compare"><i
                                                                    class="ion-ios-settings-strong"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-col-5">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product8.jpg') }}"
                                                    alt=""></a>
                                            <a class="secondary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product9.jpg') }}"
                                                    alt=""></a>
                                            <div class="quick_button">
                                                <a href="#" data-toggle="modal" data-target="#modal_box"
                                                    data-placement="top" data-original-title="quick view"> quick view</a>
                                            </div>
                                        </div>
                                        <div class="product_content">
                                            <div class="tag_cate">
                                                <a href="#">Clothing,</a>
                                                <a href="#">Potato chips</a>
                                            </div>
                                            <h3><a href="#">Dummy animal</a></h3>
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
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
                                                        posuere metus vitae </p>
                                                </div>
                                                <div class="action_links">
                                                    <ul>
                                                        <li><a href="#" title="Wishlist"><span
                                                                    class="icon icon-Heart"></span></a></li>
                                                        <li class="add_to_cart"><a href="#" title="add to cart">add to
                                                                cart</a></li>
                                                        <li><a href="#" title="compare"><i
                                                                    class="ion-ios-settings-strong"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-col-5">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product10.jpg') }}"
                                                    alt=""></a>
                                            <a class="secondary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product11.jpg') }}"
                                                    alt=""></a>
                                            <div class="quick_button">
                                                <a href="#" data-toggle="modal" data-target="#modal_box"
                                                    data-placement="top" data-original-title="quick view"> quick view</a>
                                            </div>
                                        </div>
                                        <div class="product_content">
                                            <div class="tag_cate">
                                                <a href="#">Women</a>
                                            </div>
                                            <h3><a href="#">Furniture</a></h3>
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
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
                                                        posuere metus vitae </p>
                                                </div>
                                                <div class="action_links">
                                                    <ul>
                                                        <li><a href="#" title="Wishlist"><span
                                                                    class="icon icon-Heart"></span></a></li>
                                                        <li class="add_to_cart"><a href="#" title="add to cart">add to
                                                                cart</a></li>
                                                        <li><a href="#" title="compare"><i
                                                                    class="ion-ios-settings-strong"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-col-5">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product12.jpg') }}"
                                                    alt=""></a>
                                            <a class="secondary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product13.jpg') }}"
                                                    alt=""></a>
                                            <div class="quick_button">
                                                <a href="#" data-toggle="modal" data-target="#modal_box"
                                                    data-placement="top" data-original-title="quick view"> quick view</a>
                                            </div>
                                        </div>
                                        <div class="product_content">
                                            <div class="tag_cate">
                                                <a href="#">Men,</a>
                                            </div>
                                            <h3><a href="#">Letraset animal</a></h3>
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
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
                                                        posuere metus vitae </p>
                                                </div>
                                                <div class="action_links">
                                                    <ul>
                                                        <li><a href="#" title="Wishlist"><span
                                                                    class="icon icon-Heart"></span></a></li>
                                                        <li class="add_to_cart"><a href="#" title="add to cart">add to
                                                                cart</a></li>
                                                        <li><a href="#" title="compare"><i
                                                                    class="ion-ios-settings-strong"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-col-5">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product15.jpg') }}"
                                                    alt=""></a>
                                            <a class="secondary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product14.jpg') }}"
                                                    alt=""></a>
                                            <div class="quick_button">
                                                <a href="#" data-toggle="modal" data-target="#modal_box"
                                                    data-placement="top" data-original-title="quick view"> quick view</a>
                                            </div>
                                        </div>
                                        <div class="product_content">
                                            <div class="tag_cate">
                                                <a href="#">Women</a>
                                            </div>
                                            <h3><a href="#">Aliquam furniture</a></h3>
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
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
                                                        posuere metus vitae </p>
                                                </div>
                                                <div class="action_links">
                                                    <ul>
                                                        <li><a href="#" title="Wishlist"><span
                                                                    class="icon icon-Heart"></span></a></li>
                                                        <li class="add_to_cart"><a href="#" title="add to cart">add to
                                                                cart</a></li>
                                                        <li><a href="#" title="compare"><i
                                                                    class="ion-ios-settings-strong"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-col-5">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product16.jpg') }}"
                                                    alt=""></a>
                                            <a class="secondary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product11.jpg') }}"
                                                    alt=""></a>
                                            <div class="quick_button">
                                                <a href="#" data-toggle="modal" data-target="#modal_box"
                                                    data-placement="top" data-original-title="quick view"> quick view</a>
                                            </div>
                                        </div>
                                        <div class="product_content">
                                            <div class="tag_cate">
                                                <a href="#">Clothing,</a>
                                                <a href="#">Potato chips</a>
                                            </div>
                                            <h3><a href="#">Natural Lorem Ipsum</a></h3>
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
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
                                                        posuere metus vitae </p>
                                                </div>
                                                <div class="action_links">
                                                    <ul>
                                                        <li><a href="#" title="Wishlist"><span
                                                                    class="icon icon-Heart"></span></a></li>
                                                        <li class="add_to_cart"><a href="#" title="add to cart">add to
                                                                cart</a></li>
                                                        <li><a href="#" title="compare"><i
                                                                    class="ion-ios-settings-strong"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-col-5">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product5.jpg') }}"
                                                    alt=""></a>
                                            <a class="secondary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product6.jpg') }}"
                                                    alt=""></a>
                                            <div class="quick_button">
                                                <a href="#" data-toggle="modal" data-target="#modal_box"
                                                    data-placement="top" data-original-title="quick view"> quick view</a>
                                            </div>
                                        </div>
                                        <div class="product_content">
                                            <div class="tag_cate">
                                                <a href="#">Clothing,</a>
                                            </div>
                                            <h3><a href="#">Furniture</a></h3>
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
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
                                                        posuere metus vitae </p>
                                                </div>
                                                <div class="action_links">
                                                    <ul>
                                                        <li><a href="#" title="Wishlist"><span
                                                                    class="icon icon-Heart"></span></a></li>
                                                        <li class="add_to_cart"><a href="#" title="add to cart">add to
                                                                cart</a></li>
                                                        <li><a href="#" title="compare"><i
                                                                    class="ion-ios-settings-strong"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-col-5">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product16.jpg') }}"
                                                    alt=""></a>
                                            <a class="secondary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product15.jpg') }}"
                                                    alt=""></a>
                                            <div class="quick_button">
                                                <a href="#" data-toggle="modal" data-target="#modal_box"
                                                    data-placement="top" data-original-title="quick view"> quick view</a>
                                            </div>
                                        </div>
                                        <div class="product_content">
                                            <div class="tag_cate">
                                                <a href="#">Clothing,</a>
                                                <a href="#">Potato chips</a>
                                            </div>
                                            <h3><a href="#">Letraset animal</a></h3>
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
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
                                                        posuere metus vitae </p>
                                                </div>
                                                <div class="action_links">
                                                    <ul>
                                                        <li><a href="#" title="Wishlist"><span
                                                                    class="icon icon-Heart"></span></a></li>
                                                        <li class="add_to_cart"><a href="#" title="add to cart">add to
                                                                cart</a></li>
                                                        <li><a href="#" title="compare"><i
                                                                    class="ion-ios-settings-strong"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-col-5">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product8.jpg') }}"
                                                    alt=""></a>
                                            <a class="secondary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product3.jpg') }}"
                                                    alt=""></a>
                                            <div class="quick_button">
                                                <a href="#" data-toggle="modal" data-target="#modal_box"
                                                    data-placement="top" data-original-title="quick view"> quick view</a>
                                            </div>
                                        </div>
                                        <div class="product_content">
                                            <div class="tag_cate">
                                                <a href="#">men</a>
                                                <a href="#">Potato chips</a>
                                            </div>
                                            <h3><a href="#">Aliquam furniture</a></h3>
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
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
                                                        posuere metus vitae </p>
                                                </div>
                                                <div class="action_links">
                                                    <ul>
                                                        <li><a href="#" title="Wishlist"><span
                                                                    class="icon icon-Heart"></span></a></li>
                                                        <li class="add_to_cart"><a href="#" title="add to cart">add to
                                                                cart</a></li>
                                                        <li><a href="#" title="compare"><i
                                                                    class="ion-ios-settings-strong"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-col-5">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product10.jpg') }}"
                                                    alt=""></a>
                                            <a class="secondary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product12.jpg') }}"
                                                    alt=""></a>
                                            <div class="quick_button">
                                                <a href="#" data-toggle="modal" data-target="#modal_box"
                                                    data-placement="top" data-original-title="quick view"> quick view</a>
                                            </div>
                                        </div>
                                        <div class="product_content">
                                            <div class="tag_cate">
                                                <a href="#">men</a>
                                                <a href="#">Potato chips</a>
                                            </div>
                                            <h3><a href="#">Natural Contrary</a></h3>
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
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
                                                        posuere metus vitae </p>
                                                </div>
                                                <div class="action_links">
                                                    <ul>
                                                        <li><a href="javascript:void(0)" title="Wishlist"><span
                                                                    class="icon icon-Heart"></span></a></li>
                                                        <li class="add_to_cart"><a href="#" title="add to cart">add to
                                                                cart</a></li>
                                                        <li><a href="javascript:void(0)" title="compare"><i
                                                                    class="ion-ios-settings-strong"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-col-5">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product3.jpg') }}"
                                                    alt=""></a>
                                            <a class="secondary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product5.jpg') }}"
                                                    alt=""></a>
                                            <div class="quick_button">
                                                <a href="#" data-toggle="modal" data-target="#modal_box"
                                                    data-placement="top" data-original-title="quick view"> quick view</a>
                                            </div>
                                        </div>
                                        <div class="product_content">
                                            <div class="tag_cate">
                                                <a href="#">Clothing,</a>
                                                <a href="#">Potato chips</a>
                                            </div>
                                            <h3><a href="#">Donec eu furniture</a></h3>
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
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
                                                        posuere metus vitae </p>
                                                </div>
                                                <div class="action_links">
                                                    <ul>
                                                        <li><a href="#" title="Wishlist"><span
                                                                    class="icon icon-Heart"></span></a></li>
                                                        <li class="add_to_cart"><a href="#" title="add to cart">add to
                                                                cart</a></li>
                                                        <li><a href="#" title="compare"><i
                                                                    class="ion-ios-settings-strong"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-col-5">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product16.jpg') }}"
                                                    alt=""></a>
                                            <a class="secondary_img" href="#"><img
                                                    src="{{ asset('assets/fontend/img/product/product5.jpg') }}"
                                                    alt=""></a>
                                            <div class="quick_button">
                                                <a href="#" data-toggle="modal" data-target="#modal_box"
                                                    data-placement="top" data-original-title="quick view"> quick view</a>
                                            </div>
                                        </div>
                                        <div class="product_content">
                                            <div class="tag_cate">
                                                <a href="#">Women</a>
                                            </div>
                                            <h3><a href="#">Duis pulvinar</a></h3>
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
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
                                                        posuere metus vitae </p>
                                                </div>
                                                <div class="action_links">
                                                    <ul>
                                                        <li><a href="#" title="Wishlist"><span
                                                                    class="icon icon-Heart"></span></a></li>
                                                        <li class="add_to_cart"><a href="#" title="add to cart">add to
                                                                cart</a></li>
                                                        <li><a href="#" title="compare"><i
                                                                    class="ion-ios-settings-strong"></i></a></li>
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
    <section class="newsletter_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="newsletter_content">
                        <h2>Our Newsletter</h2>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <div class="subscribe_form">
                            <form id="mc-form" class="mc-form footer-newsletter">
                                <input id="mc-email" type="email" autocomplete="off" placeholder="Email address..." />
                                <button type="button" onclick="addsubscriber()" id="mc-submit">Subscribe</button>
                            </form>
                            <!-- mailchimp-alerts Start -->
                            <div class="mailchimp-alerts text-centre">
                                <div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
                                <div class="mailchimp-success"></div><!-- mailchimp-success end -->
                                <div class="mailchimp-error"></div><!-- mailchimp-error end -->
                            </div><!-- mailchimp-alerts end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
<script type="text/javascript">
    $(function() {
        $("img").lazy();
    });
</script>
<script>

function addsubscriber()
{
    //alert($("#mc-email").val())
    $.ajax({
            type: "POST",
            data: {
                "_token": '{{ csrf_token() }}',
                "email": $("#mc-email").val()
            },
            url: "{{ route('user.subscribes') }}",
            success: function(response) 
            {
                console.log(response)
               if(response == 3)
               {
                  
                   $.toast({
                        heading: 'warning',
                        text: 'Please log in first',
                        icon: 'warning',
                        position: 'top-right'
                    });
               }
               else if(response == 1)
               {
                    $.toast({
                        heading: 'success',
                        text: 'Congratulation your successfully subcribe our membership',
                        icon: 'success',
                        position: 'top-right'
                    });
                   
               }
               else if(response  == 0)
               {
                   $.toast({
                        heading: 'warning',
                        text: 'Your already subscribe our membership',
                        icon: 'warning',
                        position: 'top-right'
                    });
               }
                else if(response  == 4)
               {
                   $.toast({
                        heading: 'warning',
                        text: 'Please enter your mail id',
                        icon: 'warning',
                        position: 'top-right'
                    });
               }
            }
    })
}
</script>
@endsection





