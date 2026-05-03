@extends('client/layout_cli')
@section('content')
<div class="services-breadcrumb">
        <div class="agile_inner_breadcrumb">
            <div class="container">
                <ul class="w3_short">
                    <li>
                        <a href="{{route('cli_index')}}">Home</a>
                        <i>|</i>
                    </li>
                    <li>GIỚI THIỆU</li>
                </ul>
            </div>
        </div>
    </div>


    <div class="contact" style="background: #d7b3ee;padding-bottom: 200px;" >
    	<h3  class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3 got">
               THÔNG TIN KHÁCH HÀNG
        </h3>
        <div class="profile">
        	<div class="checkout-title1">
		<p> thông tin đăng nhập</p>
	    </div>
       <div class="address_form_agile mt-sm-5 mt-4">
       	@foreach($cus as $c)
					<form method="post" class="creditly-card-form agileinfo_form">
						@csrf
						<div class="creditly-wrapper wthree, w3_agileits_wrapper">
							<div class="information-wrapper">
								<div class="first-row">
										<div class="controls form-group">
											<input class="form-control name" type="text" name="name" data-validation="required" data-validation-length="min5" data-validation-error-msg="vui lòng điền ít nhất 5 ký tự" value="{{$c->customer_name}}"  placeholder="Tên khách hàng" required="">
										</div>
									
										<div class="w3_agileits_card_number_grid_left form-group">
											<div class="controls">
												<input data-validation="email" data-validation-length="min5" data-validation-error-msg="vui lòng nhập đúng dịnh dạng email" type="email" class="form-control email" value="{{$c->customer_email}}" placeholder="E-mail khách hàng" name="email" required="">
											</div>
										</div>
										<div class="w3_agileits_card_number_grid_right form-group">
											<div class="controls">
												<input data-validation="number" data-validation-length="min11" data-validation-error-msg="vui lòng nhập số điện thoại bắt đầu bằng 0 và gồm 11 chữ số" type="text" class="form-control phone" value="{{$c->customer_phone}}" placeholder="Số điện thoại" name="phone" required="">
											</div>
										</div>
										<div class="w3_agileits_card_number_grid_right form-group">
											<div class="controls">
												<input data-validation="required" data-validation-length="min8" data-validation-error-msg="vui lòng nhập password ít nhất 8 ký tự" type="password" class="form-control pass" value="{{$c->customer_password}}" placeholder="Password khách hàng" name="pass" required="">
											</div>
										</div>
										
										
										
									


								</div>
								
								<input type="button" data-id="{{session::get('customer_id')}}" style="color:white;background: #3cb834;text-transform: uppercase;" value="Cập nhật thông tin"  name="send_order" class="btn btn-primary btn-sm update_pro">
							</div>
						</div>
					</form>
					@endforeach


					<!-- <div class="checkout-right-basket">
						<a href="payment.html">Make a Payment
							<span class="far fa-hand-point-right"></span>
						</a>
					</div> -->
	</div>
</div>

    </div>
@stop