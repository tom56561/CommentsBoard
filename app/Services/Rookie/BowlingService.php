<?php

namespace App\Services\Rookie;

class BowlingService
{
    public function getBowlingList(array $_aInput)
    {
        $aResult = [];
        foreach ($_aInput as $key => $aInput) {
            $aScore[] = $aInput[0] + $aInput[1];

            if(count($aScore) == 1){
                $aResult[0] = $aScore[0];
            }
            if(count($aScore) > 1){
                $aResult[$key] = $aResult[$key-1] + $aScore[$key];
            }
        }
        return $aResult;

    }

}
