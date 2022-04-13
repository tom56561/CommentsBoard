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

    public function getPostList()
    {
        $aData = $this->oPostRepo->getPostList();
        foreach($aData as $Post){
            $aData[$Post['id']] = [$Post['content']];
        }
        return $aData;
    }

}