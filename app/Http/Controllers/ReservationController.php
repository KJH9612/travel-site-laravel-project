<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Airline_reservation;
use App\Models\Hreservation;
use App\Models\PackageReservation;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
		$id = $request->input('id');
		$data['packageReservations'] = PackageReservation::leftJoin('packages', 'package_reservations.package_id', '=', 'packages.id')
			->select('package_reservations.*', 'packages.departure_date as package_departure_date', 'packages.arrival_date as package_arrival_date', 'packages.name as package_name')
			->where('package_reservations.consumer_id', '=', $id)->get();

		$data['airlineReservations'] = Airline_Reservation::leftJoin('schedules', 'airline_reservations.schedules_id', '=', 'schedules.id')
			->leftJoin('consumers', 'airline_reservations.consumers_id', '=', 'consumers.id')
			->leftJoin('planes', 'schedules.air_id', '=', 'planes.id')
			->leftJoin('airports as departure', 'schedules.departure_id', '=', 'departure.id')
			->leftJoin('airports as destnation', 'schedules.destnation_id', '=', 'destnation.id')
			->leftJoin('cities as departure_city', 'departure.cities_id', '=', 'departure_city.id')
			->leftJoin('cities as destnation_city', 'destnation.cities_id', '=', 'destnation_city.id')
			->select('schedules.*', 'airline_reservations.*', 'consumers.name as consumer_name', 'consumers.uid as consumers_uid', 'planes.number as planes_number', 'departure.name as departure_name','departure_city.name as departure_city_name', 'destnation.name as destnation_name', 'destnation_city.name as destnation_city_name')
			->where('consumers.id', '=', $id)->orderby('schedules.startDate', 'asc')->orderby('airline_reservations.id', 'asc')->get();

		$data['hotelReservations'] = Hreservation::leftJoin('hotels', 'hreservations.hotel_id', '=', 'hotels.id')
			->leftJoin('consumers', 'hreservations.consumer_id', '=', 'consumers.id')
			->leftJoin('hrooms', 'hreservations.hroom_id', '=', 'hrooms.id')
			->leftJoin('cities', 'hotels.city_id', '=', 'cities.id')
			->leftJoin('nations', 'cities.nation_ID', '=', 'nations.id')
			->select('hreservations.*', 'hreservations.id as hreservations_id', 'hotels.name as hotels_name', 'hotels.address as hotels_address', 'hotels.explain as hotels_explain', 'hrooms.price as hrooms_price', 'cities.name as cities_name', 'nations.name as nations_name')
			->where('consumers.id', '=', $id)->orderby('hreservations.check_in', 'asc')->get();

        return view('reservation.index', $data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id, Request $request)
    {
		$data['kind'] = $request->input('kind');
		//항공기         kind  1 = 패키지여행, 2 = 항공기, 3 = 호텔
		if($data['kind'] == 1){
			$data['row'] = PackageReservation::leftJoin('packages', 'package_reservations.package_id', '=', 'packages.id')
				->leftjoin('consumers', 'package_reservations.consumer_id', '=', 'consumers.id')
				->select('package_reservations.*', 'packages.departure_date as package_departure_date', 'packages.arrival_date as package_arrival_date', 'packages.name as package_name', 'consumers.name as consumer_name')
				->where('package_reservations.id', '=', $id)->first();
		}

		else if($data['kind'] == 2){
			$data['row']= Airline_Reservation::leftJoin('schedules', 'airline_reservations.schedules_id', '=', 'schedules.id')
			->leftJoin('consumers', 'airline_reservations.consumers_id', '=', 'consumers.id')
			->leftJoin('planes', 'schedules.air_id', '=', 'planes.id')
			->leftJoin('airports as departure', 'schedules.departure_id', '=', 'departure.id')
			->leftJoin('airports as destnation', 'schedules.destnation_id', '=', 'destnation.id')
			->leftJoin('cities as departure_city', 'departure.cities_id', '=', 'departure_city.id')
			->leftJoin('cities as destnation_city', 'destnation.cities_id', '=', 'destnation_city.id')
			->select('schedules.*', 'airline_reservations.*', 'consumers.name as consumer_name', 'consumers.uid as consumers_uid', 'planes.number as planes_number', 'departure.name as departure_name','departure_city.name as departure_city_name', 'destnation.name as destnation_name', 'destnation_city.name as destnation_city_name')
			->where('airline_reservations.id', '=', $id)->orderby('schedules.startDate', 'asc')->orderby('airline_reservations.id', 'asc')->first();
		}
		else if($data['kind'] == 3){
			$data['row'] = Hreservation::leftJoin('hotels', 'hreservations.hotel_id', '=', 'hotels.id')
			->leftJoin('consumers', 'hreservations.consumer_id', '=', 'consumers.id')
			->leftJoin('hrooms', 'hreservations.hroom_id', '=', 'hrooms.id')
			->leftJoin('cities', 'hotels.city_id', '=', 'cities.id')
			->leftJoin('nations', 'cities.nation_ID', '=', 'nations.id')
			->select('hreservations.*', 'hreservations.id as hreservations_id', 'hotels.name as hotels_name', 'hotels.address as hotels_address', 'hotels.explain as hotels_explain', 'hrooms.bed as hrooms_bed', 'hrooms.bathroom as hrooms_bathroom', 'hrooms.size as hrooms_size', 'cities.name as cities_name', 'nations.name as nations_name', 'consumers.name as consumer_name', 'consumers.uid as consumers_uid')
			->where('hreservations.id', '=', $id)->orderby('hreservations.check_in', 'asc')->first();
		}
        return view('reservation.show', $data);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $request, $id)
    {
		$kind = $request->input('kind');
		//kind  1 = 패키지여행, 2 = 항공기, 3 = 호텔
		if($kind == 1) $row = PackageReservation::find($id);
		else if($kind == 2) $row = Airline_Reservation::find($id);
		else if($kind == 3) $row = hReservation::find($id);
		$row->delete();
		$url = route('consumer_reservation.index',['id'=> session()->get('consumer')->id]);
		return redirect($url);
    }
}
