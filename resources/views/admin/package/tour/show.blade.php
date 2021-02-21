@extends('admin/amain')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
			<form method="post" action="{{route('a_tour.destroy', $row->id)}}">
			@method('DELETE')
			@csrf
		<div class="card-header py-3">
			<h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-map-marked-alt"> Tour</i>
					<a href='#' class="btn btn-primary float-right" onclick="history.back();"><i class="fas fa-undo"></i></a>
					<span class="float-right">&nbsp;</span>
					<button  class="btn btn-primary float-right" onClick="return confirm('삭제할까요 ?');"><i class="fas fa-trash-alt"></i></button>
					<span class="float-right">&nbsp;</span>
					<a href="{{ route('a_tour.edit', $row->id) }}" class="btn btn-primary float-right"><i class="fas fa-pen"></i></a>
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
					  <th scope="row" width="20%" style="vertical-align:middle;">name </th>
					  <td width="80%">
						<input type="text" class="form-control" name="name" size="30" value="{{$row->name}}" disabled>
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">context</th>
					  <td width="80%">
						<textarea name="context" rows="10" style="width:100%;" disabled >{{$row->context}}</textarea>
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">pic1</th>
					  <td width="80%">
						<p>{{$row->pic1}}</p>
						<img src="/storage/tour_pic/{{$row->pic1}}" style="width:300px;height:200px">
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">pic2</th>
					  <td width="80%">
						<p>{{$row->pic2}}</p>
						<img src="/storage/tour_pic/{{$row->pic2}}" style="width:300px;height:200px">
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">city</th>
					  <td width="80%">
						<input type="text" class="form-control" name="destnation_id" size="30" value="{{$row->city_name}}" disabled>
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