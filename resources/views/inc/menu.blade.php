<div class="navbar-inner">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="agileits-navi_search">

            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="menu">
                <div class="flex-menu">
                    <ul class="d-flex align-items-center justify-content-between wrap-content menu_desktop">
                        <li class="link-menu "><a class="transition " href="{{route('cli_index')}}" title="">
                                <h2>@lang('lang.home')</h2>
                            </a>
                        </li>
                        <li class="line"></li>
                        <li class="link-menu "><a style="cursor: pointer;" title="">
                                <h2>Sản phẩm</h2>
                            </a>
                            <div class="d-flex menu_ca_bra">
                                <ul class="">
                                    <li>Thương hiệu</li>
                                    @foreach($bra as $b)
                                    <li><span></span><a href="{{route('list-pro-brand', $b->id )}}">{{$b->brand_name}}</a></li>
                                    @endforeach
                                </ul>
                            <ul class=""style="width: 50%;position: absolute;left: 305px;">
                                <li>Danh mục sản phẩm</li>
                                @foreach($cate as $c)
                                <li><span></span><a href="{{route('list_pro', $c->category_id)}}">{{$c->category_name}}</a></li>
                                @endforeach
                            </ul>
                            </div>
                        </li>
                        <li class="line"></li>
                        <li class="link-menu">
                            <a class="transition" style="cursor: pointer;" title="">
                                <h2>@lang('lang.post')</h2>
                            </a>
                            <ul>
                                @foreach($cate_post1 as $p)
                                <li><span></span><a href="{{route('dm_baiviet',$p->cate_post_slug)}}">{{$p->cate_post_name}}</a></li>
                                @endforeach
                            </ul>

                        </li>
                        <li class="line"></li>
                        <li class="link-menu">
                            <a class="transition" href="{{Route('gioithieu')}}" title="Gioi thieu">
                                <h2>@lang('lang.introduce')</h2>
                            </a>

                        </li>
                        <li class="line"></li>
                        <!-- <li><a class="transition" href="" title=""><h2>sản phẩm</h2></a></li>
	            <li class="line"></li> -->
                        <li class="link-menu"><a class="transition" href="{{URL::to('/lien-he')}}" title="">
                                <h2>@lang('lang.contact')</h2>
                            </a></li>


                        <?php
                        $cus_id = Session::get('customer_id');
                        if (isset($cus_id)) { ?>
                            <li class="line"></li>
                            <li class="link-menu"><a class="transition" href="{{url('/history')}}" title="">
                                    <h2>@lang('lang.orderhistory')</h2>
                                </a></li>
                        <?php
                        }
                        ?>
                        <!-- <li class="line"></li>
			<li>
                <a class="transition" style="cursor: pointer;" title=""><h2>@lang('lang.languge')</h2></a>
                <ul>
				    <li><span></span><a href="{{url('lang/vn')}}"><img src="{!! asset('images.png')!!}" alt=""></a></li>
                	<li><span></span><a href="{{url('lang/en')}}"><img src="{!! asset('download.jfif')!!}" alt=""></a></li>
                	
                </ul>
                
            </li> -->
                    </ul>

                </div>
            </div>

        </nav>
    </div>
</div>