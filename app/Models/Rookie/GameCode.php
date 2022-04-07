<?php

namespace App\Models\Rookie;

use Illuminate\Database\Eloquent\Model;

class GameCode extends Model
{
    //指定連接的DB名稱
    protected $connection = 'Rookie';
    //指定Table名稱
    protected $table = 'GameCode';
    //主鍵名稱
    protected $primaryKey = ['GameType', 'GameCode'];
    //對應現有DB設定
    public $timestamps = false;
    public $incrementing = false;
}
