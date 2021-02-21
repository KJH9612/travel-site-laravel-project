<!DOCTYPE html>
<html lang="en">
<head>
	<title>여행사 홈페이지</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<link rel="stylesheet" href="/h_css/bootstrap.min.css">

	<link href="/h_css/switch-button.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>

	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Arizonia&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="/h_css/animate.css">
	
	<link rel="stylesheet" href="/h_css/owl.carousel.min.css">
	<link rel="stylesheet" href="/h_css/owl.theme.default.min.css">
	<link rel="stylesheet" href="/h_css/magnific-popup.css">

	<link rel="stylesheet" href="/h_css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="/h_css/jquery.timepicker.css">

	<link rel="stylesheet" href="/h_css/flaticon.css">
	<link rel="stylesheet" href="/h_css/style.css">
	<link rel="stylesheet" href="/h_css/fontawesome-all.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">

	<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="/h_css/handle-counter.css">

	
	<!-- ajax -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
		<div class="container">
			<a class="navbar-brand" href="/">Pacific<span>Travel Agency</span></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="oi oi-menu"></span> Menu
			</button>

			<div class="collapse navbar-collapse" id="ftco-nav">
				<ul class="navbar-nav ml-auto">
				@if(strpos(url()->current(),'home'))
					<li class="nav-item active"><a href="/" class="nav-link">Home</a></li>
				@else
					<li class="nav-item"><a href="/" class="nav-link">Home</a></li>
				@endif

				@if(strpos(url()->current(),'about'))
					<li class="nav-item active"><a href="about.html" class="nav-link">About</a></li>
				@else
					<li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
				@endif

				@if(strpos(url()->current(),'package'))
					<li class="nav-item active"><a href="{{route('package.index')}}" class="nav-link">Package</a></li>
				@else
					<li class="nav-item"><a href="{{route('package.index')}}" class="nav-link">Package</a></li>
				@endif

				@if(strpos(url()->current(),'hotel'))
					<li class="nav-item active"><a href="{{route('hotel.index')}}" class="nav-link">Hotel</a></li>
				@else
					<li class="nav-item"><a href="{{route('hotel.index')}}" class="nav-link">Hotel</a></li>
				@endif
				
				@if(strpos(url()->current(),'air'))
					<li class="nav-item active"><a href="/air" class="nav-link">Air</a></li>
				@else
					<li class="nav-item"><a href="/air" class="nav-link">Air</a></li>
				@endif	

				@if(strpos(url()->current(),'blog'))
					<li class="nav-item active"><a href="/blog" class="nav-link">Blog</a></li>
				@else
					<li class="nav-item"><a href="/blog" class="nav-link">Blog</a></li>
				@endif

				@if(session()->exists('consumer'))
					@if(strpos(url()->current(),'consumer'))
					<li class="nav-item active"><a href="{{route('consumer.edit', session()->get('consumer')->id)}}" class="nav-link">Mypage</a></li>
					@else
					<li class="nav-item"><a href="{{route('consumer.edit', session()->get('consumer')->id)}}" class="nav-link">Mypage</a></li>
					@endif
				<li class="nav-item"><a href="/consumer_logout" class="nav-link">Logout</a></li>
				@else
				<li class="nav-item"><a href="#staticBackdrop" class="nav-link" data-toggle="modal">Login</a></li>
				@endif
				</ul>
			</div>
		</div>
	</nav>

<!-- LoginModal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">로그인</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       		<form action="/consumer_login" method="post">
				@csrf
				<input type="hidden" name="url" value="{{url()->current()}}">
				<input type="text" placeholder="아이디" name="uid"  class="form-control"  maxlength="20" required="" style="padding:6px 10;margin-bottom:20px">
				<input type="password" placeholder="비밀번호" name="pwd" class="form-control" maxlength="20" required="" style="padding:6px 10;margin-bottom:30px">
			<button type="submit" class="btn btn-block btn-info" style="min-height:50px;font-weight:600;font-size:16px;color:white;">로그인</button>
		</form>
      </div>
      <div class="modal-footer" style="justify-content:center;">
        <a href="{{route('consumer.create')}}" style="color:cornflowerblue;">회원가입</a>
      </div>
    </div>
  </div>
</div>
<!--End LoginModal -->

	<!-- END nav -->
	@yield('content')

		<footer class="ftco-footer bg-bottom ftco-no-pt" style="background-image: url(/images/bg_3.jpg);">
			<div class="container">
				<div class="row mb-5">
					<div class="col-md pt-5">
						<div class="ftco-footer-widget pt-md-5 mb-4">
							<h2 class="ftco-heading-2">About</h2>
							<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
							<ul class="ftco-footer-social list-unstyled float-md-left float-lft">
								<li class="ftco-animate"><a href="#"><span class="fab fa-twitter"></span></a></li>
								<li class="ftco-animate"><a href="#"><span class="fab fa-facebook-f"></span></a></li>
								<li class="ftco-animate"><a href="#"><span class="fab fa-instagram"></span></a></li>
							</ul>
						</div>
					</div>
					<div class="col-md pt-5 border-left">
						<div class="ftco-footer-widget pt-md-5 mb-4 ml-md-5">
							<h2 class="ftco-heading-2">Infromation</h2>
							<ul class="list-unstyled">
								<li><a href="#" class="py-2 d-block">Online Enquiry</a></li>
								<li><a href="#" class="py-2 d-block">General Enquiries</a></li>
								<li><a href="#" class="py-2 d-block">Booking Conditions</a></li>
								<li><a href="#" class="py-2 d-block">Privacy and Policy</a></li>
								<li><a href="#" class="py-2 d-block">Refund Policy</a></li>
								<li><a href="#" class="py-2 d-block">Call Us</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md pt-5 border-left">
						<div class="ftco-footer-widget pt-md-5 mb-4">
							<h2 class="ftco-heading-2">Experience</h2>
							<ul class="list-unstyled">
								<li><a href="#" class="py-2 d-block">Adventure</a></li>
								<li><a href="#" class="py-2 d-block">Hotel and Restaurant</a></li>
								<li><a href="#" class="py-2 d-block">Beach</a></li>
								<li><a href="#" class="py-2 d-block">Nature</a></li>
								<li><a href="#" class="py-2 d-block">Camping</a></li>
								<li><a href="#" class="py-2 d-block">Party</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md pt-5 border-left">
						<div class="ftco-footer-widget pt-md-5 mb-4">
							<h2 class="ftco-heading-2">Have a Questions?</h2>
							<div class="block-23 mb-3">
								<ul>
									<li><span class="icon fas fa-map-marker-alt"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
									<li><a href="#"><span class="icon fa fa-phone"></span><span class="text">+2 392 3929 210</span></a></li>
									<li><a href="#"><span class="icon fa fa-paper-plane"></span><span class="text">info@yourdomain.com</span></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 text-center">

						<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
						</div>
					</div>
				</div>
			</footer>
			
			

			<!-- loader -->
			<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
						
			<!-- ajax modal -->
			<div class="modal fade" id="formModal" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="formModalLabel">Create Todo</h4>
						</div>
						<div class="modal-body">
							<form id="myForm" name="myForm" class="form-horizontal" novalidate="">

								<div class="form-group">
									<label>Description</label>
										<input hidden="hidden" />
										<input type="text" class="form-control" id="comment" name="comment"
											placeholder="Enter Description" value="" onkeypress="if(event.keyCode === 13) document.getElementById('btn-save').click();">
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" id="btn-save" value="add">Save changes
							</button>
							<input type="hidden" id="todo_id" name="todo_id" value="0">
						</div>
					</div>
				</div>
			</div>

			<script src="/h_js/jquery.min.js"></script>
			<script src="/h_js/jquery-migrate-3.0.1.min.js"></script>
			<script src="/h_js/popper.min.js"></script>
			<script src="/h_js/bootstrap.min.js"></script>
			<script src="/h_js/jquery.easing.1.3.js"></script>
			<script src="/h_js/jquery.waypoints.min.js"></script>
			<script src="/h_js/jquery.stellar.min.js"></script>
			<script src="/h_js/owl.carousel.min.js"></script>
			<script src="/h_js/jquery.magnific-popup.min.js"></script>
			<script src="/h_js/jquery.animateNumber.min.js"></script>
			<script src="/h_js/bootstrap-datepicker.js"></script>
			<script src="/h_js/bootstrap-datepicker.ko.js"></script>
			<script src="/h_js/scrollax.min.js"></script>
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
			<script src="/h_js/google-map.js"></script>
			<script src="/h_js/main.js"></script>

			<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
			<!-- ajax -->
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
		    <script src="{{ asset('/h_js/comment.js') }}" defer></script>


    <script src="/h_js/handleCounter.js"></script>
    <script>
        $(function ($) {
            var options = {
                minimum: 0,
                maximize: 10,
                onChange: valChanged,
                onMinimum: function(e) {
                    console.log('reached minimum: '+e)
                },
                onMaximize: function(e) {
                    console.log('reached maximize'+e)
                }
            }
            $('#handleCounter').handleCounter(options)
            $('#handleCounter2').handleCounter(options)
			$('#handleCounter3').handleCounter({maximize: 100})
        })
        function valChanged(d) {
//            console.log(d)
        }
    </script>
    <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

		</body>
		</html>