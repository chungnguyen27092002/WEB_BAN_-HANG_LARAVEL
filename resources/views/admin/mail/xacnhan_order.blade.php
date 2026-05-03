<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Đơn hàng</title>
	<style>
		span.chao {
			text-transform: capitalize;
			font-size: 16px;
			color: #7d3737;
		}

		span.ten {
			color: #001fff;
			margin-left: 19px;
			text-transform: capitalize;
			font-size: 19px;
		}

		.w-900 {
			max-width: 950px;
			margin: auto;
		}

		table,
		th,
		td {
			border: 1px solid black;
		}

		.container {
			background: url(public/photo-1541696490-8744a5dc0228.jfif) no-repeat center;
			background-size: cover;
			padding-bottom: 53px;
		}


		.w-1200 {
			max-width: 1200px;
			margin: auto;
		}

		.title {
			text-align: center;
			font-size: 30px;
			color: green;
			padding-top: 50px;
		}

		.thongbao {
			color: #cc2b2b;
			text-transform: uppercase;
			font-size: 20px;
		}

		.info {
			font-size: 17px;
			color: #7d3737;
		}

		.ma {
			text-transform: capitalize;
			font-size: 18px;
		}

		span.ten1 {
			margin-left: 20px;
			font-size: 19px;
			color: #35a000;
		}
	</style>
</head>

<body>
	<div class="container w-1200">
		<div class="title">
		<h4 style="magrin :0">Cửa Hàng Mỹ Phẩm Chúng Tôi Xin Cảm Ơn Quý Khách</h4>
		<h4 style="magrin :0; font-size: 18px;">Chúng tôi chuyên các loại Mỹ Phẩm chất lượng cao</h4>
		</div>
		<div class="content w-900">
			<p><span class="chao">Chào bạn:</span><span class="ten">{{$shipping_array['customer_name']}}</span></p>
			<p class="thongbao">Chúng tôi đã xác nhận bạn đã đặt hàng tại cửa hàng chúng tôi gồm những thông tin sau đây: </p>
			<p class="info">THÔNG TIN ĐƠN HÀNG</p>
			<p class="ma">Mã đơn hàng:<span class="ten1">{{$code['order_code']}}</span></p>
			<p class="ma">Mã khuyến mãi áp dụng:<span class="ten1">{{$code['coupon_code']}}</span></p>
			<p class="ma">Phí giao hàng:<span class="ten1">{{number_format($shipping_array['fee_ship'],0,',','.')}}VND</span></p>
			<p class="ma">Dịch vụ:<span class="ten1">Đặt hàng trực tuyến</span></p>
			<p class="info">THÔNG TIN NGƯỜI NHẬN</p>
			<p class="ma">Email:
				@if ($shipping_array['shipping_email']=='')
				<span style="color: #7d3737;"> Không có</span>
				@else
				<span style="color: #7d3737;">{{$shipping_array['shipping_email']}}</span>
				@endif
			</p>
			<p class="ma">Họ tên người gửi:
				@if ($shipping_array['shipping_name']=='')
				<span style="color: #7d3737;"> Không có</span>
				@else
				<span style="color: #7d3737;">{{$shipping_array['shipping_name']}}</span>
				@endif
			</p>
			<p class="ma">Địa chỉ nhận hàng :
				@if ($shipping_array['shipping_address']=='')
				<span style="color: #7d3737;"> Không có</span>
				@else
				<span style="color: #7d3737;">{{$shipping_array['shipping_address']}}, </span>
				<span style="color: #7d3737;">{{$shipping_array['shipping_address2']}}</span>
				@endif
			</p class="ma">
			<p class="ma">Số điện thoại:
				@if ($shipping_array['shipping_phone']=='')
				<span style="color: #7d3737;"> Không có</span>
				@else
				<span style="color: #7d3737;">{{$shipping_array['shipping_phone']}}</span>
				@endif
			</p>
			<p class="ma">Ghi chú đơn hàng:
				@if ($shipping_array['shipping_notes']=='')
				<span style="color: #7d3737;"> Không có</span>
				@else
				<span style="color: #7d3737;">{{$shipping_array['shipping_notes']}}</span>
				@endif
			</p>
			<p class="ma">Hình thức thanh toán:
				@if ($shipping_array['shipping_method']==0 || $shipping_array['shipping_method']==2)
				<span style="color: #7d3737;"> Chuyển Khoản</span>
				@else
				<span style="color: #7d3737;">Tiền mặt</span>
				@endif
			</p>
			<p style="color: #7d3737;">Nếu thông tin người nhận hàng không có chúng tôi sẽ liên hệ với người đặt hàng để trao đổi về thông tin đông hya2ng đã đặt </p>
			<h4 style="text-transform:uppercase; color:#7d3737;">Sản phẩm đã được chúng tôi xác nhận</h4>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Sản phẩm</th>
						<th>Size</th>
						<th>giá tiền</th>
						<th>Số lượng</th>
						<th>Mã khuyễn mãi</th>
						<th>Thành tiền</th>
					</tr>
				</thead>
				<tbody>
					@php
					$sub_total=0;
					$total =0;
					@endphp
					@foreach ($cart_array as $key => $cart)
					@php
					$size=$cart['product_size'];
					$_price=($cart['product_price']-$cart['product_km']);
					$km=$_price*$cart['product_sales_quantity'];
					if($size=="L")
					{
					$price=($_price+(($_price*20)/100));
					$sub=($km+(($km*20)/100));
					}elseif($size=="S"){
					$price=($_price-(($_price*20)/100));
					$sub=($km-(($km*20)/100));
					}else{
					$price=$km;
					$sub=$km;
					}
					$total += $sub;
					@endphp
					<tr>
						<td>{{$cart['product_name']}}</td>
						<td>{{$cart['product_size']}}</td>
						<td>{{number_format($price,0,',','.')}}VND</td>
						<td>{{$cart['product_qty']}}</td>
						<td>{{$code['coupon_code']}}</td>
						<td>{{number_format($sub,0,',','.')}}VND</td>
					</tr>

					@endforeach

					@if(isset($code['coupon_code']) && !empty($code['coupon_code']) && $code['coupon_code']!='Không sử dụng')
					@if(isset($code['coupon_condition']) && !empty($code['coupon_condition']) && $code['coupon_condition'] == 1)
					<tr>
						@php
						$total_coupon = $total - (($total * $code['coupon_number']) / 100);
						$total_after = $total_coupon + $shipping_array['fee_ship'];
						@endphp
						<td colspan="6" align="right">
							<strong>Tổng thanh toán (+ phí ship): {{ number_format( $total_after, 0, ',', '.') }} VND (Giảm -{{$code['coupon_number']}} %)</strong>
						</td>
					</tr>
					@elseif(isset($code['coupon_condition']) && !empty($code['coupon_condition']) && $code['coupon_condition'] == 2)
					<tr>
						@php
						$total_coupon = $total - $code['coupon_number'];
						$total_after = $total_coupon + $shipping_array['fee_ship'];
						@endphp
						<td colspan="6" align="right">
							<strong>Tổng thanh toán (+ phí ship): {{ number_format( $total_after, 0, ',', '.') }} VND (Giảm -{{number_format($code['coupon_number'],0,',','.')}} VNĐ)</strong>
						</td>
					</tr>
					@endif
					@else <!-- Trường hợp không có mã giảm giá -->
					<tr>
						@php
						$total_coupon = $total + $shipping_array['fee_ship'];
						@endphp
						<td colspan="6" align="right">
							<strong>Tổng thanh toán (+ phí ship): {{ number_format($total_coupon, 0, ',', '.') }} VND </strong>
						</td>
					</tr>
					@endif

					<!-- <tr>
					@php
							
							$total += $shipping_array['fee_ship'];
						@endphp
						 <td colspan="5" align="rigth">Tông thanh toán: {{number_format($total,0,',','.')}}VND</td>
					</tr> -->
				</tbody>
			</table>
		</div>
		<p class="ma w-900" style="color:#7d3737;">Xem lịch sử đơn hàng tại đây: <a target="_blank" href="{{url('/history')}}">Lịch sữ đơn hàng của bạn</a></p>
		<p class="ma w-900" style="color:#7d3737;">Mọi chi tiết xin liên hệ website tại: <a target="_blank" href="{{url('/cli/index')}}">shop</a>, hoặc liên hệ qua hotline:19005689, Xin cảm ơn quý khác đã đặt hàng tại shop chúng tôi.</p>
	</div>
	</div>

</body>

</html>