@extends('hmain')
@section('content')
<style>
.my-color{
	color:#F15D30;
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
.reservation-button{
	color:#fff;
	background-color:#F15D30;
	padding-block:10px;
	font-weight:700;
	font-size:18px;
	border-radius:7px;
	border: 2px solid #F15D30;
}
.reservation-button:hover {
	background:#f9fafb;
	color:#F15D30;
}
.service-button{
	color:black;
	background-color:#f9fafb;
	padding-block:10px;
	font-weight:700;
	font-size:14px;
	border-radius:7px;
	border: 1px solid #000;
}
.service-button:hover{
	color:#F15D30;
	border: 1px solid #F15D30;
}
.service-button:not(:disabled):not(.disabled).active{
	background:#F15D30;
	color:#fff;
	border:1px solid #F15D30;
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

<section class="ftco-section ftco-no-pt ftco-no-pb">
  <div class="container">
    <div class="row">
	  <div class="col-lg-8 ftco-animate py-md-5 mt-md-5">
		<p style="height:500px;width:100%;background-size:cover;background-image:url('/storage/package_pic/{{$row->pic}}');display:block;"></p>
		<br>
		<h1> {{$row->name}} </h1>
		<br><br>
		<div>
		  <form name="form1" action="{{route('package.store')}}" method="post"> 
		  @csrf
		  	<input type="hidden" name="consumer_id" value="{{session()->get('consumer')->id}}" readonly>
			<input type="hidden" name="package_id" value="{{$row->id}}" readonly>
			<input type="hidden" name="adult" value="{{$adult}}" style="display:none;" readonly>
			<input type="hidden" name="kid" value="{{$kid}}" style="display:none;" readonly>
			<input type="hidden" name="baby" value="{{$baby}}" style="display:none;" readonly>
			<input type="hidden" name="package_total" value="{{$packageTotal}}" style="display:none;" readonly>
			<input type="hidden" name="service_total" value="0" readonly>
			<input type="hidden" name="total" value="{{$packageTotal}}" style="display:none;"  readonly>
			<table class="table text-center" >
			<thead>
				<tr>
					<th colspan="2" style="border-top:0px;font-size:15px">서비스 선택</td>
				</tr>
			</thead>
			<tr>
				<td width="75%" align="left" style="padding-left:7%;vertical-align:middle;"><i class="fas fa-concierge-bell"></i> 호텔 조식추가</td>
				<td width="25%" align="center" style="">
					<div class="btn-group-toggle" data-toggle="buttons">
					  <label class="btn service-button" id="breakfast-label" for="breakfast" onclick="priceCompute({{$packageTotal}}, 'breakfast',50000);" style="width:100%">
						<input type="checkbox" id="breakfast" name="breakfast" value="off"> +50,000원
					  </label>
					</div>
				</td>
			</tr>
			<tr>
				<td align="left" style="padding-left:7%;vertical-align:middle;"><i class="fas fa-bed"></i> 침대 사이즈 업 </td>
				<td align="center" style="">
					<div class="btn-group-toggle" data-toggle="buttons">
					  <label class="btn service-button" id="bedsize-label" for="bedsize" onclick="priceCompute({{$packageTotal}}, 'bedsize',70000);" style="width:100%">
						<input type="checkbox" id="bedsize" name="bedsize" value="off"> +70,000원
					  </label>
					</div>
				</td>
			</tr>
			<tr>
				<td align="left" style="padding-left:7%;vertical-align:middle;"><i class="fas fa-wifi"></i> 휴대용 Wifi</td>
				<td align="center" style="">
					<div class="btn-group-toggle" data-toggle="buttons">
					  <label class="btn service-button" id="wifi-label" for="wifi" onclick="priceCompute({{$packageTotal}}, 'wifi',90000);" style="width:100%">
						<input type="checkbox" id="wifi" name="wifi" value="off"> +90,000원
					  </label>
					</div>
				</td>
			</tr>
			@if($row->departure_schedule_startDate)
			<tr>
				<td align="left" style="padding-left:7%;vertical-align:middle;"><i class="fas fa-plane"></i> 항공기 업그레이드</td>
				<td align="center" style="">
					<div class="btn-group-toggle" data-toggle="buttons">
					  <label class="btn service-button" id="airplaneup-label" for="airplaneup" onclick="priceCompute({{$packageTotal}}, 'airplaneup',350000);" style="width:100%">
						<input type="checkbox" id="airplaneup" name="airplaneup" value="off"> +350,000원
					  </label>
					</div>
				</td>
			</tr>
			@endif
			<tr>
				<td align="left" style="padding-left:7%;vertical-align:middle;"><i class="fas fa-bus-alt"></i> 공항 셔틀버스</td>
				<td align="center" style="">
					<div class="btn-group-toggle" data-toggle="buttons">
					  <label class="btn service-button" id="shuttle-label" for="shuttle" onclick="priceCompute({{$packageTotal}}, 'shuttle',70000);" style="width:100%">
						<input type="checkbox" id="shuttle" name="shuttle" value="off"> +70,000원
					  </label>
					</div>
				</td>
			</tr>
			</table>
		  </form>
		</div>
	  </div> 
	  <!-- .col-md-8 -->
	  <div class="col-lg-4 sidebar ftco-animate bg-light py-md-5">
		  <div class="text-center">
			<div class="sidebar-box pt-md-5">
				<div style="color:#fff;background-color:#F15D30;padding-block:10px;font-weight:1000;font-size:20px;">패키지 여행</div>
			</div>
		  </div>
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
			<div class="reservation-bmargin">
				<p style="margin-bottom:0px;font-weight:bold"><i class="fas fa-credit-card"></i> 여행 비용 </p>
				<div class="row">
					<div class="col-7" style="justify-content:center;margin-top:9px">
						<p style="margin-bottom:0px">패키지 여행 비용</p>
					</div>
					<div class="col-5" style="margin-top:9px" align="right"><p id="package-price">{{number_format($packageTotal)}}원</p></div>
					<div class="col-7" style="justify-content:center;margin-top:9px">
						<p style="margin-bottom:0px">서비스 추가 비용</p>
					</div>
					<input type="text" name="service_price" value="600000" style="display:none;" width="80%" readonly>
					<div class="col-5" style="margin-top:9px" align="right"><p id="service-price">0원</p></div>
				</div>		

				<div class="text-center reservation-bmargin">
					<div class="row">
					<div class="col-5" style="justify-content:center;">
						<p class="my-color" style="margin-bottom:0px;font-size:22px;font-weight:700">총 비용</p></div>
					<div class="col-7" align="right">
						<p id="total-price" class="my-color" style="font-size:22px;font-weight:700">{{number_format($packageTotal)}}원</p>
					</div>
					</div>
				</div>
			</div>
			<button type="button" class="btn btn-block reservation-button" onclick="document.form1.submit();">예약 하기</button>
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
var serviceTotal = 0; var total = 0;

function priceCompute(pPrice, id, price){
	if(document.getElementById(id).value == "off"){
		lavelId = id + "-label";
		document.getElementById(lavelId).className = "btn service-button active";

		document.getElementById(id).value = "on";
		serviceTotal += parseInt(price);
	}
	else{
		lavelId = id + "-label";
		document.getElementById(lavelId).className = "btn service-button";

		document.getElementById(id).value = "off";
		serviceTotal -= parseInt(price);
	}
	total = serviceTotal + parseInt(pPrice);

	form1.service_total.value = serviceTotal;
	document.getElementById('service-price').innerHTML = serviceTotal.toLocaleString() + "원"; 
	form1.total.value = total;
	document.getElementById('total-price').innerHTML = total.toLocaleString() + "원"; 
}

</script>
@endsection()