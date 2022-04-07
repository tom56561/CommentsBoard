<?php

namespace App\Repositories\Rookie;

use App\Models\Rookie\GameCode;

class GameCodeRepository
{
    private $oGameCode;

    public function __construct(GameCode $_oGameCode)
    {
        $this->oGameCode = $_oGameCode;
    }

    public function getGameCodeList()
    {
        return $this->oGameCode
            ->get()
            ->toArray();
    }

    public function getGameCodeListByCondition(int $_iGameType)
    {
        return $this->oGameCode
            ->where(['GameType' => $_iGameType])
            ->get()
            ->toArray();
    }
}
