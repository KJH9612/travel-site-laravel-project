@extends('admin/amain')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
			
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
			<form method="post" action="{{route('a_package_reservation.store')}}" enctype="multipart/form-data">
			@csrf
		<div class="card-header py-3">
			<h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-clipboard-list"> Package_Reservation</i>
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
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">consumer <font color="red">*</font></th>
					  <td width="80%">
						<select name="consumer_id" class="form-control">
							<option value="{{old('consumer_id')}}">예약자를 선택해주세요.</option>
							@foreach($consumers as $consumer)
								<option value="{{$consumer->id}}">{{$consumer->name}}({{$consumer->uid}})</option>
							@endforeach
					    </select>
						@error('consumer_id') {{ $message }} @enderror
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">package <font color="red">*</font></th>
					  <td width="80%">
						<select name="package_id" class="form-control">
							<option value="{{old('package_id')}}">패키지를 선택해주세요.</option>
							@foreach($packages as $package)
								<option value="{{$package->id}}">{{$package->name}} ({{$package->departure_date}} ~ {{$package->arrival_date}})</option>
							@endforeach
					    </select>
						@error('package_id') {{ $message }} @enderror
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">adult <font color="red">*</font></th>
					  <td width="80%">
						<input type="text" class="form-control" name="adult" size="30" value="{{ old('adult') }}" placeholder="여행 가는 어른의 수를 입력해주세요.">
						@error('adult') {{ $message }} @enderror
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">kid <font color="red">*</font></th>
					  <td width="80%">
						<input type="kid" class="form-control" name="kid" size="30" value="{{ old('kid') }}" placeholder="여행 가는 어린이의 수를 입력해주세요.">
						@error('kid') {{ $message }} @enderror
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">baby <font color="red">*</font></th>
					  <td width="80%">
						<input type="text" class="form-control" name="baby" size="30" value="{{ old('baby') }}" placeholder="여행 가는 유아의 수를 입력해주세요.">
						@error('baby') {{ $message }} @enderror
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">service</th>
					  <td width="80%">
						<input type="checkbox" name="breakfast"> 호텔 조식추가</div>&nbsp;&nbsp;
						<input type="checkbox" name="bedsize"> 침대 사이즈 업</div>&nbsp;&nbsp;
						<input type="checkbox" name="wifi"> 휴대용 wifi</div>&nbsp;&nbsp;
						<input type="checkbox" name="airplaneup"> 항공기 업그레이드</div>&nbsp;&nbsp;
						<input type="checkbox" name="shuttle"> 공항 셔틀버스</div>
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