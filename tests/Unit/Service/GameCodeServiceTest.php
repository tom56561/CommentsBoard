<?php

namespace Tests\Unit\Service;

use App;
use App\Repositories\Rookie\GameCodeRepository;
use App\Services\Rookie\GameCodeService;
use Mockery;
use PHPUnit\Framework\TestCase;

class GameCodeServiceTest extends TestCase
{
    public function testGetGameCodeList()
    {
        # Arrange
        $aExpected = [
            3001 => [
                1 => 'A',
                2 => 'B',
            ],
        ];

        $mockGameCode = Mockery::mock(GameCodeRepository::class);
        $mockGameCode->shouldReceive('getGameCodeList')->andReturn([
            [
                'GameType'     => 3001,
                'GameCode'     => 1,
                'GameCodeName' => 'A',
                'WagersType'   => 0,
            ],
            [
                'GameType'     => 3001,
                'GameCode'     => 2,
                'GameCodeName' => 'B',
                'WagersType'   => 0,
            ],
        ]);
        App::instance(GameCodeRepository::class, $mockGameCode);

        # Act
        $aActual = App::make(GameCodeService::class)->getGameCodeList();
        # Assert
        $this->assertEquals($aExpected, $aActual);
    }

    public function testGetGameCodeListByCondition()
    {
        # Arrange
        $iGameType = 3001;
        $aExpected = [
            3001 => [
                1 => 'A',
                2 => 'B',
            ],
        ];

        $mockGameCode = Mockery::mock(GameCodeRepository::class);
        $mockGameCode->shouldReceive('getGameCodeListByCondition')->with($iGameType)->andReturn([
            [
                'GameType'     => 3001,
                'GameCode'     => 1,
                'GameCodeName' => 'A',
                'WagersType'   => 0,
            ],
            [
                'GameType'     => 3001,
                'GameCode'     => 2,
                'GameCodeName' => 'B',
                'WagersType'   => 0,
            ],
        ]);
        App::instance(GameCodeRepository::class, $mockGameCode);

        # Act
        $aActual = App::make(GameCodeService::class)->getGameCodeListByCondition($iGameType);
        # Assert
        $this->assertEquals($aExpected, $aActual);
    }

    // public function testGetGameTypeList()
    // {
    //     # Arrange
    //     $aExpected = [
    //         3001, 3003, 3008, 3011
    //     ];

    //     # Act
    //     $aActual = App::make(GameCodeService::class)->getGameTypeList();
    //     # Assert
    //     $this->assertEquals($aExpected, $aActual);
    // }

    // public function testGetGameTypeList1()
    // {
    //     # Arrange
    //     $aExpected = [
    //         3001, 3003, 3008, 3011
    //     ];

    //     # Act
    //     $aActual = App::make(GameCodeService::class)->getGameTypeList1();
    //     # Assert
    //     $this->assertEquals($aExpected, $aActual);
    // }
}
