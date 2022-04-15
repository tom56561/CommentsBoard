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

    public function getPostListByDesc()
    {
        return $this->oPost
            ->orderBy('id','DESC')
            ->get()
            ->toArray();
    }

    public function createNewData(array $data)
    {
        return $this->oPost->create($data);
    }



    // public function getPostListByCondition(int $_iUserId)
    // {
    //     return $this->oPost
    //         ->where(['user_id' => $_iUserId])
    //         ->get()
    //         ->toArray();
    // }
}