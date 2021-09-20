
<?php 
$segment = URL::current();
$url = explode('/',$segment);

?>
@if(!isset($url[4]))
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
@endif
 @php  $recent = recentproducts();  @endphp
 @if(!is_null($recent))
<section class="product_section p_bottom p_section1 pt-5 retpro bg-white">
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
                           
                            @foreach ($recent as $recent_views)
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
                                                <p>{{$recent_views->seo_description}} </p>
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
</section>
@endif