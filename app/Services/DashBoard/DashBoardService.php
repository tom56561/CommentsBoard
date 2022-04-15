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

    public function getPostListByDesc()
    {
        $aData = $this->oPostRepo->getPostListByDesc();
        // foreach($aData as $Post){
        //     $aData[$Post['user_id']][$Post['title']]=[$Post['content']];
        // }
        return $aData;
    }

    public function createNewData(array $data)
    {
        return $this->oPostRepo->createNewData($data);
    }

}