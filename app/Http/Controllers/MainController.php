<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;	//DB Lib 사용

use App\Models\Package;
use App\Models\Airport;
use App\Models\PackageReservation;
use App\Models\Hreservation;
use App\Models\Airline_reservation;

class MainController extends Controller
{
	public function adminMainPage()
	{
		$data['pReservations'] = PackageReservation::get();
		$data['pTotal'] = PackageReservation::leftjoin('packages', 'package_reservations.package_id', '=', 'packages.id')->where('packages.departure_date', 'like', date("Y", time()) ."%")->sum('total');
		$data['pCount'] = PackageReservation::count();
		$data['tmp'] = $data['pTotal'];
		
		


		$data['hReservations'] = Hreservation::get();
		$data['hTotal'] = Hreservation::sum('price');
		$data['hCount'] = Hreservation::count();

		$data['aReservations'] = Airline_reservation::get();
		$data['aTotal'] = Airline_reservation::sum('total');
		$data['aCount'] = Airline_reservation::count();
		return view('admin.index', $data);
	}
	public function mainPage()
	{
		$data['list'] = $this->getPlace();
		$data['packages'] = Package::leftjoin('nations', 'packages.nation_id', '=', 'nations.id')
			->select('packages.*', 'nations.name as nation_name')->inRandomOrder()->limit(10)->get();
		$data['hotels'] = $this->getHotel();

		//return response($data);
		return view('index', $data);
	}
	/*ㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡ*/
	public function getPlace()
	{
		$result = Airport::leftjoin('cities', 'airports.cities_id', '=', 'cities.id')
			->select('airports.*', 'cities.name as cities_name')
			->orderby('airports.name', 'asc')->get();
			
		return $result;
	}
	public function getHotel()
	{
		//$query = 'select hotels.*, cities.name as city_name, countries.name as country_name from hotels left join cities on hotels.city_id = cities.id left join countries on cities.country_id = countries.id;';
		//$result = DB::select($query);
		//Query Builder
		//$result = DB::table('products') ->orderby('name', 'asc') ->get();
		//Eloquent ORM
		$result = DB::table('hotels') 			
			->leftjoin('cities', 'hotels.city_id', '=', 'cities.id')
			->leftjoin('nations', 'cities.nation_id', '=', 'nations.id')
			->leftjoin('geographics', 'hotels.geographic_id', '=', 'geographics.id')
			->select('hotels.*', 'cities.name as city_name', 'nations.name as nation_name', 'geographics.place as geo_place', 'geographics.fontawe as geo_fontawe', DB::raw('(select max(hrooms.bed) from hrooms where hrooms.hotel_id = hotels.id) as maxbed'), DB::raw('(select min(hrooms.bed) from hrooms where hrooms.hotel_id = hotels.id) as minbed'), DB::raw('(select max(hrooms.bathroom) from hrooms where hrooms.hotel_id = hotels.id) as maxbathroom'), DB::raw('(select min(hrooms.bathroom) from hrooms where hrooms.hotel_id = hotels.id) as minbathroom'), DB::raw('(select max(hrooms.price) from hrooms where hrooms.hotel_id = hotels.id) as price'))
			->inRandomOrder()->limit(6)->get();
		return $result;
	}
}
