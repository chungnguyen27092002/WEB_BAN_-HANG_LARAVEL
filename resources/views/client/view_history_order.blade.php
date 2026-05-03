@extends('client/layout_cli')
@section('content')

<div class="bao-all  ">
  <div class="baobang">
    <div class="table-agile-info left-table">

      <div class="panel panel-default wrap-1200">

        <h3 style="margin-top:40px !important;" class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3 margi">
          @lang('lang.order_de')</h3>
        <div class="panel-heading liet">
          Thông tin khách hàng
        </div>
        <div class="table-responsive">
          <?php
          $message = Session::get('message');
          if ($message) {
            echo '<span class="text-alert">' . $message . '</span>';
            Session::put('message', null);
          }
          ?>
          <table class="table table-striped b-t b-light">
            <thead class="dau">
              <tr>

                <th>@lang('lang.cus_name')</th>
                <th>@lang('lang.num')</th>
                <th>@lang('lang.E_cus')</th>


              </tr>
            </thead>
            <tbody>

              <tr>
                <td>{{$customer->customer_name}}</td>
                <td>{{$customer->customer_phone}}</td>
                <td>{{$customer->customer_email}}</td>
              </tr>

            </tbody>
          </table>

        </div>

      </div>
    </div>








    <div class="table-agile-info right-table wrap-1200">

      <div class="panel panel-default ">
        <div class="panel-heading liet">
          Thông tin vận chuyển hàng
        </div>


        <div class="table-responsive">
          <?php
          $message = Session::get('message');
          if ($message) {
            echo '<span class="text-alert">' . $message . '</span>';
            Session::put('message', null);
          }
          ?>
          <table class="table table-striped b-t b-light">
            <thead class="dau">
              <tr>

                <th>@lang('lang.ship')</th>
                <th>@lang('lang.ad')</th>
                <th>@lang('lang.sdt')</th>
                <th>@lang('lang.em')</th>
                <th>@lang('lang.note')</th>
                <th>@lang('lang.pay_me')</th>

              </tr>
            </thead>
            <tbody>
              <tr>
                <td>{{$shipping->shipping_name}}</td>
                <td>{{$shipping->shipping_address}}</td>
                <td>{{$shipping->shipping_phone}}</td>
                <td>{{$shipping->shipping_email}}</td>
                <td>{{$shipping->shipping_notes}}</td>
                <td>@if($shipping->shipping_method==0)<span class="online">Chuyển khoản qua PayPal</span> @elseif($shipping->shipping_method==2)<span class="online">Chuyển khoản qua VnPay</span> @else <span class="offline">Tiền mặt</span> @endif</td>


              </tr>

            </tbody>
          </table>

        </div>

      </div>
    </div>


  </div>





  <div class="table-agile-info">

    <div class="panel panel-default wrap-1200">
      <div class="panel-heading liet">
        chi tiết đơn hàng
      </div>
      <div class="baochitiet">
        <div class="table-responsive chitietdh">
          <?php
          $message = Session::get('message');
          if ($message) {
            echo '<span class="text-alert">' . $message . '</span>';
            Session::put('message', null);
          }
          ?>
          <table class="table table-striped ">
            <thead class="dau">
              <tr>
                <th style="width:20px;">
                  STT
                </th>
                <th>@lang('lang.product_name')</th>
                <th>@lang('lang.kho')</th>
                <th>@lang('lang.gia')</th>
                <th>Size</th>
                <th>Số lượng</th>
                <th>@lang('lang.price')</th>
                <th>@lang('lang.total')</th>

                <!-- <th style="width:30px;"></th> -->
              </tr>
            </thead>
            <tbody>
              @php
              $i = 0;
              $total = 0;
              @endphp
              @foreach($order_details as $key => $details)

              <?php
              $i++;
              $km = $details->product_price * $details->product_sales_quantity;
              if ($details->product_size == "L") {
                $_price = ($details->product_price + (($details->product_price * 20) / 100));
                $subtotal = ($km + (($km * 20) / 100));
              } elseif ($details->product_size == "S") {
                $_price = ($details->product_price + (($details->product_price * 20) / 100));
                $subtotal = ($km) - ($km * 20) / 100;
              } else {
                $_price = $details->product_price;
                $subtotal = ($km);
              }

              $total += $subtotal;
              ?>
              <tr>

                <td><i>{{$i}}</i></td>
                <td>{{$details->product_name}}</td>
                <td>{{$details->product->soluong}}</td>
                <td>@if($details->product_coupon!='no')
                  {{$details->product_coupon}}
                  @else
                  Không mã
                  @endif
                </td>
                <td>{{$details->product_size}}</td>


                <td><input type="text" disabled="true" {{$order_status==2 ? 'disabled' : ''}} class="order_qty_{{$details->product_id}} order_qty_cr" value="{{$details->product_sales_quantity}}" name="product_sales_quantity" style="width: 61px">

                  <input type="hidden" name="order_qty_storage" class="order_qty_storage_{{$details->product_id}}" value="{{$details->product->product_quantity}}">

                  <input type="hidden" name="order_code" class="order_code" value="{{$details->order_code}}">

                  <input type="hidden" name="order_product_id" class="order_product_id" value="{{$details->product_id}}">

                </td>
                <td>{{ $_price}} VNĐ</td>
                <td>{{number_format($subtotal ,0,',','.')}} VNĐ</td>
              </tr>
              @endforeach
              <br>
              <tr style="text-align: right;">
                <td colspan="2">
                  @php
                  $total_coupon = 0;
                  @endphp
                  @if($coupon_condition==1)
                  @php
                  $total_after_coupon = ($total*$coupon_number)/100;
                  echo 'Tổng giảm :'.number_format($total_after_coupon,0,',','.').'</br>';
                  if($total > 200000){
                  $total_coupon = $total - $total_after_coupon;
                  }else{
                  $total_coupon = $total - $total_after_coupon + $details->product_feeship;
                  }


                  @endphp
                  @else
                  @php
                  echo 'Tổng giảm :'.number_format($coupon_number,0,',','.').' VNĐ'.'</br>';
                  if($total > 200000){
                  $total_coupon = $total - $coupon_number ;
                  }else{
                  $total_coupon=$total - $coupon_number + $details->product_feeship;
                  }


                  @endphp
                  @endif
                  @if($subtotal > 200000)
                  Phí ship : 0đ (đơn hàng trên 200.000 đ)
                  @else
                  @lang('lang.fee_s') : {{number_format($details->product_feeship,0,',','.')}} VNĐ
                  @endif</br>

                  @lang('lang.t'): {{number_format($total_coupon,0,',','.')}} VNĐ
                </td>
              </tr>
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>
</div>
@stop