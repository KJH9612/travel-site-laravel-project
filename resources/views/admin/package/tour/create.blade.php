@extends('admin/amain')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
			
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
			<form method="post" action="{{route('a_tour.store')}}" enctype="multipart/form-data">
			@csrf
		<div class="card-header py-3">
			<h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-map-marked-alt"> Tour</i>
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
					  <th scope="row" width="20%" style="vertical-align:middle;">name <font color="red">*</font></th>
					  <td width="80%">
						<input type="text" class="form-control" name="name" size="30" value="{{ old('name') }}" placeholder="관광지 명을 입력해주세요.">
						@error('name') {{ $message }} @enderror
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">context <font color="red">*</font></th>
					  <td width="80%">
						<textarea name="context" rows="10" value="{{ old('context') }}" maxlength="512" style="width:100%;"placeholder="관광지에 대한 설명을 써주세요."></textarea>
						@error('context') {{ $message }} @enderror
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">pic1 <font color="red">*</font></th>
					  <td width="80%">
						<input type="file" class="form-control" name="pic1" size="30" value="{{ old('pic1') }}">
						@error('pic1') {{ $message }} @enderror
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">pic2 <font color="red">*</font></th>
					  <td width="80%">
						<input type="file" class="form-control" name="pic2" size="30" value="{{ old('pic2') }}">
						@error('pic2') {{ $message }} @enderror
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
				  </tbody>
				</table>
		</div>
			</form>
	</div>

</div>

<!-- /.container-fluid -->

 @stop