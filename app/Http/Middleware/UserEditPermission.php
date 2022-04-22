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
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $_oRequest, Closure $next)
    {
        $iPostId = $_oRequest->id;
        $sUserId = \Auth::user()->id;
        $bUserEditPermission = $this->oUserService->checkUserEditPermission($iPostId, $sUserId);
        if($bUserEditPermission){
            return $next($_oRequest);
        }
            return response()->json(['UserRole_Error'=>'You are not the Author of the post'], 401);
    }
}
