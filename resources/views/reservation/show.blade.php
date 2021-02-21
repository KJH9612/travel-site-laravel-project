@extends('main')
@section('content')
<style>
table tr th{
	color:#fff;
	background-color:#F15D30
}
.my-margin{
	margin-bottom:20px;
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
		<div class="my-margin">
			@if($kind == 1)
			<?php
				$icon = array("<i class='fa fa-cutlery' aria-hidden='true'></i> 조식추가", "<i class='fa fa-bed' aria-hidden='true'></i> 침대사이즈 업", "<i class='fa fa-wifi' aria-hidden='true'></i> 휴대용 wifi", "<i class='fa fa-plane' aria-hidden='true'></i> 항공기 업그레이드", "<i class='fa fa-bus' aria-hidden='true'></i> 공항 셔틀버스");
				$option = "";
				if($row->breakfast == "on") $option = $option .$icon[0];
				if($row->bedsize == "on") $option = $option ? $option .", " .$icon[1] ." " : $option .$icon[1];
				if($row->wifi == "on") $option = $option ? $option .", " .$icon[2] ." " : $option .$icon[2];
				if($row->airplaneup == "on") $option = $option ? $option .", " .$icon[3] ." " : $option .$icon[3];
				if($row->shuttle == "on") $option = $option ? $option .", " .$icon[4] ." " : $option .$icon[4];
				if(!$option) $option = "없음";
			?>
			<table class="table text-center table-bordered" align="center" style="margin-top:30px;font-size:14px;max-width:600px">
				<tr>
				  <th width="100%" colspan="4" style="color:#fff;background-color:#CC503D">{{$row->package_name}}</th>
				</tr>
				<tr>
				  <th width="25%">예약번호</th>
				  <td width="75%" colspan="3" align="left">{{$row->id}}</td>
				</tr>
				<tr>
				  <th>예약자명</th>
				  <td colspan="3" align="left">{{$row->consumer_name}}</td>
				</tr>
				<tr>
				  <th>인원</th>
				  <td colspan="3" align="left">어른 : {{$row->adult}}명, 어린이 : {{$row->kid}}명, 유아 : {{$row->baby}}명</td>
				</tr>
				<tr>
				  <th>날짜</th>
				  <td colspan="3" align="left">{{$row->package_departure_date}} ~ {{$row->package_arrival_date}}</td>
				</tr>
				<tr>
				  <th>서비스 상품</th>
				  <td colspan="3" align="left"><?=$option?></td>
				</tr>
				<tr>
				  <th width="25%">패키지 비용</td>
				  <td width="25%" align="left">{{number_format($row->package_total)}}원</td>
				  <th width="25%">서비스 비용</td>
				  <td width="25%" align="left">{{number_format($row->service_total)}}원</td>
				</tr>
				<tr>
				  <th >총합</th>
				  <td colspan="3" align="left">{{number_format($row->total)}}원</td>
				</tr>
			</table>
		@elseif($kind == 2)
		<?php
			$title = $row->planes_number ."(" .$row->departure_city_name ." -> " .$row->destnation_city_name .")";
			$start = $row->departure_name ."공항(" .$row->departure_city_name .") " .trim(substr($row->startDate,0,16));
			$end = $row->destnation_name ."공항(" .$row->destnation_city_name .") " .trim(substr($row->endDate,0,16));
			$price = number_format($row->price);
			$diff = strtotime($row->endDate) - strtotime($row->startDate);
			$flyTime = substr(date("H:i:s", $diff), 0, 5);
		?>
			<table class="table text-center table-bordered" align="center" style="margin-top:30px;font-size:14px;max-width:600px">
				<tr>
				  <th width="100%" colspan="4" style="color:#fff;background-color:#CC503D">{{$title}}</td>
				</tr>
				<tr>
				  <th width="25%">예약 번호</td>
				  <td width="75%" colspan="3" align="left">{{$row->id}}</td>
				</tr>
				<tr>
				  <th >예약자명</th>
				  <td colspan="3" align="left">{{$row->consumer_name}}</td>
				</tr>
				<tr>
				  <th>출발</td>
				  <td colspan="3" align="left">{{$start}}</td>
				</tr>
				<tr>
				  <th >도착</td>
				  <td colspan="3" align="left">{{$end}}</td>
				</tr>
				<tr>
				  <th >인원</td>
				  <td colspan="3" align="left">어른 : {{$row->adult}}명, 어린이 : {{$row->child}}명, 유아 : {{$row->infant}}명</td>
				</tr>
				<tr>
				  <th >위탁 수하물</td>
				  <td colspan="3" align="left">{{$row->baggage}}개</td>
				</tr>
				<tr>
				  <th width="25%">비행 시간</td>
				  <td width="25%" align="left">{{$flyTime}}</td>
				  <th width="25%">가격</td>
				  <td width="25%" align="left">{{$price}}원</td>
				</tr>
			</table>
			@elseif($kind == 3)
			<?php
				$price = number_format($row->price);
				//$room = "$row->type"  ." (크기 : " .$row->hrooms_size ."m2 침대 : "  .$row->hrooms_bed  ." 화장실 : " .$row->hrooms_bathroom .")";
				$room = "$row->type"  ."(침대 : "  .$row->hrooms_bed  ." 화장실 : " .$row->hrooms_bathroom .")";

				$icon = array("<i class='fa fa-cutlery' aria-hidden='true'></i> 조식제공", "<i class='fa fa-wifi' aria-hidden='true'></i> 무료 wifi", "<i class='fa fa-bed' aria-hidden='true'></i> 침대사이즈 업");
				$option = "";
				if($row->breakfast == "on") $option = $option .$icon[0];
				if($row->wifiegg == "on") $option = $option ? $option .", " .$icon[1] ." " : $option .$icon[1];
				if($row->bedsize == "on") $option = $option ? $option .", " .$icon[2] ." " : $option .$icon[2];
				if(!$option) $option = "없음";
			?>
			<table class="table text-center table-bordered" align="center" style="margin-top:30px;font-size:14px;max-width:600px">
				<tr>
				  <th width="100%" colspan="4" style="color:#fff;background-color:#CC503D">{{$row->hotels_name}}</th>
				</tr>
				<tr>
				  <th width="25%">예약 번호</th>
				  <td width="75%" colspan="3" align="left">{{$row->hreservations_id}}</td>
				</tr>
				<tr>
				  <th>예약지먕</th>
				  <td colspan="3" align="left">{{$row->consumer_name}}</td>
				</tr>
				<tr>
				  <th>인원</td>
				  <td  colspan="3" align="left">어른 : {{$row->adult}}명, 어린이 : {{$row->child}}명</td>
				</tr>
				<tr>
				  <th width="25%">체크인</td>
				  <td width="25%" align="left">{{$row->check_in}}</td>
				  <th width="25%">체크아웃</td>
				  <td width="25%" align="left">{{$row->check_out}}</td>
				</tr>
				<tr>
				  <th>방 정보</th>
				  <td colspan="3" align="left">{{$room}}</td>
				</tr>
				<tr>
				  <th>옵션</th>
				  <td colspan="3" align="left"><?=$option?></td>
				</tr>
				<tr>
				  <th>호텔 위치</th>
				 <td colspan="3" align="left"> {{$row->hotels_address}}</td>
				</tr>
				<tr>
				  <th>가격</th>
				  <td colspan="3" align="left">{{$price}}원</td>
				</tr>
			</table>
			@endif
		</div>
		<div class="my-margin text-center">
            @if($kind == 1 && $row->review == 0 /*&& $row->check_out <= date('Y-m-d') 구현 완료 후 지울것*/)
				<a href="{{route('blog.create')}}?packId={{$row->id}}" class="btn btn-primary" style="max-width:600px;width:100%;">후기 남기기</a>
            @elseif($kind == 1 && $row->review == 1)
                <a href="{{route('blog.show', $row->id)}}" class="btn btn-primary" style="max-width:600px;width:100%;">후기 보러가기</a>
            @endif
			<form action="{{  route('consumer_reservation.destroy', [$row->id, 'kind' => $kind])   }}" method="post">
                @csrf
                @method('DELETE')
				<button type="submit" class="btn btn-danger" Onclick="javascript:return confirm('예약 취소 하시겠습니까?');" style="max-width:600px;width:100%;">예약 취소</button>
			</form>
		</div>
	</div>
</div>
@endsection()
