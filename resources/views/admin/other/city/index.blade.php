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
                            <h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-city"> CityTable</i>
									<a href="{{ route('city.create') }}" class="btn btn-primary" style="float: right;"><i class="fas fa-plus-square"></i></a>
								</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
												  <th>name</th>
												  <th>nation</th>
												  <th>info</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th width="20%">ID</th>
												  <th>name</th>
												  <th>nation</th>
												  <th>info</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
											@foreach($list as $row)
                                        <tr>
                                            <td width="20%"><a href="{{ route('city.show', $row->id) }}" >{{$row->id}}</a></td>
											     <td>{{$row->name}}</td>
												  <td>{{$row->nation_name}}</td>
												  <td>{{$row->info}}</td>
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