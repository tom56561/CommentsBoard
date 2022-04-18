<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DashBoard\DashBoardService;

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
        $aData = $this->oDashBoardService->getPostListByDesc();

        $aResult = [
            'result' => true,
            'data'   => $aData,
        ];

        return view('posts.comment')->with('comments',$aResult);

        // return response()->json($aResult);

        // $comments = Post::orderBy('id','DESC')->get();
        // return view('posts.comment',compact('comments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $_oRequest)
    {
        $iUserId = \Auth::id();
        $sContent = $_oRequest->content;
        $aData = $this->oDashBoardService->addNewPost($iUserId, $sContent);
        $aResult = [
            'result'     => true,
            'data'       => $aData,
        ];

        return response()->json($aResult);
        // $post = new Post;
        // $post->content = $_oRequest->content;
        // $post->user_id = \Auth::id();
        // $post->save();

        // dd($_oRequest->all());
        
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
        return 'show';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $_oRequest, $_iId)
    {

        $sContent = $_oRequest->content;
        $aData = $this->oDashBoardService->editPost($_iId, $sContent);
        $aResult = [
            'result'     => true,
            'data'       => $aData,
        ];

        return response()->json($aResult);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($_iId)
    {
        $bStatus = $this->oDashBoardService->deletePost($_iId);
        return response()->json($bStatus);
    }
}
