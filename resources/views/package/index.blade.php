@extends('hmain')
@section('content')
 <style>
 .my-color{
	color:#F15D30;
}
 </style>
 <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_1.jpg');">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 text-center">
       <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span> <span>Package <i class="fa fa-chevron-right"></i></span></p>
       <h1 class="mb-0 bread">package</h1>
     </div>
   </div>
 </div>
</section>

<section class="ftco-section ftco-no-pb">
 <div class="container">
  <div class="row">
   <div class="col-md-12">
    <div class="search-wrap-1 ftco-animate">
     <form action="{{route('package.index')}}" action="get" class="search-property-1">
      <div class="row no-gutters">
       <div class="col-lg d-flex">
        <div class="form-group p-4 border-0">
         <label for="#">나라검색</label>
         <div class="form-field">
           <div class="icon"><span class="fa fa-search"></span></div>
           <input type="text" name="nation" value="{{$nation}}" class="form-control" placeholder="Search country">
         </div>
       </div>
     </div>
     <div class="col-lg d-flex">
      <div class="form-group p-4">
       <label for="#">출발 날짜</label>
       <div class="form-field">
         <div class="icon"><span class="fa fa-calendar"></span></div>
         <input type="text" name="departure_date" value="{{$departure_date}}" class="form-control checkin_date" placeholder="Departure Date">
       </div>
     </div>
   </div>
   <div class="col-lg d-flex">
    <div class="form-group p-4">
     <label for="#">도착 날짜</label>
     <div class="form-field">
       <div class="icon"><span class="fa fa-calendar"></span></div>
       <input type="text" name="arrival_date" value="{{$arrival_date}}" class="form-control checkout_date" placeholder="Arrival Date">
     </div>
   </div>
 </div>
 <div class="col-lg d-flex">
  <div class="form-group p-4">
   <label for="#">가격</label>
   <div class="form-field">
     <div class="select-wrap">
      <div class="icon"><span class="fa fa-chevron-down"></span></div>
      <select name="price" id="" class="form-control">
	    <?php
			$money = array("300000", "500000", "700000", "1000000", "2000000", "3000000", "4000000", "5000000", "6000000", "7000000", "8000000", "9000000", "10000000");
		?>
		<option value="0">상관 없음</option>
		@foreach($money as $pri)
		@if($price == $pri)
		<option value="{{$pri}}" selected>{{number_format($pri)}}원</option>
		@else
	    <option value="{{$pri}}">{{number_format($pri)}}원</option>
		@endif
		@endforeach
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

<section class="ftco-section">
	<div class="container">
		<div class="row">
		@foreach($list as $row)
		<?php
			$tmp =  (strtotime($row->arrival_date) - strtotime($row->departure_date))/86400;
			$tmp2 = $tmp + 1;
			$day = $tmp ."박" .$tmp2 ."일";
			$star = $row->star;
		?>
			<div class="col-md-4 ftco-animate">
				<div class="project-wrap hotel">
					<a href="{{route('package.show', $row->id)}}" class="img" style="background-image: url(/storage/package_pic/{{$row->pic}});">
					<span class="price">{{number_format($row->adult_price)}}원/{{$day}}</span>
					</a>
					<div class="text p-4">
						<p class="star mb-2">
							@while($star >= 1.0)
								<span class="fa fa-star"></span>
								<? $star = $star - 1;?>
							@endwhile
							@if($star >= 0.5)
								<span class="fas fa-star-half-alt"></span>
							@endif
						</p>
						<span class="days">3 Days Tour</span>
						<h3 style="margin-bottom:5px;"><a href="{{route('package.show', $row->id)}}">{{$row->name}}</a></h3>
						<div class="icon my-color"><span class="fas fa-map-marker-alt"></span> {{$row->nation_name}} 여행</div>
						<p class="location my-color" style="margin-bottom:0px"><span class="fas fa-calendar-alt"></span> {{$row->departure_date}} ~ {{$row->arrival_date}}</p>
					</div>
				</div>
			</div>
		@endforeach
		</div>
<!---
	<div class="row mt-5">
	  <div class="col text-center">
		<div class="block-27">
		  <ul>
			<li><a href="#">&lt;</a></li>
			<li class="active"><span>1</span></li>
			<li><a href="#">2</a></li>
			<li><a href="#">3</a></li>
			<li><a href="#">4</a></li>
			<li><a href="#">5</a></li>
			<li><a href="#">&gt;</a></li>
		  </ul>
		</div>
	  </div>
	</div>

-->
	</div>
</section>



<section class="ftco-intro ftco-section ftco-no-pt">
 <div class="container">
  <div class="row justify-content-center">
   <div class="col-md-12 text-center">
    <div class="img"  style="background-image: url(images/bg_2.jpg);">
     <div class="overlay"></div>
     <h2>We Are Pacific A Travel Agency</h2>
     <p>We can manage your dream building A small river named Duden flows by their place</p>
     <p class="mb-0"><a href="#" class="btn btn-primary px-4 py-3">Ask For A Quote</a></p>
   </div>
 </div>
</div>
</div>
</section>


@endsection()
