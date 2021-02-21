@extends('admin/amain')
@section('content')
<script type="text/javascript">
	$(function () {
		$('#arrival_date').datetimepicker({ format: 'L'});
		$('#departure_date').datetimepicker({ format: 'L'});
	});
</script>
<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
			<form method="post" action="{{route('a_package.update', $row->id)}}" enctype="multipart/form-data">
			@method('PATCH')
			@csrf
		<div class="card-header py-3">
			<h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-route"> Package</i>
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
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">nation <font color="red">*</font></th>
					  <td width="80%">
						<select name="nation_id" class="form-control">
							@foreach($nations as $nation)
								@if($nation->id == $row->nation_id)
									<option value="{{$nation->id}}" selected>{{$nation->name}}</option>
								@else
									<option value="{{$nation->id}}">{{$nation->name}}</option>
								@endif
							@endforeach
					   </select>
					   @error('nation_id') {{ $message }} @enderror
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">name <font color="red">*</font></th>
					  <td width="80%">
						<input type="text" class="form-control" name="name" size="30" value="{{$row->name}}" placeholder="패키지 이름을 입력해주세요.">
						@error('name') {{ $message }} @enderror
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">explain <font color="red">*</font></th>
					  <td width="80%">
						<textarea name="explain" rows="10" maxlength="512" value="{{old('explain')}}" style="width:100%;"placeholder="관광지에 대한 설명을 써주세요.">{{$row->explain}}</textarea>
						@error('explain') {{ $message }} @enderror
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">adult_price <font color="red">*</font></th>
					  <td width="80%">
						<input type="text" class="form-control" name="adult_price" size="30" value="{{$row->adult_price}}" placeholder="어른의 패키지 이용가격을 써주세요.">
						@error('adult_price') {{ $message }} @enderror
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">kid_price <font color="red">*</font></th>
					  <td width="80%">
						<input type="text" class="form-control" name="kid_price" size="30" value="{{$row->kid_price}}" placeholder="어린이의 패키지 이용가격을 써주세요.">
						@error('kid_price') {{ $message }} @enderror
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">baby_price <font color="red">*</font></th>
					  <td width="80%">
						<input type="text" class="form-control" name="baby_price" size="30" value="{{$row->baby_price}}" placeholder="유아 패키지 이용가격을 써주세요.">
						@error('baby_price') {{ $message }} @enderror
					  </td>
					</tr>
					<?php
						$departure_tmp = explode("-", $row->departure_date);
						$departure_date = $departure_tmp[1] ."/" .$departure_tmp[2] ."/" .$departure_tmp[0];
						$arrival_tmp = explode("-", $row->arrival_date);
						$arrival_date = $arrival_tmp[1] ."/" .$arrival_tmp[2] ."/" .$arrival_tmp[0];
					?>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">departure_date <font color="red">*</font></th>
					  <td width="80%">
						<div class="input-group date" id="departure_date" data-target-input="nearest">
							<input type="text" name="departure_date" class="form-control datetimepicker-input" data-target="#departure_date" value="{{$departure_date}}" placeholder="출발일을 선택 해주세요.">
							<div class="input-group-append" data-target="#departure_date" data-toggle="datetimepicker">
								<div class="input-group-text"><i class="fa fa-calendar"></i></div>
							</div>
						</div>
						@error('departure_date') {{ $message }} @enderror
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">arrival_date <font color="red">*</font></th>
					  <td width="80%">
						<div class="input-group date" id="arrival_date" data-target-input="nearest">
							<input type="text" name="arrival_date" class="form-control datetimepicker-input" data-target="#arrival_date" value="{{$arrival_date}}" placeholder="도착일을 선택 해주세요." maxlength="10">
							<div class="input-group-append" data-target="#arrival_date" data-toggle="datetimepicker">
								<div class="input-group-text"><i class="fa fa-calendar"></i></div>
							</div>
						</div>
						@error('arrival_date') {{ $message }} @enderror
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">pic <font color="red">*</font></th>
					  <td width="80%">
						<input type="file" class="form-control" name="pic" size="30" value="">
						<p>{{$row->pic}}</p>
						<img src="/storage/package_pic/{{$row->pic}}" style="width:300px;height:200px">
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">departure_schedule </th>
					  <td width="80%">
						<select name="departure_schedule_id" class="form-control">
							<option value="{{old('departure_schedule_id')}}">출발 항공기 스케줄을 선택하세요.</option>
							@foreach($schedules as $schedule)
								@if($schedule->id == $row->departure_schedule_id)
									<option value="{{$schedule->id}}" selected>{{$schedule->departure_airport_name}}({{$schedule->departure_city_name}}) {{$schedule->startDate}} ->  {{$schedule->destnation_airport_name}}({{$schedule->destnation_city_name}}) {{$schedule->endDate}}</option>
								@else
									<option value="{{$schedule->id}}">{{$schedule->departure_airport_name}}({{$schedule->departure_city_name}}) {{$schedule->startDate}} ->  {{$schedule->destnation_airport_name}}({{$schedule->destnation_city_name}}) {{$schedule->endDate}}</option>
								@endif

							@endforeach
					   </select>
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">arrival_schedule </th>
					  <td width="80%">
						<select name="arrival_schedule_id" class="form-control">
							<option value="{{old('arrival_schedule_id')}}">도착 항공기 스케줄을 선택하세요.</option>
							@foreach($schedules as $schedule)
								@if($schedule->id == $row->arrival_schedule_id)
									<option value="{{$schedule->id}}" selected>{{$schedule->departure_airport_name}}({{$schedule->departure_city_name}}) {{$schedule->startDate}} ->  {{$schedule->destnation_airport_name}}({{$schedule->destnation_city_name}}) {{$schedule->endDate}}</option>
								@else
									<option value="{{$schedule->id}}">{{$schedule->departure_airport_name}}({{$schedule->departure_city_name}}) {{$schedule->startDate}} ->  {{$schedule->destnation_airport_name}}({{$schedule->destnation_city_name}}) {{$schedule->endDate}}</option>
								@endif

							@endforeach
					   </select>
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">star <font color="red">*</font></th>
					  <td width="80%">
						<input type="text" class="form-control" name="star" size="30" value="{{ $row->star }}" placeholder="평점을 입력하세요.">
						@error('star') {{ $message }} @enderror
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
