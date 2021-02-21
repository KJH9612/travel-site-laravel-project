<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Package;
use App\Models\PackageSchedule;
use App\Models\PackageReservation;

class PackageController extends Controller
{
    public function index(Request $request)
    {
		$data['nation'] = $request->input('nation');
		$nation = $data['nation'] ? $data['nation'] : "";
		$nation = "%" .$nation ."%";
		$data['departure_date'] = $request->input('departure_date');
		$departure_date = $data['departure_date'] ? $data['departure_date'] : 0;
		$data['arrival_date'] = $request->input('arrival_date');
		$arrival_date = $data['arrival_date'] ? $data['arrival_date'] : "2099/12/31";
		$data['price'] = $request->input('price');
		$price = $data['price'] ? $data['price'] : 1000000000000;
		

		$data['list'] = Package::leftjoin('nations', 'nation_id', '=', 'nations.id')->select('packages.*', 'nations.name as nation_name')
			->where('nations.name', 'like', $nation)->where('packages.departure_date', '>=', $departure_date)
			->where('packages.arrival_date', '<=', $arrival_date)->where('packages.adult_price', '<=', $price)->get();
        return view('package.index', $data);
    }
	
    public function show($id)
    {
		$data['row'] = Package::leftjoin('nations', 'nation_id', '=', 'nations.id')
			->leftjoin('schedules as departure_schedule', 'packages.departure_schedule_id', '=', 'departure_schedule.id')
			->leftjoin('schedules as arrival_schedule', 'packages.arrival_schedule_id', '=', 'arrival_schedule.id')
			->leftjoin('planes as departure_plan', 'departure_schedule.air_id', '=', 'departure_plan.id')
			->leftjoin('planes as arrival_plan', 'arrival_schedule.air_id', '=', 'arrival_plan.id')
			->leftjoin('airports as departure_start_airport', 'departure_schedule.departure_id', '=', 'departure_start_airport.id')
			->leftjoin('airports as departure_end_airport', 'departure_schedule.destnation_id', '=', 'departure_end_airport.id')
			->leftjoin('airports as arrival_start_airport', 'arrival_schedule.departure_id', '=', 'arrival_start_airport.id')
			->leftjoin('airports as arrival_end_airport', 'arrival_schedule.destnation_id', '=', 'arrival_end_airport.id')
			->select('packages.*', 'nations.name as nation_name', 'departure_schedule.startDate as departure_schedule_startDate', 'departure_schedule.endDate as departure_schedule_endDate', 'arrival_schedule.startDate as arrival_schedule_startDate', 'arrival_schedule.endDate as arrival_schedule_endDate', 'departure_plan.number as departure_plan_number', 'arrival_plan.number as arrival_plan_number', 'departure_start_airport.name as departure_start_airport_name', 'departure_end_airport.name as departure_end_airport_name', 'arrival_start_airport.name as arrival_start_airport_name', 'arrival_end_airport.name as arrival_end_airport_name')->where('packages.id', '=', $id)->first();

		$data['schedule_list'] = PackageSchedule::leftjoin('hotels', 'package_schedules.hotel_id', '=', 'hotels.id')
			->leftjoin('tours', 'package_schedules.tour_id', '=', 'tours.id')
			->leftjoin('cities', 'package_schedules.city_id', '=', 'cities.id')
			->select('package_schedules.*', 'hotels.star as hotels_star', 'hotels.name as hotels_name', 'tours.name as tour_name', 'tours.context as tour_context', 'tours.pic1 as tour_pic1', 'tours.pic2 as tour_pic2', 'cities.name as city_name')
			->where('package_schedules.package_id', '=', $id)->orderby('package_schedules.date', 'asc')->orderby('package_schedules.sort', 'asc')->get();
		$data['count_day'] = PackageSchedule::where('package_id', '=', $id)->distinct('date')->count();
        return view('package.show', $data);
    }
	public function order(Request $request, $id)
	{
		$data['adult'] = $request->input('adult');
		$data['kid'] = $request->input('kid');
		$data['baby'] = $request->input('baby');
		$data['packageTotal'] = $request->input('total');
		$data['row'] = Package::leftjoin('nations', 'nation_id', '=', 'nations.id')
			->leftjoin('schedules as departure_schedule', 'packages.departure_schedule_id', '=', 'departure_schedule.id')
			->leftjoin('schedules as arrival_schedule', 'packages.arrival_schedule_id', '=', 'arrival_schedule.id')
			->leftjoin('planes as departure_plan', 'departure_schedule.air_id', '=', 'departure_plan.id')
			->leftjoin('planes as arrival_plan', 'arrival_schedule.air_id', '=', 'arrival_plan.id')
			->select('packages.*', 'nations.name as nation_name', 'departure_schedule.startDate as departure_schedule_startDate', 'arrival_schedule.startDate as arrival_schedule_startDate', 'departure_plan.number as departure_plan_number', 'arrival_plan.number as arrival_plan_number')->where('packages.id', '=', $id)->first();

		return view('package.order', $data);
	}
	public function store(Request $request)
    {
		$row = new PackageReservation([
			'adult' => $request->input('adult'),
			'kid' => $request->input('kid'),
			'baby' => $request->input('baby'),
			'package_id' => $request->input('package_id'),
			'consumer_id' => $request->input('consumer_id'),
			'package_total' => $request->input('package_total'),
			'service_total' => $request->input('service_total'),
			'total' => $request->input('total'),
			'breakfast' => $request->input('breakfast')? $request->input('breakfast') : "off",
			'bedsize' => $request->input('bedsize')? $request->input('bedsize') : "off",
			'wifi' => $request->input('wifi')? $request->input('wifi') : "off",
			'airplaneup' => $request->input('airplaneup')? $request->input('airplaneup') : "off",
			'shuttle' => $request->input('shuttle')? $request->input('shuttle') : "off"
		]);
		$row->save();

		return redirect(route('package.index'));
    }
    public function create()
    {
        //
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
        //
    }
}
