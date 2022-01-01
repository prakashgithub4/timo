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
                    @php $ontop = '0'; $onside = '1'; $menu = menuhelper($ontop,$onside); @endphp
                    <div id="menu" class="text-left ">
                        <ul class="offcanvas_main_menu">
                            <li class="menu-item-has-children active">
                                <a href="#">Home</a>
                            </li>
                           @foreach($menu as $menus)
                           @if (isset($menus['isMega']) && $menus['isMega'] == 1)
                            <li class="menu-item-has-children">
                                <a href="{{route('menu.details',$menus['id'])}}">{{ $menus['menu_name'] }}</a>
                                <ul class="sub-menu">
                                    @if (isset($menus['mega_sub']))
                                    @foreach ($menus['mega_sub'] as $mega)
                                    <li class="menu-item-has-children">
                                        <a href="{{route('menu.details',$mega['id'])}}">{{ $mega['menu_name'] }}</a>
                                        <ul class="sub-menu">
                                            @foreach ($mega['sub'] as $mega_sub)
                                            <li><a href="{{route('menu.details',$mega_sub['id'])}}"><img
                                                        src="{{ isset($mega_sub['icon'])? $mega_sub['icon'] : asset('assets/fontend/img/nav-round.png')}}"
                                                        style="height: 24px; width:26px;"
                                                        alt="{{ $mega_sub['name'] }}">{{ $mega_sub['name'] }}</a></li>

                                             @endforeach
                                           
                                        </ul>
                                    </li>
                                    @endforeach
                                    @endif
                                   
                                </ul>
                            </li>
                            @elseif (isset($menus['isMega'])&&$menus['isMega'] == 0)
                            <li class="menu-item-has-children">
                                <a href="{{route('menu.details',$menus['id'])}}">{{ $menus['menu_name'] }}</a>
                                <ul class="sub-menu">
                                    @foreach ($menus['sub'] as $sub)
                                    <li><a href="{{route('menu.details',$sub['id'])}}"><img src="{{ isset($sub['icon']) ? $sub['icon'] :asset('assets/fontend/img/nav-round.png') }}"
                                                style="height: 24px; width:26px;"
                                                alt="{{$sub['name']}}">{{$sub['name']}}</a></li>
                                   
                                     @endforeach
                                </ul>
                            </li>
                            @endif
                            @endforeach
                         
                        </ul>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>