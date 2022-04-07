<?php

namespace Tests\Unit\Repositories\Rookie;

use App;
use App\Models\Rookie\GameCode as GameCodeModel;
use App\Repositories\Rookie\GameCodeRepository;
use Mockery;
use Tests\TestCase;

class GameCodeRepositoryTest extends TestCase
{
    public function testGetGameCodeList()
    {
        # Arrange

        # Mockery
        $oGameCode = Mockery::mock(GameCodeModel::class);
        $oGameCode->shouldReceive('get')->andReturn(Mockery::self())
            ->shouldReceive('toArray')->andReturn([
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
        # Act
        App::instance(GameCodeModel::class, $oGameCode);
        $aActual = App::make(GameCodeRepository::class)->getGameCodeList();

        # Assert
        $aExpected = [
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
        ];
        $this->assertEquals($aExpected, $aActual);
    }

    public function testGetGameCodeListByCondition()
    {
        # Arrange
        $iGameType      = 3001;

        # Mockery
        $oGameCode = Mockery::mock(GameCodeModel::class);
        $oGameCode->shouldReceive('where')->once()->with(['GameType' => $iGameType])->andReturn(Mockery::self())
            ->shouldReceive('get')->andReturn(Mockery::self())
            ->shouldReceive('toArray')->andReturn([
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
        # Act
        App::instance(GameCodeModel::class, $oGameCode);
        $aActual = App::make(GameCodeRepository::class)->getGameCodeListByCondition($iGameType);

        # Assert
        $aExpected = [
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
        ];
        $this->assertEquals($aExpected, $aActual);
    }
}
