@extends('admin/amain')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
			<form method="post" action="{{route('a_package_schedule.update', $row->id)}}" enctype="multipart/form-data">
			@method('PATCH')
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
						<input type="text" class="form-control" name="id" size="30" value="{{$row->id}}" disabled>
					  </td>
					</tr>
					<tr class="date">
					  <th scope="row" width="20%" style="vertical-align:middle;">package <font color="red">*</font></th>
					  <td width="80%">
					  	<select name="package_id" class="form-control">
							@foreach($packages as $package)
								@if($package->id == $row->package_id)
									<option value="{{$package->id}}" selected>{{$package->name}}</option>
								@else
									<option value="{{$package->id}}">{{$package->name}}</option>
								@endif
							@endforeach
					   </select>
					   @error('package_id') {{ $message }} @enderror
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">date <font color="red">*</font></th>
					  <td width="80%">
						<input type="text" class="form-control" name="date" size="30" value="{{$row->date}}" placeholder="몇 일차인지 작성해주세요.">
						@error('date') {{ $message }} @enderror
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">sort <font color="red">*</font></th>
					  <td width="80%">
						<input type="text" class="form-control" name="sort" size="30" value="{{$row->sort}}" placeholder="몇번째 일정인지 입력해주세요.">
						@error('sort') {{ $message }} @enderror
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">context <font color="red">*</font></th>
					  <td width="80%">
						<textarea name="context" rows="3" style="width:100%;" maxlength="100" value="{{old('context')}}" placeholder="스케줄에 대한 설명을 해주세요."><?=$row->context?></textarea>
						@error('context') {{ $message }} @enderror
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">type <font color="red">*</font></th>
					  <td width="80%">
						<select name="type" class="form-control">
							<?php$tmps = array("비행", "관광", "호텔");?>
							@foreach($tmps as $tmp)
								@if($tmp == $row->type)
									<option value="{{$tmp}}" selected>{{$tmp}}</option>
								@else
									<option value="{{$tmp}}" >{{$tmp}}</option>
								@endif
							@endforeach
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
								@if($tour->id == $row->tour_id)
									<option value="{{$tour->id}}" selected>{{$tour->name}}</option>
								@else
									<option value="{{$tour->id}}">{{$tour->name}}</option>
								@endif
							@endforeach
					   </select>
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">city <font color="red">*</font></th>
					  <td width="80%">
					  	<select name="city_id" class="form-control">
							@foreach($cities as $city)
								@if($city->id == $row->city_id)
									<option value="{{$city->id}}" selected>{{$city->name}}</option>
								@else
									<option value="{{$city->id}}">{{$city->name}}</option>
								@endif
							@endforeach
					   </select>
					   @error('city_id') {{ $message }} @enderror
					  </td>
					</tr><form method="post" action="">

					</form>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">hotel</th>
					  <td width="80%">
					  	<select name="hotel_id" class="form-control">
							<option value="{{old('hotel_id')}}">호텔을 선택해주세요</option>
							@foreach($hotels as $hotel)
								@if($hotel->id == $row->hotel_id)
									<option value="{{$hotel->id}}" selected>[{{$hotel->hotel_city_name}}]{{$hotel->name}}</option>
								@else
									<option value="{{$hotel->id}}">[{{$hotel->hotel_city_name}}] {{$hotel->name}}</option>
								@endif
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
