<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DashBoard\DashBoardService;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
    private $oDashBoardService;

    public function __construct(DashBoardService $_oDashBoardService)
    {
        $this->oDashBoardService = $_oDashBoardService;
    }

    public function index()
    {
        $aData = $this->oDashBoardService->getPostListByDesc();

        $aResult = [
            'result' => true,
            'data'   => $aData,
        ];

        return view('posts.comment')->with('comments',$aResult);
    }

    public function store(Request $_oRequest)
    {
        $_oRequest->validate([
            'content' => 'required',
        ]);
        
        $iUserId = \Auth::id();
        $sUserName =\Auth::user()->name;
        $sContent = $_oRequest->content;
        $aData = $this->oDashBoardService->addNewPost($iUserId, $sContent, $sUserName);
        $aResult = [
            'result'     => true,
            'data'       => $aData,
        ];

        return response()->json($aResult);
 
    }


    public function show($id)
    {
        return 'show';
    }


    public function update(Request $_oRequest, $_iId)
    {
        $_oRequest->validate([
            'content' => 'required',
        ]);
        $sContent = $_oRequest->content;
        $aData = $this->oDashBoardService->editPost($_iId, $sContent);
        $aResult = [
            'result'     => true,
            'data'       => $aData,
        ];

        return response()->json($aResult);
    }

    public function destroy($_iId)
    {
        $bStatus = $this->oDashBoardService->deletePost($_iId);
        return response()->json($bStatus);
    }
}
