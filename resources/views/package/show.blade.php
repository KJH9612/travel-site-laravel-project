@extends('hmain')
@section('content')
<style>
.my-color{
	color:#F15D30;
}
.my-color2{
	color:#C92800;
}
.my-margin{
	margin-bottom:50px;
}
.my-title{
	font-size:20px;
}
.my-context{
	color:black;
	font-size:14px;
	line-height:1.6;
	font-weight:400;
}
.schedule-lpadding{
	padding-left:5%;
}
.date-bmargin{
	margin-bottom:30px;
}
.reservation-bmargin{
	margin-bottom:20px;
}
.reservation-bmargin2{
	margin-bottom:40px;
}
p{
	color:black;
}
.my-button {
	text-decoration:none;
	font-family:Arial;
	box-shadow:inset #ffffff -2px 2px 4px -2px,#d6d6d6 2px 3px 2px;
	background:linear-gradient(#f15d30, #f07d30);
	text-indent:0px;
	line-height:35px;
	border-radius:41px;
	text-align:center;
	vertical-align:middle;
	display:inline-block;
	font-size:28px;
	color:#ffffff;
	width:35px;
	height:35px;
	text-shadow:#6daac2 0px 0px 0px;
	margin-top:9px;
	padding:1px;
	border:0px;
}
.my-button:hover {
	color:#f15d30;
	background:#f9fafb;
	border: 1px solid #f15d30;
	margin-top:8px;
	padding:0px;
}
.reservation-button{
	color:#fff;
	background-color:#F15D30;
	padding-block:10px;
	font-weight:700;
	font-size:18px;
	border-radius:7px;
	border: 2px solid #F15D30;
	height: auto;
}
.reservation-button:hover {
	background:#f9fafb;
	color:#F15D30;
}
p{
	color:black;
}
</style>


 <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('/images/bg_1.jpg');">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 text-center">
       <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span> <span class="mr-2"><a href="hotel.html">Package <i class="fa fa-chevron-right"></i></a></span> <span>Package Details <i class="fa fa-chevron-right"></i></span></p>
       <h1 class="mb-0 bread">Package Details</h1>
     </div>
   </div>
 </div>
</section>

<?php

	$tmp =  (strtotime($row->arrival_date) - strtotime($row->departure_date))/86400;
	$tmp2 = $tmp + 1;
	$day = $tmp ."박" .$tmp2 ."일";
?>
<section class="ftco-section ftco-no-pt ftco-no-pb">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 ftco-animate py-md-5 mt-md-5">
        <p  style="height:500px;width:100%;background-size:cover;background-image:url('/storage/package_pic/{{$row->pic}}');display:block;"></p>
		<br>
        <h1> {{$row->name}}</h1>
        <div class="icon my-color"><i class="fas fa-map-marker-alt"></i></span> {{$row->nation_name}} 여행</div>
		<div class="icon my-color"><i class="far fa-clock"></i> {{$day}}</div>
		<div class="icon my-color"><i class="fas fa-calendar-alt"></i> {{$row->departure_date}} ~ {{$row->arrival_date}}</div>
		<br><br>
		<ul class="nav nav-tabs" id="myTab" role="tablist">
		  <li class="nav-item" role="presentation">
			<a class="nav-link active" id="detail-tab" data-toggle="tab" href="#detail" role="tab" aria-controls="home" aria-selected="true">상세 정보</a>
		  </li>
		  <li class="nav-item" role="presentation">
			<a class="nav-link" id="tourism-tab" data-toggle="tab" href="#tourism" role="tab" aria-controls="profile" aria-selected="false">관광 정보</a>
		  </li>
		  <li class="nav-item" role="presentation">
			<a class="nav-link" id="schedule-tab" data-toggle="tab" href="#schedule" role="tab" aria-controls="contact" aria-selected="false">일정</a>
		  </li>
		</ul>
		<div class="tab-content" id="myTabContent">
		  <div class="tab-pane fade show active" id="detail" role="tabpanel" aria-labelledby="detail-tab"><br>
			<div class="my-margin">
				<h4 class="my-color"><i class="fa fa-credit-card" aria-hidden="true"></i> 가격</h4><br>
				<table class="table text-center my-margin" align="center">
					<thead>
						<tr>
							<th>성인</th>
							<th>어린이</th>
							<th>유아</th>
						</tr>
					</thead>
					<tr>
						<td>{{number_format($row->adult_price)}}원</td>
						<td>{{number_format($row->kid_price)}}원</td>
						<td>{{number_format($row->baby_price)}}원</td>
					</tr>
				</table>
			</div>
			@if($row->departure_plan_number)
			<div class="my-margin">
				<h4 class="my-color"><i class="fa fa-plane" aria-hidden="true"></i> 비행기</h4>
				<table class="table text-center" align="center">
					<thead>
						<tr>
							<th width="12%">#</th>
							<th width="10%">편명</th>
							<th width="20%">날짜</th>
							<th>목적지</th>
						</tr>
					</thead>
					<tr>
						<th>출발</th>
						<td>{{$row->departure_plan_number}}</td>
						<td>{{substr($row->departure_schedule_startDate, 0, 10)}}</td>
						<td>{{$row->departure_start_airport_name}}({{substr($row->departure_schedule_startDate, 11, 5)}}) -> {{$row->departure_end_airport_name}}({{substr($row->departure_schedule_endDate, 11, 5)}})</td>
					</tr>
					<tr>
						<th>도착</th>
						<td>{{$row->arrival_plan_number}}</td>
						<td>{{substr($row->arrival_schedule_startDate, 0, 10)}}</td>
						<td>{{$row->arrival_start_airport_name}}({{substr($row->arrival_schedule_startDate, 11, 5)}}) -> {{$row->arrival_end_airport_name}}({{substr($row->arrival_schedule_endDate, 11, 5)}})</td>
					</tr>
				</table>
			</div>
			@endif
			<div class="my-margin">
				<h4 class="my-color"><i class="fas fa-hotel"></i> 호텔</h4>
				<table class="table text-center" align="center">
					<thead>
						<tr>
							<th width="15%">#</th>
							<th width="45%">호텔이름</th>
							<th>호텔 등급</th>
						</tr>
					</thead>
					<tr>
					<?php $hotel_num = 1;?>
					@foreach($schedule_list as $schedule)
						@if($schedule->hotel_id)
							<td>{{$hotel_num}}일차</td>
							<td>{{$schedule->hotels_name}}</td>
							<td>
								<p class="star mb-2">
									@for($i = 0; $i < $schedule->hotels_star; $i++)
									<span class="fa fa-star"></span>
									@endfor
								</p>
							</td>
						</tr>
						<?$hotel_num ++;?>
						@endif
					@endforeach
				</table>
			</div>
		  </div>
		  <div class="tab-pane fade" id="tourism" role="tabpanel" aria-labelledby="tourism-tab"><br>
		  	<div class="my-margin">
				<?php
					$explain = "· " .$row->explain;
					$explain = str_replace("\n","<br>· ",$explain);
				?>
				<h4 class="my-color"><i class="fab fa-pinterest"></i> 관광 포인트</h4>
				<p><?=$explain?></p>
				<hr>
			</div>
			<h4 class="my-color"><i class="fa fa-flag" aria-hidden="true"></i> 관광 정보</h4><br>
			@foreach($schedule_list as $schedule)
				@if($schedule->tour_id)
				<div class="my-margin">
					<p class="my-title"><i class="fas fa-map-marker-alt my-color2"></i> {{$schedule->tour_name}}</p>
					<img src="/storage/tour_pic/{{$schedule->tour_pic1}}" alt="" width="48%" height="200px">
					<img src="/storage/tour_pic/{{$schedule->tour_pic2}}" alt="" width="48%" height="200px" style="margin-left:3%">
					<p class="my-context"><?=str_replace("\n","<br>",$schedule->tour_context);?></p>
				</div>
				@endif
			@endforeach
		  </div>
		  <div class="tab-pane fade" id="schedule" role="tabpanel" aria-labelledby="schedule-tab">
			<div class="accordion" id="accordionExample">
			  @for($i=1; $i<=$count_day; $i++)
			  <?php
			  	$pDay = "+" .$i-1 ."days";
				$current_city = 0;
			  ?>
			  <div class="card">
				<div class="card-header" id="schedule{{$i}}">
				  <h2 class="mb-0">
					<button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{$i}}" aria-expanded="true" aria-controls="collapse{{$i}}">
					{{$i}}일차 {{date("Y-m-d", strtotime($row->departure_date.$pDay))}}
					</button>
				  </h2>
				</div>
				<div id="collapse{{$i}}" class="collapse show" aria-labelledby="schedule{{$i}}" data-parent="#accordionExample">
				  <div class="card-body">
					@foreach($schedule_list as $schedule)
						@if($schedule->date == $i)
							@if($schedule->city_id != $current_city)
							<?php $current_city =  $schedule->city_id; ?>
							<h2 class="my-color"><i class="fas fa-map-marker-alt"></i> {{$schedule->city_name}}</h2>
							@endif
							@if($schedule->type == "비행")
							<h5 class="schedule-lpadding date-bmargin"><i class="fa fa-plane my-color2" aria-hidden="true"></i> {{$schedule->context}}</h5>
							@elseif($schedule->type == "호텔")
							<h5 class="schedule-lpadding date-bmargin"><i class="fas fa-hotel my-color2"></i></i> {{$schedule->context}}</h5>
							@elseif($schedule->type == "관광")
								@if($schedule->tour_id)
								<div class="schedule-lpadding date-bmargin">
									<h5><i class="far fa-compass my-color2"></i> {{$schedule->context}}</h5>
									<img src="/storage/tour_pic/{{$schedule->tour_pic1}}" alt="" width="45%" height="200px">
									<img src="/storage/tour_pic/{{$schedule->tour_pic2}}" alt="" width="45%" height="200px" style="margin-left:2%">
								</div>
								@else
								<h5 class="schedule-lpadding date-bmargin"><i class="far fa-compass my-color2"></i> {{$schedule->context}}</h5>
								@endif
							@endif
						@endif
					@endforeach
				  </div>
				</div>
			  </div>
			  @endfor
			</div>
		  </div>
		</div>
	  </div>
	  <!-- .col-md-8 -->
      <div class="col-lg-4 sidebar ftco-animate bg-light py-md-5">
		  <div class="text-center">
			<div class="sidebar-box pt-md-5">
				<div style="color:#fff;background-color:#F15D30;padding-block:10px;font-weight:1000;font-size:20px;">패키지 여행</div>
			</div>
		  </div>
		  <form name="reservation" action="{{route('package.order', $row->id)}}" method="post">
		  @csrf
			<div class="reservation-bmargin2">
				<p style="margin-bottom:0px;font-weight:bold"><i class="fas fa-calendar-alt"></i> 여행 날짜</p>
				<div class="row" style="justify-content:center;">
					<div class="col-5 text-right">
						<p style="margin-bottom:0px;margin-top:7px;font-size:18px;">{{$row->departure_date}}</p>
					</div>
					<div class="col-2 text-center" style="font-size:18px;margin-top:7px;"><p style="margin-bottom:0px;"> ~ </p></div>
					<div class="col-5">
						<p style="margin-bottom:0px;margin-top:7px;font-size:18px;">{{$row->arrival_date}}</p>
					</div>
				</div>
			</div>
			<div class="reservation-bmargin2">
				<div class="reservation-bmargin">
					<div class="reservation-bmargin">
						<p style="margin-bottom:0px;font-weight:bold"><i class="fas fa-male"></i> 성인 <span style="font-weight:100">(만 12세 이상)</span></p>
						<div class="row">
							<div class="col-7 row" style="justify-content:center">
								<div class="btn my-button" onclick="adultP({{$row->adult_price}}, {{$row->kid_price}}, {{$row->baby_price}});">+</div>
								<div class="col-6"><input type="text" name="adult" value="2" class="form-control text-center" style="width:100%" maxlength="2" onchange="adultC({{$row->adult_price}}, {{$row->kid_price}}, {{$row->baby_price}});"></div>
								<div class="btn my-button" onclick="adultM({{$row->adult_price}}, {{$row->kid_price}}, {{$row->baby_price}});">-</div>
							</div>
							<div class="col-5" style="margin-top:9px" align="right"><p id="adult-price">{{number_format($row->adult_price * 2)}}원</p></div>
						</div>
					</div>
					<div class="reservation-bmargin">
						<p style="margin-bottom:0px;font-weight:bold"><i class="fas fa-child"></i> 어린이 <span style="font-weight:100">(만 2~11세)</span></p>
						<div class="row">
							<div class="col-7 row" style="justify-content:center">
								<div class="btn my-button" onclick="kidP({{$row->adult_price}}, {{$row->kid_price}}, {{$row->baby_price}});">+</div>
								<div class="col-6"><input type="text" name="kid" value="0" class="form-control text-center" style="width:100%"  maxlength="2" onchange="kidC({{$row->adult_price}}, {{$row->kid_price}}, {{$row->baby_price}});"></div>
								<div class="btn my-button" onclick="kidM({{$row->adult_price}}, {{$row->kid_price}}, {{$row->baby_price}});">-</div>
							</div>
							<div class="col-5" style="margin-top:9px" align="right"><p id="kid-price">0원</p></div>
						</div>
					</div>
					<div class="reservation-bmargin">
						<p style="margin-bottom:0px;font-weight:bold"><i class="fas fa-baby"></i> 유아 <span style="font-weight:100">(0~23개월)</span></p>
						<div class="row">
							<div class="col-7 row" style="justify-content:center">
								<div class="btn my-button" onclick="babyP({{$row->adult_price}}, {{$row->kid_price}}, {{$row->baby_price}});">+</div>
								<div class="col-6"><input type="text" name="baby" value="0" class="form-control text-center" style="width:100%"  maxlength="2" onchange="babyC({{$row->adult_price}}, {{$row->kid_price}}, {{$row->baby_price}});"></div>
								<div class="btn my-button" onclick="babyM({{$row->adult_price}}, {{$row->kid_price}}, {{$row->baby_price}});">-</div>
							</div>
							<div class="col-5" style="margin-top:9px" align="right"><p id="baby-price">0원</p></div>
						</div>
					</div>
					<div class="text-center">
						<input type="text" id="total" name="total" value="{{$row->adult_price * 2}}" style="display:none;" width="80%" readonly>
						<p id="total-price" class="my-color" style="font-size:22px;font-weight:700">{{number_format($row->adult_price * 2)}}원</p>
					</div>
				</div>
			</div>
				@if(session()->exists('consumer'))
				<input type="submit" class="btn-block btn reservation-button" value="예약 하기" style="">
				@else
				<a href="#staticBackdrop" class="btn-block reservation-button text-center" data-toggle="modal" style="">로그인 후 이용 가능합니다.</a>
				@endif
		  </form>
      </div>

    </div>
  </div>
</section>



<script>
	var adult = 2;    var kid = 0;    var baby = 0;
	var adultTotal = 0;    var kidTotal = 0;    var babyTotal = 0; $totalPrice = 0;
	function adultP(adultPrice, kidPrice, babyPrice){
		adult += 1;
		if(adult < 0) adult = 0;
		reservation.adult.value =  adult;
		adultC(adultPrice, kidPrice, babyPrice);
	}
	function adultM(adultPrice, kidPrice, babyPrice){
		adult -= 1;
		if(adult < 0) adult = 0;
		reservation.adult.value =  adult;
		adultC(adultPrice, kidPrice, babyPrice);
	}
	function adultC(adultPrice, kidPrice, babyPrice){
		if(Number.isNaN(parseInt(reservation.adult.value))){
			reservation.adult.value = adult;
			return;
		}
		else{
			adult = parseInt(reservation.adult.value);
			adultTotal = adult * adultPrice;  //성인 총 가격
			kidTotal = kid * kidPrice;
			babyTotal = baby * babyPrice;
			document.getElementById('adult-price').innerHTML = adultTotal.toLocaleString() + "원";
			totalPrice = adultTotal + kidTotal + babyTotal; //총 가격
			document.getElementById('total-price').innerHTML = totalPrice.toLocaleString() + "원";
			reservation.total.value = totalPrice;
			document.getElementById('total').value = totalPrice;
		}
	}
	function kidP(adultPrice, kidPrice, babyPrice){
		kid += 1;
		if(kid < 0) kid = 0;
		reservation.kid.value = kid;
		kidC(adultPrice, kidPrice, babyPrice);
	}
	function kidM(adultPrice, kidPrice, babyPrice){
		kid -= 1;
		if(kid < 0) kid = 0;
		reservation.kid.value =  kid;
		kidC(adultPrice, kidPrice, babyPrice);
	}
	function kidC(adultPrice, kidPrice, babyPrice){
		if(Number.isNaN(parseInt(reservation.kid.value))){
			reservation.kid.price = kid;
			return;
		}
		else{
			kid = parseInt(reservation.kid.value);
			adultTotal = adult * adultPrice;  //성인 총 가격
			kidTotal = kid * kidPrice;
			babyTotal = baby * babyPrice;
			document.getElementById('kid-price').innerHTML = kidTotal.toLocaleString() + "원";
			totalPrice = adultTotal + kidTotal + babyTotal; //총 가격
			document.getElementById('total-price').innerHTML = totalPrice.toLocaleString() + "원";
			reservation.total.value = totalPrice;
			document.getElementById('total').value = totalPrice;
		}
	}
	function babyP(adultPrice, kidPrice, babyPrice){
		baby += 1;
		if(baby < 0) baby = 0;
		reservation.baby.value = baby;
		babyC(adultPrice, kidPrice, babyPrice);
	}
	function babyM(adultPrice, kidPrice, babyPrice){
		baby -= 1;
		if(baby < 0) baby = 0;
		reservation.baby.value =  baby;
		babyC(adultPrice, kidPrice, babyPrice);
	}
	function babyC(adultPrice, kidPrice, babyPrice){
		if(Number.isNaN(parseInt(reservation.baby.value))){
			reservation.baby.price = baby;
			return;
		}
		else{
			baby = parseInt(reservation.baby.value);
			adultTotal = adult * adultPrice;  //성인 총 가격
			kidTotal = kid * kidPrice;
			babyTotal = baby * babyPrice;
			document.getElementById('baby-price').innerHTML = babyTotal.toLocaleString() + "원";
			totalPrice = adultTotal + kidTotal + babyTotal; //총 가격
			document.getElementById('total-price').innerHTML = totalPrice.toLocaleString() + "원";
			reservation.total.value = totalPrice;
			document.getElementById('total').value = totalPrice;
		}
	}
</script>
@endsection()
