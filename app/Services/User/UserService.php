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

    public function editUser(int $_iId, string $_sName, string $_sEmail, string $_sRole) :array
    {
        
        $bUpadte = $this->oUserRepo->editUser($_iId, $_sName, $_sEmail, $_sRole);
        if($bUpadte){
            return $this->oUserRepo->getUserListByCondition($_iId);
        }
            return false;

    }
    public function deleteUser($_iId) :bool
    {
        return $this->oUserRepo->deleteUser($_iId);
    }

}
