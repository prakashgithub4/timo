
@extends('layouts.app')
@section('title')
Compare
@endsection
@section('content')
<div class="breadcrumbs_area">
            <div class="container">   
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb_content">
                            <h3>Compare</h3>
                            <ul>
                                <li><a href="index.html">home</a></li>
                                <li>></li>
                                <li>compare</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>         
        </div>
            <!--breadcrumbs area end-->
    
        <!-- main-content-wrap start -->
        <div class="main-content-wrap compaer-page">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <form action="#">
                            <!-- Compare Table -->
                             <div class="compare-table table-responsive">
                                <table class="table mb-0">
                                    <tbody>
                                       
                                       @if(count($compair_array['products']) > 1)
                                        <tr>
                                            <td class="first-column">{{$compair_array['products'][0]['product']}}</td>
                                              @for ($i = 1; $i < count($compair_array['products']); $i++)
                                            <td class="product-image-title">
                                                <a href="#" class="image"><img src="{{$compair_array['products'][$i]['image']}}" alt="Compare Product"></a>
                                            </td>
                                           @endfor
                                           
                                        </tr>

                                        <tr>
                                            <td class="first-column">View Details</td>
                                           @for ($i = 1; $i < count($compair_array['category']); $i++)
                                            <td class="pro-desc">
                                                <a href="#" class="category"><strong>{{$compair_array['category'][$i]['name']}}</strong></a>
                                            </td>
                                            @endfor
                                            

                                        </tr>
                                      <tr>
                                            <td class="first-column">Price</td>
                                             @for ($i = 1; $i < count($compair_array['price']); $i++)
                                            <td class="pro-price">{{$compair_array['price'][$i]['amount']}}</td>
                                           @endfor
                                        </tr>
                                        
                                        <tr>
                                            <td class="first-column">Shape</td>
                                             @for ($i = 1; $i < count($compair_array['shape']); $i++)
                                            <td class="pro-price">{{$compair_array['shape'][$i]['name']}}</td>
                                           @endfor
                                        </tr>
                                        
                                        
                                        <tr>
                                            <td class="first-column">Color</td>
                                             @for ($i = 1; $i < count($compair_array['color']); $i++)
                                            <td class="pro-price">{{$compair_array['color'][$i]['name']}}</td>
                                           @endfor
                                        </tr>
                                    
                                          
                                          @for ($i = 0; $i < count($compair_array['attribute_name']); $i++)
                                          @php $attribute_id = $compair_array['attribute_name'][$i]['attribute_id'];  @endphp
                                        <tr>
                                            <td class="first-column">{{$compair_array['attribute_name'][$i]['name']}}</td>
                                             <?php foreach($compair_array['attribute'][$attribute_id] as $key=>$item){ ?>

                                                <td class="pro-price">{{$item}}</td>
                                            <?php } ?>
                                           
                                        </tr>


                                        @endfor
                                       
                                        <tr>
                                            
                                            <td class="first-column">{{$compair_array['add_to_cart'][0]['add_to_cart']}}</td>
                                           @for ($i = 1; $i < count($compair_array['add_to_cart']); $i++)
                                            <td class="pro-addtocart"><a href="javascript:add_to_cart({{$compair_array['add_to_cart'][$i]['product_id']}})"  class="add-to-cart"  tabindex="0"><span>ADD TO CART</span></a></td>
                                            @endfor
                                           
                                        </tr>
                                        <tr>
                                            @foreach($compair_array['delete'] as $key=>$del)
                                            @if($key == 0)
                                            <td class="first-column">{{$del['delete']}}</td>
                                            @else
                                            <td class="pro-remove"><button type="button" class ="remove_compair" data ="{{$del['compaire_id']}}"><i class="fa fa-trash-o"></i></button></td>
                                            @endif
                                            @endforeach
                                        
                                        </tr>
                                        @else
                                        <tr>
                                            
                                            
                                            <td class="pro-price" colspan="2">No product available </td>
                                          
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- main-content-wrap end -->
        @endsection
        @section('script')
        <script>
           $(".remove_compair").on( "click", function() {
               let compare_id = $(this).attr('data');
               removecompare(compare_id);
             });
           async function removecompare(compare_id)
           {
              try
              {
               const response = await $.ajax({
                    url: "{{ route('compair.remove') }}",
                    type: 'post',
                    data: {
                        "_token": '{{ csrf_token() }}',
                        'compare_id': compare_id
                    },
                });
               if(response.stat == true)
               {
                 $.toast({
                        heading: 'success',
                        text: response.message,
                        icon: 'success',
                        position: 'top-right'
                    });
                 setTimeout(function(){ location.reload() }, 2000);

               }
               else
               {
                  $.toast({
                        heading: 'error',
                        text: response.message,
                        icon: 'error',
                        position: 'top-right'
                    });
               }
            }
              catch(error){
                console.log(error)
              }
           }
        </script>
        @endsection