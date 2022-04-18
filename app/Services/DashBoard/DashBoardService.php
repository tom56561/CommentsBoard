<?php

namespace App\Services\DashBoard;
use App\Repositories\Posts\PostRepository;


//  留言板相關邏輯
class DashBoardService
{
    private $oPostRepo;

    public function __construct(PostRepository $_oPostRepo)
    {
        $this->oPostRepo = $_oPostRepo;
    }

    public function getPostListByDesc() :array
    {
        return $this->oPostRepo->getPostListByDesc();

    }

    public function addNewPost(int $_iUserId, string $_sContent) :array
    {
        return $this->oPostRepo->addNewPost($_iUserId, $_sContent);
    }

    public function editPost(int $_iId, string $_sContent) :array
    {
        
        $bData = $this->oPostRepo->editPost($_iId, $_sContent);
        if($bData){
            return $this->oPostRepo->getPostListByCondition($_iId);
        }
            return false;

    }

    public function deletePost($_iId) :bool
    {
        return $this->oPostRepo->deletePost($_iId);
    }

}