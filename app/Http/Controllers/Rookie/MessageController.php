<?php

namespace App\Http\Controllers\Rookie;

use App\Http\Controllers\Controller;
use App\Services\Rookie\MessageService;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    private $oMessageService;

    public function __construct(MessageService $_oMessageService)
    {
        $this->oMessageService = $_oMessageService;
    }

    public function getMessage()
    {
        return "getMessage";
    }
}