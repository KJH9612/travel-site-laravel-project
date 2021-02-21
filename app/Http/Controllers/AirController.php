<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Schedule;
use App\Models\Plane;
use App\Models\City;
use App\Models\Airport;
use App\Models\Airline_reservation;
use App\Models\Package;
//hotel
use App\Models\Hotel;
use App\Models\Hreservation;
use App\Models\Geographics;
use App\Models\Comment;
use App\Models\Consumer;

class AirController extends Controller
{
    public function index()
    {
		$data['list'] = $this->getPlace();
		$data['schedule'] = null;
		$data['return_schedule'] = null;
        return view('air.index', $data);
    }
	/*ㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡ*/
	public function getPlace()
	{
		$result = Airport::leftjoin('cities', 'airports.cities_id', '=', 'cities.id')
			->select('airports.*', 'cities.name as cities_name')
			->orderby('airports.name', 'asc')->get();
			
		return $result;
	}
	/*ㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡ*/
	public function search(Request $request)
	{
		$radios = $request->input('radios');
		
		if($radios == 0) {
			$request->validate([
				'departure' => 'required',
				'destnation' => 'required',
				'startDate' => 'required',
				'endDate' => 'required',
				'adult' => 'required|min:1'
			],
			[
				'departure.required' => '출발지는 필수입력입니다.',
				'destnation.required' => '목적지는 필수입력입니다.',
				'startDate.required' => '가는 편 날짜는 필수입력입니다',
				'endDate.required' => '오는 편 날짜는 필수입력입니다.',
				'adult.required' => '인원을 선택해주세요.' 
			]);
			
			$date1 = explode('/', $request->input('startDate'));
			$date2 = explode('/', $request->input('endDate'));
			$startDate = $date1[2].'-'.$date1[0].'-'.$date1[1];
			$endDate = $date2[2].'-'.$date2[0].'-'.$date2[1];
			
		} else {
			$request->validate([
				'departure' => 'required',
				'destnation' => 'required',
				'startDate' => 'required',
				'adult' => 'required|min:1'
			],
			[
				'departure.required' => '출발지는 필수입력입니다.',
				'destnation.required' => '목적지는 필수입력입니다.',
				'startDate.required' => '가는 편 날짜는 필수입력입니다',
				'adult.required' => '인원을 선택해주세요.' 
			]);
			
			$date1 = explode('/', $request->input('startDate'));
			$startDate = $date1[2].'-'.$date1[0].'-'.$date1[1];
		}
		
		$departure = $request->input('departure');
		$destnation = $request->input('destnation');
		$adult = $request->input('adult');
		$child = $request->input('child');
		$infant = $request->input('infant');
		
		$data['schedule'] = $this->getScheduleList($departure, $destnation, $startDate);
		$data['list'] = $this->getPlace();
		
		if($radios == 0) {
			$data['return_schedule'] = $this->getScheduleList($destnation, $departure, $endDate);
		} else {
			$data['return_schedule'] = null;
		}
		
		$request->flash();
		
		return view('air.index', $data);
		
		//return response($data);
	}
	
	public function getScheduleList($departure, $destnation, $startDate) {
		$mathThese = [
			'schedules.departure_id' => $departure,
			'schedules.destnation_id' => $destnation
		];
		
		$result = Schedule::leftjoin('airports', 'schedules.departure_id', '=', 'airports.id')
			->leftjoin('airports as a', 'schedules.destnation_id', '=', 'a.id')
			->leftjoin('planes', 'schedules.air_id', '=', 'planes.id')
			->leftjoin('cities', 'airports.cities_id', '=', 'cities.id')
			->leftjoin('cities as c', 'a.cities_id', '=', 'c.id')
			->select('schedules.*', 'airports.name as departure_name', 'a.name as destnation_name', 'cities.name as departure_city', 'c.name as destnation_city', 'planes.number as planes_number')
			->where($mathThese)
			->whereDate('schedules.startDate', $startDate)
			->orderby('schedules.startDate', 'asc')->get();
		
		return $result;
	}
	
	
	public function reservation(Request $request) {
		$radios = $request->input('radios');
		
		$goCheck = $request->input('goCheck');
		$comeCheck = $request->input('comeCheck');
		
		$data['adult'] = $request->input('adult');
		$data['child'] = $request->input('child');
		$data['infant'] = $request->input('infant');
		$data['list'] = $this->getPlace();
		$data['schedule'] = $this->getSchedule($goCheck);
		
		if($radios == 0) {
			$data['return_schedule'] = $this->getSchedule($comeCheck);
		} else {
			$data['return_schedule'] = null;
		}
		
		return view('air.reservation', $data);
		//return response($data);
	}
	
	public function getSchedule($id) {
		$result = Schedule::leftjoin('planes', 'schedules.air_id', '=', 'planes.id')
			->select('schedules.*', 'planes.number as planes_number')
			->where('schedules.id', '=', $id)
			->first();
			
		return $result;
	}
	
	public function storage(Request $request) {
		$row = new Airline_reservation([
			'consumers_id' => $request->input('consumer'),
			'schedules_id' => $request->input('schedule_id'),
			'adult' => $request->input('adult'),
			'child' => $request->input('child'),
			'infant' => $request->input('infant'),
			'total' => $request->input('leave_total'),
			'baggage' => $request->input('baggage')
		]);
		
		$row->save();
		
		$return_schedule_id = $request->input('return_schedule_id');
		if($return_schedule_id != null) {
			$row2 = new Airline_reservation([
				'consumers_id' => $request->input('consumer'),
				'schedules_id' => $return_schedule_id,
				'adult' => $request->input('adult'),
				'child' => $request->input('child'),
				'infant' => $request->input('infant'),
				'total' => $request->input('return_total'),
				'baggage' => $request->input('return_baggage')
			]);
			
			$row2->save();
		}
		
		return redirect('/');
		//return response($data);
	}
}
