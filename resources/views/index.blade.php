@extends('hmain')
@section('content')
<div class="hero-wrap js-fullheight" style="background-image: url('/images/bg_5.jpg');">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text js-fullheight align-items-center" data-scrollax-parent="true">
				<div class="col-md-7 ftco-animate">
					<span class="subheading">Welcome to Pacific</span>
					<h1 class="mb-4">Discover Your Favorite Place with Us</h1>
					<p class="caps">Travel to the any corner of the world, without going around in circles</p>
				</div>
				<a href="https://vimeo.com/45830194" class="icon-video popup-vimeo d-flex align-items-center justify-content-center mb-4">
					<span class="fa fa-play"></span>
				</a>
			</div>
		</div>
	</div>

	<section class="ftco-section ftco-no-pb ftco-no-pt">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="ftco-search d-flex justify-content-center">
						<div class="row">
							<div class="col-md-12 nav-link-wrap">
								<div class="nav nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
									<a class="nav-link active mr-md-1" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Search Package</a>

									<a class="nav-link" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false">Hotel</a>

									<a class="nav-link" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3" role="tab" aria-controls="v-pills-3" aria-selected="false">Air</a>
								</div>
							</div>
							<div class="col-md-12 tab-wrap">

								<div class="tab-content" id="v-pills-tabContent">

									<div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
										<form action="{{route('package.index')}}" method="get" class="search-property-1">
											<div class="row no-gutters">
												<div class="col-md d-flex">
													<div class="form-group p-4 border-0">
														<label for="#">나라검색</label>
														<div class="form-field">
															<div class="icon"><span class="fa fa-search"></span></div>
															<input type="text" name="nation" value="{{ $text1 ?? '' }}" class="form-control" placeholder="Search country" >
														</div>
													</div>
												</div>
												<div class="col-md d-flex">
													<div class="form-group p-4">
														<label for="#">출발 날짜</label>
														<div class="form-field">
															<div class="icon"><span class="fa fa-calendar"></span></div>
															<input type="text" name="departure_date" class="form-control checkin_date" placeholder="Departure Date">
														</div>
													</div>
												</div>
												<div class="col-md d-flex">
													<div class="form-group p-4">
														<label for="#">도착 날짜</label>
														<div class="form-field">
															<div class="icon"><span class="fa fa-calendar"></span></div>
															<input type="text" name="arrival_date" class="form-control checkout_date" placeholder="Arrival Date">
														</div>
													</div>
												</div>
												<div class="col-md d-flex">
													<div class="form-group p-4">
														<label for="#">가격</label>
														<div class="form-field">
															<div class="select-wrap">
																<div class="icon"><span class="fa fa-chevron-down"></span></div>
																<select name="price" id="price" class="form-control">
																	<option value="0">상관없음</option>
																	<option value="300000">300,000원</option>
																	<option value="500000">500,000원</option>
																	<option value="700000">700,000원</option>
																	<option value="1000000">1,000,000원</option>
																	<option value="2000000">2,000,000원</option>
																	<option value="3000000">3,000,000원</option>
																	<option value="4000000">4,000,000원</option>
																	<option value="5000000">5,000,000원</option>
																	<option value="6000000">6,000,000원</option>
																	<option value="7000000">7,000,000원</option>
																	<option value="8000000">8,000,000원</option>
																	<option value="9000000">9,000,000원</option>
																	<option value="10000000">10,000,000원</option>

																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md d-flex">
													<div class="form-group d-flex w-100 border-0">
														<div class="form-field w-100 align-items-center d-flex">
															<input type="submit" value="Search" class="align-self-stretch form-control btn btn-primary">
														</div>
													</div>
												</div>
											</div>
										</form>
									</div>

									<div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-performance-tab">
										<form action="" class="search-property-1">
											<div class="row no-gutters">
												<div class="col-md d-flex">
													<div class="form-group p-4 border-0">
														<label for="#">숙박지</label>
														<div class="form-field">
															<div class="icon"><span class="fa fa-search"></span></div>
															<input type="text" name="text1" value="{{ $text1 ?? '' }}" class="form-control" placeholder="지명을 입력해주세요." >
														</div>
													</div>
												</div>
												<div class="col-md d-flex">
													<div class="form-group p-4">
														<label for="#">체크인 날짜</label>
														<div class="form-field">
															<div class="icon"><span class="fa fa-calendar"></span></div>
															<input type="text" name="check_in" class="form-control checkin_date" placeholder="체크인 날짜">
														</div>
													</div>
												</div>
												<div class="col-md d-flex">
													<div class="form-group p-4">
														<label for="#">체크아웃 날짜</label>
														<div class="form-field">
															<div class="icon"><span class="fa fa-calendar"></span></div>
															<input type="text" name="check_out" class="form-control checkout_date" placeholder="체크아웃 날짜">
														</div>
													</div>
												</div>
												<div class="col-md d-flex">
													<div class="form-group p-4">
														<label for="#">최소 가격</label>
														<div class="form-field">
															<div class="select-wrap">
																<div class="icon"><span class="fa fa-chevron-down"></span></div>
																<select name="price" id="price" class="form-control">
																	<option value="5000">5,000원</option>
																	<option value="10000">10,000원</option>
																	<option value="50000">50,000원</option>
																	<option value="100000">100,000원</option>
																	<option value="200000">200,000원</option>
																	<option value="300000">300,000원</option>
																	<option value="400000">400,000원</option>
																	<option value="500000">500,000원</option>
																	<option value="600000">600,000원</option>
																	<option value="700000">700,000원</option>
																	<option value="800000">800,000원</option>
																	<option value="900000">900,000원</option>
																	<option value="1000000">1,000,000원</option>
																	<option value="2000000">2,000,000원</option>
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md d-flex">
													<div class="form-group d-flex w-100 border-0">
														<div class="form-field w-100 align-items-center d-flex">
															<input type="submit" value="Search" class="align-self-stretch form-control btn btn-primary">
														</div>
													</div>
												</div>
											</div>
										</form>
									</div>

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
									</script>

									<div class="tab-pane fade" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-performance-tab">
										<form action="/air/search" method="post" class="search-property-1">
											  @csrf
											   <div class="row no-gutters">
													<div class="col-2 d-flex">
														<div class="form-group p-4 border-0">
															<div id="radioGroup" class="btn-group btn-group-toggle" data-toggle="buttons">
																<label class="btn btn-lg btn-danger">
																	<input type="radio" name="radios" id="radio1" value="0" checked="checked" onclick="radioCheck()"> 왕복
																</label>
																<label class="btn btn-lg btn-danger">
																	<input type="radio" name="radios" id="radio2" value="1" onclick="radioCheck()"> 편도
																</label>
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
					</div>
				</div>
			</div>
		</section>

		<section class="ftco-section services-section">
			<div class="container">
				<div class="row d-flex">
					<div class="col-md-6 order-md-last heading-section pl-md-5 ftco-animate d-flex align-items-center">
						<div class="w-100">
							<span class="subheading">Welcome to Pacific</span>
								<h2 class="mb-4">이제 모험을 떠날 시간입니다.</h2>
								<p>리스본 서쪽에 위치한 카보다로카는 위치로도 유럽 대륙의 서쪽 땅 끝에 위치하여 망망한 대서양의 불어오는 바람을 느끼기 위해 매 해 많은 사람들이 찾는다.</p>
								<p>노호탄 공원은 3면이 기암절경으로 둘러 쌓여 매우 아름다우며 공원 중앙에는 호랑이 모습과 닮은 호탄이라는 조형물이 자리하고있습니다. 바위의 높낮이로 인해 다양한 파도를 감상할 수 있으며 새들의 천국이라 부릴만큼 다양한 새들도 감상할 수 있습니다.</p>
								<p><a href="{{route('package.index')}}" class="btn btn-primary py-3 px-4">Search Destination</a></p>
						</div>
					</div>
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
								<div class="services services-1 color-1 d-block img" style="background-image: url(/images/services-1.jpg);">
									<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-paragliding"></span></div>
									<div class="media-body">
										<h3 class="heading mb-3">Activities</h3>
										<p>저희 Pacific에서는 다양한 체험을 제공합니다.</p>
									</div>
								</div>
							</div>
							<div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
								<div class="services services-1 color-2 d-block img" style="background-image: url(/images/services-2.jpg);">
									<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-route"></span></div>
									<div class="media-body">
										<h3 class="heading mb-3">Efficient schedule</h3>
										<p>전문가가 짠 일정으로 시간을 낭비하지 않고 많은 곳을 탐험할 수 있습니다.</p>
									</div>
								</div>
							</div>
							<div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
								<div class="services services-1 color-3 d-block img" style="background-image: url(/images/services-3.jpg);">
									<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-tour-guide"></span></div>
									<div class="media-body">
										<h3 class="heading mb-3">Private Guide</h3>
										<p>수 많은 모헝 경력을 가진 가이드가 곳곳을 탐험시켜줍니다.</p>
									</div>
								</div>
							</div>
							<div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
								<div class="services services-1 color-4 d-block img" style="background-image: url(/images/services-4.jpg);">
									<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-map"></span></div>
									<div class="media-body">
										<h3 class="heading mb-3">Location Manager</h3>
										<p>여행 전 미리 조사, 허가 받아 편안하고 안전하게 여행을 즐길 수 있게 해줍니다.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="ftco-section img ftco-select-destination" style="background-image: url(/images/bg_3.jpg);">
			<div class="container">
				<div class="row justify-content-center pb-4">
					<div class="col-md-12 heading-section text-center ftco-animate">
						<span class="subheading">Pacific Provide Package</span>
						<h2 class="mb-4">Select Your Destination</h2>
					</div>
				</div>
			</div>
			<div class="container container-2">
				<div class="row">
					<div class="col-md-12">
						<div class="carousel-destination owl-carousel ftco-animate">
							@foreach($packages as $package)
							<?php
								$tmp =  (strtotime($package->arrival_date) - strtotime($package->departure_date))/86400;
								$tmp2 = $tmp + 1;
								$day = $tmp ."박" .$tmp2 ."일";
							?>
								<div class="item">
									<div class="project-destination">
										<a href="{{route('package.show', $package->id)}}" class="img" style="background-image: url(/storage/package_pic/{{$package->pic}});">
											<div class="text">
												<h3>{{$package->nation_name}}</h3>
												<span>{{$day}}</span>
											</div>
										</a>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="ftco-section">
			<div class="container">
				<div class="row justify-content-center pb-4">
					<div class="col-md-12 heading-section text-center ftco-animate">
						<span class="subheading">Destination</span>
						<h2 class="mb-4">Tour Destination</h2>
					</div>
				</div>
				<div class="row">
					@foreach($hotels as $row)
					<div class="col-md-4 ftco-animate">
						<div class="project-wrap">
							<a href="{{route('hotel.show',$row->id)}}" class="img" style="background-image: url(../storage/hotel_img/{{ $row->pic }});">
								<span class="price">{{$row->price}}원/person</span>
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
					@endforeach
				</div>
			</div>
		</section>

		<section class="ftco-section ftco-about img"style="background-image: url(/images/bg_4.jpg);">
			<div class="overlay"></div>
			<div class="container py-md-5">
				<div class="row py-md-5">
					<div class="col-md d-flex align-items-center justify-content-center">
						<a href="https://vimeo.com/45830194" class="icon-video popup-vimeo d-flex align-items-center justify-content-center mb-4">
							<span class="fa fa-play"></span>
						</a>
					</div>
				</div>
			</div>
		</section>

		<section class="ftco-section ftco-about ftco-no-pt img">
			<div class="container">
				<div class="row d-flex">
					<div class="col-md-12 about-intro">
						<div class="row">
							<div class="col-md-6 d-flex align-items-stretch">
								<div class="img d-flex w-100 align-items-center justify-content-center" style="background-image:url(/images/about-1.jpg);">
								</div>
							</div>
							<div class="col-md-6 pl-md-5 py-5">
								<div class="row justify-content-start pb-3">
									<div class="col-md-12 heading-section ftco-animate">
										<span class="subheading">About Us</span>
										<h2 class="mb-4">Pacific과 함께 안전하게 모험하세요.</h2>
										<p>사전 답사, 전문적인 스케줄이 당신을 안전하고 효율적이게 모험을 즐길 수 있게 할겁니다. 짧은 휴일을 알뜰하게 보내고 싶으시면 우리 Pacific으로 오세요.</p>
										<p><a href="{{route('package.index')}}" class="btn btn-primary">Book Your Destination</a></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="ftco-section testimony-section bg-bottom" style="background-image: url(/images/bg_1.jpg);">
			<div class="overlay"></div>
			<div class="container">
				<div class="row justify-content-center pb-4">
					<div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
						<span class="subheading">Testimonial</span>
						<h2 class="mb-4">Tourist Feedback</h2>
					</div>
				</div>
				<div class="row ftco-animate">
					<div class="col-md-12">
						<div class="carousel-testimony owl-carousel">
							<div class="item">
								<div class="testimony-wrap py-4">
									<div class="text">
										<p class="star">
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
										</p>
										<p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
										<div class="d-flex align-items-center">
											<div class="user-img" style="background-image: url(/images/person_1.jpg)"></div>
											<div class="pl-3">
												<p class="name">Roger Scott</p>
												<span class="position">Marketing Manager</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="testimony-wrap py-4">
									<div class="text">
										<p class="star">
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
										</p>
										<p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
										<div class="d-flex align-items-center">
											<div class="user-img" style="background-image: url(/images/person_2.jpg)"></div>
											<div class="pl-3">
												<p class="name">Roger Scott</p>
												<span class="position">Marketing Manager</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="testimony-wrap py-4">
									<div class="text">
										<p class="star">
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
										</p>
										<p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
										<div class="d-flex align-items-center">
											<div class="user-img" style="background-image: url(/images/person_3.jpg)"></div>
											<div class="pl-3">
												<p class="name">Roger Scott</p>
												<span class="position">Marketing Manager</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="testimony-wrap py-4">
									<div class="text">
										<p class="star">
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
										</p>
										<p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
										<div class="d-flex align-items-center">
											<div class="user-img" style="background-image: url(/images/person_1.jpg)"></div>
											<div class="pl-3">
												<p class="name">Roger Scott</p>
												<span class="position">Marketing Manager</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="testimony-wrap py-4">
									<div class="text">
										<p class="star">
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
										</p>
										<p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
										<div class="d-flex align-items-center">
											<div class="user-img" style="background-image: url(/images/person_2.jpg)"></div>
											<div class="pl-3">
												<p class="name">Roger Scott</p>
												<span class="position">Marketing Manager</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>


		<section class="ftco-section">
			<div class="container">
				<div class="row justify-content-center pb-4">
					<div class="col-md-12 heading-section text-center ftco-animate">
						<span class="subheading">Our Blog</span>
						<h2 class="mb-4">Recent Post</h2>
					</div>
				</div>
				<div class="row d-flex">
					<div class="col-md-4 d-flex ftco-animate">
						<div class="blog-entry justify-content-end">
							<a href="blog-single.html" class="block-20" style="background-image: url('/images/image_1.jpg');">
							</a>
							<div class="text">
								<div class="d-flex align-items-center mb-4 topp">
									<div class="one">
										<span class="day">11</span>
									</div>
									<div class="two">
										<span class="yr">2020</span>
										<span class="mos">September</span>
									</div>
								</div>
								<h3 class="heading"><a href="#">Most Popular Place In This World</a></h3>
								<!-- <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p> -->
								<p><a href="#" class="btn btn-primary">Read more</a></p>
							</div>
						</div>
					</div>
					<div class="col-md-4 d-flex ftco-animate">
						<div class="blog-entry justify-content-end">
							<a href="blog-single.html" class="block-20" style="background-image: url('/images/image_2.jpg');">
							</a>
							<div class="text">
								<div class="d-flex align-items-center mb-4 topp">
									<div class="one">
										<span class="day">11</span>
									</div>
									<div class="two">
										<span class="yr">2020</span>
										<span class="mos">September</span>
									</div>
								</div>
								<h3 class="heading"><a href="#">Most Popular Place In This World</a></h3>
								<!-- <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p> -->
								<p><a href="#" class="btn btn-primary">Read more</a></p>
							</div>
						</div>
					</div>
					<div class="col-md-4 d-flex ftco-animate">
						<div class="blog-entry">
							<a href="blog-single.html" class="block-20" style="background-image: url('/images/image_3.jpg');">
							</a>
							<div class="text">
								<div class="d-flex align-items-center mb-4 topp">
									<div class="one">
										<span class="day">11</span>
									</div>
									<div class="two">
										<span class="yr">2020</span>
										<span class="mos">September</span>
									</div>
								</div>
								<h3 class="heading"><a href="#">Most Popular Place In This World</a></h3>
								<!-- <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p> -->
								<p><a href="#" class="btn btn-primary">Read more</a></p>
							</div>
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
@stop
