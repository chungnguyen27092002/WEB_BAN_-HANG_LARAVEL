@extends('client/layout_cli')
@section('content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3 margi"style="margin-top:40px !important;">
    LỊCH SỬ ĐƠN HÀNG</h3>
    <div class="bao_all wrap-1200">
      <div class="table-responsive">
        <?php
        $message = Session::get('message');
        if($message){
          echo '<span class="text-alert">'.$message.'</span>';
          Session::put('message',null);
        }
        ?>
        <table class="table table-striped b-t b-light">
          <thead class="dau">
            <tr>
             
              <th>Thứ tự</th>
              <th>@lang('lang.order_code')</th>
              <th>@lang('lang.data_order')</th>
              <th>@lang('lang.order_status')</th>

              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @php 
            $i = 0;
            @endphp
            @foreach($order as $key => $ord)
            @php 
            $i++;
            @endphp
            <tr>
              <td><i>{{$i}}</i></td>
              <td>{{ $ord->order_code }}</td>
              <td>{{ $ord->created_at }}</td>
              <td>@if($ord->order_status==1)
                <div class="progress">
                  <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 35%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">Đơn hàng mới</div>
                </div>
                @elseif ($ord->order_status==2) 
                <!-- <span style="color:green">Đã xử lý<i class="glyphicon glyphicon-check" style="margin-left:4px"></i></span> -->
                <div class="progress">
                  <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 65%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Đơn hàng đã xử lý</div>
                </div>
                @elseif($ord->order_status==4)
                <!-- <span style="color:#e6b70d;">Đơn hàng đang được vận chuyển<i class="glyphicon glyphicon-send" style="margin-left:6px"></i></span> -->
                <div class="progress">
                  <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Đơn hàng đã được vận chuyển</div>
                </div>
                @else
                <!-- <span style="color:red">Đơn hàng đã hủy <i class="glyphicon glyphicon-ban-circle" style="margin-left:4px"></i></span> -->
                <div class="progress">
                  <div class="progress-bar progress-bar-striped bg-danger huy" role="progressbar" style="width: 100%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">đơn hàng bị hủy</div>
                </div>
                @endif
              </td>
              
              
              <td class="d-flex">
                <a href="{{URL::to('/view-history-order/'.$ord->order_code)}}" title="xem" style="font-size: 13px;" class="btn  active styling-edit" ui-toggle-class="">
                <i class="fas fa-eye"></i></a>
                @if ($ord->order_status == 1 && $ord->shipping->shipping_method !=0)
                <button type="button" style="border:none;background:none;cursor:pointer;color:red" title="hủy đơn hàng" data-toggle="modal"  id="{{$ord->order_code}}" onclick="huydonhang(this.id)"><i class="fas fa-ban"></i></button>
                @endif
              </td>
                

                
              
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                    <form>
                      @csrf
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Lý do hủy đơn hàng</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          
                        </div>
                        <div class="modal-body">
                          <p><textarea class="lydohuydon" required cols="55" rows="5" placeholder="Lý do hủy đơn hàng......"></textarea></p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>

@stop