
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
                        <span>Loadin....</span>
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
    var count = 1;
    function createHtml(data)
    {
        
       var html = ``;
       $.each(data.data,function(index,value){
         if(value)
         {
        html += `<div class="col-lg-3 col-md-4 col-sm-6">
                        
                        <div class="single_product">
                            <div class="product_thumb">
                                <a class="primary_img" href="${value.detailUrl}"><img src="${value.image_src}" alt="${value.seo_title}"></a>
                                {{-- <div class="quick_button">
                                    <a  href="javascript:void(0)" > quick view</a>
                                </div> --}}
                            </div>
                            <div class="product_content">
                                <div class="tag_cate">
                                    <!-- <a href="#">Clothing,</a> -->
                                    <a href="${value.detailUrl}" >${value.seo_title}</a>
                                </div>
                                <h3><a href="${value.detailUrl}">${value.type}</a></h3>
                                <div class="price_box">
                                    <span class="old_price"> ${value.old_price}</span>
                                    <span class="current_price"> ${value.current_price}</span>
                                </div>
                                <div class="product_hover">
                                    <div class="product_ratings">
                                        
                                    </div>
                                    <div class="product_desc">
                                        <p>${(value.short_description==null)?'':value.short_description}</p>
                                    </div>
                                    <div class="action_links">
                            
                                           <ul>
                                            <li><a href="javascript:addwishlist(${value.id})"  title="${(value.product_wish_list_count > 0) ? 'Added to Wishlist':'Add Wishlist'}" class="${(value.product_wish_list_count > 0) ? 'added_btn':''} wish_${value.id}"><span
                                                                    class="icon icon-Heart"></span></a></li>
                                                        <li  class="add_to_cart "><a  class="${(value.isCart > 0) ? 'added_btn' : ''} cart_${value.id}" href="javascript:add_to_cart(${value.id})"  title="${(value.isCart > 0) ? 'Go to Cart':'Add to cart'}">add to 
                                                                cart</a></li>
                                                        <li><a href="javascript:compair(${value.id})"  title="${(value.isCompare > 0) ? 'Compared' :'Compare'}" class="${(value.isCompare > 0) ? 'added_btn' :''} compare_${value.isCompare}"><i
                                                                    class="ion-ios-settings-strong"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> `;
                }
       });
       
      
       $("#products").html(html);
       var pagination = `<ul>`;
       var start = 1;
       var end = data.num_of_pages;
       if(count > 1){
        pagination +=`<li><a href="javascript:getPagedata(${start})">&lt;&lt;</a></li>`;
       }
       if(count > 1)
       {
        pagination +=`<li class="next"><a href="javascript:getPagedata(${count - 1})">Prev</a></li>`
       }
       if(count > end)
       {
         count = count;
       }
       else
       {
        count = count + 1;
       }
       for(let i = count-1; i< count; i++)
       {
        pagination +=` <li id="paging_${i}" class=${(count==i)?'current':''}><a href="javascript:void(0)" onclick="getPagedata(${i})">${i}</a></li>`;
       }
       if(end > 1 && count< end)
       {
        pagination +=`<li class="next"><a href="javascript:getPagedata(${count + 1})">next</a></li><li><a href="javascript:getPagedata(${end})">&gt;&gt;</a></li></ul></div>`;
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
        count = page_no;
        createHtml(response)
        }
        catch(error){
            console.log(error)
        }
     
    }
</script>
@endsection



    
