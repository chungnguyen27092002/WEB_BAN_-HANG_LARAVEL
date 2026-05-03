@extends('manager.template.admin_layout')
@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Thêm Thương Hiệu <small>Form thêm thương hiệu</small></h2>
                        <div class="clearfix"></div>
                        @if(Session()->has('error'))
                            <section class='alert alert-danger' style="text-align: center;">{{session('error')}}</section>
                        @endif
                        @if (count($errors) > 0)
                            <section class='alert alert-danger' style="text-align: center;">
                                <ul>
                                    @foreach ($errors->all() as $err)
                                        <li>{{ $err }}</li>
                                    @endforeach
                                </ul>
                            </section>
                        @endif
                    </div>
                    <div class="x_content">
                        <form id="brand-form" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('brands.store') }}" method="post">
                            @csrf
                            <!-- Tên thương hiệu -->
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="brand-name">Tên Thương Hiệu <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" id="brand-name"  required="required" class="form-control" name="brand_name" placeholder="Nhập tên thương hiệu">
                                </div>
                            </div>
                            <!-- Mô tả -->
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="description">Mô tả</label>
                                <div class="col-md-6 col-sm-6">
                                    <textarea  class="form-control" id="ckeditor" name="brand_description" placeholder="Mô tả thương hiệu"></textarea>
                                </div>
                            </div>
                            <!-- Trạng thái -->
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Trạng Thái</label>
                                <div class="col-md-6 col-sm-6">
                                    <select name="brand_status" class="form-control">
                                        <option value="1">Hiện</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <button type="submit" class="btn btn-success">Thêm Thương Hiệu</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
