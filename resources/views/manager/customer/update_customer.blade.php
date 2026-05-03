@extends('manager.template.admin_layout')
@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Chỉnh sửa Customer</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    @if(Session()->has('error'))
                    <section class='alert alert-danger' style="text-align: center;">{{session('error')}}</section>
                    @endif
                    @if (count($errors)>0)
                    <section class='alert alert-danger' style="text-align: center;">
                        @foreach ($errors->all() as $err)
                        {{$err}}
                        @endforeach
                        @endif
                        <div class="x_content">
                            <br />
                            <form action="{{ route('customer.update', $customer->customer_id) }}" method="POST">
    @csrf
    @method('PUT') <!-- Hoặc PATCH, tùy thuộc vào yêu cầu của bạn -->
    
    <!-- Trường nhập liệu để cập nhật thông tin -->
    <div class="form-group">
        <label for="customer_name">Tên khách hàng:</label>
        <input type="text" name="customer_name" class="form-control" value="{{ $customer->customer_name }}">
    </div>

    <div class="form-group">
        <label for="customer_email">Email:</label>
        <input type="email" name="customer_email" class="form-control" value="{{ $customer->customer_email }}">
    </div>
    <div class="form-group">
        <label for="customer_email">Phone:</label>
        <input type="number" name="customer_phone" class="form-control" value="{{ $customer->customer_phone }}">
    </div>

    <!-- Trường mật khẩu mới -->
    <div class="form-group">
        <label for="customer_password">Mật khẩu mới:</label>
        <input type="password" name="customer_password" class="form-control" placeholder="Nhập mật khẩu mới">
    </div>

    <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>

                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection