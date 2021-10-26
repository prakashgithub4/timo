@extends('layouts.app')
@section('title')
Diamond Search 
@endsection
@php $price_range = pricefilterrange(); @endphp
@section('content')

<div class="error_section">
    <div class="container">   
        <div class="row">
            <div class="col-4">
                <div class="quck_check">
                    <label class="i360">
                        <input type="checkbox">
                        <span><img src="{{asset('assets/fontend/img/icon/360.png')}}" style="width: 40px;"> Available</span>
                        
                    </label>
                </div>
            </div>
            <div class="col-4">
                <div class="quck_check">
                    <label class="truck">
                        <input type="checkbox">
                        <span><img src="{{asset('assets/fontend/img/icon/truck.png')}}" style="width: 40px;">View Delevery</span>
                    </label>
                </div>
            </div>
            <div class="col-4">
                <div class="reset_btn d-flex justify-content-end">
                    <a href="{{route('diamonds.search') }}"><input type="reset" value="Reset Filter"></a>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-4">
                <div class="shape_fld">
                    <label>Shape</label>
                    <div class="select_diamond d-flex justify-content-between flex-wrap">

                        @foreach ($shape as $v)
                        <div class="indi_select w-20">
                            <label>
                            <input type="checkbox" name="shapes[]" value="<?php echo $v->id ?>" class="my_check">
                                <span><span>{{$v->name}}</span><span></span></span>
                            </label>
                        </div>
                        @endforeach
                        
                        {{-- <div class="indi_select">
                            <label>
                                <input type="checkbox">
                                <span><span>Round</span><span></span></span>
                            </label>
                        </div>
                        <div class="indi_select w-20">
                            <label>
                                <input type="checkbox">
                                <span><span>Round</span><span></span></span>
                            </label>
                        </div>
                        <div class="indi_select w-20">
                            <label>
                                <input type="checkbox">
                                <span><span>Round</span><span></span></span>
                            </label>
                        </div>
                        <div class="indi_select w-20">
                            <label>
                                <input type="checkbox">
                                <span><span>Round</span><span></span></span>
                            </label>
                        </div>
                        <div class="indi_select w-20">
                            <label>
                                <input type="checkbox">
                                <span><span>Round</span><span></span></span>
                            </label>
                        </div>
                        <div class="indi_select w-20">
                            <label>
                                <input type="checkbox">
                                <span><span>Round</span><span></span></span>
                            </label>
                        </div>
                        <div class="indi_select w-20">
                            <label>
                                <input type="checkbox">
                                <span><span>Round</span><span></span></span>
                            </label>
                        </div>
                        <div class="indi_select w-20">
                            <label>
                                <input type="checkbox">
                                <span><span>Round</span><span></span></span>
                            </label>
                        </div>
                        <div class="indi_select w-20">
                            <label>
                                <input type="checkbox">
                                <span><span>Round</span><span></span></span>
                            </label>
                        </div>
                        <div class="indi_select w-20">
                            <label>
                                <input type="checkbox">
                                <span><span>Round</span><span></span></span>
                            </label>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="range_fld">
                    <label>Price</label>
                    <div class="range_blk mt-3">
                        <fieldset class="filter-price">
                            <div class="price-wrap">
                                <!-- <span class="price-title">FILTER</span> -->
                                <div class="price-wrap-1 mb-2">
                                <label for="one">Rs</label>
                                <input id="one">
                                
                                </div>
                                <div class="price-wrap_line">-</div>
                                <div class="price-wrap-2">
                                <label for="two">Rs</label>
                                <input id="two">
                                
                                </div>
                            </div>
                            <div class="price-field">
                            <input type="range"  min="{{$price_range['min']}}" max="{{$price_range['max']}}" value="{{$price_range['min']}}" id="lower" onchange="price(null)"/>
                            <input type="range"  min="{{$price_range['min']}}" max="{{$price_range['max']}}" value="{{$price_range['max']}}" id="upper" onchange="price(null)"/>
                            </div>
                            
                        </fieldset> 
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="range_fld">
                    <label>Carat</label>
                    <div class="range_blk mt-3">
                        <fieldset class="filter-price">
                            <div class="price-wrap">
                                <!-- <span class="price-title">FILTER</span> -->
                                <div class="price-wrap-1 mb-2">
                                <!-- <label for="one1">Rs</label> -->
                                <input id="one1">
                                
                                </div>
                                <div class="price-wrap_line">-</div>
                                <div class="price-wrap-2">
                                <!-- <label for="two1">Rs</label> -->
                                <input id="two1">
                                
                                </div>
                            </div>
                            <div class="price-field">
                            <input type="range"  min="100" max="500" value="100" id="lower1" onchange="price(null)">
                            <input type="range" min="100" max="500" value="500" id="upper1" onchange="price(null)">
                            </div>
                            
                        </fieldset> 
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-bottom pt-4 pb-4 show_parent">
            <div class="col-4">
                <div class="cutbox">
                    <div class="slider-box">
                        <label for="cut">Cut</label>
                        <input type="text" id="priceRange"  readonly >
                        <div id="price-range" class="slider"></div>
                        <div class="cut_box_main">
                            <div class="cut_box"></div>
                            <div class="cut_box"></div>
                            <div class="cut_box"></div>
                            <div class="cut_box"></div>
                        </div>                                
                    </div>
                  </div>
            </div>
            <div class="col-4">
                <div class="cutbox">
                    <div class="slider-box">
                        <label for="priceRange1">Color</label>
                        <div class="form-group" style="margin-top:40px">
                            <select   class="form-control" id="color" onchange="price(null)">
                                <option value="">Choose Color</option>
                                @foreach ($colors as $cats)
                                    <option  value={{$cats->id}}>{{$cats->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <input type="text" id="priceRange1" readonly>
                        <div id="price-range1" class="slider"></div>
                        <div class="cut_box_main">
                            <div class="cut_box1"></div>
                            <div class="cut_box1"></div>
                            <div class="cut_box1"></div>
                            <div class="cut_box1"></div>
                            <div class="cut_box1"></div>
                            <div class="cut_box1"></div>
                            <div class="cut_box1"></div>
                            <div class="cut_box1"></div>
                        </div>                                 --}}
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="cutbox">
                    <div class="slider-box">
                        <label for="priceRange2">Clarity</label>
                        <input type="text" id="priceRange2" readonly>
                        <div id="price-range2" class="slider"></div>
                        <div class="cut_box_main">
                            <div class="cut_box1"></div>
                            <div class="cut_box1"></div>
                            <div class="cut_box1"></div>
                            <div class="cut_box1"></div>
                            <div class="cut_box1"></div>
                            <div class="cut_box1"></div>
                            <div class="cut_box1"></div>
                            <div class="cut_box1"></div>
                        </div>                                
                    </div>
                  </div>
            </div>
            <!-- <div class="showHide_btn">
                <button class="followbtn">More Filters</button>
            </div> -->
        </div>
        <div class="more_filter_blk">
            <div class="showHide_btn">
                <button class="followbtn">More Filters</button>
            </div>
        <div class="show_hide_blk">
            <div class="row pt-4 pb-4">
                <div class="col-4">
                    <div class="cutbox">
                        <div class="slider-box">
                            <label for="priceRange3">Polish</label>
                            <input type="text" id="priceRange3" readonly>
                            <div id="price-range3" class="slider"></div>
                            <div class="cut_box_main">
                                <div class="cut_box3"></div>
                                <div class="cut_box3"></div>
                                <div class="cut_box3"></div>                                        
                            </div>
                        </div>                                    
                    </div>
                </div>
                <div class="col-4">
                    <div class="cutbox">                                
                        <div class="slider-box">
                            <label for="priceRange4">Symnetry</label>
                            <input type="text" id="priceRange4" readonly>
                            <div id="price-range4" class="slider"></div>
                            <div class="cut_box_main">
                                <div class="cut_box3"></div>
                                <div class="cut_box3"></div>
                                <div class="cut_box3"></div>                                        
                            </div>                                    
                        </div>
                      </div>
                </div>
                <div class="col-4">
                    <div class="cutbox">
                        <div class="slider-box">
                            <label for="priceRange5">Fluorescence</label>
                            <input type="text" id="priceRange5" readonly>
                            <div id="price-range5" class="slider"></div>
                            <div class="cut_box_main">
                                <div class="cut_box5"></div>
                                <div class="cut_box5"></div>
                                <div class="cut_box5"></div>
                                <div class="cut_box5"></div>
                                <div class="cut_box5"></div>                                        
                            </div>                                    
                        </div>
                      </div>
                </div>
            </div>
            <div class="row pt-4 pb-4">
                <div class="col-4">
                    <div class="range_fld">
                        <label>Depth %</label>
                        <div class="range_blk mt-3">
                            <fieldset class="filter-price">
                                <div class="price-wrap">
                                    <!-- <span class="price-title">FILTER</span> -->
                                    <div class="price-wrap-1 mb-2">
                                    
                                    <input id="one2">
                                    <label for="one2">%</label>
                                    </div>
                                    <div class="price-wrap_line">-</div>
                                    <div class="price-wrap-2">
                                    
                                    <input id="two2">
                                    <label for="two2">%</label>
                                    
                                    </div>
                                </div>
                                <div class="price-field">
                                <input type="range"  min="0" max="100" value="5" id="lower2">
                                <input type="range" min="0" max="100" value="100" id="upper2">
                                </div>
                                
                            </fieldset> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="table_block">
            <!-- <div class="row pt-4 pb-4">
                <div class="col-6">
                    <div class="show_opt">
                        <span class="list_show active">List</span>
                        <span class="grid_show ml-4">Visual</span>
                    </div>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <div class="option_list">
                        <label>Item per page</label>
                        <select>
                            <option selected>all</option>
                            <option>24</option>
                        </select>
                    </div>
                </div>
            </div> -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="shop_toolbar">
                        <div class="list_button">
                            <ul class="nav" role="tablist">
                                <li>
                                    <a class="" data-toggle="tab" href="#large" role="tab" aria-controls="large" aria-selected="false"><i class="ion-grid" ></i></a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#list" role="tab" aria-controls="list" aria-selected="true" class="active"><i class="ion-ios-list-outline"></i> </a>
                                </li>
                            </ul>
                        </div>
                        <div class="orderby_wrapper">
                            <h3>Item per page : </h3>
                            {{-- <div class="niceselect_option" >        
                                <form class="select_option" action="#" style="display: block;">         --}}
                                    <select class ="niceselect_option" name="orderby" id="short" onchange="lengthwisedata(this.value)">
                                        {{-- <option selected="" value="1">All</option> --}}
                                        <option value="30">30</option>
                                        <option value="40">40</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                       
                                    </select>
                                {{-- </form>        
                            </div>                                         --}}
                            <div class="page_amount">
                                <p>Showing 1–9 of 21 results</p>
                            </div>
                        </div>
                    </div>


                     <!--shop tab product start-->
                        <div class="tab-content">
                            <div class="tab-pane grid_view fade retpro bg-white p-0" id="large" role="tabpanel">
                                <div class="row" id="all">
                                    {{-- <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="assets/img/product/product10.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product11.jpg" alt=""></a>
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
                                                <div class="price_box">
                                                    <span class="old_price">$89.00</span>
                                                    <span class="current_price">$75.00</span>
                                                </div>
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
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere metus vitae arcu imperdiet</p>
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
                                    </div> --}}
                                    {{-- <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="assets/img/product/product9.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product8.jpg" alt=""></a>
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
                                                <div class="price_box">
                                                    <span class="current_price">$65.00</span>
                                                </div>
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
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere metus vitae arcu imperdiet</p>
                                                    </div>
                                                    <div class="action_links">
                                                        <ul>
                                                            <li><a href="#" title="" data-original-title="Add to Wishlist"><span class="icon icon-Heart"></span></a></li>
                                                            <li class="add_to_cart"><a href="cart.html" title="add to cart">add to cart</a></li>
                                                            <li><a href="compare.html" title="compare"><i class="ion-ios-settings-strong"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="assets/img/product/product7.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product6.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" data-toggle="modal" data-target="#modal_box" data-placement="top" data-original-title="quick view"> quick view</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <div class="tag_cate">
                                                    <a href="#">Women</a>
                                                </div>
                                                <h3><a href="product-details.html">Furniture</a></h3>
                                                <div class="price_box">
                                                    <span class="current_price">$65.00</span>
                                                </div>
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
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere metus vitae arcu imperdiet</p>
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
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="assets/img/product/product5.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product4.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" data-toggle="modal" data-target="#modal_box" data-placement="top" data-original-title="quick view"> quick view</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <div class="tag_cate">
                                                    <a href="#">Men,</a>
                                                </div>
                                                <h3><a href="product-details.html">Letraset animal</a></h3>
                                                <div class="price_box">
                                                    <span class="old_price">$89.00</span>
                                                    <span class="current_price">$75.00</span>
                                                </div>
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
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere metus vitae arcu imperdiet</p>
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
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="assets/img/product/product3.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product2.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" data-toggle="modal" data-target="#modal_box" data-placement="top" data-original-title="quick view"> quick view</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <div class="tag_cate">
                                                    <a href="#">Women</a>
                                                </div>
                                                <h3><a href="product-details.html">Aliquam furniture</a></h3>
                                                <div class="price_box">
                                                    <span class="old_price">$75.00</span>
                                                    <span class="current_price">$70.00</span>
                                                </div>
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
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere metus vitae arcu imperdiet</p>
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
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="assets/img/product/product1.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product13.jpg" alt=""></a>
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
                                                <div class="price_box">
                                                    <span class="old_price">$89.00</span>
                                                    <span class="current_price">$75.00</span>
                                                </div>
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
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere metus vitae arcu imperdiet</p>
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
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="assets/img/product/product3.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product6.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" data-toggle="modal" data-target="#modal_box" data-placement="top" data-original-title="quick view"> quick view</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <div class="tag_cate">
                                                    <a href="#">Clothing,</a>
                                                </div>
                                                <h3><a href="product-details.html">Furniture</a></h3>
                                            <div class="price_box">
                                                    <span class="current_price">$65.00</span>
                                                </div>
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
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere metus vitae arcu imperdiet</p>
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
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="assets/img/product/product4.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product5.jpg" alt=""></a>
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
                                                <div class="price_box">
                                                    <span class="old_price">$70.00</span>
                                                    <span class="current_price">$65.00</span>
                                                </div>
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
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere metus vitae arcu imperdiet</p>
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
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="assets/img/product/product5.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product6.jpg" alt=""></a>
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
                                                <div class="price_box">
                                                    <span class="old_price">$89.00</span>
                                                    <span class="current_price">$75.00</span>
                                                </div>
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
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere metus vitae arcu imperdiet</p>
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
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="assets/img/product/product11.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product6.jpg" alt=""></a>
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
                                                <div class="price_box">
                                                    <span class="current_price">$55.00</span>
                                                </div>
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
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere metus vitae arcu imperdiet</p>
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
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="assets/img/product/product13.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product12.jpg" alt=""></a>
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
                                                <div class="price_box">
                                                    <span class="old_price">$89.00</span>
                                                    <span class="current_price">$75.00</span>
                                                </div>
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
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere metus vitae arcu imperdiet</p>
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
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="assets/img/product/product6.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product5.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" data-toggle="modal" data-target="#modal_box" data-placement="top" data-original-title="quick view"> quick view</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <div class="tag_cate">
                                                    <a href="#">Women</a>
                                                </div>
                                                <h3><a href="product-details.html">Duis pulvinar</a></h3>
                                            <div class="price_box">
                                                    <span class="old_price">$70.00</span>
                                                    <span class="current_price">$75.00</span>
                                                </div>
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
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere metus vitae arcu imperdiet</p>
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
                                    </div> --}}
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="shop_toolbar t_bottom">
                                            <div class="pagination pagiante-custome">
                                                {{-- <ul>
                                                    <li class="current">1</li>
                                                    <li><a href="#">2</a></li>
                                                    <li><a href="#">3</a></li>
                                                    <li class="next"><a href="#">next</a></li>
                                                    <li><a href="#">&gt;&gt;</a></li>
                                                </ul> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane list_view fade show active" id="list" role="tabpanel">
                                <table id="responsive-data-table" class="table dt-responsive nowrap" style="width:100%">
                                    <thead>
                                       <tr>
                                          <th>Wish List</th>
                                          <th class ="order">Title</th>
                                          <th class ="order">Shape</th>
                                          <th class ="order">Price</th>
                                          <th class ="order">Color</th>
                                          <th class ="order">Carat</th>
                                          <th class ="order">Cut</th>
                                          <th class ="order">Clarity</th>
                                       </tr>
                                    </thead>
                                    <tbody id ="table">
                                       
                               
                                    </tbody>
                                 </table>
                                 <div class="row">
                                    <div class="col-md-12">
                                        <div class="shop_toolbar t_bottom mt-4">
                                            <div class="pagination pagiante-custome">
                                                {{-- <ul>
                                                    <li class="current">1</li>
                                                    <li><a href="#">2</a></li>
                                                    <li><a href="#">3</a></li>
                                                    <li class="next"><a href="#">next</a></li>
                                                    <li><a href="#">&gt;&gt;</a></li>
                                                </ul> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!--shop tab product end-->
                </div>
            </div>
        </div>
    </div>    
</div>
<!--error section area end--> 
{{-- <section class="product_section p_bottom p_section1 pt-5 retpro">
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
                                        <a class="primary_img" href="#"><img src="assets/img/product/product6.jpg" alt=""></a>
                                        <a class="secondary_img" href="#"><img src="assets/img/product/product7.jpg" alt=""></a>
                                        <div class="quick_button">
                                            <a href="#" data-toggle="modal" data-target="#modal_box" data-placement="top" data-original-title="quick view"> quick view</a>
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
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere metus vitae </p>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li><a href="#" data-placement="top" title="Add to Wishlist" data-toggle="tooltip"><span class="icon icon-Heart"></span></a></li>
                                                    <li class="add_to_cart"><a href="#" title="add to cart">add to cart</a></li>
                                                    <li><a href="#" title="compare"><i class="ion-ios-settings-strong"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="custom-col-5">
                                <div class="single_product">
                                    <div class="product_thumb">
                                        <a class="primary_img" href="#"><img src="assets/img/product/product8.jpg" alt=""></a>
                                        <a class="secondary_img" href="#"><img src="assets/img/product/product9.jpg" alt=""></a>
                                        <div class="quick_button">
                                            <a href="#" data-toggle="modal" data-target="#modal_box" data-placement="top" data-original-title="quick view"> quick view</a>
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
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere metus vitae </p>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li><a href="#" title="Wishlist"><span class="icon icon-Heart"></span></a></li>
                                                    <li class="add_to_cart"><a href="#" title="add to cart">add to cart</a></li>
                                                    <li><a href="#" title="compare"><i class="ion-ios-settings-strong"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="custom-col-5">
                                <div class="single_product">
                                    <div class="product_thumb">
                                        <a class="primary_img" href="#"><img src="assets/img/product/product10.jpg" alt=""></a>
                                        <a class="secondary_img" href="#"><img src="assets/img/product/product11.jpg" alt=""></a>
                                        <div class="quick_button">
                                            <a href="#" data-toggle="modal" data-target="#modal_box" data-placement="top" data-original-title="quick view"> quick view</a>
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
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere metus vitae </p>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li><a href="#" title="Wishlist"><span class="icon icon-Heart"></span></a></li>
                                                    <li class="add_to_cart"><a href="#" title="add to cart">add to cart</a></li>
                                                    <li><a href="#" title="compare"><i class="ion-ios-settings-strong"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="custom-col-5">
                                <div class="single_product">
                                    <div class="product_thumb">
                                        <a class="primary_img" href="#"><img src="assets/img/product/product12.jpg" alt=""></a>
                                        <a class="secondary_img" href="#"><img src="assets/img/product/product13.jpg" alt=""></a>
                                        <div class="quick_button">
                                            <a href="#" data-toggle="modal" data-target="#modal_box" data-placement="top" data-original-title="quick view"> quick view</a>
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
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere metus vitae </p>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li><a href="#" title="Wishlist"><span class="icon icon-Heart"></span></a></li>
                                                    <li class="add_to_cart"><a href="#" title="add to cart">add to cart</a></li>
                                                    <li><a href="#" title="compare"><i class="ion-ios-settings-strong"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="custom-col-5">
                                <div class="single_product">
                                    <div class="product_thumb">
                                        <a class="primary_img" href="#"><img src="assets/img/product/product15.jpg" alt=""></a>
                                        <a class="secondary_img" href="#"><img src="assets/img/product/product14.jpg" alt=""></a>
                                        <div class="quick_button">
                                            <a href="#" data-toggle="modal" data-target="#modal_box" data-placement="top" data-original-title="quick view"> quick view</a>
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
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere metus vitae </p>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li><a href="#" title="Wishlist"><span class="icon icon-Heart"></span></a></li>
                                                    <li class="add_to_cart"><a href="#" title="add to cart">add to cart</a></li>
                                                    <li><a href="#" title="compare"><i class="ion-ios-settings-strong"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="custom-col-5">
                                <div class="single_product">
                                    <div class="product_thumb">
                                        <a class="primary_img" href="#"><img src="assets/img/product/product16.jpg" alt=""></a>
                                        <a class="secondary_img" href="#"><img src="assets/img/product/product11.jpg" alt=""></a>
                                        <div class="quick_button">
                                            <a href="#" data-toggle="modal" data-target="#modal_box" data-placement="top" data-original-title="quick view"> quick view</a>
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
                                               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere metus vitae </p>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li><a href="#" title="Wishlist"><span class="icon icon-Heart"></span></a></li>
                                                    <li class="add_to_cart"><a href="#" title="add to cart">add to cart</a></li>
                                                    <li><a href="#" title="compare"><i class="ion-ios-settings-strong"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="custom-col-5">
                                <div class="single_product">
                                    <div class="product_thumb">
                                        <a class="primary_img" href="#"><img src="assets/img/product/product5.jpg" alt=""></a>
                                        <a class="secondary_img" href="#"><img src="assets/img/product/product6.jpg" alt=""></a>
                                        <div class="quick_button">
                                            <a href="#" data-toggle="modal" data-target="#modal_box" data-placement="top" data-original-title="quick view"> quick view</a>
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
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere metus vitae </p>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li><a href="#" title="Wishlist"><span class="icon icon-Heart"></span></a></li>
                                                    <li class="add_to_cart"><a href="#" title="add to cart">add to cart</a></li>
                                                    <li><a href="#" title="compare"><i class="ion-ios-settings-strong"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="custom-col-5">
                                <div class="single_product">
                                    <div class="product_thumb">
                                        <a class="primary_img" href="#"><img src="assets/img/product/product16.jpg" alt=""></a>
                                        <a class="secondary_img" href="#"><img src="assets/img/product/product15.jpg" alt=""></a>
                                        <div class="quick_button">
                                            <a href="#" data-toggle="modal" data-target="#modal_box" data-placement="top" data-original-title="quick view"> quick view</a>
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
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere metus vitae </p>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li><a href="#" title="Wishlist"><span class="icon icon-Heart"></span></a></li>
                                                    <li class="add_to_cart"><a href="#" title="add to cart">add to cart</a></li>
                                                    <li><a href="#" title="compare"><i class="ion-ios-settings-strong"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="custom-col-5">
                                <div class="single_product">
                                    <div class="product_thumb">
                                        <a class="primary_img" href="#"><img src="assets/img/product/product8.jpg" alt=""></a>
                                        <a class="secondary_img" href="#"><img src="assets/img/product/product3.jpg" alt=""></a>
                                        <div class="quick_button">
                                            <a href="#" data-toggle="modal" data-target="#modal_box" data-placement="top" data-original-title="quick view"> quick view</a>
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
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere metus vitae </p>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li><a href="#" title="Wishlist"><span class="icon icon-Heart"></span></a></li>
                                                    <li class="add_to_cart"><a href="#" title="add to cart">add to cart</a></li>
                                                    <li><a href="#" title="compare"><i class="ion-ios-settings-strong"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="custom-col-5">
                                <div class="single_product">
                                    <div class="product_thumb">
                                        <a class="primary_img" href="#"><img src="assets/img/product/product10.jpg" alt=""></a>
                                        <a class="secondary_img" href="#"><img src="assets/img/product/product12.jpg" alt=""></a>
                                        <div class="quick_button">
                                            <a href="#" data-toggle="modal" data-target="#modal_box" data-placement="top" data-original-title="quick view"> quick view</a>
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
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere metus vitae </p>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li><a href="#" title="Wishlist"><span class="icon icon-Heart"></span></a></li>
                                                    <li class="add_to_cart"><a href="#" title="add to cart">add to cart</a></li>
                                                    <li><a href="#" title="compare"><i class="ion-ios-settings-strong"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="custom-col-5">
                                <div class="single_product">
                                    <div class="product_thumb">
                                        <a class="primary_img" href="#"><img src="assets/img/product/product3.jpg" alt=""></a>
                                        <a class="secondary_img" href="#"><img src="assets/img/product/product5.jpg" alt=""></a>
                                        <div class="quick_button">
                                            <a href="#" data-toggle="modal" data-target="#modal_box" data-placement="top" data-original-title="quick view"> quick view</a>
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
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere metus vitae </p>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li><a href="#" title="Wishlist"><span class="icon icon-Heart"></span></a></li>
                                                    <li class="add_to_cart"><a href="#" title="add to cart">add to cart</a></li>
                                                    <li><a href="#" title="compare"><i class="ion-ios-settings-strong"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="custom-col-5">
                                <div class="single_product">
                                    <div class="product_thumb">
                                        <a class="primary_img" href="#"><img src="assets/img/product/product16.jpg" alt=""></a>
                                        <a class="secondary_img" href="#"><img src="assets/img/product/product5.jpg" alt=""></a>
                                        <div class="quick_button">
                                            <a href="#" data-toggle="modal" data-target="#modal_box" data-placement="top" data-original-title="quick view"> quick view</a>
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
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere metus vitae </p>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li><a href="#" title="Wishlist"><span class="icon icon-Heart"></span></a></li>
                                                    <li class="add_to_cart"><a href="#" title="add to cart">add to cart</a></li>
                                                    <li><a href="#" title="compare"><i class="ion-ios-settings-strong"></i></a></li>
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
</section> --}}
@include('parcials.recent')

@endsection

@section('script')
<script>
var order = 0;

$(".order").click(function(){
    if(order > 0)
  {
      order --;
  }
  else
  {
    order ++;
  }
  oderfilter(order);
  
});
async function oderfilter(order)
{
    let result  = await $.ajax({
        url:"{{route('order.filter')}}",
        type:"GET",
        data:{order:order},
        dataType: "json"
       
    });
    if(result.stat == true)
    {
        createhtmlgrid(result.data.original,false)
    }
}

$(".my_check").on("click", function () {
            var val = $(this).val();
            //console.log($(this).val());
            price(val)
        });
        
async function price(val)
{
    let lower  = $("#lower").val();
    let maximum =$('#upper').val();
    let color = $('#color').val();
    let shape = val;
    let lower1 = $('#lower1').val();
    let max1 = $('#upper1').val();


    console.log(lower1);

    let result  = await $.ajax({
        url:"{{route('price.filter')}}",
        type:"GET",
        data:{min:lower,max:maximum,color:color,shape:shape,lower1:lower1,max1:max1},
        dataType: "json"
       
    });
    if(result.stat == true){
       
        createhtmlgrid(result.data.original,true)
    }


}


    
async function lengthwisedata(id)
{
    let result  = await $.ajax({
        url:"{{route('page.length')}}",
        type:"GET",
        data:{page_length:id},
        dataType: "json"
       
    });
    if(result.stat == true)
    {
        createhtmlgrid(result)
    }
    console.log(result)
}
$(document).ready(function () {
          
    loaddata();
});
async function loaddata()
{
    let result  = await $.ajax({
        url:"{{route('all.product')}}",
        type:"GET",
        dataType: "json"
       
    });
    if(result.stat == true)
    {
        createhtmlgrid(result)
    }
   
    
}
var count = 1;
function createhtmlgrid(result,flag = false)
{
    var html =``;
    let data = result['data'];
    
$.each(data, function(index, value) {

    html += `<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="single_product">
            <div class="product_thumb">
                <a class="primary_img" href="${value.product_details}"><img src="${value.image_src}" alt=""></a>
                <a class="secondary_img" href="${value.product_details}"><img src="${value.image_src}" alt=""></a>
                <div class="quick_button">
                    <a href="#" onclick="showquickview(${value.id})"> quick view</a>
                </div>
            </div>
            <div class="product_content">
                <div class="tag_cate">
                    
                    <a href="#">${value.type}</a>
                </div>
                <h3><a href="${value.product_details}">${value.title}</a></h3>
                <div class="price_box">
                    <span class="old_price">$${value.old_price}</span>
                    <span class="current_price">$${value.price}</span>
                </div>
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
                        <p>${value.seo_description}</p>
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
    </div>`;


  
});

$("#all").html(html);

var table = '';
$.each(data,function(index,value){
    console.log('result',data)
    
  table +=`<tr>
            <th scope="row"><label class="wishList_call"><input type="checkbox" onclick='addwishlist(${value.id})'><span></span></label></th>
                <td>${(!value.title)?'N/A':value.title}</td>
                <td>${(!value.shape)?'N/A':value.shape}</td>
                <td>${value.price}</td>
                <td>${(!value.color)?'N/A':value.color}</td>
                ${value.products.length>0?
                    $.each(value.products, function(i, e) {
                        // var year = value.products[i].aid;
                        // console.log(year)
                        // var model = value.products[i].attribute_values;
                       `<td>${ value.products[i].aid == 18? value.products[i].attribute_values:'NA'}</td>
                        <td>${ value.products[i].aid == 8? value.products[i].attribute_values:'NA'}</td>
                        <td>${ value.products[i].aid == 9? value.products[i].attribute_values:'NA'}</td>`
                    }):
                    `<td>${(!value.carat)?'N/A':value.carat}</td>
                     <td>${(!value.cuts)?'N/A':value.cuts}</td>
                     <td>${(!value.clearity)?'N/A':value.clearity}</td>`
                }
            </tr>`;
    });
    $("#table").html(table);


var start = 1;
var end = result.total_pages;

var pagination = `<div class="pagination">
                   <ul>`;
if(result.total_pages <= count)
{
    pagination +=`<li class="next"><a href="javascript:paginelink(${count - 1})">Prev</a></li>`;
}
for(let i = start; i <= end; i++)
{
   
        pagination +=`<li id ="paging_${i}" class =${(count == i)?"current":''}><a  href="javascript:paginelink(${i})">${i}</a></li>`;
    
   
}
if(count > 1)
{
    pagination +=`<li class="next"><a href="javascript:paginelink(${count + 1})">next</a></li><li><a href="javascript:paginelink(${count + 1})">&gt;&gt;</a></li></ul></div>`;
}
    if(flag == false)
    {
        $(".pagiante-custome").html(pagination);
        $(".pagiante-custome").show();
    }
    else{
        $(".pagiante-custome").hide();
    }
}
async function paginelink(page)
{
    let page_length = $('#short').val();
    
    let result  = await $.ajax({
        url:"{{route('page')}}",
        type:"GET",
        data:{page:page,length:page_length},
       
       
    });
    if(result.stat == true)
    {
        count = page;
        createhtmlgrid(result.data.original)
    }
}
</script>


@endsection 