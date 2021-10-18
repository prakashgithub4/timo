
@extends('layouts.app')
@section('title')
Product List
@endsection
@section('content')
  
    <div class="shop_area shop_fullwidth shop_reverse section retpro bg-white">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    
                    <div class="row" id ="products">  
                                         
                    </div>
                    <div class="shop_toolbar t_bottom">
                        <div class="pagination">
                           
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
@section('script')
<script>
    $(document).ready(function(){
        showall();
    })
    async function showall()
    {
        try{
            const response = await $.ajax({
            url:'{{route('product.ajax.list')}}',
            type:'GET'
        });
        console.log(response);
        createHtml(response)
        }
        catch(error){
            console.log(error)
        }
       
       
    }
    function createHtml(data)
    {
        
       var html = ``;
       $.each(data.data,function(index,value){

        html += `<div class="col-lg-3 col-md-4 col-sm-6">
                        
                        <div class="single_product">
                            <div class="product_thumb">
                                <a class="primary_img" href="#"><img src="${value.image_src}" alt=""></a>
                                {{-- <div class="quick_button">
                                    <a  href="javascript:void(0)" > quick view</a>
                                </div> --}}
                            </div>
                            <div class="product_content">
                                <div class="tag_cate">
                                    <!-- <a href="#">Clothing,</a> -->
                                    <a href="javascript:void(0)">${value.seo_title}</a>
                                </div>
                                <h3><a href="#">${value.seo_title}</a></h3>
                                <div class="price_box">
                                    <span class="old_price">${value.old_price}</span>
                                    <span class="current_price">${value.current_price}</span>
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
                                        <p>${(value.short_description==null)?'':value.short_description}</p>
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
                    </div> `;
       });
       
      
       $("#products").html(html);
       var pagination = `<ul>`;
       for(let i = 1; i<= data.num_of_pages; i++)
       {
        pagination +=` <li><a href="javascript:void(0)" onclick="getPagedata(${i})">${i}</a></li>`;
       }
       pagination +="</ul>";
       $(".pagination").html(pagination);
       
      
    }
    async function getPagedata(page_no)
    {
        try{
            const response = await $.ajax({
            url:'{{route('product.ajax.list')}}',
            type:'GET',
            data:{page_no:page_no}
        });
        console.log(response);
        createHtml(response)
        }
        catch(error){
            console.log(error)
        }
     
    }
</script>
@endsection



    
