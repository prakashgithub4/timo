<!doctype html>
<html class="no-js" lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/fontend/img/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontend/css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontend/css/custom.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/fontend/css/jquery.toast.css')}}">

</head>

<body class="clicked">
    <div class="off_canvars_overlay">
    </div>
    <div class="Offcanvas_menu Offcanvas_two offcanvas_three">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="canvas_open">
                        <a href="javascript:void(0)"><span>All</span><i class="ion-navicon"></i></a>
                    </div>
                    <div class="Offcanvas_menu_wrapper">
                        <a href="{{url('/')}}"><img src="{{ asset('assets/fontend/img/logo/logo.png') }}" alt=""
                                class="leftlogo"></a>
                        <div class="canvas_close">
                            <a href="javascript:void(0)"><i class="ion-android-close"></i></a>
                        </div>
                        <div class="welcome_text text-center mb-3">
                            <p>Free shipping on all domestic orders with coupon code <span>“Ti Amo Diamonds-2021”</span>
                            </p>
                        </div>
                        <div id="menu" class="text-left ">
                            <ul class="offcanvas_main_menu">
                                <li class="menu-item-has-children active">
                                    <a href="{{url('/')}}">Home</a>
                                </li>
                                <?php  $mymenu= \App\Models\Menu::where('head_on', '0')->get();?>
                                  @foreach($mymenu as $menu)
                                @if($menu->top == 0)
                                <li class="menu-item-has-children">
                                    <a href="javascript:void(0)">{{$menu->menu_name}}</a>
                                    <?php  $menuCategory= \App\Models\ProductCategory::where('menu_id', $menu->id)->get();?>
                                    <ul class="sub-menu">
                                        @foreach($menuCategory as $menu_cat)
                                         @if($menu_cat->mega_menu==1)
                                        <li class="menu-item-has-children">
                                            <a href="#">{{$menu_cat->product_category}}</a>
                                            <?php  $menuSubCategory= \App\Models\ProductSubCategory::where('menu_id', $menu->id)->where('product_category_id',$menu_cat->product_category_id)->get();?>
                                            <ul class="sub-menu">
                                                @foreach($menuSubCategory as $mSC)
                                                <li><a href="javascript:void(0)">@if(is_null($mSC->icon))<img src="{{asset('assets/fontend/img/nav-round.png')}}" alt="">@else <img src="{{asset('public/uploads/subcat_icons/'.$mSC->icon)}}">@endif
                                                    {{$mSC->sub_category_name}}</a></li>
                                                @endforeach
                                            
                                            </ul>
                                        </li>
                                        @endif
                                        @endforeach
                                      
                                    </ul>
                                </li>
                                @else
                                   <li class="menu-item-has-children">
                                    <a href="javascript:void(0)">{{$menu->menu_name}}</a>
                                    <?php  $menuCategory= \App\Models\ProductCategory::where('menu_id', $menu->id)->get();?>

                                    <ul class="sub-menu">
                                        @foreach($menuCategory as $mCat)
                                        @if($mCat->mega_menu==1)
                                        <?php  $menuSubCategory2= \App\Models\ProductSubCategory::where('menu_id', $menu->id)->where('product_category_id',$mCat->product_category_id)->get();?>
                                        @foreach($menuSubCategory2 as $mSubCat2)
                                        <li><a href="#">@if(is_null($mSubCat2->icon))<img src="{{asset('assets/fontend/img/nav-round.png')}}" alt="">@else <img src="{{asset('public/uploads/subcat_icons/'.$mSubCat2->icon)}}">@endif
                                            {{$mSubCat2->sub_category_name}}</a></li>
                                       
                                     @endforeach 
                                     @endif
                                     @endforeach  
                                    </ul>
                                </li>
                                @endif
                                @endforeach
                               
                            </ul>
                        </div>
                        <!-- <div class="Offcanvas_footer">
                            <span><a href="#"><i class="fa fa-envelope-o"></i> demo@example.com</a></span>
                            <ul>
                                <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li class="pinterest"><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                                <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li class="linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="home_three_body_wrapper">

        @include('parcials.header')
        @yield('banner')
        @yield('content')
        @include('parcials.footer')

        <div class="modal fade" id="modal_box" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="modal_body">
                        <div class="container">
                            <div class="row" id="modalBody">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
             <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
            
            <script src="{{ asset('assets/fontend/js/plugins.js') }}"></script>
            <!-- Main JS -->
            <script src="{{ asset('assets/fontend/js/main.js') }}"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
            <script src="{{asset('assets/fontend/js/jquery.toast.js')}}"></script>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
           <script type="text/javascript" src="{{asset('assets/fontend/js/jquery.lazy.min.js')}}"></script>
            <script type="text/javascript" src="{{asset('assets/fontend/js/jquery.lazy.plugins.min.js')}}"></script>

           

            
            @yield('script')
            <script>
                function onchangeqty(qty)
                {
                    let current = $("#current_price").val();
                    let oldprice = $("#old_price").val();
                    let current_qty = parseFloat(current) * parseInt(qty);
                    let old_qty =  parseFloat(oldprice) * parseInt(qty);
                    $("#old").html(`$${old_qty.toFixed(2)}`);
                    $("#new").html(`$${current_qty.toFixed(2)}`);
                   
                }
   
                function addwishlist(product_id)
                {
                    $.ajax({
                            type: "POST",
                            data: {
                                "_token": '{{ csrf_token() }}',
                                "product_id": product_id
                            },
                            url: "{{ route('wishlist.add') }}",
                            success: function(response) 
                            {

                               if(response == 1)
                               {
                                  // alert("Wishlist has been added successfully");
                                    $.toast({
                                    heading: 'success',
                                    text: 'Wishlist has been added successfully',
                                    icon: 'success',
                                    position: 'top-right'
                                });
                                   var wishcount = $("#wiscount").val();
                                   let calwish = Number(wishcount) + 1;
                                    $("#wiscount").val(calwish);
                                   $("#wishlistcount").text(calwish);
                                   $(".wish_"+product_id).addClass("added_btn");
                                   $(".wish_"+product_id).attr("title","Added to Wishlist");
                               }
                               else if(response == 3)
                               {
                                   //alert('Please log in first')
                                 $.toast({
                                    heading: 'warning',
                                    text: 'Please log in first',
                                    icon: 'warning',
                                    position: 'top-right'
                                });
                               }
                               else
                               {
                                 $.toast({
                                    heading: 'warning',
                                    text: 'Product is already added in wiishlist',
                                    icon: 'warning',
                                   position: 'top-right'
                                });
                                
                               }
                            }
                    })
                }
          </script>
            <script>

                function showquickview(id) {
                    
                    $.ajax({
                        type: "POST",
                        data: {
                            "_token": '{{ csrf_token() }}',
                            "id": id
                        },
                        url: "{{ route('home.quickview') }}",
                        success: function(response) {
                            console.log(response);
                            let galleries = response.data.gallery;
                            console.log(response.data.gallery)
                            let modalBodyTop  = '';
                            let modalBodyDown  = '';
                           // $.each(galleries, function(index,value) {
                              //  let active = index ? '' : 'active';
                              //  let show = index ? '' : 'show';
                                modalBodyTop += '<div class="popup-item">\
                                                    <div class="modal_tab_img">\
                                                        <a href="'+response.data.url+'">\
                                                            <img src="'+ response.data.image_src +'" alt="">\
                                                        </a>\
                                                    </div>\
                                                </div>';                
                                // modalBodyDown += '<li>\
                                //                     <a class="nav-link '+active+'" data-toggle="tab" href="#tab'+ index +'" role="tab" aria-controls="tab'+ index +'" aria-selected="false">\
                                //                         <img src="'+ value.image +'" alt="">\
                                //                     </a>\
                                //                 </li>';                
                            
                           // });
                            let modalBodyAll = '<div class="col-lg-5 col-md-5 col-sm-12">\
                                                <div class="modal_tab">\
                                                    <div class="popup_wrap">';
                            modalBodyAll += modalBodyTop;
                            modalBodyAll += '</div>\
                                            <div class="modal_tab_button">\
                                                <ul class="nav product_navactive owl-carousel" role="tablist">';
                            modalBodyAll += modalBodyDown;
                            modalBodyAll += `</ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-12" id="quickview">
                                    <div class="modal_right">
                                        <div class="modal_title mb-10">
                                            <h2 id="title"> ${response.data.seo_title} </h2>
                                        </div>
                                        <div class="modal_price mb-10">
                                            <span class="new_price" id='old'>$${response.data.old_price.toFixed(2)} </span>
                                            <span class="old_price" id='new'>$${response.data.current_price.toFixed(2)} </span>
                                        </div>
                                         <input type="hidden" id ="current_price" value="${response.data.current_price.toFixed(2)}"/>
                                         <input type="hidden" id ="old_price" value="${response.data.old_price.toFixed(2)}"/>
                                        <div class="modal_add_to_cart mb-15">
                                            <form action="#">
                                                <input min="1" max="100" step="1" value="1" type="number" onchange='onchangeqty(this.value)'>
                                                <button type="button" onclick ='add_to_cart(${response.data.id})'>add to cart</button>
                                            </form>
                                        </div>
                                        <div class="modal_description mb-15">
                                            <p>${response.data.description}</p>
                                        </div>
                                        <div class="modal_social">
                                            <h2>Share this product</h2>
                                            <ul>
                                                <li><a href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fproduct.com/"><i class="fa fa-facebook"></i></a></li>
                                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>\
                                                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>\
                                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>\
                                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>\
                                            </ul>
                                        </div>
                                    </div>
                                </div>`;
                            
                            //console.log(modalBodyAll);
                            $("#modalBody").html(modalBodyAll);
                            $("#modal_box").modal("show");
                        }
                    });

                    
                }
                /* function createproductsliderhtml()
                {
                    let html = `<div class="col-lg-5 col-md-5 col-sm-12">
                                    <div class="modal_tab" >
                                        <div class="tab-content product-details-large">
                                            <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                                                <div class="modal_tab_img">
                                                    <a href="#"><img
                                                            src="{{ asset('assets/fontend/img/product/product1.jpg') }}"
                                                            alt=""></a>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="tab2" role="tabpanel">
                                                <div class="modal_tab_img">
                                                    <a href="#"><img
                                                            src="{{ asset('assets/fontend/img/product/product2.jpg') }}"
                                                            alt=""></a>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="tab3" role="tabpanel">
                                                <div class="modal_tab_img">
                                                    <a href="#"><img
                                                            src="{{ asset('assets/fontend/img/product/product3.jpg') }}"
                                                            alt=""></a>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="tab4" role="tabpanel">
                                                <div class="modal_tab_img">
                                                    <a href="#"><img
                                                            src="{{ asset('assets/fontend/img/product/product5.jpg') }}"
                                                            alt=""></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal_tab_button" id="gallery_images">

                                            <ul class="nav product_navactive owl-carousel" role="tablist" >
                                                <li>
                                                    <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab"
                                                        aria-controls="tab1" aria-selected="false"><img
                                                            src="{{ asset('assets/fontend/img/product/product1.jpg') }}"
                                                            alt=""></a>
                                                </li>
                                                <li>
                                                    <a class="nav-link" data-toggle="tab" href="#tab2" role="tab"
                                                        aria-controls="tab2" aria-selected="false"><img
                                                            src="{{ asset('assets/fontend/img/product/product2.jpg') }}"
                                                            alt=""></a>
                                                </li>
                                                <li>
                                                    <a class="nav-link button_three" data-toggle="tab" href="#tab3"
                                                        role="tab" aria-controls="tab3" aria-selected="false"><img
                                                            src="{{ asset('assets/fontend/img/product/product3.jpg') }}"
                                                            alt=""></a>
                                                </li>
                                                <li>
                                                    <a class="nav-link" data-toggle="tab" href="#tab4" role="tab"
                                                        aria-controls="tab4" aria-selected="false"><img
                                                            src="{{ asset('assets/fontend//img/product/product5.jpg') }}"
                                                            alt=""></a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-12" id="quickview">
                                    <div class="modal_right">
                                        <div class="modal_title mb-10">
                                            <h2 id="title">Donec eu furniture</h2>
                                        </div>
                                        <div class="modal_price mb-10">
                                            <span class="new_price">$64.99</span>
                                            <span class="old_price">$78.99</span>
                                        </div>
                                        <div class="see_all">
                                            <a href="#">See all features</a>
                                        </div>
                                        <div class="modal_add_to_cart mb-15">
                                            <form action="#">
                                                <input min="0" max="100" step="2" value="1" type="number">
                                                <button type="submit">add to cart</button>
                                            </form>
                                        </div>
                                        <div class="modal_description mb-15">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                                veniam,</p>
                                        </div>
                                        <div class="modal_social">
                                            <h2>Share this product</h2>
                                            <ul>
                                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>`;
                    return html;
                } */

               
            </script>
             <script>
        $(document).ready(function()
        {
            upadatecartwithuserid();
            updatecompairlist();
        });
        async function updatecompairlist()
        {
            let result = await $.ajax({
                  url:"{{route('compair.list.update')}}",
                  type:"Post",
                  data:{
                    "_token": '{{ csrf_token() }}',
                  }

              });
              console.log(result);
        }
        async function upadatecartwithuserid()
        {
            try{
              let result = await $.ajax({
                  url:"{{route('update.user.cart')}}",
                  type:"Post",
                  data:{
                    "_token": '{{ csrf_token() }}',
                  }

              });
             
              if(result.stat == true)
              {
                var html = '';
                    var subtotal = 0;
                    var subwithqty = 1;
                     $("#cart_count").text(result.cartdetails.length);
                     html +=`<div class="cart-bx">`;
                    $.each(result.cartdetails, function(index, value) {
                        subwithqty = parseFloat(value.price) * parseFloat(value.qty);
                        subtotal = parseFloat(subtotal) + parseFloat(subwithqty);
                        html += `<div class="cart_item" id="cart_${value.id}">
                                   <div class="cart_img">
                                       <a href="#"><img src="${value.image_src}" alt=""></a>
                                   </div>
                                    <div class="cart_info">
                                        <a href="#">${value.seo_title}</a>
                                        <span class="quantity">Qty: ${value.qty}</span>
                                        <span class="price_cart">$ ${value.price.toFixed(2)}</span>
                                    </div>
                                    <div class="cart_remove">
                                        <a href="javascript:removecart(${value.id})"><i class="ion-android-close"></i></a>
                                    </div>
                                </div>`;
                    });
                    html +=`</div>`;
                    $("#total_price").text("$ " + subtotal.toFixed(2));
                    if (result.cartdetails.length > 0) {
                        html += `<div class="cart_total">
                                    <span>Subtotal:</span>
                                    <span id ="total_price">$ ${subtotal.toFixed(2)}</span>
                                </div> 
                               
                                <div class="mini_cart_footer">
                                   <div class="cart_button view_cart">
                                        <a href="{{ route('user.cart') }}">View cart</a>
                                    </div>
                                    <div class="cart_button checkout">
                                        <a class="active" href="{{route('checkout')}}">Checkout</a>
                                    </div>

                                </div>`;
                    }

                    $("#cart").html(html);
              }
            }
            catch(error)
            {
             console.log(error)
            }
        }
        async function removecart(id) {
            try {
                const result = await $.ajax({
                    url: "{{ route('remove.cart') }}",
                    type: 'post',
                    data: {
                        "_token": '{{ csrf_token() }}',
                        'cart_id': id
                    },
                })
                console.log(result);
                if (result.status == true) {
                    $("#cart_" + id).remove();
                    $(".cart_"+ id).remove();
                    if(result.cartdetails.length == 0)
                    {
                        $("#clear_cart").remove();
                    }
                    
                  //  let cartcal = $("#count_cart").val();
                    //let subcal = Number(cartcal) - 1;
                   // $("#count_cart").val(subcal);
                    $("#cart_count").text(result.cartdetails.length);

                    var html = '';
                    var subtotal = 0;
                    var subwithqty = 1;
                    html +=`<div class="cart-bx">`;
                    $.each(result.cartdetails, function(index, value) {
                       
                        subwithqty = parseFloat(value.price) * parseFloat(value.qty);
                        subtotal =   Math.abs(parseFloat(subwithqty) - parseFloat(subtotal));

                        html += `<div class="cart_item" id="cart_${value.id}">
                                   <div class="cart_img">
                                       <a href="#"><img src="${value.image_src}" alt=""></a>
                                   </div>
                                    <div class="cart_info">
                                        <a href="#">${value.seo_title}</a>
                                        <span class="quantity">Qty: ${value.qty}</span>
                                        <span class="price_cart">$ ${value.price.toFixed(2)}</span>
                                    </div>
                                    <div class="cart_remove">
                                        <a href="javascript:removecart(${value.id})"><i class="ion-android-close"></i></a>
                                    </div>
                                </div>`;
                    });
                    html +=`</div>`;
                    $("#total_price").text("$ " + subtotal.toFixed(2));
                    if (result.cartdetails.length > 0) {
                        html += `<div class="cart_total">
                                    <span>Subtotal:</span>
                                    <span id ="total_price">$ ${subtotal.toFixed(2)}</span>
                                </div> 
                               
                                <div class="mini_cart_footer">
                                   <div class="cart_button view_cart">
                                        <a href="{{ route('user.cart') }}">View cart</a>
                                    </div>
                                    <div class="cart_button checkout">
                                        <a class="active" href="{{route('checkout')}}">Checkout</a>
                                    </div>

                                </div>`;
                    }

                    $("#cart").html(html);
                    $(".cart_"+id).removeClass('added_btn');
                    $(".cart_"+id).attr("title",'Add to Cart');
                    
                }

            } catch (error) {
                console.log(error)
            }
        }
    </script>
    <script type="text/javascript">
        
           function add_to_cart(p_id, w_id = null) {
            $.ajax({
                type: "POST",
                data: {
                    "_token": '{{ csrf_token() }}',
                    "p_id": p_id
                },
                url: "{{ route('add.cart') }}",
                beforeSend: function() {
                    // run_waitMe_body('text')
                },
                success: function(response) {
                    
                     $.toast({
                        heading: 'success',
                        text: response.message,
                        icon: 'success',
                        position: 'top-right'
                    });
                   
                    if (w_id != null) {
                        let wish_current = $("#wiscount").val();
                        let calwish = Number(wish_current) - 1;
                        $("#wiscount").val(calwish);
                        $("#wishlistcount").text(calwish);
                    }
                    if (response.stat == true) {
                        $("#remove_" + w_id).remove();
                        //$("#cart_" + id).addClass('addcart');
                        console.log(response)
                        if (response.number_of_wish == 1)
                        {
                           $("#clear_wish").remove();
                        }
                        var html = '';
                        var subtotal = 0;
                        var subwithqty = 1;
                        $("#cart_count").text(response.cartdetails.length);
                        html +=`<div class="cart-bx">`;
                        $.each(response.cartdetails, function(index, value) {
                            subwithqty = parseFloat(value.price) * parseFloat(value.qty);
                            subtotal = parseFloat(subtotal) + parseFloat(subwithqty);
                           
                            html += `<div class="cart_item" id="cart_${value.id}">
                                   <div class="cart_img">
                                       <a href="#"><img src="${value.image_src}" alt=""></a>
                                   </div>
                                    <div class="cart_info">
                                        <a href="#">${value.seo_title}</a>
                                        <span class="quantity">Qty: ${value.qty}</span>
                                        <span class="price_cart">$ ${value.price.toFixed(2)}</span>
                                    </div>
                                    <div class="cart_remove">
                                        <a href="javascript:removecart(${value.id})"><i class="ion-android-close"></i></a>
                                    </div>
                                </div>`;
                        });
                        html +=`</div>`;
                        $("#total_price").text("$ " + subtotal.toFixed(2));
                        html += `<div class="cart_total">
                                    <span>Subtotal:</span>
                                    <span id ="total_price">$ ${subtotal.toFixed(2)}</span>
                                </div> 
                               
                                <div class="mini_cart_footer">
                                   <div class="cart_button view_cart">
                                        <a href="{{ route('user.cart') }}">View cart</a>
                                    </div>
                                    <div class="cart_button checkout">
                                        <a class="active" href="{{route('checkout')}}">Checkout</a>
                                    </div>

                                </div>`;

                        $("#cart").html(html);
                        $('.mini_cart').addClass("active");
                        $(".cart_"+p_id).addClass('added_btn');
                        $(".cart_"+p_id).attr("title",'Go to Cart');
                    }

                }
            });
        }

       async function compair(product_id)
        {
            try
            {
               const result = await $.ajax({
                url: "{{ route('compair.add') }}",
                type: 'post',
                data: {
                    "_token": '{{ csrf_token() }}',
                    'product_id': product_id
                }
               });
               if(result.stat == true)
               {
                $(".compare_"+product_id).addClass('added_btn');
                $(".compare_"+product_id).attr('title','Compared');
                   $.toast({
                        heading: 'success',
                        text: result.message,
                        icon: 'success',
                        position: 'top-right'
                    });

                    
               }
               else
               {
                 $.toast({
                        heading: 'error',
                        text: result.message,
                        icon: 'error',
                        position: 'top-right'
                    });
               }
            }
            catch(error)
            {
                console.log(error)
            }
         
        }
    </script>
</body>

</html>
