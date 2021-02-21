<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\PackageReservation;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Exists;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["list"] = $this->getList();
        return view('blog.index', $data);
    }

    private function getList(){
        return Blog::orderby('id', 'desc')->get();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(!session()->exists('consumer') || $request->exists('packId') == null)
            return redirect('blog');
        ## 패키지 여행 상품 데이터
        $hReserData = PackageReservation::find($request->query('packId'));
        return view('blog.create', compact('hReserData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $consumer = session()->get('consumer')->id;

        if(!$consumer) echo false;

        if($request->hasFile('upload')){
            $originName = $request->file('upload')->getClientOriginalName();
            $filename = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $filename = $filename . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path("/images/user_img/$consumer/"), $filename);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset("/images/user_img/$consumer/$filename");
            $msg = "업로드 성공";
            $response = "<script type='text/javascript'> window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
        echo false;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ## 세션에 있는 고객의 id 가져옴
        $consumer = session()->get('consumer')->id;
        if(!$consumer) echo false;
        ##해쉬값을 이용해 파일 충돌 해결
        $fFilename = hash('sha256', idate('B') + $consumer);
        ##Blog 객체 생성
        $blog = new Blog();
        ##썸네일 이미지 저장하는 부분
        if($request->hasFile('thumbnail')){
            $originName = $request->file('thumbnail')->getClientOriginalName();
            $filename = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('thumbnail')->getClientOriginalExtension();
            $filename = $filename . '_' . time() . '.' . $extension;
            $request->file('thumbnail')->move(public_path("/images/thumbnail/$consumer/"), $filename);
            ## 썸네일 이미지 파일명 저장
            $blog->thumb = $consumer . "/" .$filename;
        }

        $blog->title = $request->Input('title');
        //$content = htmlspecialchars($request->Input('content'), ENT_QUOTES, 'UTF-8');
        $content = $request->Input('content');

        ## 컨텐츠 디렉토리 파일 열기
        $write_files = fopen("body_data/$fFilename"."_"."$blog->title.txt", "w+");
        ## 파일 쓰기
        fwrite($write_files, $content);
        ## Blog Class 객체 값 채우기 ##
        ## 고객 고유 넘버
        $blog->user_id = $consumer;
        ## 고객의 데이터 파일
        $blog->filename = "body_data/$fFilename"."_"."$blog->title.txt";
        ## 패키지 여행 상품 아이디 값
        $pid = $request->Input('pId');
        $blog->pack_id = $pid;
        ## 저장
        $blog->save();


        ## 리뷰 저장
        $hre = PackageReservation::find($blog->pack_id);
        $hre->review = 1;
        $hre->save();

        return redirect('blog');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        ## 이전 페이지가 consumer_reservation일때

        if(strpos(url()->previous(), "consumer_reservation") !== false){
            $matchThese = ['user_id' => session()->get('consumer')->id, 'pack_id' => $id];
            $row = Blog::where($matchThese)->first();
        }
        else ##일반 블로그를 통해 들어왔을 경우
            $row = Blog::find($id);
        $read_file = fopen($row->filename, "r");
        $content = fread($read_file, filesize($row->filename));

        return view('blog.show', compact('row', 'content'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Blog::find($id);
        $read_file = fopen($row->filename, "r");
        $content = fread($read_file, filesize($row->filename));
        return view('blog.edit', compact('row', 'content'));
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
        $blog = Blog::find($id);
        #이미지
        if($request->hasFile('thumbnail')){
            $originName = $request->file('thumbnail')->getClientOriginalName();
            $filename = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('thumbnail')->getClientOriginalExtension();
            $filename = $filename . '_' . time() . '.' . $extension;
            ##썸네일 저장
            $request->file('thumbnail')->move(public_path("/images/thumbnail/$id/"), $filename);
            $blog->thumb = $id . '/' .$filename;
        }
        #타이틀 저장
        $blog->title = $request->Input('title');
        #하위 내용 저장
        $content = $request->Input('content');
        $write_files = fopen($blog->filename, "w+");
        fwrite($write_files, $content);

        #블로그 저장
        $blog->save();
        //return view('blog.create');
        return redirect('blog');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
