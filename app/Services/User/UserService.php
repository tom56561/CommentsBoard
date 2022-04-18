<?php

namespace App\Services\User;
use App\Repositories\Posts\PostRepository;
use App\Repositories\Posts\UserRepository;


//  會員相關邏輯
class UserService
{
    private $oPostRepo;
    private $oUserRepo;

    public function __construct(PostRepository $_oPostRepo, UserRepository $_oUserRepo)
    {
        $this->oPostRepo = $_oPostRepo;
        $this->oUserRepo = $_oUserRepo;
    }

    public function checkAdmin(string $_sUserRole) :bool
    {
        if($_sUserRole == 'admin'){
            return true;
        }
            return false;
    }

    public function checkUserEditPermission(int $_iPostId, string $_sUserId) :bool
    {
     $aPost = $this->oPostRepo->getPostListByCondition($_iPostId); 
        if($aPost['user_id'] == $_sUserId){
            return true;
        }
            return false;
    }

    public function getUserList() :array
    {
        return $this->oUserRepo->getUserList();
    }
}
