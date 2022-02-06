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
                            <li>{{$local[0]->Diamond_Type}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>         
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css" />    
   
    <div class="product_details">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="product-details-tab">
                        <div id="img-1" class="zoomWrapper single-zoom">
                            <a href="javascript:void(0)">
                                <img id="zoom1" src="{{$local[0]->ImageLink}}" data-zoom-image="{{$local[0]->ImageLink}}" alt="{{$local[0]->Diamond_Type}}">
                            </a>
                        </div>
                        @if($local[0]->Video_HTML)
                        <a href="{{$local[0]->Video_HTML}}"class="popup-youtube">
                        <div class="degview modal-toggle"  data-bs-toggle="modal" data-bs-target="#">
                            <svg width="56" height="52" viewBox="0 0 56 52" xmlns="http://www.w3.org/2000/svg"><path d="M51.2844216 27.5833333c-.8200053 13.2346296-11.8474429 23.75-25.2844216 23.75C12.0313333 51.3333333.66666667 39.9693333.66666667 26 .66666667 12.0313333 12.0313333.66666667 26 .66666667c9.0268426 0 16.9629025 4.74760088 21.4501124 11.87500003h-2.3015855v.1457148C40.9293141 6.63553714 33.9204528 2.66666667 26 2.66666667 13.134 2.66666667 2.66666667 13.1346667 2.66666667 26 2.66666667 38.866 13.134 49.3333333 26 49.3333333c12.3339298 0 22.4634832-9.6194868 23.2801998-21.75h2.0042218zm-1.8831439-4.7818367l3.9091504-4.7875689-.5797573-.9661982h-6.6587863l-.5797572.9661982 3.9091504 4.7875689zm0 2.5206275l-6.3997575-7.5738894 1.4692383-2.3661106h9.8610383l1.4692383 2.3661106-6.3997574 7.5738894zM40.3393333 26.526c0-2.8566667-.936-4.9693333-2.9046666-4.9693333C35.49 21.5566667 34.53 23.6693333 34.53 26.526c0 2.858.96 4.9706667 2.9046667 4.9706667 1.9686666 0 2.9046666-2.1126667 2.9046666-4.9706667zm2.8086667 0c0 3.8653333-1.968 7.2506667-5.7613333 7.2506667-3.7693334 0-5.666-3.3853334-5.666-7.2506667 0-3.8886667 1.9926666-7.2253333 5.762-7.2253333C41.252 19.3006667 43.148 22.6373333 43.148 26.526zM22.31 29.024c0 1.464.9606667 2.592 2.3286667 2.592 1.4886666 0 2.3046666-1.2006667 2.3046666-2.5686667 0-1.5126666-.864-2.5686666-2.2326666-2.5686666-1.512 0-2.4006667.9366666-2.4006667 2.5453333zm.6486667-3.6973333c.648-.528 1.416-.7926667 2.3766666-.7926667C28.024 24.534 29.584 26.526 29.584 28.9033333c0 2.3766667-1.776 4.8733334-4.9453333 4.8733334-3.0246667 0-4.9933334-2.1846667-4.9933334-5.0653334C19.6453333 25.23 21.71 21.7486667 27.52 18.868l1.128 2.1126667c-2.5686667 1.2006666-4.6573333 2.6413333-5.6893333 4.346zm-5.3533334-4.49l-4.2013333 4.514c2.9046667.312 4.1293333 1.872 4.1293333 3.9366666 0 2.3526667-1.9926666 4.4893334-5.2093333 4.4893334-1.4646667 0-2.64133333-.264-3.81733333-.648l.624-2.2566667c1.08066663.36 2.04066663.528 3.00133333.528 1.608 0 2.6646667-.744 2.6646667-2.0646667 0-1.2246666-1.0086667-2.0406666-3.0493334-2.0406666-.624 0-1.152.024-1.7046666.1446666l-.40800003-.9366666L13.812 21.8933333H8.72266667v-2.3526666h8.83466663l.048 1.296z" fill="#100E31" fill-rule="evenodd"></path></svg>
                        </div> 
                    </a>


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
                              
                                <!-- Add script tag with CDN link to js-cloudimage-360-view lib after all content in body tag -->
                                <script src="https://cdn.scaleflex.it/plugins/js-cloudimage-360-view/2/js-cloudimage-360-view.min.js"></script>
                               
                                    <iframe src="{{$local[0]->Video_HTML}}" width="100%" height="300" style="border:none;">
                                    </iframe>
                              </div>
                            </div>
                          </div>
                        </div>

                         


                        <div class="single-zoom-thumb">
                            <ul class="s-tab-zoom owl-carousel single-product-active" id="gallery_01">
                               
                                <li>
                                    <a href="javascript:void(0)" class="elevatezoom-gallery active" data-update="" data-image="{{$local[0]->ImageLink}}" data-zoom-image="{{$local[0]->ImageLink}}">
                                        <img src="{{$local[0]->ImageLink}}" alt="{{$local[0]->Diamond_Type}}"/>
                                    </a>

                                </li>
                             
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="product_d_right">
                    <form >
                        
                            <h1>{{$local[0]->Diamond_Type}}</h1>
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
                          
                            <div class="product_price">
                                <span class="old_price" id="old">${{number_format($local[0]->Memo_Price,2)}}</span>
                                <span class="current_price" id="new">${{number_format($local[0]->Buy_Price,2)}}</span>
                                
                            </div>
                           
                            <div class="product_meta">
                                <span>Category: <a href="javascript:void(0)">{{$local[0]->Diamond_Type}}</a></span>
                            </div>                                
                        </form>
                        

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
                            </ul>
                        </div>
                        <div class="tab-content">
                           <div class="tab-pane fade show active" id="info" role="tabpanel" >
                                 
                                <div class="proinfo">
                                    <h3>Diamond Details</h3>
                                    
                                    <table class="table table-striped">
                                        <tbody>
                                          
                                            <tr>
                                             
                                                <td>Weight</td>
                                                <td>{{$local[0]->Weight }}</td>
                                              </tr>
                                              <tr>
                                               
                                                <td>Color</td>
                                                <td>{{$local[0]->Color }}</td>
                                              </tr>
                                              <tr>
                                               
                                                <td>Clarity</td>
                                                <td>{{$local[0]->Color }}</td>
                                              </tr>

                                               <tr>
                                               
                                                <td>Cut Grade</td>
                                                <td>{{$local[0]->Cut_Grade }}</td>
                                              </tr>
                                               <tr>
                                                
                                                <td>Polish</td>
                                                <td>{{$local[0]->Polish }}</td>
                                              </tr>
                                              <tr>
                                              
                                                <td>Symmetry</td>
                                                <td>{{$local[0]->Symmetry }}</td>
                                              </tr>
                                               <tr>
                                                <td>Shape</td>
                                                <td>{{$local[0]->Shape }}</td>
                                              </tr>
                                        </tbody>
                                      </table>
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
<script>
  $(function() {
      $('.popup-youtube, .popup-vimeo').magnificPopup({
          disableOn: 700,
          type: 'iframe',
          mainClass: 'mfp-fade',
          removalDelay: 160,
          preloader: false,
          fixedContentPos: false
      });
  });
  </script>
@endsection