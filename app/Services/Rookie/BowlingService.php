<?php

namespace App\Services\Rookie;

class BowlingService
{
    public function getBowlingList(array $_aInput)
    {
        $aResult = [];
        foreach ($_aInput as $key => $aInput) {
            $iScore = $aInput[0] + $aInput[1];

            if ($key == 0) {
                if ($aInput[0] == 10) {
                    if ($_aInput[$key+1][0] == 10) {
                        $iScore = $iScore + $_aInput[$key+1][0]+$_aInput[$key+2][0];
                    } else {
                        $iScore = $iScore + $_aInput[$key+1][0]+$_aInput[$key+1][1];
                    }
                } elseif ($iScore == 10) {
                    $iScore = $iScore + $_aInput[$key+1][0];
                } else {
                    $iScore = $iScore;
                }
            } elseif ($key == 9) {
                if ($aInput[0] == 10 || $iScore == 10) {
                    $iScore = $iScore + $_aInput[$key][2];
                } elseif ($iScore == 10) {
                    $iScore = $iScore + $_aInput[$key][2];
                } else {
                    $iScore = $iScore; 
                }
            } else {
                if ($aInput[0] == 10) {
                    if ($_aInput[$key+1][0] == 10) {
                        $iScore = $iScore + $_aInput[$key+1][0]+$_aInput[$key+2][0];
                    } else {
                        $iScore = $iScore + $_aInput[$key+1][0]+$_aInput[$key+1][1];
                    }
                } elseif ($iScore == 10) {
                    $iScore = $iScore + $_aInput[$key+1][0];
                } else {
                    $iScore = $iScore; 
                }
            }

            if ($key == 0) {
                $aResult[$key] = $iScore;
            } else {
                $aResult[$key] = $aResult[$key-1] + $iScore;
            }

        }
        return $aResult;
    }
    
    
}
