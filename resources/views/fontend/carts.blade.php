@extends('layouts.app')
@section('title')
    Cart
@endsection
@section('content')

    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <h3>Shopping Basket</h3>
                        <ul>
                            <li><a href="{{ url('/') }}">home</a></li>
                            <li>></li>
                            <li>Shopping Basket</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="shopping_cart_area">
        <div class="container">
            <form method="POST" id="form">
                <div class="row">
                    <div class="col-12">
                        @if (count(cart_list()) > 0)
                            <div class="table_desc" id="clear_cart">

                                <div class="cart_page table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product_remove">Delete</th>
                                                <th class="product_thumb">Image</th>
                                                <th class="product_name">Product</th>
                                                <th class="product-price">Price</th>
                                                <th class="product_quantity">Quantity</th>
                                                <th class="product_total">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach (cart_list() as $carts)
                                                <tr class="cart_{{ $carts->id }}">
                                                    <input type="hidden" name="cart_id" value="{{ $carts->id }}" />
                                                    <td class="product_remove"><a
                                                            href="javascript:removecart({{ $carts->id }})"><i
                                                                class="fa fa-trash-o"></i></a></td>
                                                    <td class="product_thumb"><a href="#"><img
                                                                src="{{ $carts->image_src }}" alt=""></a></td>
                                                    <td class="product_name"><a href="#">{{ $carts->seo_title }}</a>
                                                    </td>
                                                    <td class="product-price">£{{ $carts->price }}</td>
                                                    <td class="product_quantity"><label>Quantity</label> <input min="0"
                                                            max="100" name="quantities" value="{{ $carts->qty }}"
                                                            type="number"></td>
                                                    <td class="product_total">£{{ $carts->sub_total }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="cart_submit d-flex justify-content-between">
                                    <button type="button">Continue shopping</button>
                                    <button type="button" onclick="updatcart()">update cart</button>
                                </div>
                            </div>
                        @else
                            <center>No any product added in cart list</center>
                        @endif
                    </div>
                </div>
                <!--  <section class="product_section p_bottom p_section1">
                        <div class="row">
                            <div class="col-12">
                                <div class="section_title">
                                    <h2>Cleaning Products</h2>
                                </div>
                            </div>
                <div class="col-12">
                    <div class="product_area cleaning-pro">
                        <div class="product_container bottom">
                            <div class="row">
                                <div class="col-md-3 col-lg-3 col-sm-6 col-12">
                                    <div class="single-shipping">
                                        <div class="shipping_icone icone_1">
                                            <img src="{{ asset('assets/fontend/img/product/product5.jpg') }}" alt="">
                                        </div>
                                        <div class="shipping_content cartcnt">
                                            <h3>Blue Nile Jewelry Polishing Cloth</h3>
                                            <p><strong>Price: $5.00</strong></p>
                                            <a href="#" class="btn">Add</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-lg-3 col-sm-6 col-12">
                                    <div class="single-shipping">
                                        <div class="shipping_icone icone_1">
                                            <img src="{{ asset('assets/fontend/img/product/product5.jpg') }}" alt="">
                                        </div>
                                        <div class="shipping_content cartcnt">
                                            <h3>Blue Nile Jewelry Polishing Cloth</h3>
                                            <p><strong>Price: $5.00</strong></p>
                                            <a href="#" class="btn">Add</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-lg-3 col-sm-6 col-12">
                                    <div class="single-shipping">
                                        <div class="shipping_icone icone_1">
                                            <img src="{{ asset('assets/fontend/img/product/product5.jpg') }}" alt="">
                                        </div>
                                        <div class="shipping_content cartcnt">
                                            <h3>Blue Nile Jewelry Polishing Cloth</h3>
                                            <p><strong>Price: $5.00</strong></p>
                                            <a href="#" class="btn">Add</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-lg-3 col-sm-6 col-12">
                                    <div class="single-shipping">
                                        <div class="shipping_icone icone_1">
                                            <img src="{{ asset('assets/fontend/img/product/product5.jpg') }}" alt="">
                                        </div>
                                        <div class="shipping_content cartcnt">
                                            <h3>Blue Nile Jewelry Polishing Cloth</h3>
                                            <p><strong>Price: $5.00</strong></p>
                                            <a href="#" class="btn">Add</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
                <div class="coupon_area">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="section_title">
                                <h2>Your Purchase Details</h2>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="coupon_code left mb-4">
                                <h3>Coupon</h3>
                                <div class="coupon_inner">
                                    <div class="row align-items-center">
                                        <div class="col-md-8 col-md-8 col-12">
                                            <p>Enter your coupon code if you have one.</p>
                                            <input placeholder="Coupon code" id="coupon" type="text" class="w-50">
                                            <button type="button" onclick="couponcode()">Apply coupon</button>
                                        </div>
                                        <div class="col-md-4 col-md-4 col-12">
                                            <h4 id="single-promo" class="mb-0 text-center d-block mt-4"><strong>Coupon
                                                    Price</strong>
                                                -£{{ !empty(@$coupon->discount) ? $coupon->discount : '00.0' }}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="coupon_code left">
                                <h3>Shipping Information</h3>
                                <div class="coupon_inner indet">
                                    <div class="cart_subtotal align-items-center">
                                        <div class="panel-default d-flex">
                                            <input id="payment" name="check_method" type="radio"
                                                data-target="createp_account">
                                            <label for="payment" class="pr-5">Receive on: <strong>Saturday, August
                                                    07</strong> FedEx Priority Overnight® with Saturday Delivery</label>
                                        </div>
                                        <p class="cart_amount">$20.00</p>
                                    </div>
                                    <div class="cart_subtotal">
                                        <div class="panel-default d-flex">
                                            <input id="payment" name="check_method" type="radio"
                                                data-target="createp_account">
                                            <label for="payment" class="pr-5">Receive on: <strong>Saturday, August
                                                    07</strong> FedEx Priority Overnight® with Saturday Delivery</label>
                                        </div>
                                        <p class="cart_amount">$20.00</p>
                                    </div>
                                    <div class="cart_subtotal">
                                        <div class="panel-default d-flex">
                                            <input id="payment" name="check_method" type="radio"
                                                data-target="createp_account">
                                            <label for="payment" class="pr-5">Receive on: <strong>Saturday, August
                                                    07</strong> FedEx Priority Overnight® with Saturday Delivery</label>
                                        </div>
                                        <p class="cart_amount">$20.00</p>
                                    </div>
                                    <div class="shipping-policy-link d-flex">
                                        View our <a href="#" class="d-flex border-0 pl-1 m-0"> shipping policy </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="coupon_code right">
                                <h3>Price Information</h3>
                                <div class="coupon_inner">
                                    <!-- <div class="cart_subtotal">
                                <p>Order #</p>
                                <p class="cart_amount">60416175</p>
                            </div> -->
                                    <div class="cart_subtotal">
                                        <p>Number of items</p>
                                        <p class="cart_amount">{{ empty($cart->quantities) ? '0' : $cart->quantities }}
                                        </p>
                                    </div>
                                    <div class="cart_subtotal">
                                        <p>Item total</p>
                                        <p class="cart_amount">£{{ empty($cart->total) ? '0.00' : $cart->total }}</p>
                                        <input type="hidden" id="item_total"
                                            value="{{ empty($cart->total) ? 0 : $cart->total }}" />
                                    </div>
                                    @if (isset($coupon))
                                        <div class="cart_subtotal" id="promo_static">
                                            <p>*Promo code: {{ $coupon->coupon }} <button type="button"
                                                    onclick="removecoupon({{ $coupon->id }})"
                                                    class="h-auto py-1 px-2">Remove</button>
                                            </p>
                                            <p class="cart_amount">
                                                -£{{ !empty(@$coupon->discount) ? $coupon->discount : '00.0' }}</p>

                                        </div>
                                    @endif
                                    <input type="hidden" id="coupon_amount"
                                        value="{{ !empty(@$coupon->discount) ? $coupon->discount : 0 }}" />
                                    <div class="cart_subtotal" id="promo">
                                        <input type="hidden" id='coupon_id'
                                            value="{{ isset($coupon) ? $coupon->expire_date : 0 }}" />
                                    </div>
                                    <!--  <div class="cart_subtotal ">
                                <p>Shipping</p>
                                <p class="cart_amount"><span>Flat Rate:</span> £255.00</p>
                            </div>
                            <a href="#">Calculate shipping</a> -->

                                    <div class="cart_subtotal">
                                        <p>Total</p>
                                        <p class="cart_amount" id="grand_total">£{{ empty($total) ? '0.00' : $total }}
                                        </p>
                                    </div>
                                    <div class="checkout_btn">
                                        <a href="#">Proceed to Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        async function updatcart() {
            let form = $("#form").serializeArray();
            try {
                const res = await $.ajax({
                    url: "{{ route('update.cart') }}",
                    type: 'post',
                    data: {
                        "_token": '{{ csrf_token() }}',
                        "form": form
                    }
                });
                if (res == 1) {
                    location.reload();
                }

            } catch (error) {
                console.log(error)
            }
        }

        async function couponcode() {
            let form = $("#form").serializeArray();
            let coupon = $("#coupon").val();

            try {
                const res = await $.ajax({
                    url: "{{ route('coupon.apply') }}",
                    type: 'post',
                    data: {
                        "_token": '{{ csrf_token() }}',
                        "coupon": coupon

                    }
                });

                var grandtotal = 0;
                var total = $("#item_total").val();
                var coupons = $("#coupon_amount").val();
                if (res.stat == true) {

                    if (res.data.status == 'apply') {
                        $('#promo').css({
                            "display": "block"
                        });
                        $('#promo').html(`<div class="cart_subtotal" id ="promo">
                                        <p>*Promo code: ${res.data.coupons} <button class="h-auto py-1 px-2">Remove</button></p>
                                    <p class="cart_amount">-£${res.data.discount}</p></div>`);
                        $('#single-promo').html(`<strong>Coupon Price</strong>-£${res.data.discount}`);
                        $("#coupon_amount").val(res.data.discount);
                        grandtotal = parseFloat(total) - parseFloat(coupons);
                        $("#grand_total").html(`£${grandtotal}`)
                        $.toast({
                            heading: 'success',
                            text: res.message,
                            icon: 'success',
                            position: 'top-right'
                        });
                    }

                } else if (res.data.status == 'expired') {
                    $('#promo_static').remove();
                    grandtotal = parseFloat(total);
                    $('#single-promo').html(`<strong>Coupon Price</strong>-£ 0.00`);
                    $("#grand_total").html(`£${grandtotal}`)
                    $.toast({
                        heading: 'error',
                        text: res.message,
                        icon: 'error',
                        position: 'top-right'
                    });
                } else {
                    $.toast({
                        heading: 'error',
                        text: res.message,
                        icon: 'error',
                        position: 'top-right'
                    });
                }
            } catch (error) {
                console.log(error)
            }
        }
        $(document).ready(function() {
            //checexpire()
            let coupon = $("#coupon_id").val();

            var expired = new Date(coupon)
            var edd = String(expired.getDate()).padStart(2, '0');
            var emm = String(expired.getMonth() + 1).padStart(2, '0'); //January is 0!
            var eyyyy = expired.getFullYear();
            expired = eyyyy + '/' + emm + "/" + edd

            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();
            today = yyyy + '/' + mm + "/" + dd;
           if(coupon != 0)
           {
                setInterval(function() {
                    if (expired < today) {
                        checexpire();
                    }
                }, 15 * 60 * 1000);
           }

        })
        async function checexpire(id) {

            let end_date = $("#expire_date").val();
            const res = await $.ajax({
                url: "{{ route('coupon.auto') }}",
                type: 'post',
                data: {
                    "_token": '{{ csrf_token() }}',
                    'expire_date': end_date


                }
            });
            if (res.stat == true) {
                var total = $("#item_total").val();
                $('#promo_static').remove();
                $('#single-promo').html(`<strong>Coupon Price</strong>-£ 0.00`);
                $("#grand_total").html(`£${total}`)
                $.toast({
                    heading: 'success',
                    text: res.message,
                    icon: 'success',
                    position: 'top-right'
                });
                $("#coupon_id").val(0);
            }
            // else
            // {
            //     $.toast({
            //         heading: 'error',
            //         text: res.message,
            //         icon: 'error',
            //         position: 'top-right'
            //      });
            // }

        }

        async function removecoupon(coupon_id) {
            const res = await $.ajax({
                url: "{{ route('coupon.remove') }}",
                type: 'post',
                data: {
                    "_token": '{{ csrf_token() }}',
                    coupon_id: coupon_id
                }
            });
            if (res.stat == true) {
                var total = $("#item_total").val();
                $('#promo_static').remove();
                $('#single-promo').html(`<strong>Coupon Price</strong>-£ 0.00`);
                $("#grand_total").html(`£${total}`)
                $.toast({
                    heading: 'success',
                    text: res.message,
                    icon: 'success',
                    position: 'top-right'
                });
            }

        }
    </script>
@endsection
