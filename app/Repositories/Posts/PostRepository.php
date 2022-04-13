<?php

namespace App\Repositories\Posts;

use App\Models\Post;

class PostRepository
{
    private $oPost;

    public function __construct(Post $_oPost)
    {
        $this->oPost = $_oPost;
    }

    public function getPostList()
    {
        return $this->oPost
            ->get()
            ->toArray();
    }

    // public function getPostListByCondition(int $_iUserId)
    // {
    //     return $this->oPost
    //         ->where(['user_id' => $_iUserId])
    //         ->get()
    //         ->toArray();
    // }
}