@extends('hmain')
@section('content')
 <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('/images/bg_1.jpg');">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 text-center">
       <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span> <span class="mr-2"><a href="index.html">Hotel <i class="fa fa-chevron-right"></i></a></span> <span>Detail <i class="fa fa-chevron-right"></i></span></p>
       <h1 class="mb-0 bread">Information</h1>
     </div>
   </div>
 </div>
</section>
<section class="ftco-section ftco-no-pt ftco-no-pb">
  <div class="container">
    <div class="row">
			@foreach($list ?? '' as $row)
      <div class="col-lg-8 ftco-animate py-md-5 mt-md-5">
	  	<p>
          <img src="../storage/hotel_img/{{ $row->pic }}" alt="" class="img-fluid">
        </p>
		<ul class="comment-list">
			<li class="comment">
				<div class="comment-body">
					<h1 class="mb-3 mt-5"><strong>{{$row->name}}</strong></h1>
					<input type="text" name="hotel_id" id="hotel_id" value="{{$row->id}}" style="display:none;">
					<div class="meta">{{$row->city_name}}, {{$row->nation_name}}</div><br><hr><br>
					<h2 class="mb-3" style="font-weight: bold;"><i class="fas fa-book-open"></i>&nbsp;호텔 설명</h2>
					<p>{{$row->explain}}</p>
				</div>
			</li>
			@endforeach
			<li class="comment">
				<hr>
			</li>
			<li class="comment">
				<div class="about-author d-flex">
				  <div class="desc">
					  <h2 class="mb-3" style="font-weight: bold;"><i class="fas fa-door-closed"></i>&nbsp;호텔 객실</h2>
					@foreach($room as $row1)
						<p style="margin-top:30px;">
						  <img src="../storage/hotel_img/{{ $row1->pic }}" alt="" class="img-fluid">
						</p>
						<p><h3 style="display: flex; align-items: center; justify-content: center; color: #f15e31;">&nbsp;&nbsp;{{$row1->type}}</h3></p>
						<div style="display: flex; align-items: center; justify-content: center; margin-top:20px">
						<i class="fas fa-bed"> 침대 <p style="text-align:center;">{{$row1->bed}}개</p></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="fas fa-toilet"> 화장실 <p style="text-align:center;">{{$row1->bathroom}}개</p></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="fas fa-money-check-alt"> 가격(1박) <p style="text-align:center;">{{number_format($row1->price)}}원</p></i>
						</div>
					@endforeach
				  </div>
				</div>
			</li>
			<li class="comment">
				<hr>
			</li>
			<li class="comment">
			<h2 class="mb-3" style="font-weight: bold;"><i class="fas fa-map-marked-alt"></i>&nbsp;호텔 위치</h2>
				  <div class="map-responsive">
					@foreach($list ?? '' as $row)
						<iframe src="{{$row->gm_address}}" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0" ></iframe>
					@endforeach
				  </div>
			</li>
			<li class="comment">
				<hr>
			</li>
			<!--  -->
			<div class="pt-5 mt-5">
			  <ul class="comment-list">
			  		@if(session()->exists('consumer'))
						<button class="btn btn-primary float-right" id="btn-add">&nbsp;후기 남기기</button>
					@else
						<button class="btn btn-primary float-right" id="btn-add" disabled>로그인 후 사용</button>
					@endif
					<h2 style="font-weight: bold; margin-bottom:0px;"><i class="fab fa-readme"></i> 이용 후기</h2>
					<span id="test" class="meta" style="color: #f37048;">{{$total}}</span>
					<span class="meta" style="color: #f37048;">개 이용 후기</span>
					<input type="text" name="count" id="count" value="{{$total}}" style="display:none">
				<ul class="children" id="todos-list">
      		  	@foreach ($com as $data)
				<li class="comment">
				  <div class="vcard bio col-2">
				  	@if($data->consumer_pic)
						<img src="../storage/user_pic/{{$data->consumer_pic}}" alt="Image placeholder">
					@else
						<img src="../storage/user_pic/default.png" alt="Image placeholder">
					@endif
				  </div>
				  <div class="comment-body col-10">
					<h3>{{$data->consumer_name}}</h3>
					<div class="meta">{{$data->updated_at}}</div>
					<p>{{$data->comment}}</p>
					@if(session()->get('consumer'))
						@if(session()->get('consumer')->uid == $data->consumer_uid)
							<p><a href="{{route('comment.destroy', $data->id)}}" class="reply" onClick="return confirm('삭제할까요 ?');">Delete</a></p>
						@endif
					@endif
				  </div>
				</li>
				@endforeach

				<?php
					if(session()->get('consumer'))
						$id = session()->get('consumer')->id;
				?>
				<input type="text" name="consumer_id" id="consumer_id" value="{{$id ?? ''}}" style="display:none;">

				@if(session()->get('consumer'))
				@foreach ($consumer as $row)
					<input type="text" name="pic" id="pic" value="{{$row->pic}}" style="display:none;">
					<input type="text" name="name" id="name" value="{{$row->name}}" style="display:none;">
					<input type="text" name="com_id" id="com_id" value="{{$com_id->id}}" style="display:none">
				@endforeach
				@endif
				</ul>
			  </ul>
			</div>
			<!--  -->
		</ul>
      </div>

	  <!-- .col-md-8 -->
      <div class="col-lg-4 sidebar ftco-animate bg-light py-md-5">
		<div class="sidebar-box pt-md-2"></div>
        <div class="sidebar-box pt-md-3" style="text-align:center; background-color:#f37048; color:#ffffff;">
            <div class="form-field">
              <h3 style="color:#ffffff;">호텔 예약</h3>
            </div>
        </div>
		<form name="form1" method="post" action="{{route('hotel.order')}}">
		@csrf
			<div class="row">
				<div class="col-5">
					<div class="form-field">
					  <div class="icon" style="text-align:center;"><span class="fa fa-calendar">&nbsp;&nbsp; 체크인</span></div>
					  <input type="text" name="check_in" id="check_in" class="form-control checkin_date" value="" placeholder="날짜 선택" onchange='fn_check()'>
					  @error('check_in') {{$message}} @enderror
					</div>
				</div>
				<div class="col-2">
					<div class="form-field">
					  <div class="icon" style="text-align:center; vertical-align:middle; height:32px;"><span>&nbsp;&nbsp;</span></div>
					  <h3><p style="text-align:center; vertical-align:middle;">~</p></h3>
					</div>
				</div>
				<div class="col-5">
					<div class="form-field">
					  <div class="icon" style="text-align:center;"><span class="fa fa-calendar">&nbsp;&nbsp; 체크아웃</span></div>
					  <input type="text" name="check_out" id="check_out" class="form-control checkin_date" value="" placeholder="날짜 선택" onchange='fn_check()'>
					  @error('check_out') {{$message}} @enderror
					</div>
				</div>

				<div class="col-5" style="display: flex; align-items: center; justify-content: center; margin-top:20px">
					<div class="form-field">
					<label style="display: flex; align-items: center; justify-content: center;"><i class="fas fa-male">&nbsp;어른</i></label>
						<div class="handle-counter" id="handleCounter">
							<button type="button" class="counter-minus btn btn-primary" style="border-radius: 3px;" onclick="fn_check();">-</button>
							<input type="text" name="adult" id="adult" value="2" style="border-radius: 0px;" onclick="fn_check();">
							<button type="button" class="counter-plus btn btn-primary" style="border-radius: 3px;" onclick="fn_check();,fn_check();">+</button>
							@error('adult') {{$message}} @enderror
						</div>
					</div>
				</div>
				<div class="col-2">
				</div>
				<div class="col-5" style="display: flex; align-items: center; justify-content: center; margin-top:20px;">
					<div class="form-field">
					<label style="display: flex; align-items: center; justify-content: center;"><i class="fas fa-child">&nbsp;어린이</i></label>
						<div class="handle-counter" id="handleCounter2">
							<button type="button" class="counter-minus btn btn-primary" style="border-radius: 3px;" onclick="javascript:fn_check();">-</button>
							<input type="text" name="child" id="child" value="0" style="border-radius: 0px;" onclick="javascript:fn_check();">
							<button type="button" class="counter-plus btn btn-primary" style="border-radius: 3px;" onclick="javascript:fn_check();">+</button>
						</div>
					</div>
				</div>

				<div class="col-2">
				</div>
				<div class="col-9" style="display: flex; align-items: center; justify-content: center; margin-top:35px">
					@foreach($room as $row1)
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" name="roomtype" id="roomtype" value="{{$row1->id}}" onchange='fn_check()' checked>
					  <label class="form-check-label" for="roomtype"><strong>{{$row1->type}}&nbsp;&nbsp;&nbsp;</strong></label>
					  <input type="text" name="roomprice{{$row1->id}}" id="roomprice{{$row1->id}}" value="{{$row1->price}}" style="display:none;">
					</div>
					@endforeach
					@error('roomtype') {{$message}} @enderror
				</div>
				<div class="col-1">
				</div>

				<div class="col-2">
				</div>
				<div class="col-8" style="display: flex; align-items: center; justify-content: center; margin-top:35px">
					<input type="text" name="price" id="price" value="0" style="border:0; background-color:#f9fafb; color:#000000; font-size:20pt; width:100%; font-weight:bold; text-align: center; display: flex; align-items: center; justify-content: center;" readonly>
					<input type="text" name="realprice" id="realprice" value="0" style="display:none;">
					@foreach($room as $row1)
						<input type="text" name="hotel_id" id="hotel_id" value="{{$row1->hotel_id}}" style="display:none;">
					@endforeach
				</div>
				<div class="col-2">
				</div>

				<div class="col-12" style="margin-top:40px">
					<div class="form-field buttonHolder">
						@if(!session()->get('consumer'))
							<button type="submit" class="btn btn-lg btn-primary btn-block" disabled><strong>로그인을 먼저 해주세요</strong></button>
						@else
							<button type="submit" class="btn btn-lg btn-primary btn-block"><strong>예약하기</strong></button>
						@endif
					</div>
				</div>
			</div>
		</form>

		<div class="sidebar-box pt-md-3" style="text-align:center; border-style:solid; border-width:1px; border-color:#f37048; border-radius:3px; color:#f37048; margin-top:80px">
            <div class="form-field" style= "border-color:#f37048;">
              <h3 style= "border-color:#f37048; color:#f37048;">편의 시설 및 서비스</h3>
            </div>
        </div>
			<div class="row">
				<div class="col-6" style="margin-top:20px;">
					<div class="form-field">
					  <div class="icon" ><span class="fas fa-wifi">&nbsp;&nbsp; 무료 wifi</span></div>
					</div>
				</div>
				<div class="col-6" style="margin-top:20px;">
					<div class="form-field">
					  <div class="icon"><span class="fas fa-video">&nbsp;&nbsp; 경비 서비스</span></div>
					</div>
				</div>

				<div class="col-6" style="margin-top:20px;">
					<div class="form-field">
					  <div class="icon"><span class="fas fa-broom">&nbsp;&nbsp; 일일 소독</span></div>
					</div>
				</div>
				<div class="col-6" style="margin-top:20px;">
					<div class="form-field">
					  <div class="icon"><span class="fas fa-concierge-bell">&nbsp;&nbsp; 24시간 룸서비스</span></div>
					</div>
				</div>

				<div class="col-6" style="margin-top:20px;">
					<div class="form-field">
					  <div class="icon"><span class="fas fa-hot-tub">&nbsp;&nbsp; 사우나</span></div>
					</div>
				</div>
				<div class="col-6" style="margin-top:20px;">
					<div class="form-field">
					  <div class="icon"><span class="fas fa-skiing-nordic">&nbsp;&nbsp; 피트니스 센터</span></div>
					</div>
				</div>

				<div class="col-6" style="margin-top:20px;">
					<div class="form-field">
					  <div class="icon"><span class="fas fa-swimmer">&nbsp;&nbsp; 실내 수영장</span></div>
					</div>
				</div>
				<div class="col-6" style="margin-top:20px;">
					<div class="form-field">
					  <div class="icon"><span class="fas fa-medkit">&nbsp;&nbsp; 의무실</span></div>
					</div>
				</div>
			</div>
	  </div>
    </div>
  </div>
</section> <!-- .section -->

<section class="ftco-intro ftco-section ftco-no-pt">
 <div class="container">
  <div class="row justify-content-center">
   <div class="col-md-12 text-center">
    <div class="img"  style="background-image: url(/images/bg_2.jpg);">
     <div class="overlay"></div>
     <h2>We Are Pacific A Travel Agency</h2>
     <p>We can manage your dream building A small river named Duden flows by their place</p>
     <p class="mb-0"><a href="#" class="btn btn-primary px-4 py-3">Ask For A Quote</a></p>
   </div>
 </div>
</div>
</div>
</section>

<script>
	var total = 0;

	function fn_check(){
		var chkRadio = document.getElementsByName('roomtype');
		var rname = 'roomprice';
		var anum = document.getElementById('adult').value;
		var cnum = document.getElementById('child').value;

		for(var i=0;i<chkRadio.length;i++){
			if(chkRadio[i].checked == true) {
				rname = rname.concat(chkRadio[i].value);
			}
		}

		var chkin = document.getElementById('check_in').value;
		var chkout = document.getElementById('check_out').value;
		var arr1 = chkin.split('-');
		var arr2 = chkout.split('-');
		var date1 = new Date(arr1[0],arr1[1],arr1[2]);
		var date2 = new Date(arr2[0],arr2[1],arr2[2]);

		var elapsedMSec = date2.getTime() - date1.getTime(); // 172800000
		var elapsedDay = elapsedMSec / 1000 / 60 / 60 / 24; // 2

		var price = document.getElementById(rname).value;

		if(isNaN(elapsedDay)==false)
			total = price * 1 * anum * elapsedDay + price * 1 / 2 * cnum * elapsedDay;

		var real = comma(total)

		document.getElementById("price").value = real + '원';
		document.getElementById("realprice").value = total;
	}


	function comma(num){
		var len, point, str;

		num = num + "";
		point = num.length % 3 ;
		len = num.length;

		str = num.substring(0, point);
		while (point < len) {
			if (str != "") str += ",";
			str += num.substring(point, point + 3);
			point += 3;
		}

		return str;
	}
</script>

@endsection()
