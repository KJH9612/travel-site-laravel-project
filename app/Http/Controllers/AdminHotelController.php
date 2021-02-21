<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;	//DB Lib 사용
use App\Models\Hotel;
use App\Models\Nation;
use App\Models\City;

class AdminHotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['list'] = $this->getlist();
		return view('admin.hotel.a_hotel.index', $data);
    }

	public function getlist()
	{
		//$query = 'select hotels.*, cities.name as city_name, countries.name as country_name from hotels left join cities on hotels.city_id = cities.id left join countries on cities.country_id = countries.id;';
		//$result = DB::select($query);
		//Query Builder
		//$result = DB::table('products') ->orderby('name', 'asc') ->get();
		//Eloquent ORM
		$result = DB::table('hotels') 			
			->leftjoin('cities', 'hotels.city_id', '=', 'cities.id')
			->leftjoin('nations', 'cities.nation_id', '=', 'nations.id')
			->select('hotels.*', 'cities.name as city_name', 'nations.name as nation_name')	
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
		$data['list1'] = Nation::get();
		$data['list2'] = City::get();
        return view('admin.hotel.a_hotel.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
        'name'			=> 'required|max:50',
        'nation_id'		=> 'required',
		'city_id'		=> 'required',
		'address'		=> 'required|max:64',
		'gm_address'	=> 'required|max:512',
		'explain'		=> 'required|max:512',
		'pic'			=> 'required',
        'star'			=> 'required'
		],
		[
        'name.required' 		=> '호텔명은 필수입력입니다.',
        'nation_id.required'	=> '국가는 필수입력입니다.',
        'city_id.required'		=> '도시는 필수입력입니다.',
        'address.required'		=> '상세주소는 필수입력입니다.',
        'gm_address.required'	=> '구글맵 주소는 필수입력입니다.',
        'explain.required'		=> '호텔 소개는 필수입력입니다.',
		'pic.required'			=> '호텔 사진은 필수입력입니다.',
        'star.required'			=> '성급은 필수입력입니다.',
		'name.max' 				=> '호텔명은 최대 50자입니다.',
		'address.max' 			=> '상세주소는 최대 64자입니다.',
		'gm_address.max' 		=> '구글맵 주소는 최대 512자입니다.',
		'explain.max' 			=> '호텔 소개는 최대 512자입니다.'
		]);
		
		$row = new Hotel([
			'name'			=> $request->input('name'),
			'nation_id'		=> $request->input('nation_id'),
			'city_id'		=> $request->input('city_id'),
			'address'		=> $request->input('address'),
			'gm_address'	=> $request->input('gm_address'),
			'explain'		=> $request->input('explain'),
			'star'			=> $request->input('star')
		]);

		if ($request->hasFile('pic'))               // 업로드할 파일 선택한 경우
		{
			$pic = $request->file('pic');
			$picname = $pic->getClientOriginalName();         // file name
			$picsize    = $pic->getSize();                    // file size
			$pic->storeAs('public/hotel_img', $picname);      // 저장(폴더 자동생성)

			$row->pic = $picname;
		}
		
		$row->save();

		return redirect('a_hotel');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['row'] = $this->gethotel($id);
		return view('admin.hotel.a_hotel.show', $data);
    }

	public function gethotel($id)
	{
		//$query = 'select hotels.*, cities.name as city_name, countries.name as country_name from hotels left join cities on hotels.city_id = cities.id left join countries on cities.country_id = countries.id;';
		//$result = DB::select($query);
		//Query Builder
		//$result = DB::table('products') ->orderby('name', 'asc') ->get();
		//Eloquent ORM
		$result = DB::table('hotels') 			
			->leftjoin('cities', 'hotels.city_id', '=', 'cities.id')
			->leftjoin('nations', 'cities.nation_id', '=', 'nations.id')
			->select('hotels.*', 'cities.name as city_name', 'nations.name as nation_name')	
			->where('hotels.id', '=', $id)
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
        $data['row'] = Hotel::find($id);
		$data['list1'] = Nation::get();
		$data['list2'] = City::get();
		
		return view('admin.hotel.a_hotel.edit', $data);
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
         $request->validate([
        'name'			=> 'required|max:50',
        'nation_id'		=> 'required',
		'city_id'		=> 'required',
		'address'		=> 'required|max:64',
		'gm_address'	=> 'required|max:512',
		'explain'		=> 'required|max:512',
        'star'			=> 'required'
		],
		[
        'name.required' 		=> '호텔명은 필수입력입니다.',
        'nation_id.required'	=> '국가는 필수입력입니다.',
        'city_id.required'		=> '도시는 필수입력입니다.',
        'address.required'		=> '상세주소는 필수입력입니다.',
        'gm_address.required'	=> '구글맵 주소는 필수입력입니다.',
        'explain.required'		=> '호텔 소개는 필수입력입니다.',
        'star.required'			=> '성급은 필수입력입니다.',
		'name.max' 				=> '호텔명은 최대 50자입니다.',
		'address.max' 			=> '상세주소는 최대 64자입니다.',
		'gm_address.max' 		=> '구글맵 주소는 최대 512자입니다.',
		'explain.max' 			=> '호텔 소개는 최대 512자입니다.'
		]);
		
		$row = Hotel::find($id);

		$row->name			= $request->input('name');
		$row->nation_id		= $request->input('nation_id');
		$row->city_id		= $request->input('city_id');
		$row->address		= $request->input('address');		
		$row->gm_address	= $request->input('gm_address');
		$row->explain		= $request->input('explain');
		$row->star			= $request->input('star');

		if ($request->hasFile('pic'))               // 업로드할 파일 선택한 경우
		{
			$pic = $request->file('pic');
			$picname = $pic->getClientOriginalName();         // file name
			$picsize    = $pic->getSize();                    // file size
			$pic->storeAs('public/hotel_img', $picname);      // 저장(폴더 자동생성)

			$row->pic = $picname;
		}
		
		$row->save();

		return redirect('a_hotel');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Hotel::find($id);
		$row->delete();
		
		return redirect('a_hotel');
    }
}
