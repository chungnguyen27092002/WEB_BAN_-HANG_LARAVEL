<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link href="{!! asset('web/css/style.css')!!}" rel="stylesheet" type="text/css" media="all" />
	<meta http-equiv="refresh" content="5;url=cli/index" />
	@include('inc.bootstrap_cli')
</head>
<body id="margin0">
	<div class="loader">
		<img src="{!! asset('web/skateboard-13963_128.gif')!!}" alt="noimg">
	</div>
@include('inc.search_form')
@include('inc.menu')
<div class="background"><span class="thank"></span>
</div>
<script>
	var string="Bạn đã đặt hàng thành công ! Cảm ơn bạn đã mua sản phẩm của shop chúng tôi";
	const  char=document.querySelector('.thank');
	var index=0;
	function move(){
		if(index <= string.length-1){
		index++;
		var newstring=string.slice(0,index);
		char.innerHTML=newstring;
		}else{
			index=0;
		}

	}
	setInterval(move,80);
</script>
<script>
  
</script>
</body>
</html>

