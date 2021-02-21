@extends('hmain')
@section('content')
<style>
$blue: #269bff;
$bg-light: #f2f2f2;
$bg-med: #eee;

div.checkbox.switcher, div.radio.switcher {
  label {padding: 0;
    * {vertical-align: middle;}
    input {display: none;
      &+span {position: relative; display: inline-block; margin-right: 10px; width: 56px; height: 28px; background: $bg-light; border: 1px solid $bg-med; border-radius: 50px; transition: all 0.3s ease-in-out;
        small {position: absolute; display: block; width: 50%; height: 100%; background: #fff; border-radius: 50%; transition: all 0.3s ease-in-out; left: 0;}
      }
      &:checked+span {background: $blue; border-color: $blue;
        small {left: 50%;}
      }
    }
  }
}

// the basic
body {color: #757575; font-family: 'Lato', sans-serif; font-size: 16px;}
  div.container {padding: 5% 0}
}
</style>

 <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('/images/bg_1.jpg');">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 text-center">
       <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span> <span class="mr-2"><a href="index.html">Hotel <i class="fa fa-chevron-right"></i></a></span> <span>Hotel Detail <i class="fa fa-chevron-right"></i></span></p>
       <h1 class="mb-0 bread">Hotel Details</h1>
     </div>
   </div>
 </div>
</section>

<section class="ftco-section ftco-no-pt ftco-no-pb">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 ftco-animate py-md-5 mt-md-5">
	  <form name="form1" method="post" action="{{route('hotel.reservation')}}" name="hreserve">
	  @csrf
	  @foreach($room as $row)
	  	<p>
          <img src="../storage/hotel_img/{{$row->pic}}" alt="" class="img-fluid">
        </p>
			<div class="about-author d-flex" style="display: flex; align-items: center; justify-content: center;">
			  <div class="desc">
					<p style="margin-top:30px;">
					</p>
					<p><h3 style="display: flex; align-items: center; justify-content: center; color: #f15e31;">&nbsp;&nbsp;{{$row->type}}</h3></p>
					<div style="display: flex; align-items: center; justify-content: center; margin-top:20px">
					<i class="fas fa-bed"> 침대 <p style="text-align:center;">{{$row->bed}}개</p></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="fas fa-toilet"> 화장실 <p style="text-align:center;">{{$row->bathroom}}개</p></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="fas fa-money-check-alt"> 가격(1박) <p style="text-align:center;">{{$row->price}}</p></i>
					</div>
			  </div>
			</div>
			<ul class="comment-list">
				<li class="comment" style="margin-top:10px; margin-bottom:10px;">
					<hr>
				</li>
				<li class="comment" style="margin-bottom:0px;">
					<div class="row" style="display: flex; align-items: center; justify-content: center;">
						<div class="col-1"></div>
						<div class="col-5" style="display: flex; align-items: start; justify-content: left;">
							<div class="form-field" style="display: flex; align-items: start; justify-content: left;">
							  <div class="icon"><span class="fas fa-concierge-bell">&nbsp;&nbsp; 조식 추가</span></div>
							</div>
						</div>
						<div class="col-3"></div>
						<div class="col-2" style="display: flex; align-items: center; justify-content: right;">
							<div class="form-field" >
							  <input type="checkbox" name="addmorning" id="addmorning" data-toggle="switchbutton" data-onstyle="primary" data-offstyle="outline-light" data-width="100" onchange="javascript:check1();">
							</div>
						</div>
						<div class="col-1"></div>
					</div>
				</li>

				<li class="comment" style="margin-top:10px; margin-bottom:10px;">
					<hr>
				</li>
				<li class="comment" style="margin-bottom:0px;">
					<div class="row" style="display: flex; align-items: center; justify-content: center;">
						<div class="col-1"></div>
						<div class="col-5" style="display: flex; align-items: start; justify-content: left;">
							<div class="form-field" style="display: flex; align-items: start; justify-content: left;">
							  <div class="icon"><span class="fas fa-bed">&nbsp;&nbsp; 침대사이즈</span></div>
							</div>
						</div>
						<div class="col-3"></div>
						<div class="col-2" style="display: flex; align-items: center; justify-content: right;">
							<div class="form-field" >
							  <input type="checkbox" name="bedsize" id="bedsize" data-toggle="switchbutton" data-onstyle="primary" data-offstyle="outline-light" data-width="100" onchange="javascript:check2();"">
							</div>
						</div>
						<div class="col-1"></div>
					</div>
				</li>

				<li class="comment" style="margin-top:10px; margin-bottom:10px;">
					<hr>
				</li>
				<li class="comment" style="margin-bottom:0px;">
					<div class="row" style="display: flex; align-items: center; justify-content: center;">
						<div class="col-1"></div>
						<div class="col-5" style="display: flex; align-items: start; justify-content: left;">
							<div class="form-field" style="display: flex; align-items: start; justify-content: left;">
							  <div class="icon"><span class="fas fa-wifi">&nbsp;&nbsp; 휴대용 WIFI</span></div>
							</div>
						</div>
						<div class="col-3"></div>
						<div class="col-2" style="display: flex; align-items: center; justify-content: right;">
							<div class="form-field" >
							  <input type="checkbox" name="addwifi" id="addwifi" data-toggle="switchbutton" data-onstyle="primary" data-offstyle="outline-light" data-width="100" onchange="javascript:check3();">
							</div>
						</div>
						<div class="col-1"></div>
					</div>
				</li>


				<li class="comment" style="margin-top:10px; margin-bottom:10px;">
					<hr>
				</li>

			</ul>
      </div>
	  @endforeach
	  <!-- .col-md-8 -->
      <div class="col-lg-4 sidebar ftco-animate bg-light py-md-5" >
		<div class="sidebar-box pt-md-2"></div>
        <div class="sidebar-box pt-md-3" style="text-align:center; border-style:solid; border-width:1px; border-color:#f37048; border-radius:3px; color:#f37048; ">
            <div class="form-field">
              <h3 style="color:#f37048;">호텔 예약</h3>
            </div>
        </div>

			<div class="row">
				<div class="col-2"></div>
				<div class="col-4">
					<div class="form-field">
					  <p style="text-align:left; vertical-align:middle; font-size:15pt;">체크인 : </p>
					</div>
				</div>
				<div class="col-4">
					<div class="form-field">
					  <input type="text" name="check_in" id="check_in" value="{{$check_in}}" style="text-align:right; font-size:15pt; border:0; background-color:#f9fafb; width:100%; text-align: right;" readonly>
					</div>
				</div>
				<div class="col-2"></div>

				<div class="col-2"></div>
				<div class="col-4">
					<div class="form-field">
					  <p style="text-align:left; vertical-align:middle; font-size:15pt;">체크아웃 : </p>
					</div>
				</div>
				<div class="col-4">
					<div class="form-field">
					   <p style="text-align:right; vertical-align:middle; font-size:15pt;"><input type="text" name="check_out" id="check_out" value="{{$check_out}}" style="border:0; background-color:#f9fafb; width:100%; text-align: right;" readonly></p>
					</div>
				</div>
				<div class="col-2"></div>

				<div class="col-2"></div>
				<div class="col-4">
					<div class="form-field">
					  <p style="text-align:left; vertical-align:middle; font-size:15pt;">어른 : </p>
					</div>
				</div>
				<div class="col-4">
					<div class="form-field">
					   <p style="text-align:right; vertical-align:middle; font-size:15pt;"><input type="text" name="adult" id="adult" value="{{$adult}}" style="border:0; background-color:#f9fafb; width:100%; text-align: right;" readonly></p>
					</div>
				</div>
				<div class="col-2"></div>

				<div class="col-2"></div>
				<div class="col-4">
					<div class="form-field">
					  <p style="text-align:left; vertical-align:middle; font-size:15pt;">어린이 : </p>
					</div>
				</div>
				<div class="col-4">
					<div class="form-field">
					   <p style="text-align:right; vertical-align:middle; font-size:15pt;"><input type="text" name="child" id="child" value="{{$child}}" style="border:0; background-color:#f9fafb; width:100%; text-align: right;" readonly></p>
					</div>
				</div>
				<div class="col-2"></div>
				@foreach($room as $row)
				<div class="col-2"></div>
				<div class="col-4">
					<div class="form-field">
					  <p style="text-align:left; vertical-align:middle; font-size:15pt;">객실 : </p>
					</div>
				</div>
				<div class="col-4">
					<div class="form-field">
					   <p style="text-align:right; vertical-align:middle; font-size:15pt;"><input type="text" name="type" id="type" value="{{$row->type}}" style="border:0; background-color:#f9fafb; width:100%; text-align: right;" readonly></p>
					   <input type="text" name="hotel_id" id="hotel_id" value="{{$row->hotel_id}}" style="border:0; background-color:#f9fafb; width:100%; text-align: right; display:none;">
					   <!--수정roomtype-->
					  <input type="text" name="roomtype" value="{{$row->id}}" style="display:none;">
					</div>
				</div>
				<div class="col-2"></div>
				@endforeach

				<div class="col-2"></div>
				<div class="col-3">
					<div class="form-field">
					  <p style="text-align:left; vertical-align:middle; font-size:15pt;">가격 : </p>
					</div>
				</div>
				<div class="col-5">
					<div class="form-field">
					  <p style="text-align:right; vertical-align:middle; font-size:15pt;"><input type="text" name="price" id="price" value="{{$price}}" style="border:0; background-color:#f9fafb; width:100%; text-align: right;" readonly></p>
					  <input type="text" name="realprice" id="realprice" value="{{$realprice}}" style="border:0; background-color:#f9fafb; width:100%; text-align: right; display:none;">
					  <input type="text" name="consumer_id" id="consumer_id" value="{{$consumer_id}}" style="border:0; background-color:#f9fafb; width:100%; text-align: right; display:none;">
					</div>
				</div>
				<div class="col-2"></div>

				<div class="col-12" style="margin-top:20px">
					<div class="form-field buttonHolder">
						<button type="submit" class="btn btn-lg btn-primary btn-block"><strong>예약하기</strong></button>
						<a href="{{route('hotel.index')}}" class="btn btn-lg btn-primary btn-block" style="margin-top:20px;"><strong>메인</strong></a>
					</div>
				</div>
				</form>
			</div>


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

<section class="ftco-intro ftco-section ftco-no-pt" style="margin-top:10px">
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

	function check1(){
		var chkbox = document.getElementById('addmorning');
		var total = document.getElementById('realprice').value;
		if(chkbox.checked)
			total = parseInt(total) + 50000;
		else
			total = parseInt(total) - 50000;

		var real = total;
		total = comma(total);

		document.getElementById("price").value = total + '원';
		document.getElementById("realprice").value = real;
	}

	function check2(){
		var chkbox = document.getElementById('bedsize');
		var total = document.getElementById('realprice').value;
		if(chkbox.checked)
			total = parseInt(total) + 70000;
		else
			total = parseInt(total) - 70000;

		var real = total;
		total = comma(total);

		document.getElementById("price").value = total + '원';
		document.getElementById("realprice").value = real;
	}


function check3(){
		var chkbox = document.getElementById('addwifi');
		var total = document.getElementById('realprice').value;
		if(chkbox.checked)
			total = parseInt(total) + 90000;
		else
			total = parseInt(total) - 90000;

		var real = total;
		total = comma(total);

		document.getElementById("price").value = total + '원';
		document.getElementById("realprice").value = real;
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

