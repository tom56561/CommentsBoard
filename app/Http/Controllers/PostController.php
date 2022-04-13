<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

//  resorece 控制器    曾山修茶   ＣＵＲＤ 


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
        return 'Post@Jarek  index' ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //建立ＰＯＳＴ網頁表單
        return view('post.create') ;  
        //  回傳resource / view / post 下的create 
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  網頁表單內容儲存到資料庫的邏輯
        // dd($request->all()) ;    確認收到的ＦＯＲｍ  ＣＲＥＡＴＥ 值

        $request->validate([
            'title' => 'required' ,
            'content' => 'required' ,
        ]);

        $post = new Post ;
        $post->title = request('title') ;
        $post->content = request('content') ;
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
        // 顯示單筆資料頁面
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // 用於編輯資料的網頁表單   
        return view('post.edit', compact('post')) ;


        //  回傳resource / view / post 下的edit

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
        //  網頁表單資料 更新到資料庫邏輯
        

        //  驗證欄位是否為空值
        $request->validate([
            'title' => 'required' ,
            'content' => 'required' ,
        ]);

        $post->title = request('title') ;
        $post->content = request('content') ;
        $post->user_id = \Auth::id();
        $post->save();
        
        return redirect()->route('posts.edit', [$post->id])->with('success', true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // 移除這筆資料邏輯
        $post->delete();
        return redirect()->to('/') ;
    }
}
