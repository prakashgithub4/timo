@extends('layouts.app')
@section('title')
Wishlist
@endsection
@section('content')
 <div class="breadcrumbs_area">
            <div class="container">   
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb_content">
                            <h3>Wishlist</h3>
                            <ul>
                                <li><a href="{{url('/')}}">home</a></li>
                                <li>></li>
                                <li>Wishlist</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>         
        </div>
<div class="wishlist_area">
    <div class="container">   
        <form > 
            <div class="row">
                <div class="col-12">
                    <div class="table_desc wishlist">
                        @if(count($wishlist_product)  > 0)
                        <div class="cart_page table-responsive" id ="clear_wish">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product_remove">Delete</th>
                                        <th class="product_thumb">Image</th>
                                        <th class="product_name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product_quantity">Stock Status</th>
                                        <th class="product_total">Add To Cart</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($wishlist_product as $wishlist)
                                    
                                    @php $price = price_rang($wishlist->product_id); @endphp
                                    <tr id ="remove_{{$wishlist->wislist_id}}">
                                       <td class="product_remove"><a href="javascript:removewishlist({{$wishlist->wislist_id}})">X</a></td>
                                        <td class="product_thumb"><a href="#"><img src="{{$wishlist->image_src}}" alt=""></a></td>
                                        <td class="product_name"><a href="#">{{$wishlist->seo_title}}</a></td>
                                        <td class="product-price">${{$price['current_price']}}</td>
                                        <td class="product_quantity">{{($wishlist->variant_inventory_qty >= 1) ? "In Stock":"Out of Stock"}}</td>
                                        <td class="product_total"><a href="javascript:add_to_cart({{ $wishlist->wp_id }},{{ $wishlist->wislist_id }})">Add To Cart</a></td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>   
                        </div>
                        @else
                         <center>No any product added in Wishlist </center>
                        @endif  

                    </div>
                 </div>
             </div>

        </form> 
        <div class="row">
            <div class="col-12">
                 <div class="wishlist_share">
                    <h4>Share on:</h4>
                    <ul>
                        <li><a href="javascript:void(0)"><i class="fa fa-rss"></i></a></li>           
                        <li><a href="javascript:void(0)"><i class="fa fa-vimeo"></i></a></li>           
                        <li><a href="javascript:void(0)"><i class="fa fa-tumblr"></i></a></li>           
                        <li><a href="javascript:void(0)"><i class="fa fa-pinterest"></i></a></li>        
                        <li><a href="javascript:void(0)"><i class="fa fa-linkedin"></i></a></li>        
                    </ul>      
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    function removewishlist(id)
    {
      //  var confirms = confirm("Are you sure want to delete this product?");

        swal({
              title: "Are you sure?",
              text: "Once deleted, you will not be able to recover this wishlist Product!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
        .then((willDelete) => {
          if (willDelete) {
            
                $.ajax({
                    type: "POST",
                    data: {
                        "_token": '{{ csrf_token() }}',
                        "id": id
                    },
                    url: "{{ route('wishlist.remove') }}",
                    success: function(response) 
                    {  
                        swal("Wishlist has been deleted successfully", {
                          icon: "success",
                        });
                        var wishcount = $("#wiscount").val();
                        let calwish = Number(wishcount) - 1;
                        $("#wiscount").val(calwish);
                        $("#wishlistcount").text(calwish);
                        $("#remove_"+id).remove();
                        if(response.wishlist.length == 0)
                        {
                            $("#clear_wish").remove();
                        }
                       
                    }
                });
          } else {
              console.log('done')
                
            //swal("Wishlist Product has been removed..!");
          }
        });
        // if(confirms == true)
        // {
        //     $.ajax({
        //     type: "POST",
        //     data: {
        //         "_token": '{{ csrf_token() }}',
        //         "id": id
        //     },
        //     url: "{{ route('wishlist.remove') }}",
        //     success: function(response) 
        //     {  
        //         //alert(response.message);
        //         $.toast({
        //             heading: 'Success',
        //             text: ''+response.message+'',
        //             icon: 'success'
        //            })
        //         var wishcount = $("#wiscount").val();
        //         let calwish = Number(wishcount) - 1;
        //         $("#wiscount").val(calwish);
        //         $("#wishlistcount").text(calwish);
        //         $("#remove_"+id).remove();
               
        //     }
        // });
            
        // }
    }
</script>
@endsection