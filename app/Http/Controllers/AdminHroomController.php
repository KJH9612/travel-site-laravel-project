<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;	//DB Lib 사용
use App\Models\Hroom;
use App\Models\Hotel;

class AdminHroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['list'] = $this->getlist();
		return view('admin.hotel.a_hroom.index', $data);
    }
	
	public function getlist()
	{
		//$query = 'select hotels.*, cities.name as city_name, countries.name as country_name from hotels left join cities on hotels.city_id = cities.id left join countries on cities.country_id = countries.id;';
		//$result = DB::select($query);
		//Query Builder
		//$result = DB::table('products') ->orderby('name', 'asc') ->get();
		//Eloquent ORM
		$result = DB::table('hrooms') 			
			->leftjoin('hotels', 'hotels.id', '=', 'hrooms.hotel_id')
			->select('hrooms.*', 'hotels.name as hotel_name')	
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
        $data['list'] = Hotel::get();
		
		return view('admin.hotel.a_hroom.create', $data);
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
        'hotel_id'	=> 'required',
        'type'		=> 'required',
		'bed'		=> 'required',
		'bathroom'	=> 'required',
		'price'		=> 'required',
		'size'		=> 'required',
		'pic'		=> 'required'
		],
		[
        'hotel_id.required' => '호텔명은 필수입력입니다.',
        'type.required'		=> '방 종류는 필수입력입니다.',
        'bed.required'		=> '침대 수는 필수입력입니다.',
        'bathroom.required'	=> '화장실 수는 필수입력입니다.',
        'price.required'	=> '가격은 필수입력입니다.',
        'size.required'		=> '평수는 필수입력입니다.',
		'pic.required'		=> '사진은 필수입력입니다.',
		]);
		
		$row = new Hroom([
			'hotel_id'	=> $request->input('hotel_id'),
			'type'		=> $request->input('type'),
			'bed'		=> $request->input('bed'),
			'bathroom'	=> $request->input('bathroom'),
			'price'		=> $request->input('price'),
			'size'		=> $request->input('size')
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

		return redirect('a_hroom');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['row'] = $this->gethroom($id);
		return view('admin.hotel.a_hroom.show', $data);
    }

	public function gethroom($id)
	{
		//$query = 'select hotels.*, cities.name as city_name, countries.name as country_name from hotels left join cities on hotels.city_id = cities.id left join countries on cities.country_id = countries.id;';
		//$result = DB::select($query);
		//Query Builder
		//$result = DB::table('products') ->orderby('name', 'asc') ->get();
		//Eloquent ORM
		$result = DB::table('hrooms') 			
			->leftjoin('hotels', 'hotels.id', '=', 'hrooms.hotel_id')
			->select('hrooms.*', 'hotels.name as hotel_name')	
			->where('hrooms.id', '=', $id)
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
        $data['row'] = Hroom::find($id);
		$data['list'] = Hotel::get();
		
		return view('admin.hotel.a_hroom.edit', $data);
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
        'hotel_id'	=> 'required',
        'type'		=> 'required',
		'bed'		=> 'required',
		'bathroom'	=> 'required',
		'price'		=> 'required',
		'size'		=> 'required'        
		],
		[
        'hotel_id.required' => '호텔명은 필수입력입니다.',
        'type.required'		=> '방 종류는 필수입력입니다.',
        'bed.required'		=> '침대 수는 필수입력입니다.',
        'bathroom.required'	=> '화장실 수는 필수입력입니다.',
        'price.required'	=> '가격은 필수입력입니다.',
        'size.required'		=> '평수는 필수입력입니다.'
		]);
		
		$row = Hroom::find($id);

		$row->hotel_id	= $request->input('hotel_id');
		$row->bed		= $request->input('bed');
		$row->bathroom	= $request->input('bathroom');
		$row->price		= $request->input('price');		
		$row->type		= $request->input('type');
		$row->size		= $request->input('size');

		if ($request->hasFile('pic'))               // 업로드할 파일 선택한 경우
		{
			$pic = $request->file('pic');
			$picname = $pic->getClientOriginalName();         // file name
			$picsize    = $pic->getSize();                    // file size
			$pic->storeAs('public/hotel_img', $picname);      // 저장(폴더 자동생성)

			$row->pic = $picname;
		}
		
		$row->save();

		return redirect('a_hroom');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Hroom::find($id);
		$row->delete();

		return redirect('a_hroom');
    }
}
