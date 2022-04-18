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
}
