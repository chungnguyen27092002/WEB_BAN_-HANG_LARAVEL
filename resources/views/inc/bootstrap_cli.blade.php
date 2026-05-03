	<title>{{$meta_title}}</title>
	<!-- Meta tag Keywords -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />

	<!-- <meta name="keywords" content="Electro Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design"
	/> -->
	<meta name="title" content="{{$meta_title}}">
	<meta name="description" content="{{$meta_desc}}">

	<link rel="icon" type="image/x-icon" href="" />
	<meta name="robots" content="INDEX,FOLLOW" />
	<link rel="canonical" href="{{$url_canonical}}" />
	<meta name="author" content="">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
	<?php
	if ($com == 'detail') { ?>
		<meta property="og:url" content="{{$url_canonical}}" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="{{$meta_title}}" />
		<meta property="og:description" content="{{$meta_desc}}" />
		<meta property="og:image" content="{{$share_images}}" />

	<?php }
	?>
	<script>
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- //Meta tag Keywords -->
	<link rel="stylesheet" href="{!! asset('web/css/sweetalert.css')!!}" type="text/css" media="all" />
	<!-- Custom-Files -->
	<link href="{!! asset('web/css/bootstrap.css')!!}" rel="stylesheet" type="text/css" media="all" />
	<!-- Bootstrap css -->
	<link href="{!! asset('web/css/style.css')!!}" rel="stylesheet" type="text/css" media="all" />
	<!-- Main css -->
	<link rel="stylesheet" href="{!! asset('web/css/fontawesome-all.css')!!}">
	<!-- Font-Awesome-Icons-CSS -->
	<link href="{!! asset('web/css/popuo-box.css')!!}" rel="stylesheet" type="text/css" media="all" />
	<!-- pop-up-box -->
	<link href="{!! asset('web/css/menu.css')!!}" rel="stylesheet" type="text/css" media="all" />
	<link href="{!! asset('web/css/slick-theme.css')!!}" rel="stylesheet" type="text/css" media="all" />
	<link href="{!! asset('web/css/slick.css')!!}" rel="stylesheet" type="text/css" media="all" />


	<link href="{!! asset('web/css/jquery.simplyscroll-style.css')!!}" rel="stylesheet" type="text/css" media="all" />
	<link href="{!! asset('web/css/jquery.simplyscroll.css')!!}" rel="stylesheet" type="text/css" media="all" />
	<link rel="stylesheet" href="{!! asset('web/css/owl_them.css')!!}">
	<link rel="stylesheet" href="{!! asset('web/css/owl.css')!!}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
	<link href="//fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i&amp;subset=latin-ext" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese"
		rel="stylesheet">

	<link href="{!! asset('layout_admin/admin/vendors/animate.css/animate.min.css')!!}" rel="stylesheet">

	<style>
		df-messenger {
			z-index: 999;
			position: fixed;
			bottom: 16px;
			right: 16px;
		}
	</style>

	<!-- Messenger Plugin chat Code -->
	<div id="fb-root"></div>

	<!-- Your Plugin chat code -->
	<div id="fb-customer-chat" class="fb-customerchat">
	</div>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Nếu chưa có jQuery -->
	<script>
		$(document).ready(function() {
			// Lắng nghe sự kiện khi mở bất kỳ modal nào	
			$('[data-toggle="modal"]').on('click', function() {
				// Đóng tất cả modal
				$('.modal').modal('hide');
			});
		});
		var chatbox = document.getElementById('fb-customer-chat');
		chatbox.setAttribute("page_id", "103770788636351");
		chatbox.setAttribute("attribution", "biz_inbox");

		window.fbAsyncInit = function() {
			FB.init({
				xfbml: true,
				version: 'v11.0'
			});
		};

		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s);
			js.id = id;
			js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
	<!-- //web fonts -->
	<!-- Swiper JS -->


	<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
	<script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
{{-- Chatbot --}}
	{{-- <df-messenger
  intent="WELCOME"
  chat-title="NewAgent"
  agent-id="53bf4456-2dc3-407c-a2f2-9f370109bd7a"
  language-code="vi"
></df-messenger> --}}

{{-- reCAPTCHA --}}
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
		document.addEventListener('DOMContentLoaded', function() {
			const dfMessenger = document.querySelector('df-messenger');

			if (dfMessenger) {
				dfMessenger.addEventListener('df-messenger-loaded', () => {
					const shadowRoot = dfMessenger.shadowRoot;
					if (shadowRoot) {
						// Tìm tất cả các phần tử có thể nhận input
						const chatWrapper = shadowRoot.querySelector('.chat-wrapper');
						const inputField = shadowRoot.querySelector('df-messenger-user-input');
						const messageList = shadowRoot.querySelector('df-message-list');

						// Ngăn chặn sự kiện space ở nhiều cấp độ
						[chatWrapper, inputField, messageList].forEach(element => {
							if (element) {
								element.addEventListener('keydown', function(e) {
									if (e.keyCode === 32 || e.key === ' ') {
										e.stopPropagation();
										e.preventDefault();

										// Nếu đang ở trong input field, thêm dấu cách vào text
										if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') {
											const cursorPosition = e.target.selectionStart;
											const textBeforeCursor = e.target.value.substring(0, cursorPosition);
											const textAfterCursor = e.target.value.substring(cursorPosition);
											e.target.value = textBeforeCursor + ' ' + textAfterCursor;
											// Di chuyển con trỏ về đúng vị trí
											e.target.selectionStart = e.target.selectionEnd = cursorPosition + 1;
										}
									}
								}, true);

								// Ngăn chặn cả sự kiện scroll
								element.addEventListener('scroll', function(e) {
									e.stopPropagation();
								}, true);
							}
						});
					}
				});

				// Thêm listener cho toàn bộ df-messenger
				dfMessenger.addEventListener('keydown', function(e) {
					if (e.keyCode === 32 || e.key === ' ') {
						e.stopPropagation();
						e.preventDefault();
					}
				}, true);
			}
		});

		// Ngăn chặn scroll toàn trang khi focus vào chat
		document.addEventListener('keydown', function(e) {
			const dfMessenger = document.querySelector('df-messenger');
			if (dfMessenger && dfMessenger.contains(e.target)) {
				if (e.keyCode === 32 || e.key === ' ') {
					e.stopPropagation();
				}
			}
		}, true);

		document.addEventListener('DOMContentLoaded', function() {
			const dfMessenger = document.querySelector('df-messenger');

			if (dfMessenger) {
				dfMessenger.addEventListener('df-messenger-loaded', () => {
					const shadowRoot = dfMessenger.shadowRoot;
					if (shadowRoot) {
						const titlebar = shadowRoot.querySelector('df-messenger-titlebar');
						if (titlebar) {
							// Thêm event listener cho nút đóng
							titlebar.addEventListener('click', function(e) {
								// Kiểm tra nếu click vào phần after (nút đóng)
								const rect = titlebar.getBoundingClientRect();
								if (e.clientX > rect.right - 40) { // 40px là khoảng không gian cho nút đóng
									// Đóng chat
									dfMessenger.removeAttribute('expanded');
								}
							});
						}
					}
				});
			}
		});
	</script>
	<script src="https://app.tudongchat.com/js/chatbox.js"></script>
	<script>
	  const tudong_chatbox = new TuDongChat('iWS6Jknr8o2KItWv0et-R')
	  tudong_chatbox.initial()
	</script>