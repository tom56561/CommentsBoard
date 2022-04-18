<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'user_id', 'content',
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id','user_id');
    }
    // public function user()
    // {
    //     return $this->belongsTo('App\Models\User');
    // }
}
