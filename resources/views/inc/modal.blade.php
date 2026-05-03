<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content modal-content-form">
			<div class="modal-header">
				<h5 class="modal-title text-center">@lang('lang.login')</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{route('dangnhap')}}" method="post" id="login-form">
					@csrf
					<div class="form-group re">
						<input type="Email" class="form-control" placeholder="Email... " name="email" required="">
					</div>
					<div class="form-group re">
						<input type="password" class="form-control" placeholder="Password... " name="password" required="" id="password1">
					</div>
<!-- reCAPTCHA -->
<div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
					<div class="right-w3l">
						<input type="submit" style="background-color: #fff; color: #222; width: 40%;" class="form-control" value="@lang('lang.login')">
					</div>
					<p class="text-center dont-do mt-3">
						<a href="#" data-toggle="modal" data-target="#exampleModal3">
							@lang('lang.ForgotPassword')</a>
					</p>


				</form>
				<p class="text-center dont-do mt-3">Bạn chưa có tài khoản?
					<a href="#" data-toggle="modal" data-target="#exampleModal2">
						@lang('lang.registration')</a>
					hoặc <a href="{{url('/login-google')}}">
						<img width="10%" alt="Đăng nhập bằng google" src="{{asset('/google.png')}}">
					</a>
				</p>
			</div>
		</div>
	</div>
</div>

<!-- register -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content modal-content-form">
			<div class="modal-header">
				<h5 class="modal-title">@lang('lang.registration')</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{route('dangky')}}" method="post" id="regis-form">
					@csrf
					<div class="form-group re">
						<input type="text" class="form-control" placeholder="Tên đăng nhập... " name="name">
					</div>
					<div class="form-group re">
						<input type="text" class="form-control" placeholder="Số điện thoại... " name="sdt">
					</div>
					<div class="form-group re">
						<input type="email" class="form-control" placeholder="Email... " name="email">
					</div>
					<div class="form-group re">
						<input type="password" class="form-control" placeholder="Password... " name="password" id="password">
					</div>
					<div class="form-group re">
						<input type="password" class="form-control" placeholder="Nhập lại mật khẩu... " name="re_password">
					</div>
					<div class="right-w3l">
						<input type="submit" style="background-color: #fff;color: #222;width: 40%;" class="form-control" value="Đăng ký">
					</div>

				</form>
				<p class="text-center dont-do mt-3">Bạn đã có tài khoản?
					<a href="#" data-toggle="modal" data-target="#exampleModal">
						@lang('lang.login')</a>
					hoặc <a href="{{url('/login-google')}}">
						<img width="10%" alt="Đăng nhập bằng google" src="{{asset('/google.png')}}">
					</a>
				</p>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content modal-content-form">
			<div class="modal-header">
				<h5 class="modal-title">@lang('lang.comfirmPassword')</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{route('postlaymk')}}" method="post">
					@csrf
					<div class="form-group">
						<input type="email" class="form-control" placeholder="Email.. " name="email">
					</div>
					<div class="right-w3l">
						<input type="submit" style="background-color: #fff; color: #222;" class="form-control" value="@lang('lang.Confirm')">
					</div>

				</form>
			</div>
		</div>
	</div>
</div>




<!-- Modal -->
<div class="modal fade" id="infomodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content modal-content-form">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				...
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>


<div class="modal" tabindex="-1" role="dialog" id="modali">
	<div class="modal-dialog" role="document">
		<div class="modal-content modal-content-form">
			<div class="modal-header">
				<h5 class="modal-title">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Modal body text goes here.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary">Save changes</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>








<div class="modal fade" id="xemnhanh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content modal-content-view">
			<div class="modal-header">
				<h5 class="modal-title product_quickview_title" style="color: #222;" id="">

					<span id="product_quickview_title"></span>

				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<style type="text/css">
					span#product_quickview_content img {
						width: 100%;
					}

					@media screen and (min-width: 768px) {
						.modal-dialog {
							width: 700px;
							/* New width for default modal */
						}

						.modal-sm {
							width: 350px;
							/* New width for small modal */
						}
					}

					@media screen and (min-width: 992px) {
						.modal-lg {
							width: 1200px;
							/* New width for large modal */
						}
					}
				</style>
				<div class="baotrum">
					<div class="taice1">

						<span id="product_quickview_image"></span>
						<span id="product_quickview_gallery"></span>

					</div>
					<form class="form3">
						@csrf
						<div id="product_quickview_value"></div>
						<div class=" taice">
							<h2><span id="product_quickview_title"></span></h2>
							<div style="display: flex; gap: 10px; align-items: center;">
								<p><span class="nhanh">Size(NẾU CÓ):</span></p>

								<div id="size"></div>
							</div>
							<br>
							<?php /*<p class="nhanh" >@lang('lang.ProductPrice') : <span style="font-size: 20px; color: brown;font-weight: bold;" class="product_quickview_price"></span> (size: vừa)</p>*/ ?>

							<label class="nhanh">@lang('lang.Amont'):</label>
							<input type="number" class="soluong cart_product_sl" min=1 value="1" name="soluong">

							</span>
							<p class="nhanh">@lang('lang.ProductDescription'):</p>
							<!--  <hr> -->
							<p><span id="product_quickview_desc" style="color: #222;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;"></span></p>
							<hr>
							<p><span id="product_quickview_content"></span></p>
							<input type="hidden" name="sl">
							<div style="margin-bottom: 10px" id="product_quickview_button"></div>
							<div id="beforesend_quickview"></div>
						</div>
					</form>

				</div>

			</div>
			<div class="modal-footer">
				<button style="text-transform: uppercase;" type="button" class="btn btn-secondary" data-dismiss="modal">@lang('lang.close')</button>
				<button style="text-transform: uppercase;" type="button" class="btn btn-default redirect-cart">@lang('lang.goToCart')</button>
			</div>
		</div>
	</div>
</div>




<?php
$cus_id = Session::get('customer_id');
if (isset($cus_id)) {
	$favorites = Session::get('favorites', collect()); // Lấy danh sách sản phẩm yêu thích từ session
?>
	<div class="modal fade" id="favoritesModal" tabindex="-1" role="dialog" aria-labelledby="favoritesModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				@if($favorites->isNotEmpty()) <!-- Kiểm tra nếu có sản phẩm yêu thích trong session -->
				<div class="modal-header">
					<h5 class="modal-title" id="favoritesModalLabel">Sản phẩm yêu thích</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						@foreach($favorites as $favorite)
						<div class="col-md-4">
							<div class="card mb-3">
								<img src="{{ asset('images/' . $favorite->product_image) }}" class="card-img-top" alt="{{ $favorite->product_name }}">
								<div class="card-body">
									<a href="{{route('cli_detail',$favorite->product_id)}}">
										<h5 class="card-title">{{ $favorite->product_name }}</h5>
									</a>
									<p class="card-text">{{ number_format($favorite->product_price, 0, ',', '.') }} VND</p>
										<a href="{{ route('favorites.remove', $favorite->product_id) }}" class="btn btn-danger">Xóa</a>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
				</div>
				@else
		<p>Không có sản phẩm yêu thích nào.</p>
		@endif
			</div>
		</div>
	</div>
	
<?php } ?>

@if (session()->has('message'))
<section class='alert alert-success' style="text-align: center;">{{session('message')}}</section>
@elseif (session()->has('error'))
<section class='alert alert-danger' style="text-align: center;">{{session('error')}}</section>
@endif
@if (count($errors)>0)
<section class='alert alert-danger' style="text-align: center;">
	@foreach ($errors->all() as $err)
	{{$err}}
	@endforeach
</section>
@endif