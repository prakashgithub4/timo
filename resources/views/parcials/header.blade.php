<header class="header_area header_three">
    <!--header top start-->
    <div class="header_top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-12">
                    <div class="welcome_text">
                        <p>Free shipping on all domestic orders with coupon code <span>“Ti Amo Diamonds-2021”</span></p>
                    </div>
                </div>
                <div class="col-lg-7 col-md-12">
                    <div class="middel_right">
                        <div class="search_btn">
                            <form action="javascript:void(0)">
                                <input placeholder="Search product..." type="text">
                                <button type="submit"><i class="ion-ios-search-strong"></i></button>
                            </form>
                        </div>
                        <div class="box_setting" style="border-right: 0px;">
                            <a href="javascript:void(0)"><i class="fa fa-user" aria-hidden="true"></i></a>
                            <div class="dropdown_setting">
                                <ul>

                                    @if (\Auth::user() && \Auth::user()->user_type == 'customer')
                                        <li><a href="{{ route('user.account', 'settings') }}"><i
                                                    class="fa fa-cog" aria-hidden="true"></i> Account Settings </a>
                                        </li>
                                        <li><a href="{{ route('user.account', 'order') }}"><i class="fa fa-truck"
                                                    aria-hidden="true"></i> Orders </a></li>
                                        <li><a href="{{ route('user.account', 'returns') }}"><i class="fa fa-history"
                                                    aria-hidden="true"></i> Returns </a></li>
                                        <li><a href="{{ route('wishlist') }}"><i class="fa fa-heart"
                                                    aria-hidden="true"></i> Wishlist</a></li>
                                        <li><a href="{{ route('user.account', 'address') }}"><i class="fa fa-book"
                                                    aria-hidden="true"></i> Address Book </a></li>
                                        <li><a href="{{ route('compair') }}"><i class="fa fa-book"
                                                    aria-hidden="true"></i> Compair </a></li>
                                        <li><a href="{{ route('user.account', 'credit-card') }}"><i
                                                    class="fa fa-credit-card" aria-hidden="true"></i> Credit Card </a>
                                        </li>
                                        <li><a href="{{ route('user.logout') }}"><i class="fa fa-sign-out"
                                                    aria-hidden="true"></i> Log Out</a></li>
                                    @else
                                        <li><a href="{{ route('user.login') }}">Log In</a></li>
                                        <li><a href="{{ route('user.create') }}">Registration</a></li>
                                    @endif

                                </ul>

                            </div>
                        </div>
                        <div class="box_setting">
                            <a href="{{ route('wishlist') }}"><i class="fa fa-heart" aria-hidden="true"></i>
                                <span class="wis_quantity" id="wishlistcount">{{ countwishlist() }}</span>
                            </a>
                            <input type="hidden" id="wiscount" value="{{ countwishlist() }}" />
                        </div>
                        <div class="cart_link">
                            <a href="javascript:void(0)">
                                <i class="ion-android-cart"></i>
                                <span class="cart_text_quantity" id="total_price"> $ {{ total_cart() }}</span></a>
                            <!-- total cart -->
                            <input type='hidden' id="cart_total_price" value="{{ total_cart() }}" />

                            <span class="cart_quantity" id="cart_count">{{ total_cart_count() }}</span>
                            <!-- for count cart -->
                            <input type="hidden" id="count_cart" value="{{ total_cart_count() }}" />
                        </div>
                        <!-- <div class="cart_link">
                            <a href="javascript:void(0)">
                                <i class="ion-android-cart"></i>
                                <span class="cart_text_quantity"> $138.00</span></a>
                            <span class="cart_quantity">2</span>
                        </div> -->
                        <!--mini cart-->
                        <div class="mini_cart">
                            <div class="cart_close">
                                <div class="cart_text">
                                    <h3>cart</h3>
                                </div>
                                <div class="mini_cart_close">
                                    <a href="javascript:void(0)"><i class="ion-android-close"></i></a>
                                </div>
                            </div>
                            <div id="cart">
                                <div class="cart-bx">
                                    @php  $cart = cart_list();   @endphp
                                    @foreach ($cart as $carts)
                                        <div class="cart_item" id="cart_{{ $carts->id }}">
                                            <div class="cart_img">
                                                <a href="#"><img src="{{ $carts->image_src }}" alt=""></a>
                                            </div>
                                            <div class="cart_info">
                                                <a href="#">{{ $carts->seo_title }}</a>
                                                <span class="quantity">Qty: {{ $carts->qty }}</span>
                                                <span class="price_cart">${{ $carts->price }}</span>
                                            </div>
                                            <div class="cart_remove">
                                                <a href="javascript:removecart({{ $carts->id }})"><i
                                                        class="ion-android-close"></i></a>
                                            </div>
                                        </div>
                                    @endforeach
                                    <!--  <div class="cart_item">
                                       <div class="cart_img">
                                           <a href="javascript:void(0)"><img src="{{ asset('assets/fontend/img/s-product/product.jpg') }}" alt=""></a>
                                       </div>
                                        <div class="cart_info">
                                            <a href="#">Letraset animal</a>
                                            <span class="quantity">Qty: 1</span>
                                            <span class="price_cart">$60.00</span>
                                        </div>
                                        <div class="cart_remove">
                                            <a href="#"><i class="ion-android-close"></i></a>
                                        </div>
                                    </div>
                                    <div class="cart_item">
                                       <div class="cart_img">
                                           <a href="#"><img src="{{ asset('assets/fontend/img/s-product/product2.jpg') }}" alt=""></a>
                                       </div>
                                        <div class="cart_info">
                                            <a href="#">Natural passages</a>
                                            <span class="quantity">Qty: 1</span>
                                            <span class="price_cart">$69.00</span>
                                        </div>
                                        <div class="cart_remove">
                                            <a href="#"><i class="ion-android-close"></i></a>
                                        </div>
                                    </div>
                                    <div class="cart_item">
                                       <div class="cart_img">
                                           <a href="javascript:void(0)"><img src="{{ asset('assets/fontend/img/s-product/product.jpg') }}" alt=""></a>
                                       </div>
                                        <div class="cart_info">
                                            <a href="#">Letraset animal</a>
                                            <span class="quantity">Qty: 1</span>
                                            <span class="price_cart">$60.00</span>
                                        </div>
                                        <div class="cart_remove">
                                            <a href="#"><i class="ion-android-close"></i></a>
                                        </div>
                                    </div>
                                    <div class="cart_item">
                                       <div class="cart_img">
                                           <a href="#"><img src="{{ asset('assets/fontend/img/s-product/product2.jpg') }}" alt=""></a>
                                       </div>
                                        <div class="cart_info">
                                            <a href="#">Natural passages</a>
                                            <span class="quantity">Qty: 1</span>
                                            <span class="price_cart">$69.00</span>
                                        </div>
                                        <div class="cart_remove">
                                            <a href="#"><i class="ion-android-close"></i></a>
                                        </div>
                                    </div> -->
                                </div>
                                @if (@count($cart) > 0)
                                    <div class="cart_total">
                                        <span>Subtotal:</span>
                                        <span>{{ total_cart() }}</span>
                                    </div>
                                    <div class="mini_cart_footer">
                                        <div class="cart_button view_cart">
                                            <a href="{{ route('user.cart') }}">View cart</a>
                                        </div>
                                        <div class="cart_button checkout">
                                            <a class="active" href="{{ route('checkout') }}">Checkout</a>
                                        </div>

                                    </div>
                                @endif
                            </div>
                        </div>
                        <!--mini cart end-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--header top start-->

    <!--header middel start-->
    <div class="header_middel">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-2 col-md-3 col-4">
                    <div class="logo">
                        <a href="{{ url('/') }}"><img src="{{ asset('assets/fontend/img/logo/logo.png') }}"
                                alt=""></a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="header_bottom sticky-header">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <div class="main_menu_inner">
                                    <div class="logo_sticky">
                                        <a href="{{ url('/') }}"><img
                                                src="{{ asset('assets/fontend/img/logo/logo.png') }}" alt=""></a>
                                    </div>
                                    <div class="main_menu">
                                        <nav>
                                            <ul>
                                                <li class="active"><a href="{{ url('/') }}">Home</a></li>
                                                <?php $mymenu = \App\Models\Menu::where('head_on', '1')->offset(0)->limit(7)->get(); ?>

                                                @foreach ($mymenu as $menu)
                                                    @if ($menu->mega == 1)
                                                        <li><a href="javascript:void(0)">{{ $menu->menu_name }} <i
                                                                    class="fa fa-angle-down"></i></a>
                                                            <?php $menuCategory = \App\Models\ProductCategory::where('menu_id', $menu->id)->get(); ?>

                                                            @if (count($menuCategory) > 0)
                                                                <ul class="mega_menu">
                                                                    @foreach ($menuCategory as $menu_cat)
                                                                        {{-- @if ($menu_cat->mega_menu == 1) --}}
                                                                        <li><a
                                                                                href="javascript:void(0)">{{ $menu_cat->product_category }}</a>
                                                                            <?php $menuSubCategory = \App\Models\ProductSubCategory::where('menu_id', $menu->id)
                                                                                ->where('product_category_id', $menu_cat->product_category_id)
                                                                                ->get(); ?>
                                                                            <ul>
                                                                                @foreach ($menuSubCategory as $mSC)
                                                                                    <li><a href="javascript:void(0)">@if (is_null($mSC->icon))<img src="{{ asset('assets/fontend/img/nav-round.png') }}" alt="">@else <img src="{{ asset('public/uploads/subcat_icons/' . $mSC->icon) }}">@endif
                                                                                            {{ $mSC->sub_category_name }}</a>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </li>
                                                                        {{-- @endif --}}
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @else
                                                        <?php $menuCategory = \App\Models\ProductCategory::where('menu_id', $menu->id)->get(); ?>
                                                        @if (count($menuCategory) == 0)
                                                            <li><a href="javascript:void(0)">{{ $menu->menu_name }}
                                                                </a>
                                                            @else
                                                            <li><a href="javascript:void(0)">{{ $menu->menu_name }}
                                                                    <i class="fa fa-angle-down"></i></a>
                                                                <ul class="sub_menu pages">
                                                                    @if (count($menuCategory) > 0)
                                                                        @foreach ($menuCategory as $mCat)
                                                                        <li class="menu-item-has-children">

                                                                            <a href="#">{{$mCat->product_category}}</a>
                                                                                <?php $menuSubCategory = \App\Models\ProductSubCategory::where('menu_id', $menu->id)
                                                                                    ->where('product_category_id', $mCat->product_category_id)
                                                                                    ->get(); ?>
                                                                                      @if(count($menuSubCategory)>0)
                                                                                      @foreach($menuSubCategory as $mSC)
                                                                                      <li><a href="javascript:void(0)">@if(is_null($mSC->icon))<img src="{{asset('assets/fontend/img/nav-round.png')}}" alt="">@else <img src="{{asset('public/uploads/subcat_icons/'.$mSC->icon)}}">@endif
                                                                                          {{$mSC->sub_category_name}}</a></li>
                                                                                      @endforeach
                                                                                @endif
                                                                        </li>
                                                                        @endforeach
                                                                    @endif
                                                                </ul>
                                                        @endif
                                                        </li>
                                                    @endif
                                                @endforeach

                                            </ul>
                                            </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
