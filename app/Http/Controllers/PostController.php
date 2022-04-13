<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //顯示Post列表
        return 13;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //建立Post網頁表單
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //將表單內容儲存進資料庫的邏輯
        
        //驗證是否資料正確才可以進行修改
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        //將所有請求輸出  dd()：輸出
        //dd($request->all());
        $post = new Post;
        $post->title = request('title');
        $post->content = request('content');
        $post->user_id = \Auth::id(); 
        $post->save();
        return redirect()->to('/');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //顯示單筆資料的頁面
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //編輯資料的網頁表單
        // return view('post.edit')->with('post',$post); 相同功能
        return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //將網頁表單資料更新到資料庫地邏輯

        //驗證是否資料正確才可以進行修改
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        
        $post->title = request('title');
        $post->content = request('content');
        $post->user_id = \Auth::id(); 
        $post->save();
        return redirect()->route('posts.edit', [$post->id])->with('success',true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //移除這筆資料的邏輯

        $post->delete();
        return redirect()->to('/');
    }
}
