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
			<h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-address-book"> ConsumerTable</i>
					<a href="{{ route('a_consumer.create') }}" class="btn btn-primary" style="float: right;"><i class="fas fa-plus-square"></i></a>
				</h4>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th width="10%">ID</th>
							<th width="14%">name</th>
							<th width="18%">uid</th>
							<th width="18%">pwd</th>
							<th width="20%">tel</th>
							<th width="10%">gender</th>
							<th width="10%">rank</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th width="10%">ID</th>
							<th width="14%">name</th>
							<th width="18%">uid</th>
							<th width="18%">pwd</th>
							<th width="20%">tel</th>
							<th width="10%">gender</th>
							<th width="10%">rank</th>
						</tr>
					</tfoot>
					<tbody>
						@foreach($list as $row)
						<?php
							$tel = substr($row->tel, 0, 3) ."-" .substr($row->tel, 3, 4) ."-" .substr($row->tel, 7, 4);
							$rank = $row->rank ? "관리자" : "사용자";
							$gender = $row->gender ? "여자" : "남자";
						?>
						<tr>
							<td><a href="{{route('a_consumer.show', $row->id)}}">{{$row->id}}</a></td>
							<td>{{$row->name}}</td>
							<td>{{$row->uid}}</td>
							<td>{{$row->pwd}}</td>
							<td>{{$tel}}</td>
							<td>{{$gender}}</td>
							<td>{{$rank}}</td>
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
