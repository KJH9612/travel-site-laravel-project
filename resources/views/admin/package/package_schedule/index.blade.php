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
			<h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-clipboard-list"> Package_ScheduleTable</i>
					<a href="{{ route('a_package_schedule.create') }}" class="btn btn-primary" style="float: right;"><i class="fas fa-plus-square"></i></a>
				</h4>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th width="10%">ID</th>
							<th width="25%">package</th>
							<th width="10%">date</th>
							<th width="10%">sort</th>
							<th width="25%">context</th>
							<th width="10%">type</th>
							<th width="10%">city</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>ID</th>
							<th>package</th>
							<th>date</th>
							<th>sort</th>
							<th>context</th>
							<th>type</th>
							<th>city</th>
						</tr>
					</tfoot>
					<tbody>
						@foreach($list as $row)
						<?php
							$context = $row->context;
							if(mb_strlen($context) > 30) $context = mb_substr($context, 0, 30).'...';
						?>
						<tr>
							<td><a href="{{route('a_package_schedule.show', $row->id)}}">{{$row->id}}</a></td>
							<td>{{$row->package_name}}</td>
								  <td>{{$row->date}}일차</td>
								  <td>{{$row->sort}}번째</td>
								  <td>{{$context}}</td>
								  <td>{{$row->type}}</td>
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
