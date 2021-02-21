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
                            <h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-door-closed"> Hotel-Room Table</i>
							<a href="{{ route('a_hroom.create') }}"  class="btn btn-primary" style="float: right;"><i class="fas fa-plus-square"></i></a>
							</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="10%">ID</th>
                                            <th width="20%">Hotel-Name</th>
											<th width="20%">Type</th>
											<th width="10%">Bed</th>
											<th width="10%">Bathroom</th>
											<th width="15%">Price($)</th>
											<th width="15%">Size</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th width="10%">ID</th>
                                            <th width="20%">Hotel-Name</th>
											<th width="20%">Type</th>
											<th width="10%">Bed</th>
											<th width="10%">Bathroom</th>
											<th width="15%">Price($)</th>
											<th width="15%">Size</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
											@foreach($list as $row)
                                        <tr>
                                            <td width="10%"><a href="{{ route('a_hroom.show', $row->id) }}" >{{$row->id}}</a></td>
                                            <td width="20%">{{$row->hotel_name}}</td>
											<td width="20%">{{$row->type}}</td>
											<td width="10%">{{$row->bed}}</td>
											<td width="10%">{{$row->bathroom}}</td>
											<td width="15%">{{$row->price}}</td>
											<td width="15%">{{$row->size}}</td>
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