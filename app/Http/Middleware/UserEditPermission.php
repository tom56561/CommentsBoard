<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\User\UserService;

class UserEditPermission
{
    private $oUserService;

    public function __construct(UserService $_oUserService)
    {
        $this->oUserService = $_oUserService;
    }

    public function handle(Request $_oRequest, Closure $next)
    {
        $iPostId = $_oRequest->id;
        $sUserId = \Auth::user()->id;
        $bUserEditPermission = $this->oUserService->checkUserEditPermission($iPostId, $sUserId);
        $sUserRole = \Auth::user()->role;
        $bIsAdmin = $this->oUserService->checkAdmin($sUserRole);
        if ($bUserEditPermission or $bIsAdmin) {
            return $next($_oRequest);
        }
            return response()->json(['UserRole_Error' => 'You are not the Author of the post'], 401);
    }
}
