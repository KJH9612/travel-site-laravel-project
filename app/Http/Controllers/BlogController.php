<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

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
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $imageBaseUrl = "/images/test/";

        if($request->hasFile('upload')){
            $originName = $request->file('upload')->getClientOriginalName();
            $filename = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $filename = $filename . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('images/test'), $filename);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('/images/test/'.$filename);
            $msg = "Image uploaded successfully";
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
        $blog = new Blog();
        if($request->hasFile('thumbnail')){
            $originName = $request->file('thumbnail')->getClientOriginalName();
            $filename = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('thumbnail')->getClientOriginalExtension();
            $filename = $filename . '_' . time() . '.' . $extension;
            $request->file('thumbnail')->move(public_path('images/test'), $filename);
        }
        $blog->title = $request->Input('title');
        //$content = htmlspecialchars($request->Input('content'), ENT_QUOTES, 'UTF-8');
        $content = $request->Input('content');
        $write_files = fopen("body_data/".$blog->title.".txt", "w+");
        fwrite($write_files, $content);
        $blog->user_id = 1;
        $blog->save();
        //return view('blog.create');
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
        $row = Blog::find($id);
        $file_name = "body_data/".$row->title.".txt";
        $read_file = fopen($file_name, "r");
        $content = fread($read_file, filesize($file_name));
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
        $file_name = "body_data/".$row->title.".txt";
        $read_file = fopen($file_name, "r");
        $content = fread($read_file, filesize($file_name));
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
        if($request->hasFile('thumbnail')){
            $originName = $request->file('thumbnail')->getClientOriginalName();
            $filename = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('thumbnail')->getClientOriginalExtension();
            $filename = $filename . '_' . time() . '.' . $extension;
            $request->file('thumbnail')->move(public_path('images/test'), $filename);
        }
        $blog->title = $request->Input('title');
        //$content = htmlspecialchars($request->Input('content'), ENT_QUOTES, 'UTF-8');
        $content = $request->Input('content');
        $write_files = fopen("body_data/".$blog->title.".txt", "w+");
        fwrite($write_files, $content);
        $blog->user_id = 1;
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
