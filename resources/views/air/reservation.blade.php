@extends('main')
@section('content')
 <!-- END nav -->

 <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('/images/air.png');">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 text-center">
       <p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="fa fa-chevron-right"></i></a></span> <span>Air <i class="fa fa-chevron-right"></i></span></p>
       <h1 class="mb-0 bread">Air</h1>
     </div>
   </div>
 </div>
</section>

<script>
	var total_price_start = 0;
	var total_price_end = 0;

	function optionCheck(num) {
		if(num == 0) {
			if(total_price_start == 0 || total_price_end == 0) {
				alert('위탁 수화물을 선택해주세요.');
			} else {
				if(confirm('결제 하시겠습니까?') == true) {
					document.form1.submit();
				}
			}
		}
		else {
			if(total_price_start == 0) {
				alert('위탁 수화물을 선택해주세요.');
			} else {
				if(confirm('결제 하시겠습니까?') == true) {
					document.form1.submit();
				}
			}
		}
	}

	function startCalculate() {
		var count = document.getElementsByName('baggage');

		var price = priceCalculate(count);
		var old_price = $('#s_total').val();
		total_price_start = Number(old_price) + price;

		$('#leave_total').val(total_price_start);
		$('#total1').html(numberWithCommas(total_price_start));
		$('#baggage_price').html(numberWithCommas(price));

		$('#total').html(numberWithCommas(total_price_start + total_price_end));
	}

	function endCalculate() {
		var count = document.getElementsByName('return_baggage');

		var price = priceCalculate(count);
		var old_price = $('#e_total').val();
		total_price_end = Number(old_price) + price;

		$('#return_total').val(total_price_end);
		$('#total2').html(numberWithCommas(total_price_end));
		$('#return_baggage_price').html(numberWithCommas(price));

		$('#total').html(numberWithCommas(total_price_start + total_price_end));
	}

	function priceCalculate(count) {
		var price = 0;

		for(var i = 0; i < count.length; i++) {
			if(count[i].checked == true) {
				price = count[i].value * 30000;
			}
		}

		return price;
	}

	function numberWithCommas(x) {
		return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}
</script>

<section class="ftco-section ftco-no-pb">
	<form method="post" action="/air/storage" name="form1">
	@csrf

	<input type="hidden" name="adult" value="{{$adult}}">
	<input type="hidden" name="child" value="{{$child}}">
	<input type="hidden" name="infant" value="{{$infant}}">
	<input type="hidden" name="schedule_id" value="{{$schedule->id}}">
	<input type="hidden" name="consumer" value="{{session()->get('consumer')->id}}">
	<p><p><br>
	<div class="container">
	  <div class="row text-white align-items-center text-center">
		<div class="col-md-12"><h2>정보 확인</h2></div>
	  </div>
	  <div class="row align-items-center text-right">
		<div class="col-md-12" style="font-size: 13px">어린이는 성인 가격의 50%<br>24개월 미만의 유아는 무료입니다.</div>
	  </div>

	  <?php
			$date1 = $schedule->startDate;
			$str_date1 = strtotime($date1);
			$startDate = date('m/d', $str_date1);
			$startTime = date('H:i', $str_date1);

			$date2 = $schedule->endDate;
			$str_date2 = strtotime($date2);
			$endDate = date('m/d', $str_date2);
			$endTime = date('H:i', $str_date2);

			$s_total = ($schedule->price * $adult) + ($schedule->price / 2 * $child);
		?>
		<input type="hidden" name="s_total" id="s_total" value="{{$s_total}}">
		<input type="hidden" name="leave_total" id="leave_total" value="">

	  <div class="row bg-primary text-white align-items-center text-center">
		<div class="col-md-2">가는편</div>
		<div class="col-md-1">{{ $schedule->planes_number }}</div>
		<div class="col-md-4">
			@foreach($list as $row)
				@if($schedule->departure_id == $row->id)
					{{ $row->cities_name }}({{$row->name}})
				@endif
			@endforeach
			&nbsp;{{$startDate}} &nbsp;{{$startTime}}
		</div>
		<div class="col-md-1">----></div>
		<div class="col-md-4">
			@foreach($list as $row)
				@if($schedule->destnation_id == $row->id)
					{{ $row->cities_name }}({{$row->name}})
				@endif
			@endforeach
			&nbsp;{{$endDate}} &nbsp;{{$endTime}}
		</div>
	  </div>

		<br>
		<div class="row align-items-center text-center" id="schedule">
			<div class="col-md-2 text-center">성인</div>
			<div class="col-md-2 text-center">어린이</div>
			<div class="col-md-2 text-center">유아</div>
			<div class="col-md-5 text-right">가격 &nbsp; &nbsp;</div>
		</div>

		<hr>
		<div class="row align-items-center text-center" id="schedule">
			<div class="col-md-2 text-center">{{$adult}}</div>
			<div class="col-md-2 text-center">{{$child}}</div>
			<div class="col-md-2 text-center">{{$infant}}</div>
			<div class="col-md-5 text-right">{{number_format($s_total)}}</div>
		</div>

		<hr>
		<div class="row align-items-center text-center" id="schedule">
			<div class="col-md-4 text-center">위탁 수하물 추가 (20kg 초과시 위탁 수하물)</div>
			<div class="col-md-4 text-right">
				<input type="radio" name="baggage" value="0"
					onclick="startCalculate()"> 추가 없음 &nbsp; &nbsp;
				<input type="radio" name="baggage" value="1"
					onclick="startCalculate()"> 1개 &nbsp; &nbsp;
				<input type="radio" name="baggage" value="2"
					onclick="startCalculate()"> 2개 &nbsp; &nbsp;
				<input type="radio" name="baggage" value="3"
					onclick="startCalculate()"> 3개 &nbsp; &nbsp;
			</div>
			<div class="col-md-3 text-right" id="baggage_price"></div>
		</div>

		<hr>
		<div class="row align-items-center text-center" id="schedule">
			<div class="col-md-11 text-right" id="total1"></div>
		</div>
	</div>
	<p><p><br>

	@if($return_schedule)
		<?php
			$date1 = $return_schedule->startDate;
			$str_date1 = strtotime($date1);
			$startDate = date('m/d', $str_date1);
			$startTime = date('H:i', $str_date1);

			$date2 = $return_schedule->endDate;
			$str_date2 = strtotime($date2);
			$endDate = date('m/d', $str_date2);
			$endTime = date('H:i', $str_date2);

			$e_total = ($return_schedule->price * $adult) + ($return_schedule->price / 2 * $child);
		?>
		<input type="hidden" name="return_schedule_id" value="{{$return_schedule->id}}">
		<input type="hidden" name="e_total" id="e_total" value="{{$e_total}}">
		<input type="hidden" name="return_total" id="return_total" value="">

		<div class="container">
		  <div class="row bg-primary text-white align-items-center text-center">
			<div class="col-md-2">오는편</div>
			<div class="col-md-1">{{$return_schedule->planes_number}}</div>
			<div class="col-md-4">
				@foreach($list as $row)
					@if($return_schedule->departure_id == $row->id)
						{{ $row->cities_name }}({{$row->name}})
					@endif
				@endforeach
				&nbsp;{{$startDate}} &nbsp;{{$startTime}}
			</div>
			<div class="col-md-1">----></div>
			<div class="col-md-4">
				@foreach($list as $row)
					@if($return_schedule->destnation_id == $row->id)
						{{ $row->cities_name }}({{$row->name}})
					@endif
				@endforeach
				&nbsp;{{$endDate}} &nbsp;{{$endTime}}
			</div>
		  </div>

			<br>
			<div class="row align-items-center text-center" id="schedule">
				<div class="col-md-2 text-center">성인</div>
				<div class="col-md-2 text-center">어린이</div>
				<div class="col-md-2 text-center">유아</div>
				<div class="col-md-5 text-right">가격 &nbsp; &nbsp;</div>
			</div>

			<hr>
			<div class="row align-items-center text-center" id="schedule">
				<div class="col-md-2 text-center">{{$adult}}</div>
				<div class="col-md-2 text-center">{{$child}}</div>
				<div class="col-md-2 text-center">{{$infant}}</div>
				<div class="col-md-5 text-right">{{number_format($e_total)}}</div>
			</div>

			<hr>
			<div class="row align-items-center text-center" id="schedule">
				<div class="col-md-4 text-center">위탁 수하물 추가 (20kg 초과시 위탁 수하물)</div>
				<div class="col-md-4 text-right">
					<input type="radio" name="return_baggage" value="0"
					onclick="endCalculate()"> 추가 없음 &nbsp; &nbsp;
					<input type="radio" name="return_baggage" value="1"
					onclick="endCalculate()"> 1개 &nbsp; &nbsp;
					<input type="radio" name="return_baggage" value="2"
					onclick="endCalculate()"> 2개 &nbsp; &nbsp;
					<input type="radio" name="return_baggage" value="3"
					onclick="endCalculate()"> 3개 &nbsp; &nbsp;
				</div>
				<div class="col-md-3 text-right" id="return_baggage_price"></div>
			</div>

			<hr>
			<div class="row align-items-center text-center" id="schedule">
				<div class="col-md-11 text-right" id="total2"></div>
			</div>
		</div>
		<p><p><br>
	@endif


	<div class="container">
		<div class="row bg-primary text-white align-items-center" style="font-size:25px">
			<div class="col-md-6"> &nbsp; &nbsp; 총 가격 : </div>
			<div class="col-md-5 text-right" id="total"></div>
		</div>
	</div>


	<br>
	<div class="container">
		<div class="col-lg d-flex">
		  <div class="form-group d-flex w-100 border-0">
		   <div class="form-field w-100 align-items-center d-flex">
		   <input type="button" value="이전페이지" class="align-self-stretch form-control btn btn-primary" onclick="history.back();"> &nbsp; &nbsp;
			@if($return_schedule)
				<input type="button" value="결제" onclick="optionCheck(0)" class="align-self-stretch form-control btn btn-primary">
			@else
				<input type="button" value="결제" onclick="optionCheck(1)" class="align-self-stretch form-control btn btn-primary">
			@endif
		  </div>
		</div>
	</div>
	<p><p><br>
	</form>
</section>

<section class="ftco-section">
 <div class="container">
  <div class="row">
   <div class="col-md-4 ftco-animate">
    <div class="project-wrap hotel">
     <a href="#" class="img" style="background-image: url(/images/tour_1.jpg);">

    </a>
    <div class="text p-4">
      <span class="days">Tours List</span>
      <h3><a href="#">투어</a></h3>
   </div>
 </div>
</div>
<div class="col-md-4 ftco-animate">
  <div class="project-wrap hotel">
   <a href="#" class="img" style="background-image: url(/images/hotel-resto-2.jpg);">

  </a>
  <div class="text p-4">
    <span class="days">Hotel</span>
    <h3><a href="#">호텔 예약</a></h3>
 </div>
</div>
</div>
<div class="col-md-4 ftco-animate">
  <div class="project-wrap hotel">
   <a href="#" class="img" style="background-image: url(/images/blog_1.jpg);">

  </a>
  <div class="text p-4">
    <span class="days">Blog</span>
    <h3><a href="#">후기</a></h3>
 </div>
</div>
</div>
</div>
</section>
@stop
