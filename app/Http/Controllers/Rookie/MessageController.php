<?php

namespace App\Http\Controllers\Rookie;

use App\Http\Controllers\Controller;
use App\Services\Rookie\MessageService;
use App\Services\Rookie\GameCodeService;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    private $oMessageService;
    private $oGameCodeService;

    public function __construct(MessageService $_oMessageService, GameCodeService $_oGameCodeService)
    {
        $this->oMessageService = $_oMessageService;
        $this->oGameCodeService = $_oGameCodeService;
    }

    public function getMessage()
    {
        return "getMessage";
    }

    public function getGameCodeList()
    {
        $aData = $this->oGameCodeService->getGameCodeList();

        $aResult = [
            'result'     => true,
            'data'       => $aData,
        ];

        return response()->json($aResult);
    }

    public function getGameCodeByGameType(Request $_oRequest)
    {
        $iGameType = $_oRequest->gametype;
        $aData = $this->oGameCodeService->getGameCodeListByCondition($iGameType);

        $aResult = [
            'result'     => true,
            'data'       => [
                'gametype' => $iGameType,
                'list' => $aData,
            ],
        ];

        return response()->json($aResult);
    }
}