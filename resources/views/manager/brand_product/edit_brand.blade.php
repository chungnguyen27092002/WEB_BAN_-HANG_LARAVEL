@extends('manager.template.admin_layout')
@section('content')
<div class="right_col" role="main">
				<div class="">
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Sửa thương hiệu</h2>
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
										</li>
										
										<li><a class="close-link"><i class="fa fa-close"></i></a>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{route('brands.update',$brand->id)}}" method="post">
										@csrf
                                        @method('PUT')
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tên Loại <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="first-name" value="{{$brand->brand_name}}" required="required" class="form-control"  name="brand_name" placeholder="Nhập tên thương hiệu">
											</div>
										</div>
										
										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Mô tả</label>
											<div class="col-md-6 col-sm-6 ">
												<!-- <input id="middle-name" class="form-control" type="text" name="middle-name"> -->
												<textarea type="text" class="form-control" name="brand_description" required="required" id="ckeditor"  placeholder="Mô tả">{{$brand->brand_description	}}</textarea>
											</div>
										</div>
										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Trạng thái</label>
											<div class="col-md-6 col-sm-6 ">
												<select name="brand_status" id="" class="form-control" >
											      @if($brand->brand_status==1)
											      <option value="1">Hiển thị</option>
											      <option value="0">Ẩn</option>
											      @elseif($brand->brand_status==0)
											      <option value="0">Ẩn</option>
											      <option value="1">Hiển thị</option>
											      @endif
												</select>
											</div>
										</div>
										<div class="ln_solid"></div>
										<div class="item form-group text-center">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<!-- <button class="btn btn-primary" type="button">Cancel</button> -->
												<!-- <button class="btn btn-primary" type="reset">Reset</button> -->
												<button type="submit" class="btn btn-success">Submit</button>
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