
<!DOCTYPE html>
<html lang="zxx">

<head>
@include('inc.bootstrap_cli')
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
	
	<!-- top-header -->
    @include('inc.topheader')

	@include('inc.modal')
    
	@include('inc.search_form')
	@include('inc.menu')
	<?php 
	if($com=='index'){?>
		@include('inc.slide')
	<?php } ?>
	@yield('content')
	@include('inc.footer')
	@include('inc.boot2_detail')
</body>
</html>