@extends('admin/amain')
@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-fw fa-table"></i>Tables</h1>
                    <p class="mb-4"></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-clipboard-list"> Airline_ReservationTable</i></h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>consumer</th>
												  <th>schedule</th>
												  <th>price</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th width="5%">ID</th>
                                            <th>consumer</th>
												  <th>schedule</th>
												  <th>price</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
											@foreach($list as $row)
                                        <tr>
                                            <td width="5%"><a href="{{ route('airline.show', $row->id) }}">{{$row->id}}</a></td>
                                            <td>{{$row->consumers_name}}</td>
												  <td>
													{{$row->startDate}} ({{$row->departure_name}}) &nbsp -> &nbsp {{$row->endDate}} ({{$row->destnation_name}})
												  </td>
												  <td>{{number_format($row->total)}}</td>
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