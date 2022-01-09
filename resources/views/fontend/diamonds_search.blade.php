@extends('layouts.app')
@section('title')
Diamond Search 
@endsection
@php $price_range = pricefilterrange(); @endphp
@section('content')

<div class="error_section">
    <div class="container">   
        <div class="row delsec">
            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                <div class="quck_check">
                    <label class="i360">
                        <input type="checkbox" id="isThreesixty">
                        <span><img src="{{asset('assets/fontend/img/icon/360.png')}}" style="width: 40px;"> Available</span>
                        
                    </label>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                <div class="quck_check">
                    <label class="truck">
                        <input type="checkbox">
                        <span><img src="{{asset('assets/fontend/img/icon/truck.png')}}" style="width: 40px;">View Delevery</span>
                    </label>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                <div class="reset_btn d-flex justify-content-end">
                   <input type="reset" value="Reset Filter" onclick="window.location.reload()">
                </div>
            </div>
        </div>
        <div class="row mt-5 border-bottom pt-4 pb-4 show_parent">
            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                <div class="shape_fld">
                    <label>Shape</label>
                    <div class="select_diamond d-flex justify-content-between flex-wrap">
                        @foreach ($shape as $shapes)
                        <div class="indi_select">
                            <label>
                                <input type="checkbox" onclick="shape({{$shapes->id}},this)">
                                <span><span>{{$shapes->name}}</span><span></span></span>
                            </label>
                        </div>
                        @endforeach
                        
                    
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                <div class="range_fld">
                    <label>Price</label>
                    <div class="range_blk mt-3">
                        <fieldset class="filter-price">
                            <div class="price-wrap">
                                <div class="price-wrap-1 mb-2">
                                <label for="one">Rs</label>
                                <input id="one">
                                
                                </div>
                                <div class="price-wrap_line">-</div>
                                <div class="price-wrap-2">
                                <label for="two">Rs</label>
                                <input id="two">
                                
                                </div>
                            </div>
                            <div class="price-field">
                            <input type="range"  min="{{$price_range['min']}}" max="{{$price_range['max']}}" value="{{$price_range['min']}}" id="lower" onchange="price()"/>
                            <input type="range"  min="{{$price_range['min']}}" max="{{$price_range['max']}}" value="{{$price_range['max']}}" id="upper" onchange="price()"/>
                            </div>
                            
                        </fieldset> 
                    </div>
                </div>
            </div>            
            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                <div class="range_fld">
                    <label>Carat</label>
                    <div class="range_blk mt-3">
                        <fieldset class="filter-price">
                            <div class="price-wrap">
                                <!-- <span class="price-title">FILTER</span> -->
                                <div class="price-wrap-1 mb-2">
                                <!-- <label for="one1">Rs</label> -->
                                <input id="one1">
                                
                                </div>
                                <div class="price-wrap_line">-</div>
                                <div class="price-wrap-2">
                                <!-- <label for="two1">Rs</label> -->
                                <input id="two1">
                                
                                </div>
                            </div>
                            <div class="price-field">
                            <input type="range"  min="1" max="100" value="1" id="lower1" onchange="carat()">
                            <input type="range" min="1" max="100" value="100" id="upper1" onchange="carat()">
                            </div>
                            
                        </fieldset> 
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                <div class="cutbox">
                    <div class="slider-box">
                      
                        <label for="priceRange">Cut</label>
                        <input type="text" id="priceRange" readonly>
                        <div id="price-range" class="slider"></div>
                        <div class="cut_box_main">
                            <div class="cut_box"></div>
                            <div class="cut_box"></div>
                            <div class="cut_box"></div>
                            <div class="cut_box"></div>
                        </div>                                
                    </div>
                  </div>
            </div>
           <!--  <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                <div class="cutbox">
                    <div class="slider-box">
                        <label for="priceRange1">Color</label>
                        <input type="text" id="priceRange1" readonly>
                        <div id="price-range1" class="slider"></div>
                        <div class="cut_box_main">
                            <div class="cut_box1"></div>
                            <div class="cut_box1"></div>
                            <div class="cut_box1"></div>
                            <div class="cut_box1"></div>
                            <div class="cut_box1"></div>
                            <div class="cut_box1"></div>
                            <div class="cut_box1"></div>
                            <div class="cut_box1"></div>
                        </div>                                
                    </div>
                </div>
            </div> -->
            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                <div class="cutbox">
                    <div class="slider-box">
                        <label for="priceRange2">Clarity</label>
                        <input type="text" id="priceRange2" readonly>
                        <div id="price-range2" class="slider"></div>
                        <div class="cut_box_main">
                            <div class="cut_box1"></div>
                            <div class="cut_box1"></div>
                            <div class="cut_box1"></div>
                            <div class="cut_box1"></div>
                            <div class="cut_box1"></div>
                            <div class="cut_box1"></div>
                            <div class="cut_box1"></div>
                            <div class="cut_box1"></div>
                        </div>                                
                    </div>
                  </div>
            </div>
            <!-- <div class="showHide_btn">
                <button class="followbtn">More Filters</button>
            </div> -->
        </div>
        <div class="more_filter_blk">
            <div class="showHide_btn">
                <button class="followbtn">More Filters</button>
            </div>
        <div class="show_hide_blk">
            <div class="row pt-4 pb-4">
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="cutbox">
                        <div class="slider-box">
                            <label for="priceRange3">Polish</label>
                            <input type="text" id="priceRange3" readonly>
                            <div id="price-range3" class="slider"></div>
                            <div class="cut_box_main">
                                <div class="cut_box3"></div>
                                <div class="cut_box3"></div>
                                <div class="cut_box3"></div>                                        
                            </div>
                        </div>                                    
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="cutbox">                                
                        <div class="slider-box">
                            <label for="priceRange4">Symnetry</label>
                            <input type="text" id="priceRange4" readonly>
                            <div id="price-range4" class="slider"></div>
                            <div class="cut_box_main">
                                <div class="cut_box3"></div>
                                <div class="cut_box3"></div>
                                <div class="cut_box3"></div>                                        
                            </div>                                    
                        </div>
                      </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="cutbox">
                        <div class="slider-box">
                            <label for="priceRange5">Fluorescence</label>
                            <input type="text" id="priceRange5" readonly>
                            <div id="price-range5" class="slider"></div>
                            <div class="cut_box_main">
                                <div class="cut_box5"></div>
                                <div class="cut_box5"></div>
                                <div class="cut_box5"></div>
                                <div class="cut_box5"></div>
                                <div class="cut_box5"></div>                                        
                            </div>                                    
                        </div>
                      </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="range_fld">
                        <label>Depth %</label>
                        <div class="range_blk mt-3">
                            <fieldset class="filter-price">
                                <div class="price-wrap">
                                    <!-- <span class="price-title">FILTER</span> -->
                                    <div class="price-wrap-1 mb-2">
                                    
                                    <input id="one2">
                                    <label for="one2">%</label>
                                    </div>
                                    <div class="price-wrap_line">-</div>
                                    <div class="price-wrap-2">
                                    
                                    <input id="two2">
                                    <label for="two2">%</label>
                                    
                                    </div>
                                </div>
                                <div class="price-field">
                                <input type="range"  min="0" max="100" value="1" id="lower2" onchange="dept()">
                                <input type="range" min="0" max="100" value="100" id="upper2"  onchange="dept()">
                                </div>
                                
                            </fieldset> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="table_block">           
            <div class="row mt-5">
                <div class="col-12 col-md-12 col-lg-12 col-sm-12">
                    <div class="shop_toolbar">
                        <div class="list_button">
                            <ul class="nav" role="tablist">
                                <li>
                                    <a class="" data-toggle="tab" href="#large" role="tab" aria-controls="large" aria-selected="false"><i class="ion-grid" ></i></a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#list" role="tab" aria-controls="list" aria-selected="true" class="active"><i class="ion-ios-list-outline"></i> </a>
                                </li>
                            </ul>
                        </div>
                        <div class="orderby_wrapper">
                            <h3>Item per page : </h3>
                            {{-- <div class="niceselect_option" >        
                                <form class="select_option" action="#" style="display: block;">         --}}
                                    <select class ="niceselect_option" name="orderby" id="short" onchange="lengthwisedata(this.value)">
                                        {{-- <option selected="" value="1">All</option> --}}
                                        <option value="30">30</option>
                                        <option value="40">40</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                       
                                    </select>
                                {{-- </form>        
                            </div>                                         --}}
                            <div class="page_amount">
                                <p id="show"></p>
                            </div>
                        </div>
                    </div>


                     <!--shop tab product start-->
                        <div class="tab-content">
                            <div class="tab-pane grid_view fade retpro bg-white p-0" id="large" role="tabpanel">
                                <div class="row" id="all">
                                    
                                </div>
                                <div class="row paginating">
                                    <div class="col-12 col-md-12 col-lg-12 col-sm-12">
                                        <div class="shop_toolbar t_bottom">
                                            <div class="pagination pagiante-custome">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane list_view fade show active" id="list" role="tabpanel">
                                <table id="responsive-data-table" class="table dt-responsive nowrap" style="width:100%">
                                    <thead id="thead">
                                       <tr>
                                          <th>Wish List</th>
                                          <th class ="order">Shape</th>
                                          <th class ="order">Price</th>
                                          <th class ="order">Color</th>
                                          <th class="order">Carat</th>
                                          <th class="order">Cut</th>
                                          <th class="order">Clarity</th>
                                          <th class="order">Polish</th>
                                          <th class="order">Symnetry</th>
                                          <th class="order">Fluorescence</th>
                                          <th class="order">Depth %</th>
                                          
                                       </tr>
                                    </thead>
                                    <tbody id ="table">
                                                                      

                                    </tbody>
                                 </table>
                                 <div class="row paginating" >
                                    <div class="col-12 col-md-12 col-lg-12 col-sm-12">
                                        <div class="shop_toolbar t_bottom mt-4">
                                            <div class="pagination pagiante-custome">
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!--shop tab product end-->
                </div>
            </div>
        </div>
    </div>
    
</div>

@include('parcials.recent')

@endsection

@section('script')
<script type="text/javascript" src="{{asset('assets/fontend/js/custom.js')}}"></script> 
<script>
   
    </script>
<script>
    async function dept(){
        let min = $("#lower2").val();
        let max = $("#upper2").val();
        let result  = await $.ajax({
        url:"{{route('price_filter')}}",
        type:"GET",
        data:{cmin:min,cmax:max,dept:'dept'},
        dataType: "json"
       
    });
     
        if(result.stat == true)
        {
            createhtmlgrid(result.data.original,true)
        }
    }
    async function attributesearch(min,max,route,attribute,heading){
   
    let result  = await $.ajax({
        url:route,
        type:"GET",
        data:{cmin:min,cmax:max,attribute:attribute},
        dataType: "json"
       
    });
     console.log(result)
        if(result.stat == true)
        {
            createhtmlgrid(result.data.original,true)
        }
    }

</script>
<script>
    $(function() {
    
    $("#price-range").slider({
      step: 25,
      range: true, 
      min:0, 
      max:100, 
      values: [0,100], 
      slide: function(event, ui)
      {
        attributesearch(ui.values[0],ui.values[1],"{{route('price_filter')}}","cut","Cut")
          $("#priceRange").val(ui.values[0] + " - " + ui.values[1]);
      }
    });
    $("#priceRange").val($("#price-range").slider("values", 0) + " - " + $("#price-range").slider("values", 1));

    $("#price-range1").slider({
        step: 12.5,
        range: true, 
        min: 0, 
        max: 100, 
        values: [0, 100], 
        slide: function(event, ui)
        {$("#priceRange1").val(ui.values[0] + " - " + ui.values[1]);}
      });
      $("#priceRange1").val($("#price-range1").slider("values", 0) + " - " + $("#price-range1").slider("values", 1));

      $("#price-range2").slider({
        step: 12.5,
        range: true, 
        min: 0, 
        max: 100, 
        values: [0, 100], 
        slide: function(event, ui)
        {
            attributesearch(ui.values[0],ui.values[1],"{{route('price_filter')}}",'clarity','Clarity')
            $("#priceRange2").val(ui.values[0] + " - " + ui.values[1]);
        }
      });
      $("#priceRange2").val($("#price-range2").slider("values", 0) + " - " + $("#price-range2").slider("values", 1));

      $("#price-range3").slider({
        step: 33.33,
        range: true, 
        min: 0, 
        max: 100, 
        values: [0, 100], 
        slide: function(event, ui)
        {
            attributesearch(ui.values[0],ui.values[1],"{{route('price_filter')}}",'polish','Polish')
            $("#priceRange3").val(ui.values[0] + " - " + ui.values[1]);
        }
      });
      $("#priceRange3").val($("#price-range3").slider("values", 0) + " - " + $("#price-range3").slider("values", 1));

      $("#price-range4").slider({
        step: 33.33,
        range: true, 
        min: 0, 
        max: 100, 
        values: [0, 100], 
        slide: function(event, ui)
        {
            attributesearch(ui.values[0],ui.values[1],"{{route('price_filter')}}","symnetry",'Symnetry')
            $("#priceRange4").val(ui.values[0] + " - " + ui.values[1]);
        }
      });
      $("#priceRange4").val($("#price-range4").slider("values", 0) + " - " + $("#price-range4").slider("values", 1));

      $("#price-range5").slider({
        step: 20,
        range: true, 
        min: 0, 
        max: 100, 
        values: [0, 100], 
        slide: function(event, ui)
        {
            attributesearch(ui.values[0],ui.values[1],"{{route('price_filter')}}",'fluorescence','Fluorescence')
            $("#priceRange5").val(ui.values[0] + " - " + ui.values[1]);
        }
      });
      $("#priceRange5").val($("#price-range5").slider("values", 0) + " - " + $("#price-range5").slider("values", 1));
    
  });
    </script>

    <script>
        $(document).ready(function(){
            $("#isThreesixty").click(function(){
                let isThreeSixty = this.checked ? 1 : 0;
                 getThreeSixtyData(isThreeSixty)
            })
        })
        async function getThreeSixtyData(isThreesixty) {
          try {
              let url = "{{url('threesixty/products')}}/"+isThreesixty
             const response = await $.ajax({
                 url:url,
                 type:'Get',
             });
           //  console.log(response.data.original.data);
             createhtmlgrid(response.data.original,true)
          }
          catch(err){
              console.log(err)
          }
        }
    </script>
<script>
    var shapes = [];
    async function shape(s_id,check)
    {
        console.log(check.checked)
          shapes.push(s_id);
            if(check.checked == true){
            let result  = await $.ajax({
            url:"{{route('price_filter')}}",
            type:"GET",
            data:{
            shapes:shapes,
            shape:"shape"
            },
            dataType: "json"
       
         });
            createhtmlgrid(result.data.original,true)
        }else{
             shapes = [];
          
            let result  = await $.ajax({
            url:"{{route('price_filter')}}",
            type:"GET",
            data:{
            shapes:shapes,
            shape:"shape"
            },
            dataType: "json"
       
         });
             createhtmlgrid(result.data.original,false)
        }
       
       
     
     
    }
var order = 0;

$(".order").click(function(){
    if(order > 0)
  {
      order --;
  }
  else
  {
    order ++;
  }
  oderfilter(order);
  
});
async function oderfilter(order)
{
    let result  = await $.ajax({
        url:"{{route('price_filter')}}",
        type:"GET",
        data:{order:order,sort:'sort'},
        dataType: "json"
       
    });
    if(result.stat == true)
    {
        createhtmlgrid(result.data.original,false)
    }
}
async function price()
{
    let lower  = $("#lower").val();
    let maximum =$('#upper').val();
    let result  = await $.ajax({
        url:"{{route('price_filter')}}",
        type:"GET",
        data:{min:lower,max:maximum,price:'price'},
        dataType: "json"
       
    });

    if(result.stat == true){
       
        createhtmlgrid(result.data.original,true)
    }
   
    
    

}

async function carat()
{
    let min  = $("#lower1").val();
    let max  =$("#upper1").val();
   
    let result  = await $.ajax({
        url:"{{route('price_filter')}}",
        type:"GET",
        data:{cmin:min,cmax:max,carat:'carat'},
        dataType: "json"
       
    });
   
   if(result.stat == true)
   {
    
    createhtmlgrid(result.data.original,true)
   }
}



    
async function lengthwisedata(id)
{
    let result  = await $.ajax({
        url:"{{route('page.length')}}",
        type:"GET",
        data:{page_length:id},
        dataType: "json"
       
    });
    if(result.stat == true)
    {
        createhtmlgrid(result)
    }
    console.log(result)
}
$(document).ready(function () {
          
    loaddata();
});
async function loaddata()
{
    let result  = await $.ajax({
        url:"{{route('all.product')}}",
        type:"GET",
        dataType: "json"
       
    });
    if(result.stat == true)
    {
        console.log(result)
        createhtmlgrid(result)
    }
   
    
}
var count = 1;
function createhtmlgrid(result,flag = false)
{
    var html =``;
    let data = result['data'];
    $("#show").text(`All Diamonds(${result.maxprice})`)
$.each(data, function(index, value) {

    html += `<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="single_product">
            <div class="product_thumb">
                <a class="primary_img" href="${value.product_details}"><img src="${value.image_src}" alt=""></a>
                <a class="secondary_img" href="${value.product_details}"><img src="${value.image_src}" alt=""></a>
                <div class="quick_button">
                    <a href="#" onclick="showquickview(${value.id})"> quick view</a>
                </div>
            </div>
            <div class="product_content">
                <div class="tag_cate">
                    
                    <a href="#">${value.type}</a>
                </div>
                <h3><a href="${value.product_details}">${value.title}</a></h3>
                <div class="price_box">
                    <span class="old_price">$${value.old_price}</span>
                    <span class="current_price">$${value.price}</span>
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
                        <p>${value.seo_description}</p>
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
    </div>`;


  
});

$("#all").html(html);

var table = '';
$.each(data,function(index,value){

});

$.each(data,function(index,value){
    var td = '';
   // if(value.attributes.length > 0)
   // {
   //     for(let i =0; i<value.attributes.length; i++)
   //     {
   //        td +=`<td>${value.attributes[i].attribute_values}</td>`
   //     }
   // }
   

  table +=`<tr>
            <th scope="row"><label class="wishList_call ${(value.isWishlist == true)?'active':''}"><input type="checkbox"  onclick='addwishlist(${value.id})'><span></span></label></th>
                <td>${(!value.shape)?'N/A': `<a href='${value.shape_url}'><img src='${value.slogo}' height="20" width="20"/> ${value.shape}`}</a></td>
                <td>$ <a href='${value.product_url}'>${value.price}</a></td>
                <td>${(!value.color)?'N/A':`<a href='${value.product_url}'>${value.color}</a>`}</td>
                <td>${(!value.attributes[0])?'N/A':`<a href='${value.product_url}'>${value.attributes[0].attribute_values}</a>`}</td>
                <td>${(!value.attributes[1])?'N/A':`<a href='${value.product_url}'>${value.attributes[1].attribute_values}</a>`}</td>
                <td>${(!value.attributes[2])?'N/A':`<a href='${value.product_url}'>${value.attributes[2].attribute_values}</a>`}</td>
                <td>${(!value.attributes[3])?'N/A':`<a href='${value.product_url}'>${value.attributes[3].attribute_values}</a>`}</td>
                <td>${(!value.attributes[4])?'N/A':`<a href='${value.product_url}'>${value.attributes[4].attribute_values}</a>`}</td>
                <td>${(!value.attributes[5])?'N/A':`<a href='${value.product_url}'>${value.attributes[5].attribute_values}</a>`}</td>
                <td>${(!value.attributes[6])?'N/A':`<a href='${value.product_url}'>${value.attributes[6].attribute_values}</a>`}</td>
             
            </tr>`;
    });
    $("#table").html(table);


var start = 1;
var end = result.total_pages;

var pagination = `<div class="pagination">
                   <ul>`;
if(count > 1)
{
    pagination +=`<li><a href="javascript:paginelink(${start})">&lt;&lt;</a></li>`;
}

if(count > 1)
{
    pagination +=`<li class="next"><a href="javascript:paginelink(${count - 1})">Prev</a></li>`;
}
for(let i = count; i <= count; i++)
{
      
    pagination +=`<li id ="paging_${i}" class =${(count == i)?"current":''}><a  href="javascript:paginelink(${i})">${i}</a></li>`;   
   
}
if(end > 1 && count < end)
{
    pagination +=`<li class="next"><a href="javascript:paginelink(${count + 1})">next</a></li><li><a href="javascript:paginelink(${end})">&gt;&gt;</a></li></ul></div>`;
}
    if(flag == false)
    {
        $(".pagiante-custome").html(pagination);
        //$(".pagiante-custome").show();
        $(".paginating").show();
    }
    else{
      //  $(".pagiante-custome").hide();
        $(".paginating").hide();
    }
}
async function paginelink(page)
{
    let page_length = $('#short').val();
    
    let result  = await $.ajax({
        url:"{{route('page')}}",
        type:"GET",
        data:{page:page,length:page_length},
       
       
    });
    if(result.stat == true)
    {
        count = page;
        createhtmlgrid(result.data.original)
    }
}
</script>


@endsection 


