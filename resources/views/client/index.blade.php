@extends('client/layout_cli')
@section('content')

<div class="ads-grid py-3 py-xl-0">
	<div class="container py-xl-4 py-lg-2">
		<!-- tittle heading -->
		<!-- <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
		@lang('lang.ourProduct')</h3> -->
		<div id="cart"></div>


		<!-- //tittle heading -->
		<div class="row">
			<!-- product left -->
			<div class="agileinfo-ads-display col-lg-12">
				<div class="wrapper">
					<!-- first section -->
					<h3 class="tittle-w3l text-center patop" style="margin-top: 50px;margin-bottom: 0 !important;">
					Sản phẩm dành cho bạn</h3>
					<div class="product-sec1">

						<div class="row" id="list-index" style="display: flex; flex-wrap: wrap; margin-top: 20px;">

							@foreach($product as $p)



							<div class="pr-item" style="width: calc(25% - 30px);
    margin: 0 15px;
    margin-bottom: 32px;
    position: relative;
    overflow: hidden;
    cursor: pointer;">
								<div class="men-pro-item simpleCart_shelfItem">
									<div class="men-thumb-item text-center">
										<a id="wishlist_producturl{{$p->product_id}}" href="{{route('cli_detail',$p->product_id)}}">
											<div class="scale-img">
												<?php
												$gia = ($p->gia_km * 100) / $p->product_price;
												?>
												@if($p->gia_km < $p->product_price && $p->gia_km >0)
													<span class="badge badge-pill badge-danger ban">-{{ROUND($gia,1)}}%</span>
													@endif
													<img id="wishlist_productimage{{$p->product_id}}" style="width: 100%;" class="pro_img" src="{!! asset('images/'.$p->product_image)!!}" alt="">

											</div>
										</a>

										<?php

										$tong = 0;
										if ($p->pro_rating) {
											$tong = round(($p->pro_rating_number) / ($p->pro_rating));
										}

										?>
										<ul class="marg">
											<li>

												@for($i=1;$i<6;$i++)
													@if($i <=$tong && $tong>0)
													<i class="fas fa-star actise"></i>
													@else
													<i class="fas fa-star"></i>
													@endif

													@endfor
											</li>
										</ul>

									</div>
									<div class="item-info-product mt-2">
										<h4 class="pt-1">
											<a href="{{route('cli_detail',$p->product_id)}}">{{$p->product_name}}</a>
										</h4>
										<?php
										$giatien = $p->product_price - $p->gia_km
										?>
										<div class="info-product-price my-2">
											<span class="item_price">{{number_format($giatien)}} VNĐ</span>
											@if($p->gia_km < $p->product_price && $p->gia_km > 0)
												<del>{{number_format($p->product_price)}}VNĐ</del>
												@endif
										</div>
										<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
											<form>
												@csrf
												<fieldset class="mb-2">

													<input type="button" data-toggle="modal" data-target="#xemnhanh" value="@lang('lang.quickview')" style="background:#fff" class="btn btn-default xemnhanh" data-id_soluong="{{$p->soluong}}" data-id_product="{{$p->product_id}}">

												</fieldset>
											</form>

										</div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
						<div class="phantrang">
							{!! $product->links('pagination::bootstrap-4') !!}
						</div>
					</div>
					<div class="quangcao">

						<div class="row">
							<div class="rundt wrap_1200">
								@foreach($quangcao as $quang)
								<a href="{{$quang->link}}"><img class="hinh" height="200px" src="{!! asset('uploads/quangcao/'.$quang->hinh_quangcao)!!}" alt=""></a>
								@endforeach
							</div>
						</div>

					</div>

					<h3 class="tittle-w3l text-center patop" style="margin-top: 50px;margin-bottom: 0 !important;">
						Phụ kiện làm đẹp & Tiện ích</h3>
					<div class="run1 cach">

						@foreach($toping as $t)
						<?php

						$gia = ($t->gia_km * 100) / $t->product_price;
						$tong = 0;
						if ($t->pro_rating) {
							$tong = round(($t->pro_rating_number) / ($t->pro_rating));
						}
						$giatien = $t->product_price - $t->gia_km;

						?>
						@if($t->gia_km < $t->product_price && $t->gia_km >0)
							<span class="badge badge-pill badge-danger ban">-{{ROUND($gia,1)}}%</span>
							@endif
							<a href="{{route('cli_detail',$t->product_id)}}">
								<div class="baoca">
									<div class="scale-img">
										<img class="hi" src="{!! asset('images/'.$t->product_image)!!}" alt="">
									</div>
									<h4 class="text-center">
										<a style="color:black;text-transform: uppercase;font-size:15px" href="{{route('cli_detail',$t->product_id)}}">{{$t->product_name}}</a>
									</h4>
									<p class="p-tien"><span class="item_price">{{number_format($giatien)}} VNĐ</span>
										@if($t->gia_km < $t->product_price && $t->gia_km > 0)
											<del>{{number_format($t->product_price)}} VNĐ</del>
											@endif</p>
									<form>
										@csrf
										<fieldset>

											<input type="button" data-toggle="modal" data-target="#xemnhanh" value="@lang('lang.quickview')" class="btn btn-default panhanh xemnhanh" data-id_soluong="{{$t->soluong}}" data-id_product="{{$t->product_id}}">

										</fieldset>
									</form>
								</div>
							</a>
							@endforeach

					</div>


					<div class="join-w3l1">
						<div class="container py-xl-4 py-lg-2">
							<div class="row">
								<!-- <div class="col-lg-6">
										<div class="join-agile text-left p-4">
											<div class="row">
												<div class="col-sm-7 offer-name">
													<h6>@lang('lang.sanphammoi')</h6>
													<h4 class="mt-2 mb-3">Trà sữa chocola mới ra</h4>
													<p>@lang('lang.giamgia')</p>
												</div>
												<div class="col-sm-5 offerimg-w3l">
													<img src="{!! asset('web/images/z10.png')!!}" alt="" class="img-fluid">
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-6 mt-lg-0 mt-5">
										<div class="join-agile text-left p-4">
											<div class="row ">
												<div class="col-sm-7 offer-name">
													<h6>@lang('lang.decrip_luachon')</h6>
													<h4 class="mt-2 mb-3">Trà chanh cỡ lớn</h4>
													<p>@lang('lang.decript_giaohang')</p>
												</div>
												<div class="col-sm-5 offerimg-w3l">
													<img src="{!! asset('web/images/z11.png')!!}" alt="" class="img-fluid">
												</div>
											</div>
										</div>
									</div> -->
								<style>
									swiper-container {
										width: 100%;
										height: 100%;
									}

									swiper-slide {
										text-align: center;
										font-size: 18px;
										background: #fff;
										display: flex;
										justify-content: center;
										align-items: center;
									}

									swiper-slide img {
										display: block;
										width: 100%;
										height: 100%;
										object-fit: cover;
									}
								</style>
								<swiper-container class="mySwiper" space-between="30"
									centered-slides="true" autoplay-delay="2500" autoplay-disable-on-interaction="false">
									<swiper-slide>
										<div class="col-lg-12">
											<div class="join-agile text-left p-4">
												<div class="row">
													<div class="col-sm-7 offer-name">
														<h6>HaSaKi<br>Beauty Tower</h6>
														<h4 class="mt-2 mb-3">HaSaKi tự hào giới thiệu các sản phẩm làm đẹp cao cấp, được sản xuất từ thiên nhiên, giúp bạn luôn rạng ngời và tự tin. Ghé thăm cửa hàng của chúng tôi tại Beauty Tower để trải nghiệm ngay!</h4>
														<p>@lang('lang.giamgia')</p>
													</div>
													<div class="col-sm-5 offerimg-w3l">
														<img src="{!! asset('web/images/web_/anh1.jpg')!!}" alt="" class="img-fluid">
													</div>
												</div>
											</div>
										</div>
									</swiper-slide>
									<swiper-slide>
										<div class="col-lg-12">
											<div class="join-agile text-left p-4">
												<div class="row ">
													<div class="col-sm-7 offer-name">
														<h6>Mỹ phẩm <br>Mua Mỹ phẩm chính hãng</h6>
														<h4 class="mt-2 mb-3">Mỹ phẩm chính hảng đảm bảo chất lượng, giá rẻ bất ngờ</h4>
														<p>@lang('lang.decript_giaohang')</p>
													</div>
													<div class="col-sm-5 offerimg-w3l">
														<img src="{!! asset('web/images/web_/anh1.jpg')!!}" alt="" class="img-fluid">
													</div>
												</div>
											</div>
										</div>
									</swiper-slide>
								</swiper-container>
							</div>
						</div>
					</div>
					<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3 sellchay1">@lang('lang.SelleingProduct')</h3>

					<div class="product-sec1">

						<div class="row" style="display: flex; flex-wrap: wrap; margin-top: 20px;">
							@foreach($sp as $b)
							<div class="" style="width: calc(25% - 30px);
    margin: 0 15px;
    margin-bottom: 32px;
    position: relative;
    overflow: hidden;
    cursor: pointer;">
								<div class="men-pro-item simpleCart_shelfItem">
									<div class="men-thumb-item text-center">

										<a href="{{route('cli_detail',$b->product_id)}}">
											<div class="scale-img">
												<?php
												$gia = ($b->gia_km * 100) / $b->product_price;
												?>
												@if($b->gia_km < $b->product_price && $b->gia_km >0)
													<span class="badge badge-pill badge-danger ban">-{{ROUND($gia,1)}}%</span>
													@endif
													<img class="pro_img" style="width: 100%;" src="{!! asset('images/'.$b->product_image)!!}" alt="">

													<!--  -->

											</div>
										</a>

										<?php

										$tong = 0;
										if ($b->pro_rating) {
											$tong = round(($b->pro_rating_number) / ($b->pro_rating));
										}

										?>
										<ul class="marg">
											<li>

												@for($i=1;$i<6;$i++)
													@if($i<=$tong && $tong>0)
													<i class="fas fa-star actise"></i>
													@else
													<i class="fas fa-star"></i>
													@endif

													@endfor
											</li>
										</ul>

									</div>
									<div class="item-info-product mt-2">
										<h4 class="pt-1">
											<a href="{{route('cli_detail',$b->product_id)}}">{{$b->product_name}}</a>
										</h4>
										<?php
										$giatien = $b->product_price - $b->gia_km
										?>
										<div class="info-product-price my-2">
											<span class="item_price">{{number_format($giatien)}} VNĐ</span>
											@if($b->gia_km < $b->product_price && $b->gia_km > 0)
												<del>{{number_format($b->product_price)}} VNĐ</del>
												@endif
										</div>
										<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
											<form>
												@csrf
												<fieldset>

													<input type="button" data-toggle="modal" data-target="#xemnhanh" style="background:#fff" value="@lang('lang.quickview')" class="btn btn-default mb-2 xemnhanh" data-id_soluong="{{$b->soluong}}" data-id_product="{{$b->product_id}}">

												</fieldset>
											</form>
										</div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop