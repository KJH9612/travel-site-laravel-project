@extends('hmain')
@section('content')
<script>
		function find_text()
		{
			form1.action="{{route('hotel.index')}}";
			form1.submit();
		}
</script>


 <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_1.jpg');">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 text-center">
       <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span> <span>Hotel <i class="fa fa-chevron-right"></i></span></p>
       <h1 class="mb-0 bread">Hotel</h1>
     </div>
   </div>
 </div>
</section>

<section class="ftco-section ftco-no-pb">
 <div class="container">
  <div class="row">
   <div class="col-md-12">
    <div class="search-wrap-1 ftco-animate">
     <form name="form1" action="" method="get" class="search-property-1">
	 @csrf
      <div class="row no-gutters">
       <div class="col-lg d-flex">
        <div class="form-group p-4 border-0">
         <label for="#">숙박지</label>
         <div class="form-field">
           <div class="icon"><span class="fa fa-search"></span></div>
           <input type="text" name="text1" value="{{ $text1 ?? '' }}" class="form-control" placeholder="지명을 입력해주세요." >
         </div>
       </div>
     </div>
     <div class="col-lg d-flex">
      <div class="form-group p-4">
       <label for="#">체크인 날짜</label>
       <div class="form-field">
         <div class="icon"><span class="fa fa-calendar"></span></div>
         <input type="text" class="form-control checkin_date" placeholder="체크인 날짜">
       </div>
     </div>
   </div>
   <div class="col-lg d-flex">
    <div class="form-group p-4">
     <label for="#">체크아웃 날짜</label>
     <div class="form-field">
       <div class="icon"><span class="fa fa-calendar"></span></div>
       <input type="text" class="form-control checkout_date" placeholder="체크아웃 날짜">
     </div>
   </div>
 </div>
 <div class="col-lg d-flex">
  <div class="form-group p-4">
   <label for="#">최소 가격</label>
   <div class="form-field">
     <div class="select-wrap">
      <div class="icon"><span class="fa fa-chevron-down"></span></div>
      <select name="price" id="price" class="form-control">	  	
		<option value="" {{$price == '' ? 'selected' : '' }}>가격 입력</option>
	  	<option value="5000" {{ $price == 5000 ? 'selected' : '' }}>5,000원</option>
        <option value="10000" {{ $price == 10000 ? 'selected' : '' }}>10,000원</option>
        <option value="50000" {{ $price == 50000 ? 'selected' : '' }}>50,000원</option>
        <option value="100000" {{ $price == 100000 ? 'selected' : '' }}>100,000원</option>
        <option value="200000" {{ $price == 200000 ? 'selected' : '' }}>200,000원</option>
        <option value="300000" {{ $price == 300000 ? 'selected' : '' }}>300,000원</option>
        <option value="400000" {{ $price == 400000 ? 'selected' : '' }}>400,000원</option>
        <option value="500000" {{ $price == 500000 ? 'selected' : '' }}>500,000원</option>
        <option value="600000" {{ $price == 600000 ? 'selected' : '' }}>600,000원</option>
        <option value="700000" {{ $price == 700000 ? 'selected' : '' }}>700,000원</option>
        <option value="800000" {{ $price == 800000 ? 'selected' : '' }}>800,000원</option>
        <option value="900000" {{ $price == 900000 ? 'selected' : '' }}>900,000원</option>
        <option value="1000000" {{ $price == 1000000 ? 'selected' : '' }}>1,000,000원</option>
        <option value="2000000" {{ $price == 2000000 ? 'selected' : '' }}>2,000,000원</option>
      </select>
    </div>
  </div>
</div>
</div>
<div class="col-lg d-flex">
	<div class="form-group d-flex w-100 border-0">
		<div class="form-field w-100 align-items-center d-flex">
			<input type="submit" value="Search" class="align-self-stretch form-control btn btn-primary p-0">
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
			@if($row->price)
			<div class="col-md-4 ftco-animate">
				<div class="project-wrap hotel">
				 <a href="{{route('hotel.show',$row->id)}}" class="img" style="background-image: url(../storage/hotel_img/{{ $row->pic }});">
				  <span class="price">{{number_format($row->price)}}원/person</span>
				</a>
				<div class="text p-4">
				  <p class="star mb-2">
					@for($i=0; $i < $row->star; $i++)
						<span class="fa fa-star"></span>
					@endfor
				  </p>
				  <span class="days">{{$row->star}}-star hotel</span>
				  <h3><a href="{{route('hotel.show',$row->id)}}">{{$row->name}}</a></h3>
				  <p class="location"><span class="fa fa-map-marker"></span> {{$row->city_name}}, {{$row->nation_name}}</p>
				  <ul>
				   <li><span class="flaticon-shower"></span>{{$row->minbathroom}} ~ {{$row->maxbathroom}} 개</li>
				   <li><span class="flaticon-king-size"></span>{{$row->minbed}} ~ {{$row->maxbed}} 개</li>
				   <li><span class="fas fa-{{$row->geo_fontawe}}" style="font-size:15px;"></span>{{$row->geo_place}}</li>
				 </ul>
			   </div>
			 </div>
			</div>
			@endif
		@endforeach

	</div>

	<div class="row mt-5">
	  <div class="col text-center">
		<div class="block-27">
			{{$list->links('mypagination')}}
		</div>
	  </div>
	</div>

	</div>
	</section>

	

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
@endsection()