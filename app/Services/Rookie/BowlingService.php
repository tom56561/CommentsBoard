<?php

namespace App\Services\Rookie;

class BowlingService
{
    public function getBowlingList(array $_aInput)
    {
        $aResult = [];
        foreach ($_aInput as $aInput) {
            $aScore[] = $aInput[0] + $aInput[1];
        }

        $aResult[0] = $aScore[0];
        if (count($aScore) > 1) {
            $aResult[1] = $aScore[0] + $aScore[1];
        }
        return $aResult;

    }

}
