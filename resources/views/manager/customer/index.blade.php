@extends('manager.template.admin_layout')

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Quản lý Customer</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
              <li><a class="close-link"><i class="fa fa-close"></i></a></li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>STT</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Avatar</th>
                        <th>Chức năng</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 0; ?>
                      @foreach($customers as $key => $user)
                        <?php $i++ ?>
                        <tr>
                          <td>{{$i}}</td>
                          <td>{{ $user->customer_name }}</td>
                          <td>
                            {{ $user->customer_email }}
                            <input type="hidden" name="admin_email" value="{{ $user->customer_email }}">
                            <input type="hidden" name="admin_id" value="{{ $user->customer_id }}">
                          </td>
                          <td>
                          {{ $user->customer_phone }}
                          </td>
                          <td>
                          <img width="100" src="<?php echo $user->avatar != null ? $user->avatar : "/avatar.png" ?> " alt="">  
                          </td>
                          <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                              <p><a style="margin:5px 0;font-size:13px" class="btn btn-sm btn-info" href="{{ route('customer.edit', $user->customer_id) }}">Chỉnh sửa</a></p>
                              <form action="{{ route('customer.destroy', $user->customer_id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa customer này không')">
        Xóa
    </button>
</form>
                            </div>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
