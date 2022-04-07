<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Rookie\MessageService;
use App\Services\Rookie\GameCodeService;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function getTest()
    {
        return 'test';
    }
}