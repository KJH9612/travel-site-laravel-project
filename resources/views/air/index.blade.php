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
	function radioCheck() {
		var chk_radio = document.getElementsByName('radios');

		for(var i=0;i<chk_radio.length;i++){
			if(chk_radio[i].checked == true){
				var sel_type = chk_radio[i].value;
			}
		}

		if(sel_type == 0) {
			$("#endDate").attr("disabled", false);
		} else if(sel_type == 1) {
			$("#endDate").attr("disabled", true);
			$("#endDate").val('');
		}
	}

	function selectCheck() {
		var chk_radio1 = null;
		var chk_radio2 = null;

		var chk_radio = document.getElementsByName('radios');
		var sel_type = checkConfirmation(chk_radio);

		if(sel_type == 0) {
			chk_radio1 = document.getElementsByName('goCheck');
			chk_radio2 = document.getElementsByName('comeCheck');

			var check1 = checkConfirmation(chk_radio1);
			var check2 = checkConfirmation(chk_radio2);

			if(check1 == null || check2 == null) {
				alert('일정을 선택해 주세요');
			} else {
				document.form1.submit();
			}

		} else {
			chk_radio1 = document.getElementsByName('goCheck');
			var check = checkConfirmation(chk_radio1);

			if(check == null) {
				alert('일정을 선택해 주세요');
			} else {
				document.form1.submit();
			}
		}
	}

	function checkConfirmation(chk_radio) {
		var check = null;

		for(var i=0;i<chk_radio.length;i++){
			if(chk_radio[i].checked == true){
				check = chk_radio[i].value;
			}
		}

		return check;
	}
</script>

<section class="ftco-section ftco-no-pb">
 <div class="container">
  <div class="row">
   <div class="col-md-12">
    <div class="search-wrap-1 ftco-animate">
     <form action="/air/search" method="post" class="search-property-1">
	  @csrf

	   <div class="row no-gutters">
			<div class="col-2 d-flex">
				<div class="form-group p-4 border-0">
					<div id="radioGroup" class="btn-group btn-group-toggle" data-toggle="buttons">
						@if(old('radios') == 0)
							<label class="btn btn-lg btn-danger">
								<input type="radio" name="radios" id="radio1" value="0" checked="checked" onclick="radioCheck()"> 왕복
							</label>
							<label class="btn btn-lg btn-danger">
								<input type="radio" name="radios" id="radio2" value="1" onclick="radioCheck()"> 편도
							</label>
						@else
							<label class="btn btn-lg btn-danger">
								<input type="radio" name="radios" id="radio1" value="0" onclick="radioCheck()"> 왕복
							</label>
							<label class="btn btn-lg btn-danger">
								<input type="radio" name="radios" id="radio2" value="1" checked="checked" onclick="radioCheck()"> 편도
							</label>
						@endif
					</div>
				</div>
			</div>
			<div class="col-5 d-flex">
				<div class="form-group p-4">
				 <label for="#">출발지</label>
				 <div class="form-field">
				   <div class="icon"><span class="fa fa-chevron-down"></span></div>
					   <select name="departure" id="departure" class="form-control">
							<option value="">Select place</option>
							@foreach($list as $row)
								@if(old('departure') == $row->id)
									<option value="{{$row->id}}" selected>{{ $row->cities_name }}({{$row->name}})</option>
								@else
									<option value="{{$row->id}}">{{ $row->cities_name }}({{$row->name}})</option>
								@endif
							@endforeach
					   </select>
				 </div>
				 @error('departure'){{ $message }}@enderror
			   </div>
			 </div>
			 <div class="col-5 d-flex">
				<div class="form-group p-4">
				 <label for="#">목적지</label>
				 <div class="form-field">
				   <div class="icon"><span class="fa fa-chevron-down"></span></div>
						<select name="destnation" id="destnation" class="form-control">
							<option value="">Select place</option>
							@foreach($list as $row)
								@if(old('destnation') == $row->id)
									<option value="{{$row->id}}" selected>{{ $row->cities_name }}({{$row->name}})</option>
								@else
									<option value="{{$row->id}}">{{ $row->cities_name }}({{$row->name}})</option>
								@endif
							@endforeach
					   </select>
				 </div>
				 @error('destnation'){{ $message }}@enderror
			   </div>
			 </div>
	   </div>

      <div class="row no-gutters">
     <div class="col-lg d-flex">
      <div class="form-group p-4 border-0">
       <label for="#">가는 편 날짜</label>
       <div class="form-field">
         <div class="icon"><span class="fa fa-calendar"></span></div>
         <input type="text" id="startDate" name="startDate" value="{{ old('startDate') }}" class="form-control checkin_date" placeholder="가는 편 날짜" autocomplete="off">
       </div>
	   @error('startDate'){{ $message }}@enderror
     </div>
   </div>
   <div class="col-lg d-flex">
    <div class="form-group p-4">
     <label for="#">오는 편 날짜</label>
     <div class="form-field">
       <div class="icon"><span class="fa fa-calendar"></span></div>
       <input type="text" id="endDate" name="endDate" value="{{ old('endDate') }}" class="form-control checkout_date" placeholder="오는 편 날짜" autocomplete="off">
     </div>
	 @error('endDate'){{ $message }}@enderror
   </div>
 </div>
 <div class="col-lg d-flex">
  <div class="form-group p-4">
   <label for="#">성인<br>(만 12세 이상)</label>
   <div class="form-field">
     <div class="select-wrap">
      <div class="icon"><span class="fa fa-chevron-down"></span></div>
      <select name="adult" class="form-control">
	     <option value="">---</option>
		 @for($i = 1; $i < 8; $i++)
			@if(old('adult') == $i)
				<option value="{{$i}}" selected>성인{{$i}}</option>
			@else
				<option value="{{$i}}">성인{{$i}}</option>
			@endif
		 @endfor
      </select>
    </div>
	@error('adult'){{ $message }}@enderror
  </div>
</div>
</div>

 <div class="col-lg d-flex">
  <div class="form-group p-4">
   <label for="#">어린이<br>(만 2~11세 이상)</label>
   <div class="form-field">
     <div class="select-wrap">
      <div class="icon"><span class="fa fa-chevron-down"></span></div>
      <select name="child" class="form-control">
	    <option value="0">---</option>
		@for($i = 1; $i < 8; $i++)
			@if(old('child') == $i)
				<option value="{{$i}}" selected>어린이{{$i}}</option>
			@else
				<option value="{{$i}}">어린이{{$i}}</option>
			@endif
		@endfor
      </select>
    </div>
  </div>
</div>
</div>

 <div class="col-lg d-flex">
  <div class="form-group p-4">
   <label for="#">유아<br>(0~23개월)</label>
   <div class="form-field">
     <div class="select-wrap">
      <div class="icon"><span class="fa fa-chevron-down"></span></div>
      <select name="infant" id="" class="form-control">
		<option value="0">---</option>
		@for($i = 1; $i < 8; $i++)
			@if(old('infant') == $i)
				<option value="{{$i}}" selected>유아{{$i}}</option>
			@else
				<option value="{{$i}}">유아{{$i}}</option>
			@endif
		@endfor
      </select>
    </div>
  </div>
</div>
</div>

<div class="col-lg d-flex">
  <div class="form-group d-flex w-100 border-0">
   <div class="form-field w-100 align-items-center d-flex">
    <input type="submit" value="Search" class="align-self-stretch form-control btn btn-primary">
  </div>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</section>

@if($schedule)
	<form method="post" name="form1" action="/air/reservation">
	@csrf

	<input type="hidden" name="adult" value="{{old('adult')}}">
	<input type="hidden" name="child" value="{{old('child')}}">
	<input type="hidden" name="infant" value="{{old('infant')}}">
	<input type="hidden" name="radios" value="{{old('radios')}}">

	<p><p><br>
	<div class="container">
	  <?php
		$startDate = "";
		if(old('startDate')) {
			$start = explode('/', old('startDate'));
			$startDate = $start[2].'/'.$start[0].'/'.$start[1];
		}
	  ?>
	  <div class="row bg-primary text-white align-items-center text-center">
		<div class="col-md">{{$startDate}} (가는 편)</div>
	  </div>
	  <div class="row bg-primary text-white align-items-center text-center">
		<div class="col-md-2">
		  편명
		</div>
		<div class="col-md-3">
			@foreach($list as $row)
				@if(old('departure') == $row->id)
					{{ $row->cities_name }}({{$row->name}})
					<br><span style="font-size: 11px">출발</span>
				@endif
			@endforeach
		</div>
		<div class="col-md-1">
		  ----><br><span style="font-size: 11px">소요시간</span>
		</div>
		<div class="col-md-3">
			@foreach($list as $row)
				@if(old('destnation') == $row->id)
					{{ $row->cities_name }}({{$row->name}})
					<br><span style="font-size: 11px">도착</span>
				@endif
			@endforeach
		</div>
		<div class="col-md-3">
		  가격
		</div>
	  </div>

	  @if($schedule)
		  @if(count($schedule) > 0)
			  @foreach($schedule as $row)
				  <?php
					$date1 = $row->startDate;
					$str_date1 = strtotime($date1);
					$startTime = date('H:i', $str_date1);

					$date2 = $row->endDate;
					$str_date2 = strtotime($date2);
					$endTime = date('H:i', $str_date2);

					$sub_date = abs($str_date1 - $str_date2);
					$hours = floor($sub_date / (60 * 60));
					$min = floor($sub_date / 60 - ($hours * 60));
				  ?>
				  <br>
				  <div class="row align-items-center text-center" id="schedule">
					<div class="col-md-2 text-center">{{$row->planes_number}}</div>
					<div class="col-md-3 text-center">{{$startTime}}</div>
					<div class="col-md-1 text-center">
					  ----><br><span style="font-size: 8px">{{$hours}}시간 {{$min}}분</span>
					</div>
					<div class="col-md-3 text-center">{{$endTime}}</div>
					<div class="col-md-3 text-center">
						{{ number_format($row->price) }} &nbsp; &nbsp;
						<span>
							<input type="radio" name="goCheck" value="{{ $row->id }}">
						</span>
					</div>
				  </div>
			  @endforeach
		  @else
			  <br>
			  <div class="row align-items-center text-center">
				<div class="col-md-12 text-center">비행 일정이 없습니다.</div>
			  </div>
		  @endif
	  @endif

	</div>
	<p><p><br>


	<div class="container ">
		<?php
			$endDate = "";
			if(old('endDate')) {
				$end = explode('/', old('endDate'));
				$endDate = $end[2].'/'.$end[0].'/'.$end[1];
			}
		?>
	  <div class="row bg-primary text-white align-items-center text-center">
		<div class="col-md">{{$endDate}} (오는 편)</div>
	  </div>
	  <div class="row bg-primary text-white align-items-center text-center">
		<div class="col-md-2">
		  편명
		</div>
		<div class="col-md-3">
		   @foreach($list as $row)
				@if(old('destnation') == $row->id)
					{{ $row->cities_name }}({{$row->name}})
					<br><span style="font-size: 11px">출발</span>
				@endif
			@endforeach
		</div>
		<div class="col-md-1">
		  ----><br><span style="font-size: 11px">소요시간</span>
		</div>
		<div class="col-md-3">
		  @foreach($list as $row)
				@if(old('departure') == $row->id)
					{{ $row->cities_name }}({{$row->name}})
					<br><span style="font-size: 11px">도착</span>
				@endif
			@endforeach
		</div>
		<div class="col-md-3">
		  가격
		</div>
	  </div>

	  @if($return_schedule)
		  @if(count($return_schedule) > 0)
			  @foreach($return_schedule as $row)
				<?php
					$date1 = $row->startDate;
					$str_date1 = strtotime($date1);
					$startTime = date('H:i', $str_date1);

					$date2 = $row->endDate;
					$str_date2 = strtotime($date2);
					$endTime = date('H:i', $str_date2);

					$sub_date = abs($str_date1 - $str_date2);
					$hours = floor($sub_date / (60 * 60));
					$min = floor($sub_date / 60 - ($hours * 60));
				?>
				  <br>
				  <div class="row align-items-center text-center">
					<div class="col-md-2 text-center">{{$row->planes_number}}</div>
					<div class="col-md-3 text-center">{{$startTime}}</div>
					<div class="col-md-1 text-center">
					  ----><br><span style="font-size: 8px">{{$hours}}시간 {{$min}}분</span>
					</div>
					<div class="col-md-3 text-center">{{$endTime}}</div>
					<div class="col-md-3 text-center">
						{{number_format($row->price)}} &nbsp; &nbsp;
						<span>
							<input type="radio" name="comeCheck" value="{{$row->id}}">
						</span>
					</div>
				  </div>
			  @endforeach
		  @else
			  <br>
			  <div class="row align-items-center text-center">
				<div class="col-md-12 text-center">비행 일정이 없습니다.</div>
			  </div>
		  @endif
	  @endif
	</div>
	<p><p><br>

	<div class="container ">
		<div class="col-lg d-flex">
		  <div class="form-group d-flex w-100 border-0">
		   <div class="form-field w-100 align-items-center d-flex">
		   @if(session()->exists('consumer'))
				<input type="button" onclick="selectCheck()" value="다음 페이지" class="align-self-stretch form-control btn btn-primary glyphicon">
			@else
				<input type="text" value="로그인이 필요합니다." class="align-self-stretch form-control btn btn-primary glyphicon" readonly>
			@endif
		  </div>
		</div>
	</div>
	<p><p><br>
	</form>
@endif

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
   <a href="{{route('hotel.index')}}" class="img" style="background-image: url(/images/hotel-resto-2.jpg);">

  </a>
  <div class="text p-4">
    <span class="days">Hotel</span>
    <h3><a href="{{route('hotel.index')}}">호텔 예약</a></h3>
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
