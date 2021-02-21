@extends('main')
@section('content')
<style>
.input-margin{
	margin-bottom:20px;
}
.input-padding{
	padding:6px 10;
}
.my-active{
	background-color:#F15D30;
	border:1px solid rgba(0, 0, 0, 0.125);
	color:#fff;
}
.my-nonactive{
	background-color:#fff;
	border:1px solid rgba(0, 0, 0, 0.125);;
	color:#000;
}
</style>


 <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url(&quot;/images/bg_1.jpg&quot;); height: 912px;">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center" style="height: 912px;">
      <div class="col-md-9 ftco-animate pb-5 text-center fadeInUp ftco-animated">
       <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span> <span>My page <i class="fa fa-chevron-right"></i></span><span>Reservation <i class="fa fa-chevron-right"></i></span></p>
       <h1 class="mb-0 bread">Reservation
	   </h1>
     </div>
   </div>
 </div>
</section>

<div class="container">
	<div class="offset-lg-1 offset-md-1 col-lg-10 col-md-10" style="margin-top:30px;padding-left:0px;">
		<div class="btn-group btn-group-toggle" data-toggle="buttons">
			<a href="{{route('consumer.edit', session()->get('consumer')->id)}}"><button class="btn my-nonactive">My Info</button></a>
			<a href="{{route('consumer_reservation.index',['id'=> session()->get('consumer')->id]) }}"><button class="btn my-active">Reservation</button></a>
		</div>
	</div>
	<div class="offset-lg-1 offset-md-1 col-lg-10 col-md-10 card" style="margin-top:0px;margin-bottom:30px;color:black;">
		<h6 style="margin-top:30px;font-weight:600;font-size:19px;">예약 목록</h6>
		<hr>
		<div class="input-margin">
			<p style="font-weight:1000;font-size:17px;">패키지여행 예약 목록</p>
			<table class="table text-center" style="font-size:13px">
			  <thead style="color:#fff;background-color:#F15D30">
				<tr>
				  <th scope="col" width="10%">예약번호</th>
				  <th scope="col" width="30%">패키지명</th>
				  <th scope="col" width="25%">날짜</th>
				  <th scope="col" width="10%">인원</th>
				  <th scope="col" width="25%">가격</th>
				</tr>
			  </thead>
			  <tbody>
			  	@foreach($packageReservations as $row)
			  	<tr>
					<td>{{$row->id}}</td>
					<th><a href="{{route('consumer_reservation.show',[$row->id, 'kind'=>1]) }}">{{$row->package_name}}</a></th>
					<td>{{$row->package_departure_date}} ~ {{$row->package_arrival_date}}</td>
					<td>총 {{$row->adult + $row->kid + $row->baby}}명</td>
					<td>총 {{number_format($row->total)}}원</td>
				</tr>
				@endforeach
			  </tbody>
			</table>
		</div>
		<div class="input-margin">
			<p style="font-weight:1000;font-size:17px;">항공기 예약 목록</p>
			<table class="table text-center" style="font-size:13px">
			  <thead style="color:#fff;background-color:#F15D30">
				<tr>
				  <th scope="col" width="10%">예약번호</th>
				  <th scope="col" width="8%">편명</th>
				  <th scope="col" width="15%">날짜</th>
				  <th scope="col" width="20%">출발</th>
				  <th scope="col" width="20%">도착</th>
				  <th scope="col" width="12%">탑승인원</th>
				  <th scope="col" width="15%">가격</th>
				</tr>
			  </thead>
			  <tbody>
			  @foreach($airlineReservations as $row)
			  <?php
				$date = trim(substr($row->startDate,0,10));
				$start = $row->departure_name ."(" .$row->departure_city_name .") " .trim(substr($row->startDate,11,5));
				$end = $row->destnation_name ."(" .$row->destnation_city_name .") " .trim(substr($row->endDate,11,5));
				$num = $row->adult + $row->child + $row->infant;
				$price = number_format($row->price);
				$kind = 2;        //kind  1 = 패키지여행, 2 = 항공기, 3 = 호텔
			  ?>
				<tr>
				  <td>{{$row->id}}</td>
				  <th><a href="{{route('consumer_reservation.show',[$row->id, 'kind'=>$kind]) }}">{{$row->planes_number}}</a></th>
				  <td>{{$date}}</td>
				  <td>{{$start}}</td>
				  <td>{{$end}}</td>
				  <td>{{$num}}명</td>
				  <td>{{$price}}원</td>
				</tr>
				@endforeach
			  </tbody>
			</table>
		</div>
		<div class="input-margin">
			<p style="font-weight:1000;font-size:17px;">호텔 예약 내용</p>
			<table class="table text-center" style="font-size:13px">
			  <thead style="color:#fff;background-color:#F15D30">
				<tr>
				  <th scope="col" width="10%">예약번호</th>
				  <th scope="col" width="25%">호텔명</th>
				  <th scope="col" width="14%">크기</th>
				  <th scope="col" width="18%">체크인</th>
				  <th scope="col" width="18%">체크아웃</th>
				  <th scope="col" width="15%">숙박비</th>

				</tr>
			  </thead>
			  <tbody>
			  @foreach($hotelReservations as $row)
			  <?php
			  	$price = number_format($row->price) ."원";
				$kind = 3;        //kind  1 = 패키지여행, 2 = 항공기, 3 = 호텔
			  ?>
				<tr>
				  <td>{{$row->hreservations_id}}</td>
				  <th><a href="{{route('consumer_reservation.show',[$row->hreservations_id, 'kind'=>$kind]) }}">{{$row->hotels_name}}</a></th>
				  <td>{{$row->type}}</td>
				  <td>{{$row->check_in}}</td>
				  <td>{{$row->check_out}}</td>
				  <td>{{$price}}</td>
				</tr>
			  @endforeach
			  </tbody>
			</table>
		</div>
	</div>
</div>
@endsection()
