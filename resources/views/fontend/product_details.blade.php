@extends('layouts.app')
@section('title')
Product Details
@endsection
@section('content')
<div class="product-dt">
    <div class="breadcrumbs_area">
        <div class="container">   
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="javascript:void(0)">Diamonds</a></li>
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
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="product-details-tab">
                        <div id="img-1" class="zoomWrapper single-zoom">
                            <a href="javascript:void(0)">
                                <img id="zoom1" src="{{@$product_image_array[0]['image']}}" data-zoom-image="{{@$product_image_array[0]['image']}}" alt="{{$product->seo_title}}">
                            </a>
                        </div>
                        @if(count($threesixtyview) > 0)
                        <div class="degview modal-toggle"  data-bs-toggle="modal" data-bs-target="#degviewmodal">
                            <svg width="56" height="52" viewBox="0 0 56 52" xmlns="http://www.w3.org/2000/svg"><path d="M51.2844216 27.5833333c-.8200053 13.2346296-11.8474429 23.75-25.2844216 23.75C12.0313333 51.3333333.66666667 39.9693333.66666667 26 .66666667 12.0313333 12.0313333.66666667 26 .66666667c9.0268426 0 16.9629025 4.74760088 21.4501124 11.87500003h-2.3015855v.1457148C40.9293141 6.63553714 33.9204528 2.66666667 26 2.66666667 13.134 2.66666667 2.66666667 13.1346667 2.66666667 26 2.66666667 38.866 13.134 49.3333333 26 49.3333333c12.3339298 0 22.4634832-9.6194868 23.2801998-21.75h2.0042218zm-1.8831439-4.7818367l3.9091504-4.7875689-.5797573-.9661982h-6.6587863l-.5797572.9661982 3.9091504 4.7875689zm0 2.5206275l-6.3997575-7.5738894 1.4692383-2.3661106h9.8610383l1.4692383 2.3661106-6.3997574 7.5738894zM40.3393333 26.526c0-2.8566667-.936-4.9693333-2.9046666-4.9693333C35.49 21.5566667 34.53 23.6693333 34.53 26.526c0 2.858.96 4.9706667 2.9046667 4.9706667 1.9686666 0 2.9046666-2.1126667 2.9046666-4.9706667zm2.8086667 0c0 3.8653333-1.968 7.2506667-5.7613333 7.2506667-3.7693334 0-5.666-3.3853334-5.666-7.2506667 0-3.8886667 1.9926666-7.2253333 5.762-7.2253333C41.252 19.3006667 43.148 22.6373333 43.148 26.526zM22.31 29.024c0 1.464.9606667 2.592 2.3286667 2.592 1.4886666 0 2.3046666-1.2006667 2.3046666-2.5686667 0-1.5126666-.864-2.5686666-2.2326666-2.5686666-1.512 0-2.4006667.9366666-2.4006667 2.5453333zm.6486667-3.6973333c.648-.528 1.416-.7926667 2.3766666-.7926667C28.024 24.534 29.584 26.526 29.584 28.9033333c0 2.3766667-1.776 4.8733334-4.9453333 4.8733334-3.0246667 0-4.9933334-2.1846667-4.9933334-5.0653334C19.6453333 25.23 21.71 21.7486667 27.52 18.868l1.128 2.1126667c-2.5686667 1.2006666-4.6573333 2.6413333-5.6893333 4.346zm-5.3533334-4.49l-4.2013333 4.514c2.9046667.312 4.1293333 1.872 4.1293333 3.9366666 0 2.3526667-1.9926666 4.4893334-5.2093333 4.4893334-1.4646667 0-2.64133333-.264-3.81733333-.648l.624-2.2566667c1.08066663.36 2.04066663.528 3.00133333.528 1.608 0 2.6646667-.744 2.6646667-2.0646667 0-1.2246666-1.0086667-2.0406666-3.0493334-2.0406666-.624 0-1.152.024-1.7046666.1446666l-.40800003-.9366666L13.812 21.8933333H8.72266667v-2.3526666h8.83466663l.048 1.296z" fill="#100E31" fill-rule="evenodd"></path></svg>
                        </div> 
                        @endif

                        <style type="text/css">
                            .cloudimage-inner-box canvas{
                                width: 100% !important;
                                font-size: 0px;
                                height: 490px !important;
                                object-fit: contain !important;
                            }
                            .cloudimage-360 .cloudimage-360-prev, .cloudimage-360 .cloudimage-360-next {
                          padding: 8px;
                          background: rgb(244, 244, 244);
                          border: none;
                          border-radius: 4px;
                        }
                    
                        .cloudimage-360 .cloudimage-360-prev:focus, .cloudimage-360 .cloudimage-360-next:focus {
                          outline: none;
                        }
                    
                        .cloudimage-360 .cloudimage-360-prev {
                          display: none;
                          position: absolute;
                          z-index: 100;
                          top: calc(50% - 15px);
                          left: 20px;
                        }
                    
                        .cloudimage-360 .cloudimage-360-next {
                          display: none;
                          position: absolute;
                          z-index: 100;
                          top: calc(50% - 15px);
                          right: 20px;
                        }
                    
                        .cloudimage-360 .cloudimage-360-prev:before, .cloudimage-360 .cloudimage-360-next:before {
                          content: '';
                          display: block;
                          width: 30px;
                          height: 30px;
                          background: 50% 50% / cover no-repeat;
                        }
                    
                        .cloudimage-360 .cloudimage-360-prev:before {
                          background-image: url('https://cdn.scaleflex.it/plugins/js-cloudimage-360-view/assets/img/arrow-left.svg');
                        }
                    
                        .cloudimage-360 .cloudimage-360-next:before {
                          background-image: url('https://cdn.scaleflex.it/plugins/js-cloudimage-360-view/assets/img/arrow-right.svg');
                        }
                    
                        .cloudimage-360 .cloudimage-360-prev.not-active, .cloudimage-360 .cloudimage-360-next.not-active {
                          opacity: 0.4;
                          cursor: default;
                            }
                        </style>
                        

                        <!-- Modal -->
                        <div class="modal fade degviewmodal" id="degviewmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
                              </div>
                              <div class="modal-body">
                                 <div
                                  class="cloudimage-360"
                                  data-folder="{{asset('public/uploads/'.$product->seo_title)}}/"
                                  data-filename="pem_{index}.jpg?v1"
                                  data-amount="{{count($threesixtyview)}}"
                                  data-magnifier="3"
                                  data-full-screen
                                  data-autoplay="true"
                                >
                                  <button class="cloudimage-360-prev"></button>
                                <button class="cloudimage-360-next"></button>  
                                </div>
                                <!-- Add script tag with CDN link to js-cloudimage-360-view lib after all content in body tag -->
                                <script src="https://cdn.scaleflex.it/plugins/js-cloudimage-360-view/2/js-cloudimage-360-view.min.js"></script>
                                <!--  <div class="threesixty-wrapper">
                                    <div class="threesixty" data-path="{{ asset('public/uploads/'.$product->seo_title)}}/pem_{index}.jpg" data-count="{{count($threesixtyview)}}">
                                        <div class="ui-spinner">
                                            <span class="side side-left">
                                                <span class="fill"></span>
                                            </span>
                                            <span class="side side-right">
                                                <span class="fill"></span>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="ui">
                                        <div class="next"><i class="fa fa-step-forward" aria-hidden="true"></i></div>
                                        <div class="prev"><i class="fa fa-step-backward" aria-hidden="true"></i></div>
                                    </div>
                                </div> -->
                              </div>
                            </div>
                          </div>
                        </div>

                         


                        <div class="single-zoom-thumb">
                            <ul class="s-tab-zoom owl-carousel single-product-active" id="gallery_01">
                                @if (@count($product_image_array) > 0)
                                @foreach($product_image_array as $item)
                                <li>
                                    <a href="javascript:void(0)" class="elevatezoom-gallery active" data-update="" data-image="{{$item['image']}}" data-zoom-image="{{$item['image']}}">
                                        <img src="{{$item['image']}}" alt="{{$product->seo_title}}"/>
                                    </a>

                                </li>
                                @endforeach
                                @endif
                             
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="product_d_right">
                    <form >
                        
                            <h1>{{$product->seo_title}}</h1>
                            <div class="product_ratting">
                                <ul>
                                    <li><a href="javascript:void(0)"><i class="fa fa-star"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-star"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-star"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-star"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-star"></i></a></li>
                                    <li><a href="javascript:void(0)"> (customer review ) </a></li>
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
                                <li><a onclick="shared('facebook',{{$product->id}})" href="http://www.facebook.com/sharer.php?u={{route('product',Crypt::encryptString($product->id))}}" title="facebook"><i class="fa fa-facebook"></i></a></li>           
                                <li><a  onclick="shared('twitter',{{$product->id}})" href="https://twitter.com/share?url={{route('product',Crypt::encryptString($product->id))}}" title="twitter"><i class="fa fa-twitter"></i></a></li>           
                                <!-- <li><a href="javascript:void(0)" title="pinterest"><i class="fa fa-pinterest"></i></a></li>           
                                <li><a href="javascript:void(0)" title="google +"><i class="fa fa-google-plus"></i></a></li> -->        
                                <li><a onclick="shared('linkedin',{{$product->id}})" href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{route('product',Crypt::encryptString($product->id))}}" title="linkedin"><i class="fa fa-linkedin"></i></a></li>        
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
                <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="product_d_inner">   
                        <div class="product_info_button">    
                            <ul class="nav" role="tablist">
                                <li >
                                    <a class="active" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">Description</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews ({{count($review)}})</a>
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
                                            @if(count($attribute_data)>0)
                                            @foreach ($attribute_data as $key=>$item)
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
                                            @else
                                            @php $flag = 1; @endphp
                                            @endif
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
                                    <h2>{{count($review)}} review for Donec eu furniture</h2>
                                    @foreach($review as $reviews)
                                    @if(is_null($reviews->reply))
                                    <div class="reviews_comment_box">
                                        <div class="comment_thmb">
                                            <img src="{{asset('assets/fontend/img/blog/comment2.jpg')}}" alt="">
                                        </div>
                                        <div class="comment_text">
                                            <div class="reviews_meta">
                                                <div class="star_rating">
                                                    <ul>
                                                        @for($i = 1; $i<$reviews->ratings; $i++)
                                                         <li><a href="javascript:void(0)"><i class="ion-ios-star"></i></a></li>
                                                        @endfor
                                                    </ul>   
                                                </div>
                                                <p><strong>{{$reviews->name}} </strong>- {{date('F d, Y',strtotime($reviews->created_at))}}</p>
                                                <span>{{$reviews->message}}</span>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    @else
                                     <div class="reviews_comment_box">
                                        <div class="comment_thmb">
                                            <img src="{{asset('assets/fontend/img/blog/comment2.jpg')}}" alt="comment2.jpg">
                                        </div>
                                        <div class="comment_text">
                                            <div class="reviews_meta">
                                               <!--  <div class="star_rating">
                                                    <ul>
                                                        @for($i = 1; $i<$reviews->ratings; $i++)
                                                         <li><a href="javascript:void(0)"><i class="ion-ios-star"></i></a></li>
                                                        @endfor
                                                    </ul>   
                                                </div> -->
                                                <p><strong>Admin </strong></p>
                                                <span>{{$reviews->reply}}</span>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    @endif
                                    @endforeach
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
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
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
                <div class="col-lg-4 col-md-12 col-sm-12 col-12">
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
                            <a class="center-section" href="javascript:void(0)">
                                <i class="fa fa-search" aria-hidden="true"></i>
                               <div class="icon-component appointment " aria-hidden="false">                                     
                               </div>
                               <p>Diamond Search</p>
                            </a>
                        </div>
                    </section>
                    <section class="diamond-upgrade stacked-top">
                        <h2 class="title">Lorem Ipsum is simply dummy text of the</h2>
                        <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic</p>
                        <p><a href="javascript:void(0)">LEARN MORE</a></p>
                    </section>
                    <div class="financing-options">
                        <h2 class="title">Lorem Ipsum</h2>
                        <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                        <ul>
                           <li>when an unknown printer took a galley of type and scrambled</li>
                           <li>It has survived not only five centuries</li>
                           <li>typesetting, remaining essentially unchanged.</li>
                           <li>It was popularised in the 1960s with the release.</li>
                        </ul>
                        <p><a href="javascript:void(0)">LEARN MORE</a></p>
                     </div>
                </div>
            </div>
        </div>    
    </div>  
    <div class="product_section  p_section1 retpro">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section_title">
                        <h2>Related products</h2>
                    </div> 
                </div>  
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="product_area ">
                            <div class="product_container bottom">
                            <div class="custom-row product_row1">
                                @if(count($realted_products) > 0)
                                @foreach($realted_products as $key=>$products)
                                @php $price = price_rang($products->id); @endphp
                                <div class="custom-col-5">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="{{route('product',[Crypt::encryptString($products->id)])}}"><img src="{{$products->image_src}}" alt="{{$products->seo_title}}"></a>
                                            <!-- <a class="secondary_img" href="{{route('product',[Crypt::encryptString($products->id)])}}"><img src="{{(@gallerypicksecond($products->id)->image == null) ? $products->image_src : gallerypicksecond($products->id)->image }}" alt=""></a> -->
                                        </div>
                                        <div class="product_content">
                                            <div class="tag_cate">
                                                <a href="javascript:void(0)">{{$products->type}}</a>
                                                {{-- <a href="#">Potato chips</a> --}}
                                            </div>
                                            <h3><a href="{{route('product',[Crypt::encryptString($products->id)])}}">{{$products->seo_title}}</a></h3>
                                            <span class="old_price">${{isset($price['old_price'])?number_format($price['old_price'],2): 0}}</span>
                                            <span class="current_price">${{isset($price['current_price'])?number_format($price['current_price'],2):0}}</span>
                                            <div class="product_hover">
                                                <div class="product_ratings">
                                                    <ul>
                                                        <li><a href="javascript:void(0)"><i class="ion-ios-star-outline"></i></a></li>
                                                        <li><a href="javascript:void(0)"><i class="ion-ios-star-outline"></i></a></li>
                                                        <li><a href="javascript:void(0)"><i class="ion-ios-star-outline"></i></a></li>
                                                        <li><a href="javascript:void(0)"><i class="ion-ios-star-outline"></i></a></li>
                                                        <li><a href="javascript:void(0)"><i class="ion-ios-star-outline"></i></a></li>
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
               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section_title">
                        <h2>Recently Viewed</h2>
                    </div> 
                </div>  
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
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
          location.reload();
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