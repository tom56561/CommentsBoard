<?php

namespace App\Services\Rookie;

class BowlingService
{
    public function getBowlingList(array $_aInput)
    {
        $aResult = [];
        foreach ($_aInput as $key => $aInput) {
            $aScore[$key] = $aInput[0] + $aInput[1];

            if (count($aScore) == 1) {          //判斷是否為第一局
                if ($aScore[$key] == 10) {      //判斷是否為spare
                    $aResult[$key] = $aScore[$key] + $_aInput[$key+1][0];
                }else{                          
                    $aResult[$key] = $aScore[$key];
                }
            }
            if (count($aScore) > 1) {
                if ($aScore[$key] == 10) {      //判斷是否為spare
                    $aResult[$key] = $aResult[$key-1] + $aScore[$key] + $_aInput[$key+1][0];
                }else{
                $aResult[$key] = $aResult[$key-1] + $aScore[$key]; 
                }        
            }
        }
        return $aResult;

    }

}
