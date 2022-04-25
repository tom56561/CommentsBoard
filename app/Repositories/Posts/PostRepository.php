<?php

namespace App\Repositories\Posts;

use App\Models\Posts\Posts;


class PostRepository
{
    private $oPost;

    public function __construct(Posts $_oPost)
    {
        $this->oPost = $_oPost;
    }

    public function getPostListByDesc() :array
    {
        return $this->oPost
                    ->orderBy('id','DESC')
                    ->join('users','posts.user_id', '=', 'users.id')
                    ->select('posts.*', 'users.name')
                    ->get()
                    ->toArray();
    }

    public function addNewPost(int $_iUserId, string $_sContent) :array
    {
        return $this->oPost
                    ->create(['user_id' => $_iUserId, 'content' => $_sContent])
                    ->toArray();
    }

    public function editPost(int $_iId, string $_sContent) :bool
    {
        return $this->oPost
                    ->where(['id' => $_iId])
                    ->update(['content' => $_sContent]);
    }

    public function getPostListByCondition(int $_iId) :array
    {
        return $this->oPost
                    ->where(['id' => $_iId])
                    ->first()
                    ->toArray();

    }

    public function deletePost(int $_iId) :bool
    {
        return $this->oPost
                    ->where(['id' => $_iId])
                    ->delete();
    }
}