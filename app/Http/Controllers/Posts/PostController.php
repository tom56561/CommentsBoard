<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Services\DashBoard\DashBoardService;
use Illuminate\Http\Request;
use App\Models\Post;


class PostController extends Controller
{
    private $oDashBoardService;

    public function __construct(DashBoardService $_oDashBoardService)
    {
        $this->oDashBoardService = $_oDashBoardService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aData = $this->oDashBoardService->getPostList();

        $aResult = [
            'result' => true,
            'data'   => $aData,
        ];

        return response()->json($aResult);

        // $comments = Post::orderBy('id','DESC')->get();
        // return view('posts.comment',compact('comments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post;
        $post->title = 'test';
        $post->content = request('content');
        $post->user_id = \Auth::id();
        $post->save();

        // dd($request->all());
        
        return response()->json($post);
        // return redirect()->to('/posts');
 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comments = Post::orderBy('id','DESC')->get();
        return view('posts.show',compact('comments'));
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
        return 'update';
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
        return 'destroy';
    }
}
