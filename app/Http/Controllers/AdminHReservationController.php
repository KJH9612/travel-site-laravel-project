<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;	//DB Lib 사용
use App\Models\Hotel;
use App\Models\Hroom;
use App\Models\Hreservation;
use App\Models\Consumer;

class AdminHReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['list'] = $this->getlist();
		return view('admin.hotel.a_hreservation.index', $data);
    }

	public function getlist()
	{
		//$query = 'select hotels.*, cities.name as city_name, countries.name as country_name from hotels left join cities on hotels.city_id = cities.id left join countries on cities.country_id = countries.id;';
		//$result = DB::select($query);
		//Query Builder
		//$result = DB::table('products') ->orderby('name', 'asc') ->get();
		//Eloquent ORM
		$result = DB::table('hreservations') 			
			->leftjoin('consumers', 'hreservations.consumer_id', '=', 'consumers.id')
			->leftjoin('hrooms', 'hreservations.hroom_id', '=', 'hrooms.id')
			->leftjoin('hotels', 'hreservations.hotel_id', '=', 'hotels.id')
			->select('hreservations.*', 'consumers.name as consumer_name', 'hrooms.type as type', 'hotels.name as hotel')	
			->get();
		//$result = Product::orderby('name','asc')->get();
		//$result = Product::orderby('name','asc')->limit(10)->get();
		//$result = Product::orderby('name','asc')->skip(10)->take(10)->get();
		

		return $result;
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$data['list']  = Consumer::get();
		$data['list1'] = Hotel::get();
        $data['list2'] = $this->gethroom();
		
		return view('admin.hotel.a_hreservation.create', $data);
    }

	public function gethroom()
	{
		//$query = 'select hotels.*, cities.name as city_name, countries.name as country_name from hotels left join cities on hotels.city_id = cities.id left join countries on cities.country_id = countries.id;';
		//$result = DB::select($query);
		//Query Builder
		//$result = DB::table('products') ->orderby('name', 'asc') ->get();
		//Eloquent ORM
		$result = DB::table('hrooms') 			
			->leftjoin('hotels', 'hrooms.hotel_id', '=', 'hotels.id')
			->select('hrooms.*', 'hotels.name as hotel')	
			->get();
		//$result = Product::orderby('name','asc')->get();
		//$result = Product::orderby('name','asc')->limit(10)->get();
		//$result = Product::orderby('name','asc')->skip(10)->take(10)->get();
		

		return $result;
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $breakfast	= $request->input('breakfast');
		$bedsize	= $request->input('bedsize');		
		$wifiegg	= $request->input('wifiegg');		

        $request->validate([
		'consumer_id'	=> 'required',
        'check_in'		=> 'required',
		'check_out'		=> 'required',
		'adult'			=> 'required',
		'child'			=> 'required',			
        'hotel_id'		=> 'required',
        'hroom_id'		=> 'required'
		],
		[
		'consumer_id'			=> '예약자는 필수입력입니다.',
        'check_in.required' 	=> '입실일은 필수입력입니다.',
        'check_out.required'	=> '퇴실일은 필수입력입니다.',
        'adult.required'		=> '인원수(어른)는 필수입력입니다.',
        'child.required'		=> '인원수(어린이)는 필수입력입니다.',			
        'hotel_id.required'		=> '호텔은 필수입력입니다.'	,			
        'hroom_id.required'		=> '객실은 필수입력입니다.'	
		]);
		
		if(!$breakfast)
			$breakfast ='off';

		if(!$bedsize)
			$bedsize ='off';

		if(!$wifiegg)
			$wifiegg ='off';
		
		$row = new Hreservation([
			'consumer_id'	=> $request->input('consumer_id'),
			'check_in'		=> $request->input('check_in'),
			'check_out'		=> $request->input('check_out'),
			'adult'			=> $request->input('adult'),
			'child'			=> $request->input('child'),
			'hotel_id'		=> $request->input('hotel_id'),
			'hroom_id'		=> $request->input('hroom_id'),
			'price'			=> $request->input('realprice'),
			'breakfast'		=> $breakfast,
			'bedsize'		=> $bedsize,
			'wifiegg'		=> $wifiegg
		]);

		$row->save();

		return redirect('a_hreservation');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['row'] = $this->getdetail($id);
		return view('admin.hotel.a_hreservation.show', $data);
    }

	public function getdetail($id)
	{
		//$query = 'select hotels.*, cities.name as city_name, countries.name as country_name from hotels left join cities on hotels.city_id = cities.id left join countries on cities.country_id = countries.id;';
		//$result = DB::select($query);
		//Query Builder
		//$result = DB::table('products') ->orderby('name', 'asc') ->get();
		//Eloquent ORM
		$result = DB::table('hreservations') 			
			->leftjoin('consumers', 'hreservations.consumer_id', '=', 'consumers.id')
			->leftjoin('hrooms', 'hreservations.hroom_id', '=', 'hrooms.id')
			->leftjoin('hotels', 'hreservations.hotel_id', '=', 'hotels.id')
			->select('hreservations.*', 'consumers.name as consumer_name', 'hrooms.type as type', 'hrooms.price as rprice', 'hotels.name as hotel')	
			->where('hreservations.id', '=', $id)
			->first();
		//$result = Product::orderby('name','asc')->get();
		//$result = Product::orderby('name','asc')->limit(10)->get();
		//$result = Product::orderby('name','asc')->skip(10)->take(10)->get();
		

		return $result;
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['row'] = $this->getedit($id);
		$data['list'] = Hroom::get();
		
		return view('admin.hotel.a_hreservation.edit', $data);
    }

	public function getedit($id)
	{
		//$query = 'select hotels.*, cities.name as city_name, countries.name as country_name from hotels left join cities on hotels.city_id = cities.id left join countries on cities.country_id = countries.id;';
		//$result = DB::select($query);
		//Query Builder
		//$result = DB::table('products') ->orderby('name', 'asc') ->get();
		//Eloquent ORM
		$result = DB::table('hreservations') 			
			->leftjoin('consumers', 'hreservations.consumer_id', '=', 'consumers.id')
			->leftjoin('hotels', 'hreservations.hotel_id', '=', 'hotels.id')
			->select('hreservations.*', 'consumers.name as consumer_name', 'hotels.name as hotel')	
			->where('hreservations.id', '=', $id)
			->first();
		//$result = Product::orderby('name','asc')->get();
		//$result = Product::orderby('name','asc')->limit(10)->get();
		//$result = Product::orderby('name','asc')->skip(10)->take(10)->get();
		

		return $result;
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$breakfast	= $request->input('breakfast');
		$bedsize	= $request->input('bedsize');		
		$wifiegg	= $request->input('wifiegg');		

        $request->validate([
        'check_in'	=> 'required',
		'check_out'	=> 'required',
		'adult'		=> 'required',
		'child'		=> 'required',
        'hroom_id'	=> 'required'
		],
		[
        'check_in.required' 	=> '입실일은 필수입력입니다.',
        'check_out.required'	=> '퇴실일은 필수입력입니다.',
        'adult.required'		=> '인원수(어른)는 필수입력입니다.',
        'child.required'		=> '인원수(어린이)는 필수입력입니다.',			
        'hroom_id.required'		=> '객실은 필수입력입니다.'	
		]);
		
		if(!$breakfast)
			$breakfast ='off';

		if(!$bedsize)
			$bedsize ='off';

		if(!$wifiegg)
			$wifiegg ='off';

		$row = Hreservation::find($id);

		$row->check_in	= $request->input('check_in');
		$row->check_out	= $request->input('check_out');
		$row->adult		= $request->input('adult');
		$row->child		= $request->input('child');		
		$row->hroom_id	= $request->input('hroom_id');		
		$row->price		= $request->input('realprice');	
		$row->breakfast	= $breakfast;
		$row->bedsize	= $bedsize;
		$row->wifiegg	= $wifiegg;
		
		$row->save();

		return redirect('a_hreservation');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Hreservation::find($id);
		$row->delete();
		
		return redirect('a_hreservation');
    }
}
