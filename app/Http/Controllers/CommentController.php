<?php

namespace App\Http\Controllers;

use App\Http\Controllers\HotelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;	//DB Lib 사용
use Response;
use App\Models\Comment;
use App\Models\Hotel;				//eloquent 사용할 때 필요
use App\Models\Hreservation;
use App\Models\Geographics;
use App\Models\Consumer;

class CommentController extends Controller
{
	 /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([		
			'id'			=> 'required',
            'consumer_id'	=> 'required',
            'hotel_id'		=> 'required',
            'comment'		=> 'required'
        ]);
        $todo = Comment::create($data);

        return Response::json($todo);
    }

	public function destroy($id)
    {		
		$row = Comment::find($id);
		$h_id = Comment::where('id', $id)->first();
		$hotel_id = $h_id->hotel_id;
		$row->delete();

		$data['list'] = $this->getdetail($hotel_id);
		$data['room'] = $this->getroom($hotel_id);
		$data['com'] = $this->getcomment($hotel_id);
		//return response($h_id);
		if(session()->get('consumer'))
			$data['consumer'] = $this->getconsumer(session()->get('consumer')->uid);
		$data['com_id'] = Comment::orderBy('created_at', 'DESC')->first();
		$data['total'] = Comment::where('hotel_id', $hotel_id)->count();

		
		return redirect()->action([HotelController::class, 'show'],['hotel' => $hotel_id]);		
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
			->select('comments.*', 'consumers.name as consumer_name', 'consumers.pic as consumer_pic')
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
}
