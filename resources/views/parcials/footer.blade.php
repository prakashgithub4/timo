@php $getfooter = footercontact(); @endphp
<footer class="footer_widgets">
    <div class="container">  
        <div class="footer_top">
            <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-8">
                        <div class="widgets_container contact_us">
                            <h3>{{$getfooter->title}}</h3>
                            <div class="footer_contact">
                                <a href="#"><img src="{{ url('public/uploads/logo/') }}/{{ $getfooter->logo }}" alt="" class="w-75 pb-4"></a>
                                {!!$getfooter->address!!}
                                <ul>
                                    @if(@$getfooter->facebook !='')
                                    <li><a href="{{$getfooter->facebook}}"><i class="fa fa-facebook"></i></a></li>
                                    @endif
                                    @if(@$getfooter->twitter !='')
                                    <li><a href="{{$getfooter->twitter}}"><i class="fa fa-twitter"></i></a></li>
                                    @endif
                                    @if(@$getfooter->google !='')
                                    <li><a href="{{$getfooter->google}}"><i class="ion-social-googleplus"></i></a></li>
                                    @endif
                                    @if(@$getfooter->youtube !='')
                                    <li><a href="{{$getfooter->youtube}}"><i class="ion-social-youtube"></i></a></li>
                                    @endif

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-4 col-6">
                        <div class="widgets_container widget_menu">
                            <h3>Information</h3>
                            <div class="footer_menu">

                               <?php  $tmp = \App\Models\Cms::whereHas('categories', function ($query) {
                                $query->where('name','=','Information');
                            })->get();
                           
                            ?>

                                <ul>
                                   {{-- <?php  foreach($tmp as $row){ ?>
                                        <li><a href="{{ url('dynamic/'. encrypt($row->id)) }}">{{$row->title}}</a></li>
                                    <?php } ?> --}}
                                    <li><a href="#">Contact Us</a></li>
                                    <li><a href="#">FAQs</a></li>
                                    <li><a href="{{ url('dynamic/'. encrypt('help-and-topics')) }}">Help Topics</a></li>
                                    <li><a href="{{ url('dynamic/'. encrypt('sell-yours-diamonds')) }}">Sell Your Diamonds</a></li>
                                    <li><a href="{{ url('dynamic/'. encrypt('refer-a-friend')) }}">Refer a Friend</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-5 col-6">
                        <div class="widgets_container widget_menu">
                            <h3>My Account</h3>
                            <div class="footer_menu">
                                <ul>
                                    <li><a href="#">My Account</a></li>
                                    <li><a href="#">Wishlist</a></li>
                                    <li><a href="#">Portfolio</a></li>
                                    <li><a href="{{route('checkout')}}">Checkout</a></li>
                                    <li><a href="#">Order Status</a></li>
                                    <li><a href="#">Returns</a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-7">
                       <div class="widgets_container widget_menu">
                            <h3>About Ti Amo Diamonds</h3>
                            <div class="footer_menu">
                                <ul>
                                    <li><a href="{{ url('dynamic/'. encrypt('what-we-believe')) }}">What We Believe</a></li>
                                    <li><a href="{{ url('dynamic/'. encrypt('quality-and-value')) }}">Quality & Value</a></li>
                                    <li><a href="{{ url('dynamic/'. encrypt('tiamo-blog')) }}">TiAmo Blog</a></li>
                                    <li><a href="#">Careers</a></li>
                                    <li><a href="{{ url('dynamic/'. encrypt('locations')) }}">Locations</a></li>   
                                    <li><a href="{{ url('dynamic/'. encrypt('give-us-your-feedback')) }}">Give Us Your Feedback</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="footer_middel">
            <div class="row">
                <div class="col-12">
                    <div class="footer_middel_menu">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Sitemap</a></li>
                            <li><a href="#">Updated Privacy Policy</a></li>
                            <li><a href="#">Terms & Conditions</a></li>
                            <li><a href="#">Accessibility</a></li>
                            <li><a href="#">Do Not Sell My Personal Information</a></li>
                            <li><a href="#">Support</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer_bottom">
           <div class="row">
                <div class="col-12">
                    <div class="copyright_area">
                        <p>&copy; {{date('Y')}} <a href="#" class="text-uppercase">Ti Amo Diamonds</a>. All Rights Reserved.  | Designed and developed by <a target="_blank" href="https://asteeri.com/">Asteeri Infotech</a></p>
                        <img src="{{asset('assets/fontend/img/icon/papyel2.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>     
</footer>