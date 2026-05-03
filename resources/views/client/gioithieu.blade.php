@extends('client/layout_cli')
@section('content')
<div class="page-head_agile_info_w3l">

</div>
<div class="services-breadcrumb">
    <div class="agile_inner_breadcrumb">
        <div class="container">
            <ul class="w3_short">
                <li>
                    <a href="{{route('cli_index')}}">Home</a>
                    <i>|</i>
                </li>
                <li>@lang('lang.intro')</li>
            </ul>
        </div>
    </div>
</div>
<div class="contact" style="background: #f5f5f5;" >
    <br><br>      
    <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
    @lang('lang.intro')</h3>

    <p class="gioithieu_title">{{$gioithieu[0]['intro_title']}}</p>
        <div class="row wrap-1200">

            <div class="col-md-12">
                <div class="row d-flex justify-space-between">
                    <div class="col-md-6">
                        <span class="tho">
                        {!!$gioithieu[0]['intro_content']!!}</span>
                    </div>
                    <div class="col-md-6 gt">
                        <img class="img-thumbnail gioi" src="{{URL::to('uploads/intro/'.$gioithieu[0]['intro_image'])}}" alt="">
                    </div>
                </div>   
            </div>
        </div>
        <div class="row taicho">

            <div class="col-md-12">


            </div>
        </div>
    </div>
        @stop