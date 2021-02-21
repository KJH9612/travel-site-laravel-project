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
			<h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-route"> PackageTable</i>
					<a href="{{ route('a_package.create') }}" class="btn btn-primary" style="float: right;"><i class="fas fa-plus-square"></i></a>
				</h4>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th width="10%">ID</th>
							<th width="10%">nation</th>
							<th width="25%">name</th>
							<th width="25%">explain</th>
							<th width="15%">departure_date</th>
							<th width="15%">arrival_date</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th width="8%">ID</th>
							<th width="10%">nation</th>
							<th width="25%">name</th>
							<th width="31%">explain</th>
							<th width="12%">departure_date</th>
							<th width="12%">arrival_date</th>
						</tr>
					</tfoot>
					<tbody>
						@foreach($list as $row)
						<?php
							$explain = $row->explain;
							if(mb_strlen($explain) > 30) $explain = mb_substr($explain, 0, 30).'...';
						?>
						<tr>
							<td><a href="{{route('a_package.show', $row->id)}}">{{$row->id}}</a></td>
							<td>{{$row->nation_name}}</td>
							<td>{{$row->name}}</td>
							<td>{{$explain}}</td>
							<td>{{$row->departure_date}}</td>
							<td>{{$row->arrival_date}}</td>
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
