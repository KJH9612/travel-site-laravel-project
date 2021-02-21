<?php

namespace App\Http\Controllers;

use App\Http\Controllers\HotelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;	//DB Lib 사용
use App\Models\Hotel;				//eloquent 사용할 때 필요
use App\Models\Hreservation;
use App\Models\Geographics;
use App\Models\Comment;
use App\Models\Consumer;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		$text1=$request->input("text1");
		$price=$request->input("price");

		$data['text1']	= $text1;
		$data['price']	= $price;

		$data['list'] = $this->getlist($text1, $price);
        return view('hotel.index',$data);
    }
	
	public function getlist($text1, $price)
	{
		//$query = 'select hotels.*, cities.name as city_name, countries.name as country_name from hotels left join cities on hotels.city_id = cities.id left join countries on cities.country_id = countries.id;';
		//$result = DB::select($query);
		//Query Builder
		//$result = DB::table('products') ->orderby('name', 'asc') ->get();
		//Eloquent ORM
		if($price)
			$result = DB::table('hotels') 			
				->leftjoin('cities', 'hotels.city_id', '=', 'cities.id')
				->leftjoin('nations', 'cities.nation_id', '=', 'nations.id')
				->leftjoin('geographics', 'hotels.geographic_id', '=', 'geographics.id')
				->select('hotels.*', 'cities.name as city_name', 'nations.name as nation_name', 'geographics.place as geo_place', 'geographics.fontawe as geo_fontawe', DB::raw('(select max(hrooms.price) from hrooms where hrooms.hotel_id = hotels.id and hrooms.price <= '.$price.') as price'), DB::raw('(select max(hrooms.bed) from hrooms where hrooms.hotel_id = hotels.id) as maxbed'), DB::raw('(select min(hrooms.bed) from hrooms where hrooms.hotel_id = hotels.id) as minbed'), DB::raw('(select max(hrooms.bathroom) from hrooms where hrooms.hotel_id = hotels.id) as maxbathroom'), DB::raw('(select min(hrooms.bathroom) from hrooms where hrooms.hotel_id = hotels.id) as minbathroom'))
				->where('cities.name', 'like', '%'.$text1.'%')			
				->paginate(6);
		else
			$result = DB::table('hotels') 			
				->leftjoin('cities', 'hotels.city_id', '=', 'cities.id')
				->leftjoin('nations', 'cities.nation_id', '=', 'nations.id')
				->leftjoin('geographics', 'hotels.geographic_id', '=', 'geographics.id')
				->select('hotels.*', 'cities.name as city_name', 'nations.name as nation_name', 'geographics.place as geo_place', 'geographics.fontawe as geo_fontawe', DB::raw('(select max(hrooms.bed) from hrooms where hrooms.hotel_id = hotels.id) as maxbed'), DB::raw('(select min(hrooms.bed) from hrooms where hrooms.hotel_id = hotels.id) as minbed'), DB::raw('(select max(hrooms.bathroom) from hrooms where hrooms.hotel_id = hotels.id) as maxbathroom'), DB::raw('(select min(hrooms.bathroom) from hrooms where hrooms.hotel_id = hotels.id) as minbathroom'), DB::raw('(select max(hrooms.price) from hrooms where hrooms.hotel_id = hotels.id) as price'))
				->where('cities.name', 'like', '%'.$text1.'%')			
				->paginate(6);
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {	
		//return response($id);
		if(!session()->get('h_id')){
			$data['room'] = $this->getroom($id);
			$data['list'] = $this->getdetail($id);			
			$data['com'] = $this->getcomment($id);
			if(session()->get('consumer'))
				$data['consumer'] = $this->getconsumer(session()->get('consumer')->uid);
			$data['com_id'] = Comment::orderBy('created_at', 'DESC')->first();
			$data['total'] = Comment::where('hotel_id', $id)->count();
		}
		else {
			$data['list'] = $this->getdetail(session()->get('h_id'));
			$data['room'] = $this->getroom(session()->get('h_id'));
			$data['com'] = $this->getcomment(session()->get('h_id'));
			if(session()->get('consumer'))
				$data['consumer'] = $this->getconsumer(session()->get('consumer')->uid);
			$data['com_id'] = Comment::orderBy('created_at', 'DESC')->first();
			$data['total'] = Comment::where('hotel_id', session()->get('h_id'))->count();
			session()->forget('h_id');
		}
		//return response($data);
        return view('hotel.detail', $data);	
    }

	public function getdetail($id)
	{
		//$query = 'select hotels.*, cities.name as city_name, countries.name as nation_name from hotels left join cities on hotels.city_id = cities.id left join countries on cities.nation_id = countries.id;';
		//$result = DB::select($query);
		//Query Builder
		//$result = DB::table('products') ->orderby('name', 'asc') ->get();
		//Eloquent ORM
		$result = DB::table('hotels') 			
			->leftjoin('cities', 'hotels.city_id', '=', 'cities.id')
			->leftjoin('nations', 'cities.nation_id', '=', 'nations.id')
			->select('hotels.*', 'cities.name as city_name', 'nations.name as nation_name')
			->where('hotels.id', $id)
			->get();
		//$result = Product::orderby('name','asc')->get();
		//$result = Product::orderby('name','asc')->limit(10)->get();
		//$result = Product::orderby('name','asc')->skip(10)->take(10)->get();
		

		return $result;
	}

	public function getroom($id)
	{
		$result = DB::table('hrooms') 						
			->select('hrooms.*', DB::raw('(select hotels.name from hotels where hrooms.hotel_id = hotels.id) as hotel_name'))
			->where('hrooms.hotel_id', $id)
			->get();

		return $result;
	}

	public function getcomment($id)
	{
		$result = DB::table('comments') 			
			->leftjoin('consumers', 'comments.consumer_id', '=', 'consumers.id')
			->select('comments.*', 'consumers.name as consumer_name', 'consumers.pic as consumer_pic', 'consumers.uid as consumer_uid')
			->where('comments.hotel_id', $id)
			->get();

		return $result;
	}

	public function getconsumer($uid)
	{
		$result = DB::table('consumers') 			
			->select('consumers.*')
			->where('consumers.uid', $uid)
			->get();

		return $result;
	}

	public function getcom_id()
	{
		$result = DB::table('consumers') 			
			->select('consumers.id')
			->orderBy('created_at', 'desc')
			->first();

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


	public function login()
    {		
		session()->put('uid','uid');
		session()->put('pwd','pwd');
	
		return view('main.index');
    }

	public function logout()
    {			
		session()->forget('uid');
		session()->forget('pwd');
		
		return view('main.index');
    }

	public function order(Request $request)
    {			
		$request->validate([
        'check_in'	=> 'required',
        'check_out'	=> 'required',
        'adult'		=> 'required|integer|gt:0',
		'roomtype'		=> 'required'
		],
		[
        'check_in.required'	 => '체크인은 필수입력입니다.',
        'check_out.required' => '체크아웃은 필수입력입니다.',
        'adult.required'	 => '인원수는 필수입력입니다.',
		'roomtype.required'	 => '객실은 필수입력입니다.',
		'adult.gt'			 => '인원수는 1이상입니다.'
		]);

		$check_in	= $request->get('check_in');
		$check_out	= $request->get('check_out');
		$adult		= $request->get('adult');
		$child		= $request->get('child');
		$roomtype	= $request->get('roomtype');
		$price		= $request->get('price');
		$realprice	= $request->get('realprice');
		
		$consumer_id = session()->get('consumer')->id;

		$data['check_in']	= $check_in;
		$data['check_out']	= $check_out;
		$data['adult']		= $adult;
		$data['child']		= $child;
		$data['room']		= $this->getr_t($roomtype);
		$data['price']		= $price;
		$data['realprice']	= $realprice;
		$data['consumer_id']= $consumer_id;

		return view('hotel.order',$data);
    }

	public function reservation(Request $request)
    {		
		$morning	= $request->get('morning');
		$check_in	= $request->get('check_in');
		$check_out	= $request->get('check_out');
		$adult		= $request->get('adult');
		$child		= $request->get('child');
		$roomtype	= $request->get('roomtype');
		$realprice	= $request->get('realprice');
		$hotel_name	= $request->get('hotel_name');
		$addmorning	= $request->get('addmorning');
		$bedsize	= $request->get('bedsize');
		$addwifi	= $request->get('addwifi');
		$consumer_id= $request->get('consumer_id');
		$hotel_id	= $request->get('hotel_id');
		
		if(!$addmorning)
			$addmorning ='off';

		if(!$bedsize)
			$bedsize ='off';

		if(!$addwifi)
			$addwifi ='off';

		$row = new Hreservation([
			'check_in'	=> $request->get('check_in'),
			'check_out'	=> $request->get('check_out'),
			'adult'		=> $request->get('adult'),
			'child'		=> $request->get('child'),
			'price'		=> $request->get('realprice'),
			'hotel_id'=> $request->get('hotel_id'),
			'breakfast'	=> $addmorning,
			'bedsize'	=> $bedsize,
			'wifiegg'	=> $addwifi,
			'consumer_id'=> $request->get('consumer_id'),
			'hroom_id'  => $roomtype,
			'morning'	=> $request->get('morning')
		]);
		$row->save();

		if(!session()->get('h_id')){
			$data['room'] = $this->getroom($hotel_id);
			$data['list'] = $this->getdetail($hotel_id);			
			$data['com'] = $this->getcomment($hotel_id);
			if(session()->get('consumer'))
				$data['consumer'] = $this->getconsumer(session()->get('consumer')->uid);
			$data['com_id'] = Comment::orderBy('created_at', 'DESC')->first();
			$data['total'] = Comment::where('hotel_id', $hotel_id)->count();
		}
		else {
			$data['list'] = $this->getdetail(session()->get('h_id'));
			$data['room'] = $this->getroom(session()->get('h_id'));
			$data['com'] = $this->getcomment(session()->get('h_id'));
			if(session()->get('consumer'))
				$data['consumer'] = $this->getconsumer(session()->get('consumer')->uid);
			$data['com_id'] = Comment::orderBy('created_at', 'DESC')->first();
			$data['total'] = Comment::where('hotel_id', session()->get('h_id'))->count();
			session()->forget('h_id');
		}

		return redirect()->action([HotelController::class, 'show'],['hotel' => $request->get('hotel_id')]);
		//return view('hotel.detail', $data);
    }

	/*ㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡ*/
	public function getr_t($id)
	{
		$result = DB::table('hrooms') 						
			->select('hrooms.*')
			->where('hrooms.id', $id)
			->get();

		return $result;
	}
	/*ㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡ*/
}
