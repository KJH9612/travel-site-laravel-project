@extends('admin/amain')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
			
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
			<form method="post" action="{{route('a_package_schedule.store')}}">
			@csrf
		<div class="card-header py-3">
			<h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-clipboard-list"> Package_Schedule</i>
					<a href='#' class="btn btn-primary float-right" onclick="history.back();"><i class="fas fa-undo"></i></a>
					<span class="float-right">&nbsp;</span>
					<button class="btn btn-primary float-right"><i class="fas fa-check"></i></button>
				</h4>
		</div>
		<div class="card-body">
			<table class="table table-bordered table-striped">
				  <tbody>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">ID</th>
					  <td width="80%">
						<input type="text" class="form-control" name="id" size="30" value="" disabled>
					  </td>
					</tr>
					<tr class="date">
					  <th scope="row" width="20%" style="vertical-align:middle;">package <font color="red">*</font></th>
					  <td width="80%">
					  	<select name="package_id" class="form-control">
							<option value="{{old('package_id')}}">패키지를 선택해주세요</option>
							@foreach($packages as $package)
							<option value="{{$package->id}}">{{$package->name}}</option>
							@endforeach
					   </select>
					   @error('package_id') {{ $message }} @enderror
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">date <font color="red">*</font></th>
					  <td width="80%">
						<input type="text" class="form-control" name="date" size="30" value="{{old('date')}}" placeholder="몇 일차인지 작성해주세요.">
						@error('date') {{ $message }} @enderror
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">sort <font color="red">*</font></th>
					  <td width="80%">
						<input type="text" class="form-control" name="sort" size="30" value="{{old('sort')}}" placeholder="몇번째 일정인지 입력해주세요.">
						@error('sort') {{ $message }} @enderror
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">context <font color="red">*</font></th>
					  <td width="80%">
						<textarea name="context" rows="3" style="width:100%;" maxlength="100" value="{{old('context')}}" placeholder="스케줄에 대한 설명을 해주세요."></textarea>
						@error('context') {{ $message }} @enderror
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">type <font color="red">*</font></th>
					  <td width="80%">
						<select name="type" class="form-control">
							<option value="{{old('type')}}">타입을 선택해주세요</option>
							<option value="비행">비행</option>
							<option value="관광">관광</option>
							<option value="호텔">호텔</option>
						</select>
						@error('type') {{ $message }} @enderror
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">tour</th>
					  <td width="80%">
					  	<select name="tour_id" class="form-control">
							<option value="">관광지를 선택해주세요</option>
							@foreach($tours as $tour)
							<option value="{{$tour->id}}">{{$tour->name}}</option>
							@endforeach
					   </select>
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">city <font color="red">*</font></th>
					  <td width="80%">
					  	<select name="city_id" class="form-control">
							<option value="{{old('city_id')}}">도시를 선택해주세요</option>
							@foreach($cities as $city)
							<option value="{{$city->id}}">{{$city->name}}</option>
							@endforeach
					   </select>
					   @error('city_id') {{ $message }} @enderror
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">hotel</th>
					  <td width="80%">
					  	<select name="hotel_id" class="form-control">
							<option value="{{old('hotel_id')}}">호텔을 선택해주세요</option>
							@foreach($hotels as $hotel)
							<option value="{{$hotel->id}}">[{{$hotel->hotel_city_name}}] {{$hotel->name}}</option>
							@endforeach
					   </select>
					   @error('hotel_id') {{ $message }} @enderror
					   <font color="red">*type호텔 선택시 필수</font>
					  </td>
					</tr>
				  </tbody>
				</table>
		</div>
			</form>
	</div>

</div>

<!-- /.container-fluid -->

 @stop