<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\UserService;


class UserController extends Controller
{
    private $oUserService;

    public function __construct(UserService $_oUserService)
    {
        $this->oUserService = $_oUserService;
    }

    public function index()
    {
        $aUserList = $this->oUserService->getUserList();
        $aResult = [
            'result' => true,
            'data'   => $aUserList,
        ];

        // return $aUserList;
        return view('users.userList')->with('userList',$aResult);
    }

    public function update(Request $_oRequest, $_iId)
    {

        $sName = $_oRequest->name;
        $sEmail = $_oRequest->email;
        $sRole = $_oRequest->role;

        $aData = $this->oUserService->editUser($_iId, $sName, $sEmail, $sRole);
        $aResult = [
            'result'     => true,
            'data'       => $aData,
        ];

        return response()->json($aResult);
    }

    public function destroy($_iId)
    {
        $bStatus = $this->oUserService->deleteUser($_iId);
        return response()->json($bStatus);
    }

    public function search(Request $_oRequest)
    {
    
        $sName = $_oRequest->name;
        $sEmail = $_oRequest->email;
        $sRole = $_oRequest->role;
        $aDatefilter = explode(" to ",$_oRequest->datefilter);
        $aData = $this->oUserService->searchUser($sName, $sEmail, $sRole, $aDatefilter);
        $aResult = [
            'result'     => true,
            'data'       => $aData,
        ];
        return view('users.userList')->with('userList',$aResult);
    }

}
