<?php

namespace App\Repositories\Posts;

use App\Models\User;


class UserRepository
{
    private $oUser;

    public function __construct(User $_oUser)
    {
        $this->oUser = $_oUser;
    }

    public function getUserList() :array
    {
        return $this->oUser
                    ->get()
                    ->toArray();
    }

    
    // public function addNewUser(int $_iUserId, string $_sContent) :array
    // {
    //     return $this->oUser
    //                 ->create(['user_id' => $_iUserId, 'content' => $_sContent])
    //                 ->toArray();
    // }

    // public function editUser(int $_iId, string $_sContent) :bool
    // {
    //     return $this->oUser
    //                 ->where(['id' => $_iId])
    //                 ->update(['content' => $_sContent]);
    // }

    // public function getUserListByCondition(int $_iId) :array
    // {
    //     return $this->oUser
    //                 ->where(['id' => $_iId])
    //                 ->first()
    //                 ->toArray();

    // }

    // public function deleteUser(int $_iId) :bool
    // {
    //     return $this->oUser
    //                 ->where(['id' => $_iId])
    //                 ->delete();
    // }
}