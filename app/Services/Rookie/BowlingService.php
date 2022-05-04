<?php

namespace App\Services\Rookie;

class BowlingService
{
    public function getBowlingList(array $_aInput)
    {
        $aResult = [];
        foreach ($_aInput as $key => $aInput) {
            $aScore[$key] = $aInput[0] + $aInput[1];

            if ($key == 0) {
                if ($aInput[0] == 10) {
                    if ($_aInput[$key+1][0] == 10) {
                        $aResult[$key] = $aScore[$key] + $_aInput[$key+1][0]+$_aInput[$key+2][0];
                    } else {
                        $aResult[$key] = $aScore[$key] + $_aInput[$key+1][0]+$_aInput[$key+1][1];
                    }
                } elseif ($aScore[$key] == 10) {
                    $aResult[$key] = $aScore[$key] + $_aInput[$key+1][0];
                } else {
                    $aResult[$key] = $aScore[$key];
                }
            } elseif ($key == 9) {
                if ($aInput[0] == 10 || $aScore[$key] == 10) {
                    $aResult[$key] = $aResult[$key-1] + $aScore[$key] + $_aInput[$key][2];
                } elseif ($aScore[$key] == 10) {
                    $aResult[$key] = $aResult[$key-1] + $aScore[$key] + $_aInput[$key][2];
                } else {
                    $aResult[$key] = $aResult[$key-1] + $aScore[$key]; 
                }
            } else {
                if ($aInput[0] == 10) {
                    if ($_aInput[$key+1][0] == 10) {
                        $aResult[$key] = $aResult[$key-1] + $aScore[$key] + $_aInput[$key+1][0]+$_aInput[$key+2][0];
                    } else {
                        $aResult[$key] = $aResult[$key-1] + $aScore[$key] + $_aInput[$key+1][0]+$_aInput[$key+1][1];
                    }
                } elseif ($aScore[$key] == 10) {
                    $aResult[$key] = $aResult[$key-1] + $aScore[$key] + $_aInput[$key+1][0];
                } else {
                    $aResult[$key] = $aResult[$key-1] + $aScore[$key]; 
                }
            }

        }
        return $aResult;
    }
    
    
}
