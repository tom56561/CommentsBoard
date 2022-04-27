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

    public function getPostListByDesc(): array
    {
        $aData = $this->oPostRepo->getPostListByDesc();
        foreach ($aData as $ikey => $aTime) {
            $aData[$ikey]['created_at'] = date('Y-m-d H:i:s', strtotime($aTime['created_at']));
        }
        return $aData;
    }

    public function addNewPost(int $_iUserId, string $_sContent, string $_sUserName): array
    {
        $aData = $this->oPostRepo->addNewPost($_iUserId, $_sContent);
        $aData['created_at'] = date('Y-m-d H:i:s', strtotime($aData['created_at']));
        $aData += ['name' => $_sUserName];
        return $aData;
    }

    public function editPost(int $_iId, string $_sContent): array
    {
        $bUpadte = $this->oPostRepo->editPost($_iId, $_sContent);
        if ($bUpadte) {
            return $this->oPostRepo->getPostListByCondition($_iId);
        }
            return false;
    }

    public function deletePost($_iId): bool
    {
        return $this->oPostRepo->deletePost($_iId);
    }
}
