@extends('layouts.app')
@section('title')
Shape Details
@endsection
@section('content')
    <div class="breadcrumbs_area">
        <div class="container">   
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="#">Diamonds</a></li>
                            <li>&gt;</li>
                            <li>{{$shape_details->name}} Cut Diamonds</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>         
    </div>
    <div class="unlimited_services shape-sec">
        <div class="container">  
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="services_section_thumb">
                        <img src="{{asset('public/uploads/shape/banner')}}/{{$shape_details->banner}}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="unlimited_services_content">
                        <h1>{{$shape_details->name}} Cut Diamonds</h1>
                        <p>{{strip_tags($shape_details->description)}}</p>
                        <div class="view__work">
                            <a href="#">SHOP ALL ROUND CUT DIAMONDS  <i class="fa fa-angle-right"></i></a>
                        </div>  
                    </div>
                </div>
            </div>
        </div>     
    </div>
    <div class="shop_area shop_fullwidth shop_reverse section retpro bg-white">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="mb-5">{{$page}} of {{$total_contents}} {{$shape_details->name}} Cut Diamonds</h2>
                    <div class="row">  
                    @if(count($products) > 0)   
                    @foreach($products as $item)
                    @php $price = price_rang($item->id); @endphp                   
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            
                             <div class="single_product">
                                 <div class="product_thumb">
                                     <a class="primary_img" href="{{route('product',[Crypt::encryptString($item->id)])}}"><img src="{{$item->image_src}}" alt=""></a>
                                     <div class="quick_button">
                                         <a  href="javascript:void(0)" onclick="showquickview({{$item->id}})"> quick view</a>
                                     </div>
                                 </div>
                                 <div class="product_content">
                                     <div class="tag_cate">
                                         <!-- <a href="#">Clothing,</a> -->
                                         <a href="javascript:void(0)">{{$item->type}}</a>
                                     </div>
                                     <h3><a href="{{route('product',[Crypt::encryptString($item->id)])}}">{{$item->seo_title}}</a></h3>
                                     <div class="price_box">
                                         <span class="old_price">${{number_format($price['old_price'],2)}}</span>
                                         <span class="current_price">${{number_format($price['current_price'],2)}}</span>
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
                                             <p>{{ Str::limit($item->seo_description, 50) }}</p>
                                         </div>
                                         <div class="action_links">
                                            <ul>
                                                <li><a href="javascript:addwishlist({{$item->id}})"  title="{{($item->product_wish_list_count > 0) ? 'Added to Wishlist':'Add Wishlist'}}" class="{{($item->product_wish_list_count > 0) ? 'added_btn':''}} wish_{{$item->id}}"><span
                                                            class="icon icon-Heart"></span></a></li>
                                                <li  class="add_to_cart "><a  class="{{($item->isCart > 0) ? 'added_btn' : ''}} cart_{{$item->id}}" href="javascript:add_to_cart({{$item->id}})" title="{{($item->isCart > 0) ? 'Go to Cart':'Add to cart'}}">add to 
                                                        cart</a></li>
                                                <li><a href="javascript:compair({{$item->id}})" title="{{($item->isCompare > 0) ? 'Compared' :'Compare'}} " class="{{($item->isCompare > 0) ? 'added_btn' :''}} compare_{{$item->id}}"><i
                                                            class="ion-ios-settings-strong"></i></a></li>
                                            </ul>
                                             <!-- <ul>
                                                 <li><a href="wishlist.html" data-placement="top" title="Add to Wishlist" data-toggle="tooltip"><span class="icon icon-Heart"></span></a></li>
                                                 <li class="add_to_cart"><a href="cart.html" title="add to cart">add to cart</a></li>
                                                 <li><a href="compare.html" title="compare"><i class="ion-ios-settings-strong"></i></a></li>
                                             </ul> -->
                                         </div>
                                     </div>
                                 </div>
                             </div>
                           
                         </div> 
                          @endforeach  
                          @else
                          <div class="row">
                              <spna>No Product Available</spna>
                          </div>
                          @endif                      
                    </div>
                    <div class="shop_toolbar t_bottom">
                        <div class="pagination">
                            {!! $products->appends(Request::all())->links() !!}
                            <!-- <ul>
                                <li class="current">1</li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li class="next"><a href="#">next</a></li>
                                <li><a href="#">&gt;&gt;</a></li>
                            </ul> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection