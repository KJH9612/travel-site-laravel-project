@extends('admin/amain')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
			<form method="post" action="{{route('a_package_schedule.destroy', $row->id)}}">
			@method('DELETE')
			@csrf
		<div class="card-header py-3">
			<h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-clipboard-list"> Package_Schedule</i>
					<a href='#' class="btn btn-primary float-right" onclick="history.back();"><i class="fas fa-undo"></i></a>
					<span class="float-right">&nbsp;</span>
					<button  class="btn btn-primary float-right" onClick="return confirm('삭제할까요 ?');"><i class="fas fa-trash-alt"></i></button>
					<span class="float-right">&nbsp;</span>
					<a href="{{ route('a_package_schedule.edit', $row->id) }}" class="btn btn-primary float-right"><i class="fas fa-pen"></i></a>
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
					  <th scope="row" width="20%" style="vertical-align:middle;">package </th>
					  <td width="80%">
						<input type="text" class="form-control" name="package_id" size="30" value="{{$row->package_name}}" disabled>
					  </td>
					</tr>
					<tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">date </th>
					  <td width="80%">
						<input type="text" class="form-control" name="date" size="30" value="{{$row->date}}" disabled>
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">sort </th>
					  <td width="80%">
						<input type="text" class="form-control" name="sort" size="30" value="{{$row->sort}}" disabled>
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">context</th>
					  <td width="80%">
						<textarea name="context" rows="3" style="width:100%;" disabled >{{$row->context}}</textarea>
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">type</th>
					  <td width="80%">
						<input type="text" class="form-control" name="type" size="30" value="{{$row->type}}" disabled>
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">tour</th>
					  <td width="80%">
						<input type="text" class="form-control" name="tour_id" size="30" value="{{$row->tour_name}}" disabled>
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">city</th>
					  <td width="80%">
						<input type="text" class="form-control" name="city_id" size="30" value="{{$row->city_name}}" disabled>
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">hotel</th>
					  <td width="80%">
						<input type="text" class="form-control" name="hotel_id" size="30" value="{{$row->hotel_name}}" disabled>
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