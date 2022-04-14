<?php

namespace App\Services\Rookie;

use App\Repositories\Rookie\GameCodeRepository;

class GameCodeService
{
    private $oGameCodeRepo;

    public function __construct(GameCodeRepository $_oGameCodeRepo)
    {
        $this->oGameCodeRepo = $_oGameCodeRepo;
    }

    public function getGameCodeList()
    {
        $aData   = $this->oGameCodeRepo->getGameCodeList();
        $aResult = [];
        foreach ($aData as $aGameCode) {
            $aResult[$aGameCode['GameType']][$aGameCode['GameCode']] = $aGameCode['GameCodeName'];
        }
        return $aResult;
    }

    public function getGameCodeListByCondition($_iGameType)
    {
        $aData   = $this->oGameCodeRepo->getGameCodeListByCondition($_iGameType);
        $aResult = [];
        foreach ($aData as $aGameCode) {
            $aResult[$aGameCode['GameType']][$aGameCode['GameCode']] = $aGameCode['GameCodeName'];
        }
        return $aResult;
    }

    public function getTest()
    {
        echo 123;
    }

    public function getGameTypeList()
    {
        return [3001, 3025, 3026, 3029];
    }
}
