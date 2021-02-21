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
			<h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-map-marked-alt"> TourTable</i>
					<a href="{{ route('a_tour.create') }}" class="btn btn-primary" style="float: right;"><i class="fas fa-plus-square"></i></a>
				</h4>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th width="10%">ID</th>
							<th width="25%">name</th>
							<th width="35%">context</th>
							<th width="10%">pic1</th>
							<th width="10%">pic2</th>
							<th width="10%">city</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th width="10%">ID</th>
							<th width="25%">name</th>
							<th width="35%">context</th>
							<th width="10%">pic1</th>
							<th width="10%">pic2</th>
							<th width="10%">city</th>
						</tr>
					</tfoot>
					<tbody>
						@foreach($list as $row)
						<?php
							$context = $row->context;
							if(mb_strlen($context) > 30) $context = mb_substr($context, 0, 30).'...';
						?>
						<tr>
							<td><a href="{{route('a_tour.show', $row->id)}}">{{$row->id}}</a></td>
							<td>{{$row->name}}</td>
								  <td>{{$context}}</td>
								  <td>{{$row->pic1}}</td>
								  <td>{{$row->pic2}}</td>
								  <td>{{$row->city_name}}</td>
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
