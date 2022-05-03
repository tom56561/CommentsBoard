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
}
