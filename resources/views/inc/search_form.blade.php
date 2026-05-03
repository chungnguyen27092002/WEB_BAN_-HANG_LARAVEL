<div class="header-bot" style="background-color: #a7090c;">
		<div class="container">
			<div style="" class="row header-bot_inner_wthreeinfo_header_mid">
				<!-- logo -->
				<div class="col-md-3 logo_agile">
						<a href="{{route('cli_index')}}" class="font-weight-bold font-italic">
						<img  width="250" src="{!! asset('web/images/logo_site.svg')!!}" alt=" " class="img-fluid">
						</a>
				</div>
				<!-- //logo -->
				<!-- header-bot -->
				<div class="col-md-9 header mt-4 mb-md-0 mb-4">
					<div class="row">
						<!-- search -->
						<div class="col-9 agileits_search">
							<form class="form-inline" action="{{route('cli_search')}}" autocomplete="off" method="post">
								{{csrf_field()}}
								<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="keyword" id="keywords" required>
                                <div id="search_ajax"></div>
								<button class="btn my-2 my-sm-0" type="submit">@lang('lang.seach')</button>
							</form>
						</div>
            <!-- <div class="col-3 fl">
              <div class="vn">
                <a href="{{url('lang/vn')}}"><img src="{!! asset('download.jfif')!!}" width="50px" height="50px" alt=""></a>
                
              </div>
              <div class="en">
                <a href="{{url('lang/en')}}"><img src="{!! asset('images.png')!!}"  width="50px" height="50px" alt=""></a>
              </div>
            </div> -->
						
                            
                            
          </div>

<?php $total = 0 ?>
@foreach((array) session('cart') as $id => $details)
    <?php
    $si=$details['size'];
    $km=$details['price']-$details['price_pro'];
    if($si=="L")
    {
    	$sub=($km+(($km*20)/100))*$details['quantity'];
    }elseif($si=="S"){
    	 $sub=($km-(($km*20)/100))*$details['quantity'];
    }else{
    	$sub=$km*$details['quantity'];
    }
          $total += $sub; 
    ?>
@endforeach
<div id="wrapper">
  <div class="cart-tab visible">  
     <div id="visible">
     </div>    
      
    </a>
    <div id="show"></div><!-- @end .cart -->
  </div><!-- @end .cart-tab -->
					</div>
				</div>
			</div>
		</div>
	</div>







  
