@extends('admin/amain')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800"><i class="fas fa-fw fa-table"></i> Tables</h1>
	<p class="mb-4"></p>

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-clipboard-list"> Package_ReservationTable</i>
					<a href="{{ route('a_package_reservation.create') }}" class="btn btn-primary" style="float: right;"><i class="fas fa-plus-square"></i></a>
				</h4>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th width="10%">ID</th>
							<th width="20%">consumer</th>
							<th width="30%">package</th>
							<th width="25%">num</th>
							<th width="15%">total</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th width="10%">ID</th>
							<th width="20%">consumer</th>
							<th width="30%">package</th>
							<th width="25%">num</th>
							<th width="15%">total</th>
						</tr>
					</tfoot>
					<tbody>
						@foreach($list as $row)
						<tr>
							<td><a href="{{route('a_package_reservation.show', $row->id)}}">{{$row->id}}</a></td>
							<td>{{$row->consumer_name}}({{$row->consumer_uid}})</td>
							<td>{{$row->package_name}}</td>
							<td>어른:{{$row->adult}}, 어린이:{{$row->kid}}, 유아:{{$row->baby}}</td>
							<td>{{number_format($row->total)}}원</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>
<!-- /.container-fluid -->

 @stop