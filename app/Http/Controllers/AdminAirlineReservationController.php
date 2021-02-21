<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;	//DB Lib 사용
use App\Models\Airline_reservation;

class AdminAirlineReservationController extends Controller
{
    public function index()
    {
		$data['list'] = $this->getAirline();
		return view('admin.air.reservation.index', $data);
    }
	
	public function getAirline()
	{
		$result = Airline_reservation::leftjoin('consumers', 'airline_reservations.consumers_id', '=', 'consumers.id')
				->leftjoin('schedules', 'airline_reservations.schedules_id', '=', 'schedules.id')
				->leftjoin('airports', 'schedules.departure_id', '=', 'airports.id')
				->leftjoin('airports as a', 'schedules.destnation_id', '=', 'a.id')
				->select('airline_reservations.*', 'consumers.name as consumers_name', 'airports.name as departure_name', 'a.name as destnation_name', 'schedules.startDate as startDate', 'schedules.endDate as endDate')
				->get();
		return $result;
	}
	
    public function create()
    {
		//
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
		$data['row'] = $this->getAirline2($id);
		return view('admin.air.reservation.show', $data);
    }
	
	public function getAirline2($id)
	{
		$result = Airline_reservation::leftjoin('consumers', 'airline_reservations.consumers_id', '=', 'consumers.id')
				->leftjoin('schedules', 'airline_reservations.schedules_id', '=', 'schedules.id')
				->leftjoin('airports', 'schedules.departure_id', '=', 'airports.id')
				->leftjoin('airports as a', 'schedules.destnation_id', '=', 'a.id')
				->select('airline_reservations.*', 'consumers.name as consumers_name', 'airports.name as departure_name', 'a.name as destnation_name', 'schedules.startDate as startDate', 'schedules.endDate as endDate')
				->where('airline_reservations.id', $id)
				->first();
		return $result;
	}

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
       //
    }

    public function destroy($id)
    {
        $row = Airline_reservation::find($id);
		$row->delete();
		
		return redirect('airline');
    }
}
