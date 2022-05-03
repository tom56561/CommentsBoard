<?php

namespace Tests\Unit\Service;

use App;
use App\Repositories\Rookie\GameCodeRepository;
use App\Services\Rookie\BowlingService;
use Mockery;
use PHPUnit\Framework\TestCase;

class BowlingServiceTest extends TestCase
{
    public function testFirstRound()
    {
        # Arrange
        $aExpected = [
            7,
        ];
        $aInput = [
            [3, 4],
        ];

        # Acr
        $aActual = App::make(BowlingService::class)->getBowlingList($aInput);
        # Asset
        $this->assertEquals($aExpected, $aActual);
    }

    public function testSecondRound()
    {
        # Arrange
        $aExpected = [
            7, 15
        ];
        $aInput = [
            [3, 4],
            [6, 2],
        ];

        # Acr
        $aActual = App::make(BowlingService::class)->getBowlingList($aInput);
        # Asset
        $this->assertEquals($aExpected, $aActual);
    }

    public function testThirdRound()
    {
        # Arrange
        $aExpected = [
            7, 15, 19
        ];
        $aInput = [
            [3, 4],
            [6, 2],
            [3, 1],
        ];

        # Acr
        $aActual = App::make(BowlingService::class)->getBowlingList($aInput);
        # Asset
        $this->assertEquals($aExpected, $aActual);
    }

    public function testZeroScore()
    {
        # Arrange
        $aExpected = [
            0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
        ];
        $aInput = [
            [0, 0],
            [0, 0],
            [0, 0],
            [0, 0],
            [0, 0],
            [0, 0],
            [0, 0],
            [0, 0],
            [0, 0],
            [0, 0],
        ];

        # Acr
        $aActual = App::make(BowlingService::class)->getBowlingList($aInput);
        # Asset
        $this->assertEquals($aExpected, $aActual);
    }

    public function testSpare()
    {
        # Arrange
        $aExpected = [
            16, 24, 37, 40
        ];
        $aInput = [
            [5, 5],
            [6, 2],
            [8, 2],
            [3, 0],
        ];

        # Acr
        $aActual = App::make(BowlingService::class)->getBowlingList($aInput);
        # Asset
        $this->assertEquals($aExpected, $aActual);
    }

}

